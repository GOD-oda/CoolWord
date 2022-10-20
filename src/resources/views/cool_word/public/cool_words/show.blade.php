@extends('cool_word.public.base')

@section('main')
  <div class="container py-3">
    <div class="row py-2">
      <h1>{{ $coolWord['name'] }}</h1>
    </div>

    <div class="row py-2">
      <p>{!! nl2br(e($coolWord['description'])) !!}</p>
    </div>
  </div>
@endsection
