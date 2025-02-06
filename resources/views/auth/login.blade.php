@extends('layouts.main')
@section('title')
<title>Вход</title>
@endsection
@section('content')
<div class="row justify-content-center mt-5">
    <div class="col-md-6 col-12">
        <div class="card shadow-lg border-0 rounded-4">
            <div class="card-body p-5">
                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <h3 class="text-center mb-4 font-weight-bold text-primary">Войти в аккаунт</h3>

                    <div class="row mb-4">
                        <label for="email" class="col-md-12 col-form-label text-md-left text-muted">{{ __('Email') }}</label>
                        <div class="col-md-12">
                            <div class="input-group">
                                <span class="input-group-text bg-light">
                                    <i class="fas fa-envelope"></i>
                                </span>
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="Введите ваш email">
                            </div>
                            @error('email')
                            <div class="invalid-feedback">
                                <strong>{{ $message }}</strong>
                            </div>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-4">
                        <label for="password" class="col-md-12 col-form-label text-md-left text-muted">{{ __('Пароль') }}</label>
                        <div class="col-md-12">
                            <div class="input-group">
                                <span class="input-group-text bg-light">
                                    <i class="fas fa-lock"></i>
                                </span>
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="Введите ваш пароль">
                            </div>
                            @error('password')
                            <div class="invalid-feedback">
                                <strong>{{ $message }}</strong>
                            </div>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-4 d-flex justify-content-between">
                        <div class="col-md-6 d-flex align-items-center">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                <label class="form-check-label text-muted" for="remember">
                                    {{ __('Запомнить меня') }}
                                </label>
                            </div>
                        </div>
                        <div class="col-md-6 text-end">
                            @if (Route::has('password.request'))
                            <a class="text-decoration-none text-muted" href="{{ route('password.request') }}">
                                {{ __('Забыли пароль?') }}
                            </a>
                            @endif
                        </div>
                    </div>

                    <div class="row d-flex justify-content-center mb-0">
                        <div class="col-md-12 d-flex justify-content-center">
                            <button type="submit" class="btn btn-primary btn-block w-100 py-2 fs-5 rounded-3 shadow-sm">
                                {{ __('Войти') }}
                            </button>
                        </div>
                    </div>

                    <div class="row mt-3 text-center">
                        <div class="col-md-12">
                            <p class="text-muted mb-0">Нет аккаунта? <a href="{{ route('register') }}" class="text-decoration-none text-primary">Зарегистрироваться</a></p>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
