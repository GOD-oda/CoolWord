<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>{{ Config::get('app.name') }}</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>

<header class="my-2">
  <div class="container">
    @if (Auth::check())
      <nav class="navbar navbar-expand-lg navbar-light">
      <div class="container-fluid justify-content-end">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="cool-word" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                CoolWord
              </a>
              <ul class="dropdown-menu" aria-labelledby="cool-word">
                <li><a class="dropdown-item" href="{{ route('admin.cool_words.new') }}">新規作成</a></li>
                <li><a class="dropdown-item" href="{{ route('admin.cool_words.index') }}">一覧</a></li>
              </ul>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="tag" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                Tag
              </a>
              <ul class="dropdown-menu" aria-labelledby="tag">
                <li><a class="dropdown-item" href="{{ route('admin.tags.new') }}">新規作成</a></li>
                <li><a class="dropdown-item" href="{{ route('admin.tags.index') }}">一覧</a></li>
              </ul>
            </li>
          </ul>
          <form action="{{ route('auth.logout') }}" method="POST">
            @csrf

            <button type="submit" class="btn btn-outline-primary">Log out</button>
          </form>
        </div>
      </div>
    </nav>
    @endif
  </div>
</header>

<main>
  @yield('main')
</main>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>
