<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use App\Services\MidtransService;
use Illuminate\Support\Facades\Log;

class MidtransController extends Controller
{
    protected $midtransService;

    public function __construct(MidtransService $midtransService)
    {
        $this->midtransService = $midtransService;
    }


    public function createTransaction($orderId)
    {
        $order = Order::findOrFail($orderId);
        // Changed from getSnapToken to createTransaction
        $result = $this->midtransService->createTransaction($order);

        if (!$result['success']) {
            return response()->json([
                'error' => $result['message']
            ], 400);
        }

        return response()->json($result['data']);
    }


    public function handleNotification(Request $request)
    {
        try {
            $serverKey = config('midtrans.server_key');
            $hashed = hash("sha512", $request->order_id . $request->status_code . $request->gross_amount . $serverKey);

            if ($hashed != $request->signature_key) {
                return response()->json(['message' => 'Invalid Signature'], 403);
            }

            $order = Order::where('order_number', $request->order_id)->firstOrFail();

            switch ($request->transaction_status) {
                case 'capture':
                case 'settlement':
                    $order->update([
                        'status' => Order::STATUS_PROCESSING,
                        'payment_status' => Order::PAYMENT_PAID
                    ]);
                    break;
                case 'pending':
                    $order->update([
                        'status' => Order::STATUS_PENDING,
                        'payment_status' => Order::PAYMENT_UNPAID
                    ]);
                    break;
                case 'deny':
                case 'expire':
                case 'cancel':
                    $order->update([
                        'status' => Order::STATUS_CANCELLED,
                        'payment_status' => Order::PAYMENT_UNPAID
                    ]);
                    break;
            }

            return response()->json(['message' => 'Payment notification handled']);
        } catch (\Exception $e) {
            Log::error('Midtrans Notification Error: ' . $e->getMessage());
            return response()->json(['message' => 'Error processing notification'], 500);
        }
    }
}
