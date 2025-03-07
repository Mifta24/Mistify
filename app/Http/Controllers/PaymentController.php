<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PaymentController extends Controller
{
    public function index(Order $order)
    {
        // Check if order belongs to authenticated user
        if ($order->user_id !== auth()->id()) {
            abort(403, 'Unauthorized action.');
        }

        // Check if order is already paid
        if ($order->payment_status === Order::PAYMENT_PAID) {
            return redirect()->route('orders.show', $order)
                ->with('info', 'This order has already been paid.');
        }

        return view('front.payment.index', compact('order'));
    }

    public function process(Request $request, Order $order)
    {
        // Validate request
        $request->validate([
            'payment_method' => 'required|in:bank_transfer,e_wallet',
        ]);

        try {
            DB::beginTransaction();

            // Check if order belongs to authenticated user
            if ($order->user_id !== auth()->id()) {
                throw new \Exception('Unauthorized action.');
            }

            // Check if order is already paid
            if ($order->payment_status === Order::PAYMENT_PAID) {
                throw new \Exception('This order has already been paid.');
            }

            // Update order payment method
            $order->update([
                'payment_method' => $request->payment_method
            ]);

            // For bank transfer, show payment instructions
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

            // For e-wallet, redirect to payment gateway (implement your payment gateway here)
            if ($request->payment_method === 'e_wallet') {
                // Initialize payment gateway
                $paymentUrl = $this->initializePaymentGateway($order);

                DB::commit();

                return redirect()->away($paymentUrl);
            }

        } catch (\Exception $e) {
            DB::rollBack();

            return redirect()->back()
                ->with('error', $e->getMessage())
                ->withInput();
        }
    }

    public function callback(Request $request)
    {
        // Validate payment gateway callback
        $isValid = $this->validatePaymentCallback($request);

        if (!$isValid) {
            return response()->json(['status' => 'error'], 400);
        }

        try {
            DB::beginTransaction();

            // Get order from payment reference
            $order = Order::where('order_number', $request->order_number)->firstOrFail();

            // Update order status
            $order->update([
                'payment_status' => Order::PAYMENT_PAID,
                'status' => Order::STATUS_PROCESSING
            ]);

            DB::commit();

            return response()->json(['status' => 'success']);

        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json(['status' => 'error'], 500);
        }
    }

    private function initializePaymentGateway(Order $order)
    {
        // Implement your payment gateway initialization here
        // This is just a placeholder
        return "https://payment-gateway.com/pay/" . $order->order_number;
    }

    private function validatePaymentCallback(Request $request)
    {
        // Implement your payment gateway callback validation here
        // This is just a placeholder
        return true;
    }
}
