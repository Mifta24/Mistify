<?php

return [
    'merchant_id' => env('MIDTRANS_MERCHANT_ID'),
    'client_key' => env('MIDTRANS_CLIENT_KEY'),
    'server_key' => env('MIDTRANS_SERVER_KEY'),
    'is_production' => env('MIDTRANS_IS_PRODUCTION', false),
    'is_sanitized' => env('MIDTRANS_IS_SANITIZED', true),
    'is_3ds' => env('MIDTRANS_IS_3DS', true),

     // Add these
     'notification_url' => env('MIDTRANS_NOTIFICATION_URL', 'api/webhooks/midtrans'),
     'finish_url' => env('MIDTRANS_FINISH_URL', 'payment/{order}/finish'),
     'error_url' => env('MIDTRANS_ERROR_URL', 'payment/{order}/error'),
     'cancel_url' => env('MIDTRANS_CANCEL_URL', 'payment/{order}/cancel'),
];

