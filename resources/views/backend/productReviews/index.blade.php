@extends('layouts.admin')

@section('style')
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
@endsection

@section('content')
    <h1 class="mb-3">Product Reviews</h1>

    <div class="card">
        <div class="card-body">
            <table id="datatable" class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">User</th>
                        <th scope="col">Product</th>
                        <th scope="col">Content</th>
                        <th scope="col">Rate</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($reviews as $review)
                        <tr>
                            <th scope="row">{{ $loop->iteration }}</th>
                            <td>{{ $review->user->first_name }}</td>
                            <td>{{ $review->product->title }}</td>
                            <td>{{ $review->content }}</td>
                            <td>{{ $review->rate }}</td>

                            <td class="d-flex align-items-center" style="gap: 5px">

                                @if ($review->approved == 0)
                                    <a href="#" class="btn btn-sm btn-success" data-toggle="modal"
                                        data-target="#approvedReviewModal-{{ $loop->iteration }}">
                                        Approve
                                    </a>

                                    @include('partial.backend.approvedReviewModal')
                                @else
                                    <a href="#" class="btn btn-sm btn-info" data-toggle="modal"
                                        data-target="#hideReviewModal-{{ $loop->iteration }}">
                                        Hide
                                    </a>

                                    @include('partial.backend.hideReviewModal')
                                @endif


                                <a href="#" class="btn btn-sm btn-danger" data-toggle="modal"
                                    data-target="#deleteReviewModal-{{ $loop->iteration }}">Delete</a>


                                @include('partial.backend.deleteReviewModal')
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td class="text-center" colspan="7">
                                There are no reviews to show.
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
