<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    public function index()
    {
        $top4Categories = Category::limit(4)->orderBy('id', 'desc')->get();
        $topTrendingProducts = Product::limit(8)->orderBy('id', 'desc')->get();
        return view('frontend.index', compact('top4Categories', 'topTrendingProducts'));
    }

    public function cart()
    {
        return view('frontend.cart');
    }

    public function checkout()
    {
        return view('frontend.checkout');
    }

    public function detail()
    {
        return view('frontend.detail');
    }

    public function shop()
    {
        return view('frontend.shop');
    }
}
