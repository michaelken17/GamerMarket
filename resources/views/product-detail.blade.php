@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-9">
            @if ($message = Session::get('success'))
            <div class="alert alert-success alert-block">
                <strong>{{ $message }}</strong>
            </div>
            @endif
            @if ($message = Session::get('error'))
            <div class="alert alert-danger alert-block">
                <strong>{{ $message }}</strong>
            </div>
            @endif
            <div class="card mt-4">
                <div class="text-center">
                    <img class="img-responsive center-block card-img-top img-fluid w-50 mt-4" draggable="false"
                        src="{{url("images/{$product->image}")}}" alt="{{$product->name}}">
                </div>
                <div class="card-body">
                    <h3 class="card-title">{{$product->name}}</h3>
                    <h4 class="font-weight-bold">Rp.{{$product->price}}</h4>
                    <div class="mt-3">
                        <p class="card-text">{!! nl2br($product->description) !!}</p>
                    </div>
                    <div class="mt-3">
                        <p>Stock: {{$product->stock}}</p>
                        <p>Category: <span class="badge bg-primary">{{$product->category->name}}</span></p>
                    </div>
                    @if(Auth::check() && Auth::user()->role == 'admin')
                    @else
                    <div class="my-3">
                        <form class="row" id="form-atc">
                            @csrf
                            <input type="hidden" name="product_id" value="{{$product->id}}">
                            <div class="row">
                                <div class="col-auto">
                                    <label class="visually-hidden" for="quantity">Quantity</label>
                                    <input type="number" min="1" value="1" class="form-control" id="quantity"
                                        name="qty" placeholder="Quantity" required>
                                </div>
                                <div class="col-auto">
                                    <button type="submit" class="btn btn-outline-primary">Add To Cart</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
