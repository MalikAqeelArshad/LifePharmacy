@extends('layouts.app')

@section('content')
<div class="container">
    <!--begin:: Flash Message -->
    @include('layouts.flash-message')
    <!--end:: Flash Message -->
    <div class="card">
        <div class="card-header d-flex align-items-center justify-content-between">
            <b>{{ __('Edit Order') }}</b>
            <a href="{{ route('orders.index') }}" class="btn btn-outline-primary">List Orders</a>
        </div>
        <div class="card-body p-0">

            <table class="table table-hover">
                <thead>
                    <tr>
                        <th width="60%">Product</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($order->products as $item)
                    <tr>
                        <td>
                            <div class="row">
                                <div class="col-lg-2 col-md-4">
                                    <a href="{{ route('product.detail', $item->product->id) }}">
                                        <img class="img-thumbnail mb-2" src="{{ asset($item->product->thumbnail ? 'upload/'.$item->product->thumbnail : 'img/default.png') }}">
                                    </a>
                                </div>
                                <div class="col-lg-10 col-md-8">
                                    <a href="{{ route('product.detail', $item->product->id) }}" class="text-dark h6">{{ $item->product->title }}</a>
                                    <p class="small">{{ $item->product->description ?? '-' }}</p>
                                </div>
                            </div>
                        </td>
                        <td>{{ $item->product->price }}</td>
                        <td>{{ $item->quantity }}</td>
                        <td>{{ $item->product->price * $item->quantity }}</td>
                    </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <th>Total</th>
                        <td colspan="2" style="width:200px;"><small>Tax (5%)</small> : {{ Cart::tax() }}</td>
                        <td class="text-left" style="width:150px;"><strong>{{ Cart::total() }}</strong></td>
                    </tr>
                </tfoot>
            </table>
        </div>
        <div class="card-footer">
            <form method="POST" action="{{ route('orders.update', $order->id) }}" enctype="multipart/form-data">
                @csrf @method('PUT')
                <div class="form-group row">
                    <label for="status" class="col-sm-2 col-form-label">Status <span class="text-danger">*</span></label>
                    <div class="col-sm-10">
                        <select name="status" id="status" class="custom-select">
                            <option value="pending" @if($order->status == 'pending') selected @endif>Pending</option>
                            <option value="cancelled" @if($order->status == 'cancelled') selected @endif>Cancelled</option>
                            <option value="shipped" @if($order->status == 'shipped') selected @endif>Shipped</option>
                            <option value="delivered" @if($order->status == 'delivered') selected @endif>Delivered</option>
                        </select>
                    </div>
                </div>
                <div class="form-group text-right">
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
