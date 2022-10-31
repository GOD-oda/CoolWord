@extends('cool_word.admin.base')

@section('main')
  <div class="container py-3">
    @if (session('success_msg'))
      <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success_msg') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
    @endif

    <form action="{{ route('admin.tags.index') }}" class="row g-3">
      <div class="col-8">
        <label for="name" class="form-label">Name</label>
        <input type="text" class="form-control" id="name" name="name" value="{{ $input['name'] ?? '' }}">
      </div>
      <div class="col-4 mt-auto">
        <button type="submit" class="btn btn-primary">検索</button>
      </div>
    </form>

    <div class="row">
      @foreach ($paginator->items() as $tag)
        <div class="col-md-4 col-sm-12 my-3">
          <div class="card">
            <div class="card-body">
              <p>{{ $tag['name'] }}</p>
            </div>
          </div>
        </div>
      @endforeach
    </div>

    <div class="row">
      {{ $paginator->links() }}
    </div>
  </div>
@endsection
