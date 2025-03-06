<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CheckoutController extends Controller
{
    public function index()
    {
        if (!session()->has('cart') || empty(session('cart'))) {
            return redirect()->route('cart.index')
                ->with('error', 'Your cart is empty!');
        }

        $cartItems = session()->get('cart');
        $subtotal = $this->calculateSubtotal($cartItems);
        $shipping = 10000; // You can make this dynamic based on location
        $total = $subtotal + $shipping;

        return view('front.checkout.index', compact('cartItems', 'subtotal', 'shipping', 'total'));
    }

    public function process(Request $request)
    {
        // Validate request
        $request->validate([
            'shipping.name' => 'required|string|max:255',
            'shipping.phone' => 'required|string|max:20',
            'shipping.address' => 'required|string',
            'shipping.city' => 'required|string|max:255',
            'shipping.postal_code' => 'required|string|max:10',
            'payment_method' => 'required|in:bank_transfer,e_wallet'
        ]);

        $cart = session()->get('cart');

        if (!$cart) {
            return redirect()->route('cart.index')
                ->with('error', 'Your cart is empty!');
        }

        try {
            DB::beginTransaction();

            // Calculate totals
            $subtotal = $this->calculateSubtotal($cart);
            $shipping = 10000;
            $total = $subtotal + $shipping;

            // Create order
            $order = Order::create([
                'user_id' => Auth::id(),
                'order_number' => 'ORD-' . uniqid(),
                'total_price' => $total,
                'shipping_fee' => $shipping,
                'status' => 'pending',
                'payment_status' => 'unpaid',
                'shipping_name' => $request->input('shipping.name'),
                'shipping_phone' => $request->input('shipping.phone'),
                'shipping_address' => $request->input('shipping.address'),
                'shipping_city' => $request->input('shipping.city'),
                'shipping_postal_code' => $request->input('shipping.postal_code'),
                'notes' => $request->input('shipping.notes'),
                'payment_method' => $request->input('payment_method')
            ]);

            // Create order items
            foreach ($cart as $id => $item) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $id,
                    'quantity' => $item['quantity'],
                    'price' => $item['price']
                ]);
            }

            DB::commit();
            session()->forget('cart');

            return redirect()->route('orders.show', $order)
                ->with('success', 'Order placed successfully!');

        } catch (\Exception $e) {
            DB::rollBack();

            return redirect()->back()
                ->with('error', 'Failed to process your order. Please try again.')
                ->withInput();
        }
    }

    private function calculateSubtotal($cartItems)
    {
        return collect($cartItems)->sum(function ($item) {
            return $item['price'] * $item['quantity'];
        });
    }
}
