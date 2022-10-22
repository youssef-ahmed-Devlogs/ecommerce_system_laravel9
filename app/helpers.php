<?php

use App\Models\ProductReview;
use Illuminate\Support\Facades\Auth;

function reviewOwnershipVerification(ProductReview $review)
{
  return Auth::id() == $review->user_id || Auth::user()->hasRole('admin');
}
