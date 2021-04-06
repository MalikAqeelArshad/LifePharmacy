@extends('layouts.app')

@section('content')
<div class="container">
    <!--begin:: Flash Message -->
    @include('layouts.flash-message')
    <!--end:: Flash Message -->
    <div class="card">
        @if (Cart::count() > 0)
        <div class="card-header">Cart</div>
        <div class="card-body p-0">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th width="60%">Product</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Subtotal</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach (Cart::content() as $item)
                    <tr>
                        <td>
                            <div class="row">
                                <div class="col-lg-2 col-md-4">
                                    <a href="{{ route('product.detail', $item->model->id) }}">
                                        <img class="img-thumbnail mb-2" src="{{ asset($item->model->thumbnail ? 'upload/'.$item->model->thumbnail : 'img/default.png') }}">
                                    </a>
                                </div>
                                <div class="col-lg-10 col-md-8">
                                    <a href="{{ route('product.detail', $item->model->id) }}" class="text-dark h6">{{ $item->model->title }}</a>
                                    <p class="small">{{ $item->model->description ?? '-' }}</p>
                                </div>
                            </div>
                        </td>
                        <td>{{ $item->model->price }}</td>
                        <td>
                            <select name="quantity" class="custom-select quantity" data-id="{{ $item->rowId }}" data-productQuantity="{{ rand(1,100) }}">
                                @for ($i = 1; $i < 5 + 1 ; $i++)
                                    <option {{ $item->qty == $i ? 'selected' : '' }}>{{ $i }}</option>
                                @endfor
                            </select>
                        </td>
                        <td>{{ $item->subtotal }}</td>
                        <td>
                            <a href="javascript:;" class="btn btn-outline-danger dynamic-modal" data-toggle="modal" data-target="#delModal" data-action="{{ route('cart.destroy', $item->rowId) }}"><b>X</b></a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="2"><a href="{{ url('/') }}" class="btn btn-warning">Continue Shopping</a></td>
                        <td style="width:200px;"><small>Tax (5%)</small> : {{ Cart::tax() }}</td>
                        <td class="text-left" style="width:150px;"><strong>Total : {{ Cart::total() }}</strong></td>
                        <td><a href="{{ route('checkout.index') }}" class="btn btn-success btn-block">Checkout</a></td>
                    </tr>
                </tfoot>
            </table>
        </div>

        @else

        <div class="card-header">No items in Cart!</div>
        <div class="card-body">
        <a href="{{ url('/') }}" class="btn btn-warning">Continue Shopping</a>
        </div>
        @endif
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

@push('scripts')
<script>
        (function(){
            const classname = document.querySelectorAll('.quantity')
            Array.from(classname).forEach(function(element) {
                element.addEventListener('change', function() {
                    const id = element.getAttribute('data-id')
                    const productQuantity = element.getAttribute('data-productQuantity')
                    axios.patch(`/cart/${id}`, {
                        quantity: this.value,
                        productQuantity: productQuantity
                    })
                    .then(function (response) {
                        // console.log(response);
                        window.location.href = '{{ route('cart.index') }}'
                    })
                    .catch(function (error) {
                        // console.log(error);
                        window.location.href = '{{ route('cart.index') }}'
                    });
                })
            })
        })();
    </script>
@endpush
