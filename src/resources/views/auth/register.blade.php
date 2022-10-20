@extends('admin_base')

@section('main')
  <div class="container py-3">
    <form method="POST" action="{{ route('auth.register.register') }}">
      @csrf

      <div class="row mb-3">
        <label for="name" class="col-md-3 col-form-label text-md-end">Name</label>
        <div class="col-md-8">
          <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required>

          @error('name')
            <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
            </span>
          @enderror
        </div>
      </div>

      <div class="row mb-3">
        <label for="email" class="col-md-3 col-form-label text-md-end">Email</label>
        <div class="col-md-8">
          <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required>
          @error('email')
            <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
            </span>
          @enderror
        </div>
      </div>

      <div class="row mb-3">
        <label for="password" class="col-md-3 col-form-label text-md-end">Password</label>

        <div class="col-md-8">
          <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required>
          @error('password')
            <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
            </span>
          @enderror
        </div>
      </div>

      <div class="row mb-3">
        <label for="password-confirm" class="col-md-3 col-form-label text-md-end">Confirm Password</label>

        <div class="col-md-8">
          <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
        </div>
      </div>

      <div class="row">
        <div class="col-md-8 offset-md-3">
          <button type="submit" class="btn btn-primary">Login</button>
        </div>
      </div>

    </form>
  </div>
@endsection
