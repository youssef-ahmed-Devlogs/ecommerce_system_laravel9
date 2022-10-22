<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductReview;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductReviewController extends Controller
{
    public function store(Request $request, Product $product)
    {
        $data = $request->all();
        $data['product_id'] = $product->id;
        $data['user_id'] = Auth::id();

        ProductReview::create($data);
        return redirect()->back();
    }

    public function edit(ProductReview $review)
    {
        if (reviewOwnershipVerification($review)) {
            return view('frontend.reviews.edit', compact('review'));
        }

        return redirect()->route('frontend.index');
    }

    public function update(Request $request, ProductReview $review)
    {
        if (reviewOwnershipVerification($review)) {
            $data = $request->all();
            $data['product_id'] = $review->product_id;
            $data['user_id'] = Auth::id();

            $review->update($data);
            return redirect()->route('frontend.products.show', $review->product_id);
        }

        return redirect()->route('frontend.index');
    }

    public function destroy(Request $request, ProductReview $review)
    {
        if (reviewOwnershipVerification($review)) {
            $review->delete();
            return redirect()->back();
        }

        return redirect()->route('frontend.index');
    }
}
