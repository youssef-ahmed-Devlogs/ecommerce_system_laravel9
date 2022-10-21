@extends('layouts.admin')

@section('style')
    <style>
        .profile-image,
        .profile-image img {
            width: 200px;
            height: 200px;
            border-radius: 50%;
            object-fit: cover;
            display: block;
            margin: auto
        }

        .profile-image {
            position: relative;
        }

        .profile-image::after {
            content: "Upload";
            position: absolute;
            bottom: 0;
            left: 0;
            width: 200px;
            height: 200px;
            border-radius: 50%;
            display: block;
            background-color: rgba(0, 0, 0, 0.3);
            display: flex;
            align-items: center;
            justify-content: center;
            color: #fff;
            font-weight: bold;
            cursor: pointer;
            opacity: 0;
            transition: .5s ease-in;
        }

        .profile-image:hover:after {
            opacity: 1;
        }
    </style>
@endsection

@section('content')
    <h1 class="mb-3">Edit User</h1>

    <div class="card mb-4">
        <div class="card-header">Profile Image</div>
        <div class="card-body">

            <form action="{{ route('backend.users.updateProfileImage', $user->id) }}" method="POST"
                enctype="multipart/form-data">
                @csrf

                <div class="row">
                    <div class="col-xl-12">
                        <div class="form-group">
                            <label for="user_image" class="profile-image">

                                <img src="{{ asset('storage/' . $user->user_image) }}" alt="">

                            </label>
                            <input type="file" name="user_image" id="user_image"
                                class="form-control d-none @error('user_image') is-invalid @enderror"
                                onchange="this.form.submit()">

                            <h3 class="profile-user mt-3 text-center">
                                {{ $user->first_name . ' ' . $user->last_name }}
                            </h3>

                            @error('user_image')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="card mb-4">
        <div class="card-header">Main Inforamtion</div>
        <div class="card-body">


            <form action="{{ route('backend.users.update', $user->id) }}" method="POST">
                @csrf

                <div class="row">
                    <div class="col-xl-6">
                        <div class="form-group">
                            <label for="first_name">First Name</label>
                            <input type="text" class="form-control @error('first_name') is-invalid @enderror"
                                name="first_name" id="first_name"
                                value="{{ old('first_name') ? old('first_name') : $user->first_name }}">

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
                                name="last_name" id="last_name"
                                value="{{ old('last_name') ? old('last_name') : $user->last_name }}">
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
                                id="email" value="{{ old('email') ? old('email') : $user->email }}">
                            @error('email')
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
                                id="mobile" value="{{ old('mobile') ? old('mobile') : $user->mobile }}">

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
                            <select class="form-control" name="status" id="status">
                                <option value="1" {{ $user->status === 1 ? 'selected' : '' }}>Active</option>
                                <option value="0" {{ $user->status === 0 ? 'selected' : '' }}>Disabled</option>
                            </select>
                        </div>
                    </div>


                    <div class="col-xl-6">
                        <div class="form-group">
                            <label for="roles">Roles</label>
                            <select class="select2 form-control" name="roles[]" id="roles" multiple>
                                @foreach ($roles as $role)
                                    <option value="{{ $role->id }}"
                                        {{ in_array($role->name, $user->getRoles()) ? 'selected' : '' }}>
                                        {{ $role->display_name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

                <button class="btn btn-success">Update User</button>
            </form>
        </div>
    </div>

    <div class="card">
        <div class="card-header">Reset Password</div>

        <div class="card-body">


            <form action="{{ route('backend.users.updatePassword', $user->id) }}" method="POST">
                @csrf

                <div class="row">
                    <div class="col-xl-12">
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

                    <div class="col-xl-12">
                        <div class="form-group">
                            <label for="newPassword">New Password</label>
                            <input type="password" class="form-control @error('newPassword') is-invalid @enderror"
                                name="newPassword" id="newPassword">

                            @error('newPassword')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-xl-12">
                        <div class="form-group">
                            <label for="passwordConfirm">Password Confirm</label>
                            <input type="password" class="form-control @error('passwordConfirm') is-invalid @enderror"
                                name="passwordConfirm" id="passwordConfirm">

                            @error('passwordConfirm')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                </div>

                <button class="btn btn-primary">Update Password</button>
            </form>
        </div>
    </div>
@endsection

@section('script')
@endsection
