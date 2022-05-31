@extends('layouts.app')

@section('content')
<main class="py-4">
    <div class="container">
    <h2 class="text-center">Products</h2>
    @if ($message = Session::get('success'))
        <div class="alert alert-success alert-block">
            <strong>{{ $message }}</strong>
        </div>
    @endif
    <div class="row">
        <div class="col-lg-6 mb-4 col-md-6">
            <form class="row g-2" method="GET">
                <div class="col-auto">
                    <label for="search" class="visually-hidden">Search</label>
                    <input type="text" class="form-control" id="search" name="search" value="{{request()->has('search') ? request()->get('search') : ''}}" placeholder="Search">
                </div>
                <div class="col-auto">
                    <button type="submit" class="btn btn-primary me-2">Search</button>
                    <a href="{{route('product.add')}}" class="btn btn-outline-dark">Add Product</a>
                </div>
            </form>
        </div>
    </div>
    @if(request()->has('search'))
     <h4 class="text-center">Search Result For: {{request()->get('search')}}</h4>
    @endif
    <div class="row">
        @forelse ($products as $product)
        <div class="col-lg-4 mb-4 col-md-6">
            <div class="card h-auto">
                <a href="{{route('product.show', $product->id)}}">
                    <img class="card-img-top" src="{{url("images/{$product->image}")}}" alt="{{$product->name}}" draggable="false">
                </a>
                <div class="card-body text-center">
                    <h5 class="card-title">
                        <a href="#" class="text-decoration-none">{{$product->name}}</a>
                    </h5>
                    <h5>Rp.{{$product->price}}</h5>
                    <div class="mb-2">
                        <span class="text-warning">{{$product->category->name}}</span>
                    </div>
                    @auth
                        @if(Auth::user()->role == 'admin')
                            @if($product->stock <= 0)
                                <span class="text-danger">Product is Unavailable</span>
                            @endif
                            <button class="btn btn-outline-danger btn-delete mx-2" onclick="deleteProduct(this,{{$product->id}})">Remove</button>
                            <a class="btn btn-outline-primary mx-2" href="{{route('product.edit', $product->id)}}">Edit</a>
                        @else
                            @if($product->stock > 0)
                                <button type="button" class="btn btn-outline-primary btn-cart" onclick="addToCart({{$product->id}},1)">Add To Cart</button>
                            @else
                                <span class="text-danger">Product is Unavailable</span>
                            @endif
                        @endif
                    @endauth
                    @guest
                        @if($product->stock > 0)
                            <button class="btn btn-outline-primary" onclick="addToCart({{$product->id}},1)">Add To Cart</button>
                        @else
                            <span class="text-danger">Product is Unavailable</span>
                        @endif
                    @endguest
                </div>
            </div>
        </div>
        @empty
            <h3 class="text-center">No Products Found!</h3>
        @endforelse
    </div>
    {{$products->links()}}
</div>
</main>
@endsection
