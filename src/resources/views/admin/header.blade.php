<header class="my-2">
  <div class="container">
    @if (Auth::check())
      <div class="row justify-content-end">
        <div class="col-4">
          <a href="{{ route('admin.cool_words.new') }}" class="btn btn-primary">新規作成</a>
        </div>

        <div class="col-4">
          <form action="{{ route('auth.logout') }}" method="POST">
            @csrf

            <button type="submit" class="btn btn-primary">Log out</button>
          </form>
        </div>
      </div>
    @endif
  </div>
</header>
