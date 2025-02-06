@extends('layouts.main')
@section('title')
<title>Вход</title>
@endsection
@section('content')
<div class="row justify-content-center mt-5">
    <div class="col-md-9 ">
        <div class="card rounded-4 ">
            <div class="card-body">
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="row justify-content-end align-items-center">
                        <div class="col-md-5 col-12  justify-content-end">
                            <h2 class="russo-one-regular text-center">Вход</h2>
                        </div>

                        <div class="col-md-7 col-12">
                            <p>Нет аккаунта? <a class="text-decoration-none" href="{{route('register')}}">Зарегистрироваться</a></p>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="email" class="col-md-3 col-form-label text-md-center">{{ __('Email') }}</label>

                        <div class="col-md-9">
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="password" class="col-md-3 col-form-label text-md-center">{{ __('Пароль') }}</label>

                        <div class="col-md-9">
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-9 offset-md-3">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                <label class="form-check-label" for="remember">
                                    {{ __('Запомнить') }}
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="row d-flex justify-content-center mb-0">
                        <div class="col-md-9 col-12  d-flex justify-content-center  offset-md-3">
                            <input type="hidden" name="redirect_to" value="{{url()->previousPath()}}">
                            <button type="submit" class=" justify-content-center custom-button fs-5">
                                {{ __('Войти') }}
                            </button>

                            @if (Route::has('password.request'))
                            <!-- <a class="btn btn-link" href="{{ route('password.request') }}">
                                {{ __('Forgot Your Password?') }}
                            </a> -->
                            @endif
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
