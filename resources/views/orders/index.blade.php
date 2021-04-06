@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header d-flex align-items-center justify-content-between">
            <b>All Orders</b>
            {{-- <a href="{{ route('orders.create') }}" class="btn btn-outline-primary">Add Order</a> --}}
        </div>

        <div class="card-body">
            <!--begin:: Flash Message -->
            @include('layouts.flash-message')
            <!--end:: Flash Message -->

            <table class="table table-bordered">
                <thead>
                    <th>#</th>
                    <th>Order</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Status</th>
                    <th>Actions</th>
                </thead>
                <tbody>
                    @forelse($orders as $order)
                    <tr>
                        <td><b>{{ $loop->iteration + ($orders->currentPage() - 1) * $orders->perPage() }}</b></td>
                        <td>{{ $order->code }}</td>
                        <td>{{ $order->name }}</td>
                        <td>{{ $order->email ?? '-' }}</td>
                        <td>{{ $order->phone ?? '-' }}</td>
                        <td>{{ $order->status }}</td>
                        <td>
                            <a href="{{ route('orders.edit', $order->id) }}" class="btn btn-outline-success">Edit</a>
                            <a href="javascript:;" class="btn btn-outline-danger dynamic-modal" data-toggle="modal" data-target="#delModal" data-action="{{ route('orders.destroy', $order->id) }}">Delete</a>
                            
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="50"><center>There is no any record exist.</center></td></tr>
                    @endforelse
                </tbody>
            </table>

            <!--begin:: Pagination -->
            {{ $orders->links() }}
            <!--end:: Pagination -->
        </div>
    </div>
</div>

<!--begin:: Delete Modal -->
<div class="modal fade" id="delModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title text-danger">Delete Order</h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST" action="">
                @csrf @method('DELETE')
                <div class="modal-body pb-5">
                    <p>Are you sure want to delete?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-dismiss="modal"><small>Close</small></button>
                    <button type="submit" class="btn btn-danger"><small>Delete</small></button>
                </div>
            </form>
        </div>
    </div>
</div>
<!--end:: Delete Modal -->
@endsection
