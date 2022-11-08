@extends('public.base')

@section('main')
  <div class="index">
    <div class="container py-3">
      <form action="{{ route('cool_words.index') }}">
        <div class="row">
          <div class="col-5">
            @include('public.cool_words.form_components.name', ['value' => $input['name'] ?? ''])
          </div>

          <div class="col-5">
            @include('public.cool_words.form_components.tag', ['tags' => $tags, 'originalTagIds' => $originalTagIds])
          </div>

          <div class="col-2">
            <button type="submit" class="btn btn-primary">検索</button>
          </div>
        </div>
      </form>

      <table class="cool-word-table">
        <thead>
        <tr>
          <th scope="col" colspan="5">Name</th>
          <th scope="col" colspan="5">Tag</th>
          <th scope="col" colspan="2">閲覧数</th>
        </tr>
        </thead>

        <tbody>
        @foreach ($paginator->items() as $coolWord)
          <tr class="cool-word">
            <th scope="row" colspan="5" class="cool-word-name">
              <a href="{{ route('cool_words.show', ['id' => $coolWord['id']]) }}">{{ $coolWord['name'] }}</a>
            </th>
            <td class="cool-word-tag d-flex align-items-center flex-wrap" colspan="5">
              @foreach ($coolWord['tags'] as $tag)
                <span class="tag">{{ $tag['name'] }}</span>
              @endforeach
            </td>
            <td colspan="2">{{ $coolWord['views'] }}</td>
          </tr>
        @endforeach
        </tbody>
      </table>

      <div class="row my-3">
        {{ $paginator->links() }}
      </div>
    </div>
  </div>
@endsection
