@extends('layouts.admin')

@section('style')
@endsection

@section('content')
    <h1 class="mb-3">Edit Role</h1>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('backend.roles.update', $role->id) }}" method="POST">
                @csrf

                <div class="row">
                    <div class="col-xl-6">
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" name="name"
                                id="name" value="{{ old('name') ? old('name') : $role->display_name }}">

                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-xl-12">
                        <div class="form-group">
                            <label for="description">Description</label>

                            <textarea class="form-control @error('description') is-invalid @enderror" name="description" id="description">{{ old('description') ? old('description') : $role->description }}</textarea>
                            @error('description')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                </div>

                <button class="btn btn-primary">Add Role</button>
            </form>
        </div>
    </div>
@endsection

@section('script')
@endsection
