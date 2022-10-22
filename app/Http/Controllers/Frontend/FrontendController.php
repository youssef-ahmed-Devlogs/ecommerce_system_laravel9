<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductReview;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FrontendController extends Controller
{

    public function index()
    {
        $top4Categories = Category::limit(4)->orderBy('id', 'desc')->get();
        $topTrendingProducts = Product::limit(8)->orderBy('id', 'desc')->get();
        return view('frontend.index', compact('top4Categories', 'topTrendingProducts'));
    }

    public function show(Product $product)
    {
        $averageRate = 0;

        if ($product->reviews->sum('rate') && $product->reviews->count('rate')) {
            $averageRate = $product->reviews->sum('rate') / $product->reviews->count('rate');
        }

        $userHasReview = false;

        foreach ($product->reviews as $review) {
            if ($review->product_id === $product->id  && $review->user_id === Auth::id()) {
                $userHasReview = true;
            }
        }

        $productCategoriesIds = $product->categories->pluck('id');
        $relatedProducts = [];

        $relatedProducts = Product::whereHas('categories', function ($q) use ($productCategoriesIds, $product) {
            $q->whereIn('categories.id', $productCategoriesIds)->where('products.id', '!=', $product->id);
        })->limit(4)->latest()->get();

        if ($relatedProducts->count() == 0) {
            $relatedProducts = Product::where('id', '!=', $product->id)->limit(4)->latest()->get();
        }

        return view('frontend.detail', compact('product', 'userHasReview', 'averageRate', 'relatedProducts'));
    }

    public function cart()
    {
        return view('frontend.cart');
    }

    public function checkout()
    {
        return view('frontend.checkout');
    }

    public function shop()
    {
        return view('frontend.shop');
    }
}
