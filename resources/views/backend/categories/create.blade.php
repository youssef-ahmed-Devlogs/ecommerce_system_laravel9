@extends('layouts.admin')

@section('style')
@endsection

@section('content')
    <h1 class="mb-3">Create Category</h1>

    <div class="card">

        <div class="card-body">

            <form action="{{ route('backend.categories.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="row">
                    <div class="col-xl-6">
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" name="name"
                                id="name">

                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-xl-6">
                        <div class="form-group">
                            <label for="parent">Parent</label>
                            <select class="select2 form-control" name="parent" id="parent">
                                <option value="">Chooice the parent...</option>
                                @forelse ($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @empty
                                    <option value="">Please add category first...</option>
                                @endforelse
                            </select>
                        </div>
                    </div>

                    <div class="col-xl-12">
                        <div class="form-group">
                            <label for="description">Description</label>

                            <textarea class="form-control @error('description') is-invalid @enderror" name="description" id="description"></textarea>

                            @error('description')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="col-xl-12">
                    <div class="form-group">
                        <label for="cover">Cover</label>
                        <input type="file" class="form-control @error('cover') is-invalid @enderror" name="cover"
                            id="cover">

                        @error('cover')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <button class="btn btn-primary">Add Category</button>
            </form>
        </div>
    </div>
@endsection

@section('script')
@endsection
