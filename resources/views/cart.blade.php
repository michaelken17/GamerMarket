@extends('layouts.app')
@section('content')
<div class="container mt-4">
    <div class="text-center">
        <h5>Your Cart</h5>
    </div>
    <div class="row justify-content-center">
        <div class="col-lg-9 bg-white p-2">
            @if ($message = Session::get('success'))
            <div class="alert alert-success alert-block">
                <button type="button" class="close" data-dismiss="alert">×</button>
                <strong>{{ $message }}</strong>
            </div>
            @endif
                @if(!count($carts))
                <h5>Cart Empty!</h5>
                @endif
                <table class="table">
                    <tr>
                        <th>Product</th>
                        <th>Price</th>
                        <th>Qty</th>
                        <th>Subtotal</th>
                    </tr>
                    @foreach ($carts as $cart)
                    <tr>
                        <td width="30%"><img class="img-responsive w-25 me-2" src="{{asset("images/{$cart->product->image}")}}" alt="{{$cart->product->name}}"> {{$cart->product->name}}</td>
                        <td width="25%"><div class="fw-bold">{{$cart->product->price}}</div></td>
                        <td width="20%">
                        <div class="row">
                            <div class="col-6 mr-0">
                                <input type="number" min="0" value="{{$cart->qty}}" onchange="updateCart(this,{{$cart->id}})" class="form-control"
                                    id="quantity" name="quantity" placeholder="qty" required>
                            </div>
                        </div>
                        </td>
                        <td width="20%">{{$cart->qty * $cart->product->price}}</td>
                    </tr>
                    @endforeach
                </table>
                <div class="p-4">
                    <ul class="list-unstyled mb-4">
                        <li class="d-flex justify-content-between py-3 border-bottom">
                            <span class="fw-bolder text-muted">Total</span>
                            <h5 class="font-weight-bold">{{$grand_total}}</h5>
                        </li>
                    </ul>
                </div>
            @if(count($carts))
                <div class="text-center">
                    <a href="{{route('cart.checkout')}}" class="btn btn-outline-success">Checkout</a>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
