<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    public function index()
    {
        $cartItems = session()->get('cart', []);
        $subtotal = $this->calculateSubtotal($cartItems);
        $shipping = 10000; // You can make this dynamic based on location
        $total = $subtotal + $shipping;

        return view('front.cart', compact('cartItems', 'subtotal', 'shipping', 'total'));
    }

    public function store(Request $request, $id)
    {
        try {
            $product = Product::findOrFail($id);
            $quantity = $request->quantity ?? 1;

            if ($product->stock < $quantity) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Insufficient stock available!'
                ], 422);
            }

            $cart = session()->get('cart', []);

            if (isset($cart[$id])) {
                $cart[$id]['quantity'] += $quantity;
                if ($cart[$id]['quantity'] > $product->stock) {
                    return response()->json([
                        'status' => 'error',
                        'message' => 'Requested quantity exceeds available stock!'
                    ], 422);
                }
            } else {
                $cart[$id] = [
                    "name" => $product->name,
                    "price" => $product->price,
                    "quantity" => $quantity,
                    "image" => $product->image,
                    "category" => $product->category->name,
                    "slug" => $product->slug
                ];
            }

            session()->put('cart', $cart);

            return response()->json([
                'status' => 'success',
                'message' => 'Product added to cart successfully!',
                'cartCount' => count($cart),
                'cartTotal' => $this->calculateSubtotal($cart)
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to add product to cart!'
            ], 500);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $product = Product::findOrFail($id);
            $cart = session()->get('cart', []);

            if (!isset($cart[$id])) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Product not found in cart!'
                ], 404);
            }

            $quantity = max(1, min($request->quantity, $product->stock));
            $cart[$id]['quantity'] = $quantity;
            session()->put('cart', $cart);

            $subtotal = $this->calculateSubtotal($cart);
            $shipping = 10000;
            $total = $subtotal + $shipping;

            return response()->json([
                'status' => 'success',
                'message' => 'Cart updated successfully!',
                'quantity' => $quantity,
                'itemTotal' => $cart[$id]['price'] * $quantity,
                'subtotal' => $subtotal,
                'total' => $total
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to update cart!'
            ], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $cart = session()->get('cart', []);

            if (isset($cart[$id])) {
                unset($cart[$id]);
                session()->put('cart', $cart);

                return response()->json([
                    'status' => 'success',
                    'message' => 'Product removed from cart!',
                    'cartCount' => count($cart),
                    'cartTotal' => $this->calculateSubtotal($cart)
                ]);
            }

            return response()->json([
                'status' => 'error',
                'message' => 'Product not found in cart!'
            ], 404);

        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to remove product from cart!'
            ], 500);
        }
    }

    private function calculateSubtotal($cartItems)
    {
        return collect($cartItems)->sum(function ($item) {
            return $item['price'] * $item['quantity'];
        });
    }
}
