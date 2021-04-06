@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">Billing address</div>
        <div class="card-body">
            <!--begin:: Flash Message -->
            @include('layouts.flash-message')
            <!--end:: Flash Message -->
            <div class="row">
                <div class="col-md-4 order-md-2 mb-4">
                    <h4 class="d-flex justify-content-between align-items-center mb-3">
                        <span class="text-muted">Your cart</span>
                        <span class="badge badge-secondary badge-pill">{{ Cart::count() }}</span>
                    </h4>
                    <ul class="list-group mb-3">
                        @foreach (Cart::content() as $item)
                        <li class="list-group-item d-flex justify-content-between lh-condensed">
                            <div>
                                <h6 class="my-0">{{ $item->model->title }}</h6>
                                <small class="text-muted">Price : {{ $item->price }} * Qty : {{ $item->qty }}</small>
                            </div>
                            <span class="text-muted">{{ $item->subtotal }}</span>
                        </li>
                        @endforeach
                        <li class="list-group-item d-flex justify-content-between bg-light">
                            <h6 class="my-0">Sub Total</h6>
                            <span>{{ Cart::subTotal() }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between">
                            <div>
                                <h6 class="my-0">Tax</h6>
                                <small>Inc. (5%)</small>
                            </div>
                            <span>{{ Cart::tax() }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between bg-light">
                            <span>Total (AED)</span>
                            <strong>{{ Cart::total() }}</strong>
                        </li>
                    </ul>
                </div>
                <div class="col-md-8 order-md-1">
                    <form method="POST" action="{{ route('checkout.store') }}">
                        @csrf
                        <div class="mb-3">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" name="name" value="{{ old('name') }}" placeholder="Full Name" required>
                        </div>

                        <div class="mb-3">
                            <label for="email">Email <span class="text-muted">(Optional)</span></label>
                            <input type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="you@example.com">
                        </div>

                        <div class="mb-3">
                            <label for="address">Address</label>
                            <input type="text" class="form-control" name="address" value="{{ old('address') }}" placeholder="1234 Main St" required>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="country">Country</label>
                                <select class="custom-select d-block w-100" name="country" required>
                                    <option value="">Choose...</option>
                                    <option value="uae">United Arab Emirates</option>
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="state">City</label>
                                <select class="custom-select d-block w-100" name="city" required>
                                    <option value="">Choose...</option>
                                    <option value="Abu Dhabi">Abu Dhabi</option>
                                    <option value="Dubai">Dubai</option>
                                    <option value="Ajman">Ajman</option>
                                    <option value="Sharjah">Sharjah</option>
                                    <option value="Fujairah">Fujairah</option>
                                    <option value="Ummul Quwain">Ummul Quwain</option>
                                    <option value="Ras Al Khaima">Ras Al Khaima</option>
                                </select>
                            </div>
                        </div>

                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="same-address">
                            <label class="custom-control-label" for="same-address">Shipping address is the same as my billing address</label>
                        </div>
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="save-info">
                            <label class="custom-control-label" for="save-info">Save this information for next time</label>
                        </div>
                        <hr class="mb-4">

                        <button class="btn btn-primary btn-lg btn-block" type="submit">Continue to checkout</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
