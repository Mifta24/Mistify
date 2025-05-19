<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\ProductReview;
use Illuminate\Http\Request;

class FrontController extends Controller
{

    public function dashboard()
    {
        // Get best-selling products by counting order items
        $products = Product::where('is_bestseller', true)
            ->take(3)
            ->get();
        // Category
        $categories = Category::where('is_active', true)
            ->orderBy('sort_order')
            ->take(5)
            ->get(['id', 'name']);

        // testimonials
        $testimonials = ProductReview::with('user')
            ->orderBy('created_at', 'desc')
            ->get();
        return view('index', compact('products', 'categories', 'testimonials'));
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
            $query->where(function ($q) use ($searchTerm) {
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
        // Eager load category and reviews to avoid N+1 query issues
        $product = Product::with(['category', 'reviews'])
            ->where('slug', $slug)
            ->firstOrFail();

        // Get similar products using multiple criteria for perfume matching
        $similarProducts = $this->getSimilarPerfumes($product);

        return view('front.detail-product', compact('product', 'similarProducts'));
    }

    /**
     * Get similar perfumes based on multiple attributes
     *
     * This method finds similar perfumes using a weighted approach:
     * 1. First priority: Same fragrance family and gender
     * 2. Second priority: Same fragrance family
     * 3. Third priority: Same brand
     * 4. Fourth priority: Same category
     *
     * @param Product $product
     * @param int $limit
     * @return \Illuminate\Database\Eloquent\Collection
     */
    private function getSimilarPerfumes(Product $product, int $limit = 4)
    {
        // Start with basic query excluding the current product
        $baseQuery = Product::where('id', '!=', $product->id)
            ->where('is_active', true)
            ->with('category');

        // Collection to store our results
        $similarProducts = collect();

        // First priority: same fragrance family and gender
        if ($product->fragrance_family && $product->gender) {
            $fragFamilyAndGender = (clone $baseQuery)
                ->where('fragrance_family', $product->fragrance_family)
                ->where('gender', $product->gender)
                ->inRandomOrder()
                ->take($limit)
                ->get();

            $similarProducts = $similarProducts->merge($fragFamilyAndGender);
        }

        // If we still need more products, try same fragrance family
        if ($similarProducts->count() < $limit && $product->fragrance_family) {
            $fragFamily = (clone $baseQuery)
                ->where('fragrance_family', $product->fragrance_family)
                ->whereNotIn('id', $similarProducts->pluck('id'))
                ->inRandomOrder()
                ->take($limit - $similarProducts->count())
                ->get();

            $similarProducts = $similarProducts->merge($fragFamily);
        }

        // If we still need more, try same brand
        if ($similarProducts->count() < $limit && $product->brand) {
            $sameBrand = (clone $baseQuery)
                ->where('brand', $product->brand)
                ->whereNotIn('id', $similarProducts->pluck('id'))
                ->inRandomOrder()
                ->take($limit - $similarProducts->count())
                ->get();

            $similarProducts = $similarProducts->merge($sameBrand);
        }

        // If we still need more, try same concentration
        if ($similarProducts->count() < $limit && $product->concentration) {
            $sameConcentration = (clone $baseQuery)
                ->where('concentration', $product->concentration)
                ->whereNotIn('id', $similarProducts->pluck('id'))
                ->inRandomOrder()
                ->take($limit - $similarProducts->count())
                ->get();

            $similarProducts = $similarProducts->merge($sameConcentration);
        }

        // If we still need more, try same category
        if ($similarProducts->count() < $limit) {
            $sameCategory = (clone $baseQuery)
                ->where('category_id', $product->category_id)
                ->whereNotIn('id', $similarProducts->pluck('id'))
                ->inRandomOrder()
                ->take($limit - $similarProducts->count())
                ->get();

            $similarProducts = $similarProducts->merge($sameCategory);
        }

        // If we still don't have enough, get any products
        if ($similarProducts->count() < $limit) {
            $anyProducts = (clone $baseQuery)
                ->whereNotIn('id', $similarProducts->pluck('id'))
                ->inRandomOrder()
                ->take($limit - $similarProducts->count())
                ->get();

            $similarProducts = $similarProducts->merge($anyProducts);
        }

        // Return as collection limited to requested number
        return $similarProducts->take($limit);
    }
}
