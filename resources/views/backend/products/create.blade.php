@extends('layouts.admin')

@section('style')
@endsection

@section('content')
    <h1 class="mb-3">Create Product</h1>

    <div class="card">

        <div class="card-body">
            <form action="{{ route('backend.products.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="row">
                    <div class="col-xl-6">
                        <div class="form-group">
                            <label for="title">Title</label>
                            <input type="text" class="form-control @error('title') is-invalid @enderror" name="title"
                                id="title" value="{{ old('title') }}">

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
                                id="price" value="{{ old('price') }}">

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

                            <textarea class="form-control @error('desc') is-invalid @enderror" name="desc" id="desc">{{ old('desc') }}</textarea>

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
                    </div>

                    <div class="col-xl-6">
                        <div class="form-group">
                            <label for="categories">Categories</label>
                            <select class="select2 form-control" name="categories[]" id="categories" multiple>
                                <option value="" disabled>Chooice the parent...</option>
                                @forelse ($categories as $category)
                                    <option value="{{ $category->id }}">
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

                <button class="btn btn-primary">Add Product</button>
            </form>
        </div>
    </div>
@endsection

@section('script')
@endsection
