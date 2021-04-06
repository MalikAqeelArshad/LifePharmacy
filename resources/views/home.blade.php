@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">{{ __('Dashboard') }}</div>

        <div class="card-body">
            @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
            @endif

            <p>{{ __('You are logged in!') }} - {{ auth()->user()->name }}</p>
            @if (auth()->user()->role == 'admin')
            <ul class="list-group">
                <li class="list-group-item"><a class="d-block" href="{{ route('products.index') }}">All Products</a></li>
                <li class="list-group-item"><a class="d-block" href="{{ route('orders.index') }}">All Orders</a></li>
            </ul>
            @endif
        </div>
    </div>
</div>
@endsection
