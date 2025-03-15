<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class FrontController extends Controller
{

    public function dashboard()
    {
        return view('index');
    }

    public function about()
    {
        return view('front.about');
    }

    public function services()
    {
        return view('front.services');
    }

    public function contact()
    {
        return view('front.contact');
    }

    public function products()
    {
        // menampilkan kategori
        $categories = Category::get('id', 'name');
        // menampilkan produk
        $products = Product::with('category')->paginate(12); // Menampilkan 12 produk per halaman
        return view('front.products', compact('products', 'categories'));
    }


    public function showProduct($slug)
    {
        // Eager load category and ensure product exists
        $product = Product::with('category')
            ->where('slug', $slug)
            ->firstOrFail();

        // Get related products from same category
        $relatedProducts = Product::with('category')
            ->where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)
            ->inRandomOrder()
            ->take(4)
            ->get();

        return view('front.detail-product', compact('product', 'relatedProducts'));
    }
}
