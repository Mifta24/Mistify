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
        return view('front.products');
    }



    public function product(Product $product)
    {
        return view('front.product');
    }

    public function cart()
    {
        return view('front.cart');
    }

    public function checkout()
    {
        return view('front.checkout');
    }



}
