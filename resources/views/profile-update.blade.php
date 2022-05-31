@extends('layouts.app')

@section('content')
<main class="py-4">
    <div class="container">
    <div class="row">
      <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
        <div class="card border-0 shadow rounded-3 my-4">
          <div class="card-body p-4 p-sm-3">
            <h5 class="card-title text-center mb-5 fw-light fs-5">Update Your Profile</h5>
            <form method="POST" action="{{ route('profile.save') }}">
                @csrf
                <div class="mb-3">
                    <label for="nameInput">Name</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="nameInput" name="name" value="{{ $user->name }}" required autofocus placeholder="Name">
                    @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="emailInput">Email Address</label>
                    <input type="email" class="form-control @error('email') is-invalid @enderror" id="emailInput" value="{{ $user->email }}" autocomplete="email" readonly>
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="password">Password</label>
                    <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" placeholder="Password" name="password" value="{{$user->created_at}}" required autocomplete="new-password">
                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="confirmPassword">Confirm Password</label>
                    <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror" id="confirmPassword" placeholder="Confirm Password" name="password_confirmation" required autocomplete="new-password">
                    @error('password_confirmation')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="address">Address</label>
                    <textarea type="text" class="form-control @error('address') is-invalid @enderror" id="address" name="address" required placeholder="Address">{{ $user->address }}</textarea>
                    @error('address')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="phone">Phone</label>
                    <input type="number" class="form-control @error('phone') is-invalid @enderror" id="phone" name="phone" value="{{ $user->phone }}" required placeholder="Phone">
                    @error('phone')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="my-2 float-end">
                    <a class="btn btn-secondary fw-bold" href="{{route('profile')}}">Cancel</a>
                    <button class="btn btn-primary fw-bold" type="submit">Save</button>
                </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</main>
@endsection
