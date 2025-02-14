<?php

namespace App\Http\Controllers;

use App\Http\Resources\Product;
use Illuminate\Http\Request;

class FrontController extends Controller
{

    public function dashboard()
    {
        return view('index');
    }

    public function contact()
    {
        return view('front.contact');
    }

    public function products()
    {
        $products = Product::paginate(12); // Menampilkan 12 produk per halaman
        return view('front.products',compact('products'));
    }



    public function product($slug)
    {
        $product = Product::where('slug', $slug)->firstOrFail();
        return view('front.product',compact('product'));
    }

   



}
