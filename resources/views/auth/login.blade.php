@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
      <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
        <div class="card border-0 shadow rounded-3 my-5">
          <div class="card-body p-4 p-sm-5">
            <h5 class="card-title text-center mb-5 fw-light fs-5">Sign In</h5>
            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="mb-3">
                    <label for="emailInput">Email address</label>
                    <input type="email" class="form-control @error('email') is-invalid @enderror" id="emailInput" name="email" value="{{ old('email') ?? Cookie::get('remember_email') }}" required autocomplete="email" autofocus placeholder="Email">
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="floatingPassword">Password</label>
                    <input type="password" class="form-control @error('password') is-invalid @enderror" id="floatingPassword" placeholder="Password" name="password" required autocomplete="current-password">
                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-check mb-3">
                    <input class="form-check-input" type="checkbox" name="remember_email" id="rememberEmail" {{ old('remember') ? 'checked' : '' }}>
                    <label class="form-check-label" for="rememberEmail">Remember Email</label>
                </div>
                <div class="d-grid">
                    <button class="btn btn-danger text-uppercase fw-bold" type="submit">Sign in</button>
                </div>
                <hr class="my-4">
                <div class="d-grid">
                    <a class="btn text-uppercase fw-bold" href="{{route('register')}}">Register</a>
                </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
