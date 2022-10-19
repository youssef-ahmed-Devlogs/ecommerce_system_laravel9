@extends('layouts.admin')

@section('style')
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
@endsection

@section('content')
    <h1 class="mb-3">Categories</h1>

    <div class="card">
        <div class="card-body">
            <a href="{{ route('backend.categories.create') }}" class="btn btn-primary mb-4">
                <i class="fas fa-plus"></i>
                Add Category
            </a>

            <table id="datatable" class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col">Description</th>
                        <th scope="col">Parent</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($categories as $category)
                        <tr>
                            <th scope="row">{{ $loop->iteration }}</th>
                            <td>{{ $category->name }}</td>
                            <td>{{ $category->description }}</td>
                            <td>
                                {{ $category->category() ? $category->category()->name : 'Has no parent.' }}
                            </td>
                            <td class="d-flex align-items-center" style="gap: 5px">
                                <a href="{{ route('backend.categories.edit', $category->id) }}"
                                    class="btn btn-sm btn-success">
                                    Edit
                                </a>
                                <a href="#" class="btn btn-sm btn-danger" data-toggle="modal"
                                    data-target="#deleteCategoryModal-{{ $loop->iteration }}">Delete</a>

                                @include('partial.backend.deleteCategoryModal')
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td class="text-center" colspan="5">
                                There are no users to show.
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
