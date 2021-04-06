@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">All Products</div>
        <div class="card-body">
            <!--begin:: Flash Message -->
            @include('layouts.flash-message')
            <!--end:: Flash Message -->
            <div class="row">
                @forelse ($products as $product)
                <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
                    <div class="card mb-4 box-shadow h-100">
                        <img class="card-img-top" src="{{ asset($product->thumbnail ? 'upload/'.$product->thumbnail : 'img/default.png') }}" height="200">
                        <div class="card-body d-flex flex-column">
                            <div class="d-flex justify-content-between align-items-center">
                                <h6 class="mb-0">{{ $product->title }}</h6>
                                <small class="text-muted ml-1 flex-shrink-0">{{ $product->price }} AED</small>
                            </div>
                            <a href="{{ route('product.detail', $product->id) }}" class="btn btn-block btn-outline-secondary mt-auto">Details</a>
                        </div>
                    </div>
                </div>
                @empty
                <div class="col-md-12">There is no any record exist.</div>
                @endforelse
            </div>
    
            <!--begin:: Pagination -->
            {{ $products->links("pagination::bootstrap-4") }}
            <!--end:: Pagination -->
        </div>
    </div>
</div>
@endsection
