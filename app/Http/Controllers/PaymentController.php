<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Payment;
use Illuminate\Http\Request;
use App\Services\MidtransService;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Cache;

class PaymentController extends Controller
{

    protected $midtransService;

    public function __construct(MidtransService $midtransService)
    {
        $this->midtransService = $midtransService;
    }


    public function index(Order $order)
    {
        // Check if order belongs to authenticated user
        if ($order->user_id !== auth()->id()) {
            abort(403, 'Unauthorized action.');
        }

        // Check if order is already paid
        if ($order->payment_status === Order::PAYMENT_PAID) {
            return redirect()->route('orders.show', $order->order_number)
                ->with('info', 'This order has already been paid.');
        }

        return view('front.payment.index', compact('order'));
    }

    public function process(Request $request, Order $order)
    {
        $request->validate([
            'payment_method' => 'required|in:bank_transfer,e_wallet',
        ]);

        try {
            DB::beginTransaction();

            if ($order->user_id !== auth()->id()) {
                throw new \Exception('Unauthorized action.');
            }

            if ($order->payment_status === Order::PAYMENT_PAID) {
                throw new \Exception('This order has already been paid.');
            }

            $order->update([
                'payment_method' => $request->payment_method
            ]);

            if ($request->payment_method === 'bank_transfer') {
                $bankDetails = [
                    'bank_name' => 'Bank Central Asia (BCA)',
                    'account_number' => '1234567890',
                    'account_name' => 'PT Mistify Indonesia',
                    'amount' => $order->total_price,
                ];

                DB::commit();

                return view('front.payment.instructions', compact('order', 'bankDetails'));
            }

            if ($request->payment_method === 'e_wallet') {
                $result = $this->midtransService->createTransaction($order);

                if (!$result['success']) {
                    throw new \Exception($result['message']);
                }

                DB::commit();

                return view('front.midtrans.payment', [
                    'order' => $order,
                    'snapToken' => $result['data']['snap_token']
                ]);
            }

            throw new \Exception('Invalid payment method.');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Payment Error: ' . $e->getMessage());

            return redirect()->back()
                ->with('error', $e->getMessage())
                ->withInput();
        }
    }


    public function callback(Request $request)
    {
        try {
            // Debug full request
            Log::info('Midtrans Webhook Received:', [
                'data' => $request->all(),
                'headers' => $request->headers->all()
            ]);

            DB::beginTransaction();

            // Extract original order number from transaction ID
            $orderNumber = $request->order_id;

            // If this is a unique ID with timestamp (contains hyphen)
            if (strpos($orderNumber, '-') !== false) {
                // Try to get the original order number from cache
                $originalOrderNumber = Cache::get('midtrans_order_' . $orderNumber);

                if ($originalOrderNumber) {
                    $orderNumber = $originalOrderNumber;
                    Log::info('Resolved original order number from cache', [
                        'unique_id' => $request->order_id,
                        'original_order' => $orderNumber
                    ]);
                } else {
                    // Fallback: extract the part before the timestamp
                    $orderNumber = explode('-', $orderNumber)[0];
                    Log::info('Extracted original order number from transaction ID', [
                        'unique_id' => $request->order_id,
                        'extracted_order' => $orderNumber
                    ]);
                }
            }

            $order = Order::where('order_number', $orderNumber)->firstOrFail();

            // Update order status
            switch ($request->transaction_status) {
                case 'capture':
                case 'settlement':
                    $order->forceFill([
                        'payment_status' => Order::PAYMENT_PAID,
                        'status' => Order::STATUS_PROCESSING,
                        'paid_at' => now(),
                        'payment_details' => [
                            'transaction_id' => $request->transaction_id,
                            'payment_type' => $request->payment_type,
                            'transaction_time' => $request->transaction_time,
                            'transaction_status' => $request->transaction_status,
                            'gross_amount' => $request->gross_amount,
                            'midtrans_order_id' => $request->order_id // Store the unique ID
                        ]
                    ])->save();

                    // Update payment record
                    $payment = Payment::where('order_id', $order->id)->first();
                    if ($payment) {
                        $payment->update([
                            'status' => Payment::STATUS_COMPLETED,
                            'paid_at' => now(),
                            'notes' => 'Payment completed via ' . $request->payment_type
                        ]);
                    }

                    Log::info('Payment marked as PAID:', [
                        'order_number' => $order->order_number,
                        'transaction_id' => $request->transaction_id,
                        'midtrans_order_id' => $request->order_id
                    ]);
                    break;

                default:
                    $order->update([
                        'status' => Order::STATUS_PENDING,
                        'payment_status' => Order::PAYMENT_UNPAID
                    ]);
                    break;
            }

            DB::commit();

            return response()->json(['status' => 'success']);
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Payment Callback Error:', [
                'message' => $e->getMessage(),
                'order_id' => $request->order_id ?? null
            ]);

            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function handleError(Order $order)
    {
        return redirect()->route('payment.index', $order->order_number)
            ->with('error', 'Payment failed. Please try again.');
    }

    public function handleCancel(Order $order)
    {
        return redirect()->route('payment.index', $order->order_number)
            ->with('info', 'Payment was cancelled.');
    }

    public function handleFinish(Order $order)
    {
        try {
            // Double check payment status
            $order->refresh(); // Refresh order from database

            if ($order->payment_status === Order::PAYMENT_PAID) {
                return redirect()->route('orders.show', $order->order_number)
                    ->with('success', 'Payment completed successfully!');
            }

            // If not paid, might still be processing
            return redirect()->route('orders.show', $order->order_number)
                ->with('info', 'Payment is being processed. We will notify you once confirmed.');
        } catch (\Exception $e) {
            Log::error('Payment Finish Error: ' . $e->getMessage());
            return redirect()->route('payment.index', $order->order_number)
                ->with('error', 'Error checking payment status. Please contact support.');
        }
    }

    public function instructions(Order $order)
    {
        if ($order->user_id !== auth()->id()) {
            abort(403, 'Unauthorized action.');
        }

        if ($order->payment_method !== 'bank_transfer') {
            return redirect()->route('payment.index', $order->order_number)
                ->with('info', 'Invalid payment method.');
        }

        $bankDetails = session('bankDetails') ?? [
            'bank_name' => 'Bank Central Asia (BCA)',
            'account_number' => '1234567890',
            'account_name' => 'PT Mistify Indonesia',
            'amount' => $order->total_price,
        ];

        return view('front.payment.instructions', compact('order', 'bankDetails'));
    }
}
