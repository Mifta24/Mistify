<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order #{{ $order->order_number }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        @media print {
            .no-print {
                display: none !important;
            }
            body {
                padding: 0;
                background: white;
            }
            .container {
                width: 100%;
                max-width: none;
                padding: 0;
                margin: 0;
            }
        }
    </style>
</head>
<body class="bg-light">
    <div class="container py-5">
        <!-- Print Header -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h1 class="h3 mb-0">Order #{{ $order->order_number }}</h1>
                <p class="text-muted mb-0">{{ $order->created_at->format('d M Y, H:i') }}</p>
            </div>
            <button class="btn btn-primary no-print" onclick="window.print()">
                <i class="bi bi-printer"></i> Print
            </button>
        </div>

        <!-- Order Status -->
        <div class="card mb-4">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <p class="mb-1"><strong>Status:</strong>
                            <span class="badge bg-{{ $order->status_color }}">
                                {{ ucfirst($order->status) }}
                            </span>
                        </p>
                        <p class="mb-0"><strong>Payment Status:</strong>
                            <span class="badge bg-{{ $order->payment_status_color }}">
                                {{ ucfirst($order->payment_status) }}
                            </span>
                        </p>
                    </div>
                    <div class="col-md-6">
                        <p class="mb-1"><strong>Payment Method:</strong> {{ strtoupper($order->payment_method) }}</p>
                        <p class="mb-0"><strong>Order Date:</strong> {{ $order->created_at->format('d M Y, H:i') }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Order Items -->
        <div class="card mb-4">
            <div class="card-body">
                <h5 class="card-title mb-4">Order Items</h5>
                <div class="table-responsive">
                    <table class="table table-borderless">
                        <thead class="table-light">
                            <tr>
                                <th>Product</th>
                                <th class="text-end">Price</th>
                                <th class="text-center">Quantity</th>
                                <th class="text-end">Subtotal</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($order->items as $item)
                                <tr>
                                    <td>{{ $item->product->name }}</td>
                                    <td class="text-end">Rp {{ number_format($item->price, 0, ',', '.') }}</td>
                                    <td class="text-center">{{ $item->quantity }}</td>
                                    <td class="text-end">Rp {{ number_format($item->price * $item->quantity, 0, ',', '.') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot class="table-light">
                            <tr>
                                <td colspan="3" class="text-end"><strong>Subtotal</strong></td>
                                <td class="text-end">Rp {{ number_format($order->subtotal, 0, ',', '.') }}</td>
                            </tr>
                            <tr>
                                <td colspan="3" class="text-end"><strong>Shipping</strong></td>
                                <td class="text-end">Rp {{ number_format($order->shipping_fee, 0, ',', '.') }}</td>
                            </tr>
                            <tr>
                                <td colspan="3" class="text-end"><strong>Total</strong></td>
                                <td class="text-end"><strong>Rp {{ number_format($order->total_price, 0, ',', '.') }}</strong></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>

        <!-- Shipping Information -->
        <div class="card">
            <div class="card-body">
                <h5 class="card-title mb-4">Shipping Information</h5>
                <div class="row">
                    <div class="col-md-6">
                        <p class="mb-1"><strong>Name:</strong> {{ $order->shipping_name }}</p>
                        <p class="mb-1"><strong>Phone:</strong> {{ $order->shipping_phone }}</p>
                        <p class="mb-1"><strong>Address:</strong> {{ $order->shipping_address }}</p>
                        <p class="mb-0"><strong>City:</strong> {{ $order->shipping_city }}, {{ $order->shipping_postal_code }}</p>
                    </div>
                    @if($order->notes)
                        <div class="col-md-6">
                            <p class="mb-1"><strong>Notes:</strong></p>
                            <p class="mb-0">{{ $order->notes }}</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</body>
</html>
