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
            $size = $request->size ?? $product->default_size;
            $price = $request->price ?? $product->price;

            if ($product->stock < $quantity) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Insufficient stock available!'
                ], 422);
            }

            $cart = session()->get('cart', []);
            $cartKey = $id;

            // If we're already using size-based variants, add the size to the cart key
            if ($size) {
                $cartKey = $id . '-' . $size;
            }

            if (isset($cart[$cartKey])) {
                $cart[$cartKey]['quantity'] += $quantity;
                if ($cart[$cartKey]['quantity'] > $product->stock) {
                    return response()->json([
                        'status' => 'error',
                        'message' => 'Requested quantity exceeds available stock!'
                    ], 422);
                }
            } else {
                // Find size data from product sizes array
                $sizeData = null;
                if (isset($product->sizes) && is_array($product->sizes)) {
                    foreach ($product->sizes as $sizeItem) {
                        $sizeItem = (array) $sizeItem;
                        if (isset($sizeItem['size']) && $sizeItem['size'] == $size) {
                            $sizeData = $sizeItem;
                            break;
                        }
                    }
                }

                $cart[$cartKey] = [
                    "name" => $product->name,
                    "price" => $price,
                    "quantity" => $quantity,
                    "size" => $size,
                    "image" => $product->image,
                    "category" => $product->category->name,
                    "brand" => $product->brand,
                    "slug" => $product->slug,
                    "sizes" => $product->sizes ?? []
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
                'message' => 'Failed to add product to cart: ' . $e->getMessage()
            ], 500);
        }
    }

    // public function update(Request $request, $id)
    // {
    //     try {
    //         $product = Product::findOrFail($id);
    //         $cart = session()->get('cart', []);

    //         if (!isset($cart[$id])) {
    //             return response()->json([
    //                 'status' => 'error',
    //                 'message' => 'Product not found in cart!'
    //             ], 404);
    //         }

    //         $quantity = max(1, min($request->quantity, $product->stock));
    //         $cart[$id]['quantity'] = $quantity;
    //         session()->put('cart', $cart);

    //         $subtotal = $this->calculateSubtotal($cart);
    //         $shipping = 10000;
    //         $total = $subtotal + $shipping;

    //         return response()->json([
    //             'status' => 'success',
    //             'message' => 'Cart updated successfully!',
    //             'quantity' => $quantity,
    //             'itemTotal' => $cart[$id]['price'] * $quantity,
    //             'subtotal' => $subtotal,
    //             'total' => $total
    //         ]);
    //     } catch (\Exception $e) {
    //         return response()->json([
    //             'status' => 'error',
    //             'message' => 'Failed to update cart!'
    //         ], 500);
    //     }
    // }


    public function update(Request $request, $id)
    {
        try {
            $cart = session()->get('cart', []);

            if (!isset($cart[$id])) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Product not found in cart!'
                ], 404);
            }

            // Handle quantity changes
            if ($request->has('quantity')) {
                $product = Product::findOrFail(explode('-', $id)[0]);  // Get base product ID if using size variant
                $quantity = max(1, min($request->quantity, $product->stock));
                $cart[$id]['quantity'] = $quantity;
            }

            // Handle size changes
            if ($request->has('size')) {
                $oldKey = $id;
                $productId = explode('-', $id)[0];  // Get base product ID if using size variant
                $product = Product::findOrFail($productId);

                // Get price for the new size
                $newSize = $request->size;
                $newPrice = $product->price; // Default price

                if (isset($product->sizes[$newSize])) {
                    if (is_array($product->sizes[$newSize])) {
                        $newPrice = $product->sizes[$newSize]['price'] ?? $product->price;
                    } else {
                        $newPrice = $product->sizes[$newSize];
                    }
                }

                // Create a new cart item with the new size
                $newKey = $productId . '-' . $newSize;

                // Only create a new entry if the size actually changed
                if ($oldKey != $newKey) {
                    // Copy the old cart item to the new key with new size and price
                    $cart[$newKey] = $cart[$oldKey];
                    $cart[$newKey]['size'] = $newSize;
                    $cart[$newKey]['price'] = $newPrice;

                    // Remove the old cart item
                    unset($cart[$oldKey]);
                }
            }

            session()->put('cart', $cart);

            $subtotal = $this->calculateSubtotal($cart);
            $shipping = 10000;
            $total = $subtotal + $shipping;

            return response()->json([
                'status' => 'success',
                'message' => 'Cart updated successfully!',
                'subtotal' => $subtotal,
                'total' => $total
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to update cart: ' . $e->getMessage()
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
