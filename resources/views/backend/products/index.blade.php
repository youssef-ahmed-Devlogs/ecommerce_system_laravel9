@extends('layouts.admin')

@section('style')
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
@endsection

@section('content')
    <h1 class="mb-3">Products</h1>

    <div class="card">
        <div class="card-body">
            <a href="{{ route('backend.products.create') }}" class="btn btn-primary mb-4">
                <i class="fas fa-plus"></i>
                Add Product
            </a>

            <table id="datatable" class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Image</th>
                        <th scope="col">title</th>
                        <th scope="col">Description</th>
                        <th scope="col">Price</th>
                        <th scope="col">Categories</th>
                        <th scope="col">Created By</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($products as $product)
                        <tr>
                            <th scope="row">{{ $loop->iteration }}</th>
                            <td>
                                <img src="{{ asset('storage/' . $product->images[0]->path) }}" alt="">
                            </td>
                            <td>{{ $product->title }}</td>
                            <td style="width: 300px">{{ $product->desc ? $product->desc : 'Has no description.' }}</td>
                            <td>
                                {{ $product->price }}
                            </td>
                            <td>
                                @forelse ($product->categories as $category)
                                    {{ $category->name }}
                                    {{ $loop->iteration < $product->categories->count() ? ' , ' : '' }}
                                @empty
                                    There is no categories.
                                @endforelse
                            </td>
                            <td>
                                {{ $product->user->first_name . ' ' . $product->user->last_name }}
                            </td>
                            <td class="d-flex align-items-center" style="gap: 5px">
                                <a href="{{ route('backend.products.edit', $product->id) }}" class="btn btn-sm btn-success">
                                    Edit
                                </a>
                                <a href="#" class="btn btn-sm btn-danger" data-toggle="modal"
                                    data-target="#deleteProductModal-{{ $loop->iteration }}">Delete</a>

                                @include('partial.backend.deleteProductModal')
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td class="text-center" colspan="7">
                                There are no products to show.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection

@section('script')
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.js"></script>
    <script>
        $(document).ready(function() {
            $('#datatable').DataTable();
        });
    </script>
@endsection
