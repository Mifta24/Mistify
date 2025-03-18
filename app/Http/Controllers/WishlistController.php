<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class WishlistController extends Controller
{
    public function index()
    {
        $items = auth()->user()->wishlist()->latest()->paginate(12);
        return view('front.wishlist.index', compact('items'));
    }

    public function toggle(Request $request, Product $product)
    {
        $user = auth()->user();

        if ($user->hasInWishlist($product)) {
            $user->wishlist()->detach($product);
            $message = 'Product removed from wishlist';
            $added = false;
        } else {
            $user->wishlist()->attach($product);
            $message = 'Product added to wishlist';
            $added = true;
        }

        if ($request->wantsJson()) {
            return response()->json([
                'message' => $message,
                'added' => $added
            ]);
        }

        return back()->with('success', $message);
    }
}
