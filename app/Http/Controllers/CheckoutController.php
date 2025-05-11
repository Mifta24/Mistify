<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Payment;
use App\Models\Product;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

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

            // Validate products and stock
            foreach ($cart as $id => $item) {
                $product = Product::findOrFail($id);

                if ($product->stock < $item['quantity']) {
                    throw new \Exception("Insufficient stock for {$product->name}");
                }
            }

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

            // Create payment record
            Payment::create([
                'order_id' => $order->id,
                'payment_number' => 'PAY-' . uniqid(),
                'amount' => $total,
                'payment_method' => $request->input('payment_method'),
                'status' => Payment::STATUS_PENDING,
                'bank_name' => null,
                'account_number' => null,
                'account_name' => null,
                'notes' => null,
                'paid_at' => null
            ]);
            // Create order items and update stock
            foreach ($cart as $id => $item) {
                $product = Product::findOrFail($id);

                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $id,
                    'product_name' => $product->name,
                    'quantity' => $item['quantity'],
                    'price' => $item['price'],
                    'subtotal' => $item['price'] * $item['quantity']
                ]);

                // Decrease product stock
                $product->decrement('stock', $item['quantity']);
            }

            DB::commit();
            session()->forget('cart');

            return redirect()->route('payment.index', $order->order_number)
                ->with('success', 'Order placed successfully!');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Checkout Error: ' . $e->getMessage());

            return redirect()->back()
                ->with('error', $e->getMessage())
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
