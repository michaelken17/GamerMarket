@extends('layouts.app')

@section('content')
<main class="py-4">
    <div class="container">
    <div class="row">
    <div class="col-6 mx-auto">
        <div class="card border-0 shadow rounded-3 my-4">
            <ul class="list-group list-group-horizontal-md">
            @forelse ($categories as $category)
                <li class="list-group-item">
                    {{$category->name}}
                </li>
            @empty
                <h4>No Category</h4>
            @endforelse
            </ul>
        </div>
    </div>
    </div>
      <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
        <div class="card border-0 shadow rounded-3 my-4">
          <div class="card-body">
            <h5 class="card-title text-center mb-5 fw-light fs-5">Add new Category</h5>
            @if ($message = Session::get('success'))
                <div class="alert alert-success alert-block">
                    <strong>{{ $message }}</strong>
                </div>
            @endif
            <form method="POST" action="{{ route('category.add') }}">
                @csrf
                <div class="mb-3">
                    <label for="nameInput">Name</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="nameInput" name="name" value="{{ old('name') }}" required autofocus placeholder="Name">
                    @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="my-2 float-end">
                    <button class="btn btn-primary fw-bold" type="submit">Add</button>
                </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</main>
@endsection
