@extends('layouts.app')

@section('content')
    <section class="py-5">
        <div class="container">
            <h1 class="mb-4">Update your review</h1>
            <div class="add-reviews-area mt-3">
                <form action="{{ route('frontend.products.reviews.update', $review->id) }}" class="w-100" method="POST">
                    @csrf
                    @method('patch')

                    <ul class="review-rating list-inline mb-1 text-xs mb-3">
                        {{-- Render by javascript ( look down in scripts section) --}}
                    </ul>

                    <input type="hidden" name="rate" class="d-none" value="{{ $review->rate }}" id="review-rating">

                    @error('rate')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror

                    <div class="review-content">
                        <textarea name="content" class="form-control w-100 mb-3" cols="30" rows="10">{{ $review->content }}</textarea>

                        @error('content')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror

                        <button class="btn btn-success">Update Review</button>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection

@section('script')
    <script>
        const reviewInput = document.getElementById('review-rating');
        const starsCount = reviewInput.value;
        const reviewRatingStarsContainer = document.querySelector('.review-rating');
        const arrayOfStars = [];

        for (i = 1; i <= 5; i++) {
            arrayOfStars.push(`
                <li class="list-inline-item ${starsCount >= i ? ' active' : ''} m- 0">
                    <i class="fas fa-star"></i>
                </li>
            `);
        }

        reviewRatingStarsContainer.innerHTML = arrayOfStars.reverse().join("");


        const reviewRatingStars = Array.from(reviewRatingStarsContainer.querySelectorAll('li')).reverse();

        reviewRatingStars.forEach((star, index) => {
            star.onclick = function() {
                reviewRatingStars.forEach((ele) => ele.classList.remove('active'))
                for (let i = 0; i <= index; i++) {
                    reviewRatingStars[i].classList.add('active');
                }
                reviewInput.value = index + 1;
            }
        });
    </script>
@endsection
