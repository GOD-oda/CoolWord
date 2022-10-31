@extends('cool_word.admin.base')

@section('main')
  <div class="container py-3">
    @if ($errors->any())
      <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <ul>
          @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
    @endif

    @if (session('success_msg'))
      <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success_msg') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
    @endif

    <form action="{{ route('admin.cool_words.create') }}" method="post">
      @csrf

      <div class="mb-3">
        @include('cool_word.admin.cool_words.form_components.name', ['value' => '', 'disabled' => false])
      </div>

      <div class="mb-3">
        @include('cool_word.admin.cool_words.form_components.description', ['value' => ''])
      </div>

      <button type="submit" class="btn btn-primary">Submit</button>
    </form>
  </div>
@endsection
