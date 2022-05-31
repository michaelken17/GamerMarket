@extends('layouts.app')
@section('content')
<div class="container mt-4">
    <div class="text-center">
        <h5>Transaction</h5>
    </div>
    <div class="row justify-content-center">
        <div class="col-lg-9 bg-white p-2">
            @if ($message = Session::get('success'))
            <div class="alert alert-success alert-block">
                <strong>{{ $message }}</strong>
            </div>
            @endif
            @forelse ($transactions as $transaction)
            <h5>Transaction Date: {{$transaction->created_at}}</h5>
            <table class="table">
                <tr>
                    <th>Product</th>
                    <th>Price</th>
                    <th>Qty</th>
                    <th>Subtotal</th>
                </tr>
                @foreach ($transaction->transactionDetails as $detail)
                <tr>
                    <td width="30%"><img class="img-responsive w-25 me-2" src="{{asset("images/{$detail->product->image}")}}" alt="{{$detail->product->name}}"> {{$detail->product->name}}</td>
                    <td width="25%"><div class="fw-bold">{{$detail->product->price}}</div></td>
                    <td width="20%">
                    <div class="row">
                        <div class="col-6 mr-0">
                            <input type="number" min="0" value="{{$detail->qty}}" class="form-control" disabled>
                        </div>
                    </div>
                    </td>
                    <td width="20%">{{$detail->subtotal}}</td>
                </tr>
                @endforeach
            </table>
            <div class="p-4">
                <ul class="list-unstyled mb-4">
                    <li class="d-flex justify-content-between py-3 border-bottom">
                        <span class="fw-bolder text-muted">Total</span>
                        <h5 class="font-weight-bold">{{$transaction->total_price}}</h5>
                    </li>
                </ul>
            </div>
            @empty
            <h3>Transaction Empty!</h3>
            @endforelse

        </div>
    </div>
</div>
@endsection
