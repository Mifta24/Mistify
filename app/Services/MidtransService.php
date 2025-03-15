<?php

namespace App\Services;

use App\Models\Order;
use Illuminate\Support\Facades\Log;
use \Midtrans\Config as MidtransConfig;
use \Midtrans\Snap;

class MidtransService extends BaseService
{
    public function __construct()
    {
        // Always use sandbox mode for development
        // MidtransConfig::$merchantId = config('midtrans.merchant_id');
        MidtransConfig::$serverKey = config('midtrans.server_key');
        MidtransConfig::$clientKey = config('midtrans.client_key');
        MidtransConfig::$isProduction = false; // Force sandbox mode
        MidtransConfig::$is3ds = true;

        // Set sandbox API endpoints
        MidtransConfig::$isSanitized = true;
        MidtransConfig::$appendNotifUrl = "";
        MidtransConfig::$overrideNotifUrl = "";
    }

    // public function createTransaction(Order $order)
    // {
    //     try {
    //         $params = [
    //             'transaction_details' => [
    //                 'order_id' => $order->order_number,
    //                 'gross_amount' => (int) $order->total_price,
    //             ],
    //             'customer_details' => [
    //                 'first_name' => $order->shipping_name,
    //                 'email' => $order->user->email,
    //                 'phone' => $order->shipping_phone,
    //             ],
    //             'enabled_payments' => [
    //                 'gopay', 'bank_transfer', 'bca_va', 'bni_va',
    //                 'bri_va', 'echannel', 'permata_va'
    //             ],
    //             'callbacks' => [
    //                 'finish' => route('payment.finish', $order),
    //                 'error' => route('payment.error', $order),
    //                 'cancel' => route('payment.cancel', $order)
    //             ]
    //         ];

    //         Log::info('Midtrans Request:', $params);
    //         $snapToken = Snap::getSnapToken($params);

    //         return $this->success([
    //             'snap_token' => $snapToken,
    //             'client_key' => MidtransConfig::$clientKey,
    //             'is_production' => false
    //         ]);

    //     } catch (\Exception $e) {
    //         Log::error('Midtrans Error: ' . $e->getMessage());
    //         return $this->error($e->getMessage());
    //     }
    // }

    public function createTransaction(Order $order)
    {
        try {
            // Get ngrok URL from config or environment
            $baseUrl = config('app.url'); // Make sure this is set to your ngrok URL

            $params = [
                'transaction_details' => [
                    'order_id' => $order->order_number,
                    'gross_amount' => (int) $order->total_price,
                ],
                'customer_details' => [
                    'first_name' => $order->shipping_name,
                    'email' => $order->user->email,
                    'phone' => $order->shipping_phone,
                ],
                'enabled_payments' => [
                    'gopay',
                    'bank_transfer',
                    'bca_va',
                    'bni_va',
                    'bri_va',
                    'echannel',
                    'permata_va'
                ],
                'callbacks' => [
                    'finish' => route('payment.finish', $order->order_number),
                    'error' => route('payment.error', $order->order_number),
                    'cancel' => route('payment.cancel', $order->order_number)
                ]
            ];

            Log::info('Midtrans Request:', $params);
            $snapToken = Snap::getSnapToken($params);

            return $this->success([
                'snap_token' => $snapToken,
                'order_number' => $order->order_number
            ]);
        } catch (\Exception $e) {
            Log::error('Midtrans Error:', [
                'message' => $e->getMessage(),
                'order_number' => $order->order_number
            ]);
            return $this->error($e->getMessage());
        }
    }
}
