@extends('layouts.admin')

@section('style')
@endsection

@section('content')
    <h1 class="mb-3">Create User</h1>

    <div class="card">
        <div class="card-header">Main Inforamtion</div>
        <div class="card-body">

            <form action="{{ route('backend.users.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="row">
                    <div class="col-xl-6">
                        <div class="form-group">
                            <label for="first_name">First Name</label>
                            <input type="text" class="form-control @error('first_name') is-invalid @enderror"
                                name="first_name" id="first_name">

                            @error('first_name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>


                    </div>

                    <div class="col-xl-6">
                        <div class="form-group">
                            <label for="last_name">Last Name</label>
                            <input type="text" class="form-control @error('last_name') is-invalid @enderror"
                                name="last_name" id="last_name">
                            @error('last_name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-xl-6">
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" name="email"
                                id="email">
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-xl-6">
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" class="form-control @error('password') is-invalid @enderror"
                                name="password" id="password">

                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-xl-6">
                        <div class="form-group">
                            <label for="mobile">Mobile</label>
                            <input type="text" class="form-control @error('mobile') is-invalid @enderror" name="mobile"
                                id="mobile">

                            @error('mobile')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-xl-6">
                        <div class="form-group">
                            <label for="status">Status</label>
                            <select class="select2 form-control" name="status" id="status">
                                <option value="1">Active</option>
                                <option value="0">Disabled</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-xl-6">
                        <div class="form-group">
                            <label for="user_image">Image</label>
                            <input type="file" name="user_image" id="user_image"
                                class="form-control @error('user_image') is-invalid @enderror">

                            @error('user_image')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-xl-6">
                        <div class="form-group">
                            <label for="role">Role</label>
                            <select class="select2 form-control" name="role" id="role">
                                @foreach ($roles as $role)
                                    <option value="{{ $role->name }}">{{ $role->display_name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

                <button class="btn btn-primary">Add User</button>
            </form>
        </div>
    </div>
@endsection

@section('script')
@endsection
