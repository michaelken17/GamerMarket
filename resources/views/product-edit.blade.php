@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
      <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
        <div class="card border-0 shadow rounded-3 my-4">
          <div class="card-body p-4 p-sm-3">
            <h5 class="card-title text-center mb-5 fw-light fs-5">Edit Product</h5>
            <form method="POST" action="{{route('product.update', $product->id)}}" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label for="image">Image</label>
                    <input type="file" class="form-control @error('image') is-invalid @enderror" name="image" id="image" accept=".jpg,.jpeg,.png" required>
                    @error('image')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="nameInput">Name</label>
                    <input type="text" class="form-control" id="nameInput" value="{{ $product->name }}" readonly>
                </div>
                <div class="mb-3">
                    <label for="description">Description</label>
                    <textarea type="text" class="form-control @error('description') is-invalid @enderror" id="description" name="description" required placeholder="Description">{{ $product->description }}</textarea>
                    @error('description')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="price">Price</label>
                    <input type="number" class="form-control @error('price') is-invalid @enderror" id="price" name="price" value="{{ $product->price }}" required placeholder="Price">
                    @error('price')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="stock">Stock</label>
                    <input type="number" class="form-control @error('stock') is-invalid @enderror" id="stock" name="stock" value="{{ $product->stock }}" required placeholder="Stock">
                    @error('stock')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="category">Category</label>
                    <select class="form-control " id="category" readonly>
                        <option disabled selected>Select Category</option>
                        @foreach ($categories as $category)
                        <option value="{{$category->id}}" @if($category->id == $product->category_id) selected @endif disabled>{{$category->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="my-2 float-end">
                    <a class="btn btn-secondary fw-bold" href="{{route('product')}}">Cancel</a>
                    <button class="btn btn-primary fw-bold" type="submit">Update</button>
                </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
