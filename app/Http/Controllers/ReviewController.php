<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Models\ProductReview;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function create(Order $order, Product $product)
    {
        // Check if order belongs to user
        if ($order->user_id !== auth()->id()) {
            abort(403);
        }

        // Check if order is delivered
        if ($order->status !== Order::STATUS_DELIVERED) {
            return back()->with('error', 'You can only review products from delivered orders.');
        }

        // Check if review already exists
        $existingReview = ProductReview::where([
            'user_id' => auth()->id(),
            'product_id' => $product->id,
            'order_id' => $order->id
        ])->first();

        if ($existingReview) {
            return back()->with('error', 'You have already reviewed this product.');
        }

        return view('front.reviews.create', compact('order', 'product'));
    }

    public function store(Request $request, Order $order, Product $product)
    {
        $request->validate([
            'rating' => 'required|integer|between:1,5',
            'comment' => 'nullable|string|max:500'
        ]);

        // Check if order belongs to user
        if ($order->user_id !== auth()->id()) {
            abort(403);
        }

        // Check if order is delivered
        if ($order->status !== Order::STATUS_DELIVERED) {
            return back()->with('error', 'You can only review products from delivered orders.');
        }

        // Create review
        ProductReview::create([
            'user_id' => auth()->id(),
            'product_id' => $product->id,
            'order_id' => $order->id,
            'rating' => $request->rating,
            'comment' => $request->comment
        ]);

        return redirect()->route('orders.show', $order->order_number)
            ->with('success', 'Thank you for your review!');
    }
}
