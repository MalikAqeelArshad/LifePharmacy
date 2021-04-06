@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">Detail</div>
        <div class="card-body">
            <!--begin:: Flash Message -->
            @include('layouts.flash-message')
            <!--end:: Flash Message -->
            <div class="row">
                <div class="col-sm-4 mb-4">
                    <img class="img-thumbnail box-shadow" src="{{ asset($product->thumbnail ? 'upload/'.$product->thumbnail : 'img/default.png') }}">
                </div>
                <div class="col-sm-8">
                    <h5>{{ $product->title }}</h5>
                    <p>{{ $product->description }}</p>
                    <p class="text-muted">{{ $product->price }} AED</p>
                    <form action="{{ route('cart.store', $product->id) }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-outline-secondary px-5">Add To Cart</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
