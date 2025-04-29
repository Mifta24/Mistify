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

    public function products(Request $request)
    {
        // Get categories
        $categories = Category::where('is_active', true)
            ->orderBy('sort_order')
            ->get(['id', 'name']);

        // Initialize product query
        $query = Product::with('category');

        // Apply category filter
        if ($request->filled('category')) {
            $query->where('category_id', $request->category);
        }

        // Apply search filter
        if ($request->filled('search')) {
            $searchTerm = '%' . $request->search . '%';
            $query->where(function($q) use ($searchTerm) {
                $q->where('name', 'like', $searchTerm)
                  ->orWhere('description', 'like', $searchTerm);
            });
        }

        // Apply sorting
        if ($request->filled('sort')) {
            switch ($request->sort) {
                case 'price_asc':
                    $query->orderBy('price', 'asc');
                    break;
                case 'price_desc':
                    $query->orderBy('price', 'desc');
                    break;
                case 'newest':
                    $query->latest();
                    break;
                default:
                    $query->latest();
            }
        } else {
            $query->latest(); // Default sorting
        }

        // Get paginated results with query string
        $products = $query->paginate(12)->withQueryString();

        // Pass current filters to view
        $filters = [
            'category' => $request->category,
            'sort' => $request->sort,
            'search' => $request->search
        ];

        return view('front.products', compact('products', 'categories', 'filters'));
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
