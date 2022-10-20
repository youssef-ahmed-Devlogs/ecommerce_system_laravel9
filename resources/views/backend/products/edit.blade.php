@extends('layouts.admin')

@section('style')
@endsection

@section('content')
    <h1 class="mb-3">Create Product</h1>

    <div class="card">

        <div class="card-body">
            <form action="{{ route('backend.products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('patch')
                <div class="row">
                    <div class="col-xl-6">
                        <div class="form-group">
                            <label for="title">Title</label>
                            <input type="text" class="form-control @error('title') is-invalid @enderror" name="title"
                                id="title" value="{{ old('title') ? old('title') : $product->title }}">

                            @error('title')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-xl-6">
                        <div class="form-group">
                            <label for="price">Price</label>
                            <input type="text" class="form-control @error('price') is-invalid @enderror" name="price"
                                id="price" value="{{ old('price') ? old('price') : $product->price }}">

                            @error('price')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-xl-12">
                        <div class="form-group">
                            <label for="desc">Description</label>

                            <textarea class="form-control @error('desc') is-invalid @enderror" name="desc" id="desc">{{ old('desc') ? old('desc') : $product->desc }}</textarea>

                            @error('desc')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-xl-6">
                        <div class="form-group">
                            <label for="images">Images</label>
                            <input type="file" class="form-control @error('images') is-invalid @enderror" name="images[]"
                                id="images" multiple>

                            @error('images')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="d-flex align-items-center mb-4" style="gap: 10px;flex-wrap: wrap">
                            @foreach ($product->images as $image)
                                <img src="{{ asset('storage/' . $image->path) }}" alt=""
                                    style="border-radius: 6px;width:300px;height:200px;object-fit:cover">
                            @endforeach
                        </div>
                    </div>

                    <div class="col-xl-6">
                        <div class="form-group">
                            <label for="categories">Categories</label>
                            <select class="select2 form-control" name="categories[]" id="categories" multiple>
                                <option value="" disabled>Chooice the parent...</option>
                                @forelse ($categories as $category)
                                    <option value="{{ $category->id }}"
                                        {{ in_array($category->id, $productCategoriesIds) ? 'selected' : '' }}>
                                        {{ $category->name }}</option>
                                @empty
                                    <option value="" disabled>Please add category first...</option>
                                @endforelse
                            </select>

                            @error('categories')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                </div>

                <button class="btn btn-success">Update Product</button>
            </form>
        </div>
    </div>
@endsection

@section('script')
@endsection
