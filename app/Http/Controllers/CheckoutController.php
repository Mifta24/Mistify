<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    public function index()
    {
        if (!session()->has('cart') || empty(session('cart'))) {
            return redirect()->route('cart.index')->with('error', 'Keranjang kosong!');
        }

        return view('front.checkout.index');
    }

    public function process(Request $request)
    {
        $cart = session()->get('cart');

        if (!$cart) {
            return redirect()->route('cart.index')->with('error', 'Keranjang kosong!');
        }

        $order = Order::create([
            'user_id' => Auth::id(),
            'total' => array_sum(array_column($cart, 'price')),
            'status' => 'pending'
        ]);

        session()->forget('cart');

        return redirect()->route('orders.index')->with('success', 'Pesanan berhasil dibuat!');
    }
}
