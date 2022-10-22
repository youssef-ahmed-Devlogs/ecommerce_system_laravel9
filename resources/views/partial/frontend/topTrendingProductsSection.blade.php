<!-- TRENDING PRODUCTS-->
<section class="py-5">
    <header>
        <p class="small text-muted small text-uppercase mb-1">Made the hard way</p>
        <h2 class="h5 text-uppercase mb-4">Top trending products</h2>
    </header>
    <div class="row">
        @foreach ($topTrendingProducts as $trendProduct)
            <!-- PRODUCT-->
            <div class="col-xl-3 col-lg-4 col-sm-6">
                <div class="product trending-product text-center">
                    <div class="position-relative mb-3">

                        @if (true)
                            <div class="badge text-white badge-info">New</div>
                        @elseif (true)
                            <div class="badge text-white badge-primary">Sale</div>
                        @else
                            <div class="badge text-white badge-danger">Sold</div>
                        @endif

                        <a class="d-block" href="{{ route('frontend.products.show', $trendProduct->id) }}">
                            <img class="img-fluid w-100" src="{{ asset('storage/' . $trendProduct->images[0]->path) }}"
                                alt="...">
                        </a>
                        <div class="product-overlay">
                            <ul class="mb-0 list-inline">
                                <li class="list-inline-item m-0 p-0"><a class="btn btn-sm btn-outline-dark"
                                        href="#"><i class="far fa-heart"></i></a></li>
                                <li class="list-inline-item m-0 p-0"><a class="btn btn-sm btn-dark" href="cart.html">Add
                                        to cart</a></li>
                                <li class="list-inline-item mr-0"><a class="btn btn-sm btn-outline-dark"
                                        href="#productView" data-toggle="modal"><i class="fas fa-expand"></i></a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <h6>
                        <a class="reset-anchor" href="detail.html">
                            {{ $trendProduct->title }}
                        </a>
                    </h6>
                    <p class="small text-muted">
                        ${{ $trendProduct->price }}
                    </p>
                </div>
            </div>
        @endforeach

    </div>
</section>
