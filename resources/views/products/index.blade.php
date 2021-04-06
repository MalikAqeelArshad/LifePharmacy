@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header d-flex align-items-center justify-content-between">
            <b>{{ __('Products') }}</b>
            <a href="{{ route('products.create') }}" class="btn btn-outline-primary">Add Product</a>
        </div>

        <div class="card-body">
            <!--begin:: Flash Message -->
            @include('layouts.flash-message')
            <!--end:: Flash Message -->
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <th width="50">Featured</th>
                        <th>Product</th>
                        <th>Description</th>
                        <th>Price</th>
                        <th>Category</th>
                        <th>Publish</th>
                        <th>Actions</th>
                    </thead>
                    <tbody>
                        @forelse($products as $product)
                        <tr>
                            <td><img src="{{ asset($product->thumbnail ? 'upload/'.$product->thumbnail : 'img/default.png') }}" alt="Product Logo" width="50"></td>
                            <td>{{ $product->title }}</td>
                            <td>{{ $product->description ?? '-' }}</td>
                            <td>{{ $product->price }}</td>
                            <td>{{ ucfirst($product->category) }}</td>
                            <td>{{ $product->publish ? 'Publish' : 'Un-Publish' }}</td>
                            <td>
                                <a href="{{ route('products.edit', $product->id) }}" class="btn btn-outline-success">Edit</a>
                                <a href="javascript:;" class="btn btn-outline-danger dynamic-modal" data-toggle="modal" data-target="#delModal" data-action="{{ route('products.destroy', $product->id) }}">Delete</a>

                            </td>
                        </tr>
                        @empty
                        <tr><td colspan="50"><center>There is no any record exist.</center></td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!--begin:: Pagination -->
            {{ $products->links("pagination::bootstrap-4") }}
            <!--end:: Pagination -->
        </div>
    </div>
</div>

<!--begin:: Delete Modal -->
<div class="modal fade" id="delModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title text-danger">Delete Product</h6>
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
