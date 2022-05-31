@extends('layouts.app')
@section('content')
<div class="container mt-4">
    <div class="text-center">
        <h5>Please Confirm Your Order</h5>
    </div>
    <div class="row justify-content-center">
        <div class="col-lg-9 bg-white p-2">
            @if ($message = Session::get('success'))
            <div class="alert alert-success alert-block">
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
                                    id="quantity" name="quantity" placeholder="qty" disabled>
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
                    <p>
                        Ship To: {{Auth::user()->address}}
                    </p>
                    <div class="float-end">
                        <form method="POST" action="{{route('cart.doCheckout')}}">
                            @csrf
                            <div class="mb-3">
                                <label for="passcode">Please Confirm Passcode: {!!session()->get('passcode')!!}</label>
                                <input type="text" class="form-control @error('passcode') is-invalid @enderror" id="passcode" name="passcode" value="{{old('passcode')}}" required placeholder="Passcode">
                                @error('passcode')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <button id="checkout-btn" type="submit" class="btn btn-outline-dark rounded-pill float-end py-2 {{(!count($carts) ? 'disabled' : '')}}">
                                Checkout
                            </button>
                        </form>
                    </div>
                </div>
        </div>
    </div>
</div>
@endsection
