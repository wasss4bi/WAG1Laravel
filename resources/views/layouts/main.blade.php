<!DOCTYPE html>
<html lang="ru">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Document</title>
  <!-- @vite(['resources/css/app.css', 'resources/js/app.js']) -->
  <link rel="stylesheet" href="{{asset('build/assets/app-D-sv12UV.css')}}">
  <link rel="stylesheet" href="{{asset('build/assets/app.css')}}">
  <script src="{{asset('build/assets/app-DFMGEaK5.js')}}"></script>
  <script src="{{asset('build/assets/app.js')}}"></script>
</head>

<body>
  <div class="col-12 header-line"></div>
  <div class="col-12 header-block">
    <div class="container">
      <div class="row d-flex align-items-center">
        <nav class="navbar navbar-expand-lg col-12">
          <div class="container-fluid">
            <a class="nav-link me-5" href="{{route('main.index')}}"><img src="{{asset('build/images/logo.png')}}" alt="logo" width=100></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
              <ul class="d-flex w-100 navbar-nav fs-5">
                <li class="nav-item">
                  <a class="nav-link" href="{{route('main.index')}}">Главная</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="{{route('afisha.index')}}">Афиша мастер-классов</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="{{route('rooms.index')}}">Помещения для аренды</a>
                </li>
              </ul>
              <div class="d-flex w-25 align-items-center">
              @guest
              @if (Route::has('login'))
                <a class="nav-link text-decoration-none text-black fs-5 me-3" href="{{ route('login') }}">{{ __('Войти') }}</a>
              @endif

              @if (Route::has('register'))
                <a class="nav-link custom-button fs-5" href="{{ route('register') }}">{{ __('Регистрация') }}</a>
              @endif
              @else
              <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                {{ Auth::user()->name }}
              </a>

              <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                  {{ __('Выйти') }}
                </a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                  @csrf
                </form>
              </div>
              @endguest
              </div>
            </div>
          </div>
        </nav>
      </div>
    </div>
  </div>

  <div class="container mb-5 px-5">

    @yield('content')
  </div>

  <div class="col-12 footer-block d-flex align-items-center justify-content-center">
    <p class='d-flex fs-3'>MightyRealty &copy; 2024</p>
  </div>
</body>

</html>