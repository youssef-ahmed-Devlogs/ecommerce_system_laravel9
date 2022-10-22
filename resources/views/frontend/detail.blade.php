@extends('layouts.app')

@section('content')
    <section class="py-5">
        <div class="container">
            <div class="row mb-5">
                <div class="col-lg-6">
                    <!-- PRODUCT SLIDER-->
                    <div class="row m-sm-0">
                        <div class="col-sm-2 p-sm-0 order-2 order-sm-1 mt-2 mt-sm-0">
                            <div class="owl-thumbs d-flex flex-row flex-sm-column" data-slider-id="1">

                                @forelse ($product->images as $image)
                                    <div class="owl-thumb-item flex-fill mb-2 mr-2 mr-sm-0">
                                        <img class="w-100" src="{{ asset('storage/' . $image->path) }}"
                                            alt="{{ $product->title }}">
                                    </div>
                                @empty
                                @endforelse
                            </div>
                        </div>
                        <div class="col-sm-10 order-1 order-sm-2">
                            <div class="owl-carousel product-slider" data-slider-id="1">
                                @forelse ($product->images as $image)
                                    <a class="d-block" href="{{ asset('storage/' . $image->path) }}" data-lightbox="product"
                                        title="{{ $product->title }}">
                                        <img class="img-fluid" src="{{ asset('storage/' . $image->path) }}"
                                            alt="{{ $product->title }}">
                                    </a>
                                @empty
                                @endforelse
                            </div>
                        </div>
                    </div>
                </div>
                <!-- PRODUCT DETAILS-->
                <div class="col-lg-6">

                    <div class="d-flex align-items-center mb-2" style="gap:5px">
                        <span class="text-muted">( {{ $product->reviews->count() }} )</span>
                        <ul class="product-avg-rate list-inline m-0">

                            @for ($i = 1; $i <= 5; $i++)
                                <li class="list-inline-item {{ $averageRate >= $i ? ' active' : '' }} m-0"><i
                                        class="fas fa-star small"></i></li>
                            @endfor
                        </ul>
                    </div>
                    <h1>{{ $product->title }}</h1>
                    <p class="text-muted lead">${{ $product->price }}</p>
                    <p class="text-small mb-4">
                        {{ substr($product->desc, 0, 300) }}
                    </p>
                    <div class="row align-items-stretch mb-4">
                        <div class="col-sm-5 pr-sm-0">
                            <div
                                class="border d-flex align-items-center justify-content-between py-1 px-3 bg-white border-white">
                                <span class="small text-uppercase text-gray mr-4 no-select">Quantity</span>
                                <div class="quantity">
                                    <button class="dec-btn p-0"><i class="fas fa-caret-left"></i></button>
                                    <input class="form-control border-0 shadow-0 p-0" type="text" value="1">
                                    <button class="inc-btn p-0"><i class="fas fa-caret-right"></i></button>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-3 pl-sm-0"><a
                                class="btn btn-dark btn-sm btn-block h-100 d-flex align-items-center justify-content-center px-0"
                                href="cart.html">Add to cart</a></div>
                    </div><a class="btn btn-link text-dark p-0 mb-4" href="#"><i class="far fa-heart mr-2"></i>Add
                        to wish list</a><br>
                    <ul class="list-unstyled small d-inline-block">
                        <li class="px-3 py-2 mb-1 bg-white text-muted">
                            <strong class="text-uppercase text-dark">Category:</strong>

                            @forelse ($product->categories as $category)
                                <a class="reset-anchor ml-2" href="#">{{ $category->name }}</a>
                            @empty
                                has no categories
                            @endforelse
                        </li>
                        <li class="px-3 py-2 mb-1 bg-white text-muted">
                            <strong class="text-uppercase text-dark">Tags:</strong>
                            <a class="reset-anchor ml-2" href="#">Innovation</a>
                        </li>
                    </ul>
                </div>
            </div>
            <!-- DETAILS TABS-->
            <ul class="nav nav-tabs border-0" id="myTab" role="tablist">
                <li class="nav-item"><a class="nav-link active" id="description-tab" data-toggle="tab" href="#description"
                        role="tab" aria-controls="description" aria-selected="true">Description</a></li>
                <li class="nav-item"><a class="nav-link" id="reviews-tab" data-toggle="tab" href="#reviews" role="tab"
                        aria-controls="reviews" aria-selected="false">Reviews</a></li>
            </ul>
            <div class="tab-content mb-5" id="myTabContent">
                <div class="tab-pane fade show active" id="description" role="tabpanel" aria-labelledby="description-tab">
                    <div class="p-4 p-lg-5 bg-white">
                        <h6 class="text-uppercase">Product description </h6>
                        <p class="text-muted text-small mb-0">
                            {{ $product->desc }}
                        </p>
                    </div>
                </div>
                <div class="tab-pane fade" id="reviews" role="tabpanel" aria-labelledby="reviews-tab">
                    <div class="p-4 p-lg-5 bg-white">
                        <div class="row">
                            <div class="col-lg-8">
                                @forelse ($product->reviews as $review)
                                    <div class="media mb-3" style="position: relative">

                                        @if (reviewOwnershipVerification($review))
                                            <div class="review-actions d-flex align-items-center" style="gap:10px">
                                                <a href="{{ route('frontend.products.reviews.edit', $review->id) }}"
                                                    class="btn btn-sm btn-success edit-review">Edit</a>

                                                <form
                                                    action="{{ route('frontend.products.reviews.destroy', $review->id) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('delete')

                                                    <button class="btn btn-sm btn-danger edit-review">Delete</button>
                                                </form>
                                            </div>
                                        @endif

                                        <img class="rounded-circle"
                                            src="{{ asset('storage/' . $review->user->user_image) }}" alt=""
                                            width="50">
                                        <div class="media-body ml-3">
                                            <h6 class="mb-0 text-uppercase">
                                                {{ $review->user->first_name . ' ' . $review->user->last_name }}</h6>
                                            {{-- <p class="small text-muted mb-0 text-uppercase">20 May 2020</p> --}}
                                            <p class="small text-muted mb-0 text-uppercase">{{ $review->created_at }}</p>

                                            <ul class="list-inline mb-1 text-xs">

                                                @for ($i = 1; $i <= 5; $i++)
                                                    <li
                                                        class="review-star {{ $review->rate >= $i ? ' active' : '' }} list-inline-item m-0">
                                                        <i class="fas fa-star"></i>
                                                    </li>
                                                @endfor

                                            </ul>
                                            <p class="text-small mb-0 text-muted">
                                                {{ $review->content }}
                                            </p>
                                        </div>
                                    </div>
                                @empty
                                    <p class="text-muted">There's no reviews in this product.</p>
                                @endforelse

                                @if (!$userHasReview)
                                    <div class="add-reviews-area mt-3">
                                        <form action="{{ route('frontend.products.reviews.store', $product->id) }}"
                                            class="w-100" method="POST">

                                            @csrf
                                            <p class="mb-1">Add review to this product</p>
                                            <ul class="review-rating list-inline mb-1 text-xs">
                                                <li class="list-inline-item m- 0"><i class="fas fa-star"></i>
                                                </li>
                                                <li class="list-inline-item m-0"><i class="fas fa-star"></i>
                                                </li>
                                                <li class="list-inline-item m-0"><i class="fas fa-star"></i>
                                                </li>
                                                <li class="list-inline-item m-0"><i class="fas fa-star"></i>
                                                </li>
                                                <li class="list-inline-item m-0"><i class="fas fa-star"></i>
                                                </li>
                                            </ul>

                                            <input type="hidden" name="rate" class="d-none" id="review-rating">

                                            @error('rate')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror

                                            <div class="review-content d-none">
                                                <textarea name="content" class="form-control w-100 mb-3" cols="30" rows="10"></textarea>

                                                @error('content')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror

                                                <button class="btn btn-primary">Add Review</button>
                                            </div>
                                        </form>

                                        <script>
                                            const reviewRatingStarsContainer = document.querySelector('.review-rating');
                                            const reviewRatingStars = Array.from(reviewRatingStarsContainer.querySelectorAll('li')).reverse();
                                            const reviewInput = document.getElementById('review-rating');
                                            const reviewContent = document.querySelector('.review-content');

                                            reviewRatingStars.forEach((star, index) => {
                                                star.onclick = function() {
                                                    reviewRatingStars.forEach((ele) => ele.classList.remove('active'))
                                                    for (let i = 0; i <= index; i++) {
                                                        reviewRatingStars[i].classList.add('active');
                                                    }
                                                    reviewInput.value = index + 1;
                                                    reviewContent.classList.remove('d-none');
                                                }
                                            });
                                        </script>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- RELATED PRODUCTS-->
            <h2 class="h5 text-uppercase mb-4">Related products</h2>
            <div class="row">

                @forelse ($relatedProducts as $relatedProduct)
                    <!-- PRODUCT-->
                    <div class="col-lg-3 col-sm-6">
                        <div class="product text-center skel-loader">
                            <div class="d-block mb-3 position-relative">
                                <a class="d-block" href="detail.html">
                                    <img class="img-fluid w-100"
                                        src="{{ asset('storage/' . $relatedProduct->images[0]->path) }}" alt="...">
                                </a>
                                <div class="product-overlay">
                                    <ul class="mb-0 list-inline">
                                        <li class="list-inline-item m-0 p-0">
                                            <a class="btn btn-sm btn-outline-dark" href="#"><i
                                                    class="far fa-heart"></i>
                                            </a>
                                        </li>
                                        <li class="list-inline-item m-0 p-0">
                                            <a class="btn btn-sm btn-dark" href="#">Add to cart</a>
                                        </li>
                                        <li class="list-inline-item mr-0">
                                            <a class="btn btn-sm btn-outline-dark" href="#productView"
                                                data-toggle="modal">
                                                <i class="fas fa-expand"></i>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <h6>
                                <a class="reset-anchor" href="detail.html">{{ $relatedProduct->title }}</a>
                            </h6>
                            <p class="small text-muted">${{ $relatedProduct->price }}</p>
                        </div>
                    </div>
                @empty
                @endforelse

            </div>
        </div>
    </section>
@endsection
