@extends('layouts.admin')

@section('style')
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
@endsection

@section('content')
    <h1 class="mb-3">Roles</h1>

    <div class="card">
        <div class="card-body">
            <a href="{{ route('backend.roles.create') }}" class="btn btn-primary mb-4">
                <i class="fas fa-plus"></i>
                Add Role
            </a>

            <table id="datatable" class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col">Display Name</th>
                        <th scope="col">description</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($roles as $role)
                        <tr>
                            <th scope="row">{{ $loop->iteration }}</th>
                            <td>{{ $role->name }}</td>
                            <td>{{ $role->display_name }}</td>
                            <td>{{ $role->description }}</td>
                            <td class="d-flex align-items-center" style="gap: 5px">
                                <a href="{{ route('backend.roles.edit', $role->id) }}" class="btn btn-sm btn-success">
                                    Edit
                                </a>
                                <a href="#" class="btn btn-sm btn-danger" data-toggle="modal"
                                    data-target="#deleteRoleModal-{{ $loop->iteration }}">Delete</a>

                                @include('partial.backend.deleteRoleModal')
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td class="text-center" colspan="5">
                                There are no roles to show.
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
