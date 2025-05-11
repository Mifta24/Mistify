<?php

namespace App\Services;

use App\Models\Order;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Cache;
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
            // Generate a unique transaction ID by adding timestamp
            $uniqueOrderId = $order->order_number . '-' . time();

            // Get base URL from config
            // $baseUrl = config('app.url');

            $params = [
                'transaction_details' => [
                    'order_id' => $uniqueOrderId, // Use unique ID instead of order_number
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

            // Store mapping of unique ID to original order number
            Cache::put('midtrans_order_' . $uniqueOrderId, $order->order_number, now()->addDays(1));

            Log::info('Midtrans Request:', [
                'params' => $params,
                'original_order' => $order->order_number,
                'unique_id' => $uniqueOrderId
            ]);

            $snapToken = Snap::getSnapToken($params);

            return $this->success([
                'snap_token' => $snapToken,
                'order_number' => $order->order_number,
                'unique_order_id' => $uniqueOrderId // Pass this to the view
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
