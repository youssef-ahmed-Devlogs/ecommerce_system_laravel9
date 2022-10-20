<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\ProductReview;
use Illuminate\Http\Request;

class ProductReviewController extends Controller
{
    public function index()
    {
        $reviews = ProductReview::all();
        return view('backend.productReviews.index', compact('reviews'));
    }

    public function approved(Request $request, ProductReview $review)
    {
        $review->approved = 1;
        $review->save();

        flash()->addSuccess("The Review has been approved successfully.");
        return redirect()->route('backend.products.reviews.index');
    }

    public function hide(Request $request, ProductReview $review)
    {
        $review->approved = 0;
        $review->save();

        flash()->addSuccess("The Review has been hidden successfully.");
        return redirect()->route('backend.products.reviews.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ProductReview  $productReview
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProductReview $review)
    {
        $review->delete();
        flash()->addSuccess("The Review has been deleted successfully.");
        return redirect()->route('backend.products.reviews.index');
    }
}
