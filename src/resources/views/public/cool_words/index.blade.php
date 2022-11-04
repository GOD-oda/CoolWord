@extends('public.base')

@section('main')
  <div class="index">
    <div class="container py-3">
      <form action="{{ route('cool_words.index') }}">
        <div class="row">
          <div class="col-6">
            @include('public.cool_words.form_components.name', ['value' => $input['name'] ?? ''])
          </div>
        </div>

        <div class="row">
          <div class="col-12">
            @include('public.cool_words.form_components.tag', ['tags' => $tags, 'originalTagIds' => $originalTagIds])
          </div>
        </div>

        <div class="row">
          <div class="col-4 mt-auto">
            <button type="submit" class="btn btn-primary">検索</button>
          </div>
        </div>
      </form>

      <div class="row">
        @foreach ($paginator->items() as $coolWord)
          <div class="col-sm-12 col-md-4 card-box">
            <h4><a href="{{ route('cool_words.show', ['id' => $coolWord['id']]) }}">{{ $coolWord['name'] }}</a></h4>
            <div class="d-flex">
              <div class="tags d-flex justify-content-between p-1">
                @foreach ($coolWord['tags'] as $tag)
                  <span class="mx-1">{{ $tag['name'] }}</span>
                @endforeach
              </div>
              <div class="d-flex align-items-center">
                <span class="material-symbols-outlined">visibility</span>
                <span class="ms-2">{{ $coolWord['views'] }}</span>
              </div>
            </div>
          </div>
        @endforeach
      </div>

      <div class="row my-3">
        {{ $paginator->links() }}
      </div>
    </div>
  </div>
@endsection
