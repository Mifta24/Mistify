<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::with(['items.product'])
            ->where('user_id', Auth::id())
            ->latest()
            ->paginate(10);

        return view('front.orders.index', compact('orders'));
    }

    public function show($orderNumber)
    {
        $order = Order::with(['items.product'])
            ->where('user_id', Auth::id())
            ->where('order_number', $orderNumber)
            ->firstOrFail();

        return view('front.orders.show', compact('order'));
    }

    public function cancel($orderNumber)
    {
        $order = Order::where('user_id', Auth::id())
            ->where('order_number', $orderNumber)
            ->firstOrFail();

        if (!$order->canBeCancelled()) {
            return back()->with('error', 'This order cannot be cancelled.');
        }

        $order->updateStatus(Order::STATUS_CANCELLED);

        return back()->with('success', 'Order has been cancelled successfully.');
    }

    public function track($orderNumber)
    {
        $order = Order::where('user_id', Auth::id())
            ->where('order_number', $orderNumber)
            ->firstOrFail();

        return view('front.orders.track', compact('order'));
    }

    public function print(Order $order)
{
    // Allow both admin and order owner to print
    if ($order->user_id !== auth()->id() && !auth()->user()->is_admin) {
        abort(403);
    }

    return view('front.orders.print', compact('order'));
}
}
