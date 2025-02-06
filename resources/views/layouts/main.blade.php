<!DOCTYPE html>
<html lang="ru" data-bs-theme="dark">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    @yield('title')
    <link rel="shortcut icon" type="image/x-icon" href="build/images/favicon.png" />
    <link rel="stylesheet" href="{{ asset('build/assets/app-D-sv12UV.css') }}">
    <link rel="stylesheet" href="{{ asset('build/assets/app.css') }}">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Russo+One&display=swap" rel="stylesheet">

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

</head>

<body>
    <div class="col-12 header-block">
        <div class="container">
            <div class="row d-flex align-items-center">
                <nav class="navbar navbar-expand-lg col-12">
                    <div class="container-fluid">
                        <a class="nav-link me-5" href="{{ route('main.index') }}"><img
                                src="{{ asset('build/images/logo.png') }}" alt="logo" width=150></a>
                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                            data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false"
                            aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse" id="navbarNav">
                            <ul class="d-flex w-100 navbar-nav fs-5">
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('main.index') }}">Главная</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('afisha.index', date('d.m.y')) }}">Афиша
                                        мастер-классов</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('cabinets.index') }}">Помещения для аренды</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('main.about') }}">О нас</a>
                                </li>
                            </ul>
                            <div class="d-flex w-25 align-items-center">
                                @guest
                                    @if (Route::has('login'))
                                        <a class="nav-link text-decoration-none text-black fs-5 me-3"
                                            href="{{ route('login') }}">{{ __('Войти') }}</a>
                                    @endif

                                    @if (Route::has('register'))
                                        <a class="nav-link custom-button fs-5"
                                            href="{{ route('register') }}">{{ __('Регистрация') }}</a>
                                    @endif
                                @else
                                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                        data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                        {{ Auth::user()->name }} (@if (Auth::user()->role == 'user')
                                            Слушатель
                                        @elseif(Auth::user()->role == 'lector')
                                            Лектор
                                        @elseif(Auth::user()->role == 'admin')
                                            Админ
                                        @endif)
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                        @if (auth()->user()->role == 'admin')
                                            <a class="dropdown-item" href="{{ route('admin.index') }}">
                                                Админ-панель
                                            </a>
                                        @else
                                            <a class="dropdown-item" href="{{ route('account') }}">
                                                Личный кабинет
                                            </a>
                                        @endif
                                        <button type="button" class="dropdown-item d-flex bg-none" data-bs-toggle="modal"
                                            data-bs-target="#modalId1">
                                            Редактировать учётную запись
                                        </button>
                                        <a class="dropdown-item" href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            {{ __('Выйти') }}
                                        </a>
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                            class="d-none">
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
    @if (auth()->check())
        <div class="modal fade" id="modalId1" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false"
            role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-sm" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalTitleId">
                            Редактировать учётную запись
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="{{ route('account.user.edit') }}" enctype="multipart/form-data" method='post'>
                        <div class="modal-body">
                            @csrf
                            <span>Имя</span>
                            <input class='form-control' type="text" name="user_name" id=""
                                value='{{ auth()->user()->name }}'>
                            <span>Роль</span>
                            <select class="w-100 border rounded py-2" id="floatingSelect"
                                aria-label="Floating label select example" name='user_role'>
                                @if (auth()->user()->role == 'admin')
                                    <option class='form-option' selected value="admin">Админ</option>
                                @else
                                    <option class='form-option' selected value="user">Слушатель</option>
                                    <option value="lector">Лектор</option>
                                @endif
                            </select>
                            <input type="hidden" name="user_id" id="" value="{{ auth()->user()->id }}">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                Закрыть
                            </button>
                            <button type="submit" class="btn btn-primary">Отправить</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endif
    <div class="container mb-5 px-5 min-vh-100 ">
        @yield('content')
    </div>

    <div class="col-12 footer-block d-flex align-items-center justify-content-center">
        <p class='d-flex fs-3'>МастерЛектор &copy; 2024</p>
    </div>
    <script src="{{ asset('build/assets/app-DFMGEaK5.js') }}"></script>
    <script src="{{ asset('build/assets/app.js') }}"></script>
</body>

</html>
