@extends('admin.base')

@section('main')
  <div class="container py-3">
    <form action="{{ route('auth.login') }}" method="post">
      @csrf

      <div class="row mb-3">
        <label for="email" class="col-md-3 col-form-label text-md-end">Email</label>
        <div class="col-md-8">
          <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}" required>
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
          <input id="password" type="password" class="form-control" name="password" required>
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
