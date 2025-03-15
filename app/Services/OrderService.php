<?php

namespace App\Services;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class OrderService extends BaseService
{
    public function create(array $data, array $items)
    {
        try {
            DB::beginTransaction();

            // Create order
            $order = Order::create([
                'user_id' => auth()->id(),
                'order_number' => 'ORD-' . uniqid(),
                'total_price' => $data['total_price'],
                'shipping_fee' => $data['shipping_fee'],
                'status' => Order::STATUS_PENDING,
                'payment_status' => Order::PAYMENT_UNPAID,
                'shipping_name' => $data['shipping']['name'],
                'shipping_phone' => $data['shipping']['phone'],
                'shipping_address' => $data['shipping']['address'],
                'shipping_city' => $data['shipping']['city'],
                'shipping_postal_code' => $data['shipping']['postal_code'],
                'notes' => $data['shipping']['notes'] ?? null,
            ]);

            // Create order items
            foreach ($items as $item) {
                $product = Product::findOrFail($item['product_id']);

                if ($product->stock < $item['quantity']) {
                    throw new \Exception("Insufficient stock for {$product->name}");
                }

                $order->items()->create([
                    'product_id' => $item['product_id'],
                    'quantity' => $item['quantity'],
                    'price' => $item['price']
                ]);

                // Update product stock
                $product->decrement('stock', $item['quantity']);
            }

            DB::commit();

            return $this->success($order, 'Order created successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Order Creation Error: ' . $e->getMessage());

            return $this->error($e->getMessage());
        }
    }

    public function updateStatus(Order $order, string $status)
    {
        try {
            if (!$order->canUpdateStatus($status)) {
                throw new \Exception('Invalid status transition');
            }

            $order->updateStatus($status);

            return $this->success($order, 'Order status updated successfully');
        } catch (\Exception $e) {
            Log::error('Order Status Update Error: ' . $e->getMessage());

            return $this->error($e->getMessage());
        }
    }

    public function cancel(Order $order)
    {
        try {
            if (!$order->canBeCancelled()) {
                throw new \Exception('This order cannot be cancelled');
            }

            DB::beginTransaction();

            // Restore product stock
            foreach ($order->items as $item) {
                $item->product->increment('stock', $item->quantity);
            }

            $order->updateStatus(Order::STATUS_CANCELLED);

            DB::commit();

            return $this->success($order, 'Order cancelled successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Order Cancellation Error: ' . $e->getMessage());

            return $this->error($e->getMessage());
        }
    }
}
