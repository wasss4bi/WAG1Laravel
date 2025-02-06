@extends('layouts.main')
@section('title')
    <title>Регистрация</title>
@endsection
@section('content')
<div class="row justify-content-center mt-5">
    <div class="col-md-6 col-12">
        <div class="card shadow-lg border-0 rounded-4">
            <div class="card-body p-5">
                <form method="POST" action="{{ route('register') }}">
                    @csrf

                    <h3 class="text-center mb-4 font-weight-bold text-primary">Создайте аккаунт</h3>

                    <div class="row mb-4">
                        <label for="name" class="col-md-12 col-form-label text-md-left text-muted">{{ __('Имя') }}</label>
                        <div class="col-md-12">
                            <div class="input-group">
                                <span class="input-group-text bg-light">
                                    <i class="fas fa-user"></i>
                                </span>
                                <input id="name" maxlength="40" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus placeholder="Введите ваше имя">
                            </div>
                            @error('name')
                            <div class="invalid-feedback">
                                <strong>{{ $message }}</strong>
                            </div>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-4">
                        <label for="birthdate" class="col-md-12 col-form-label text-md-left text-muted">{{ __('Дата рождения') }}</label>
                        <div class="col-md-12">
                            <div class="input-group">
                                <span class="input-group-text bg-light">
                                    <i class="fas fa-calendar-alt"></i>
                                </span>
                                <input id="birthdate" type="date" name="birthdate" class="form-control @error('birthdate') is-invalid @enderror" required max="{{date('Y-m-d')}}">
                            </div>
                            @error('birthdate')
                            <div class="invalid-feedback">
                                <strong>{{ $message }}</strong>
                            </div>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-4">
                        <label for="role" class="col-md-12 col-form-label text-md-left text-muted">{{ __('Роль') }}</label>
                        <div class="col-md-12">
                            <select class="form-select form-select-lg @error('role') is-invalid @enderror" name="role" id="role" required>
                                <option value="user" selected>Слушатель</option>
                                <option value="lector">Лектор</option>
                            </select>
                            @error('role')
                            <div class="invalid-feedback">
                                <strong>{{ $message }}</strong>
                            </div>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-4">
                        <label for="email" class="col-md-12 col-form-label text-md-left text-muted">{{ __('Email') }}</label>
                        <div class="col-md-12">
                            <div class="input-group">
                                <span class="input-group-text bg-light">
                                    <i class="fas fa-envelope"></i>
                                </span>
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="Введите ваш email">
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
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" placeholder="Введите пароль">
                            </div>
                            @error('password')
                            <div class="invalid-feedback">
                                <strong>{{ $message }}</strong>
                            </div>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-4">
                        <label for="password-confirm" class="col-md-12 col-form-label text-md-left text-muted">{{ __('Подтвердите пароль') }}</label>
                        <div class="col-md-12">
                            <div class="input-group">
                                <span class="input-group-text bg-light">
                                    <i class="fas fa-lock"></i>
                                </span>
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password" placeholder="Подтвердите пароль">
                            </div>
                        </div>
                    </div>

                    <div class="row mb-4">
                        <label for="privacy_policy" class="col-md-12 col-form-label text-md-left text-muted">
                            Вы согласны с нашей <a href="#" data-bs-toggle="modal" data-bs-target="#modalId">политикой конфиденциальности</a>
                        </label>
                        <div class="modal fade" id="modalId" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-lg" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="modalTitleId">Политика конфиденциальности</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">@include('auth.privacy_policy')</div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Закрыть</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <input id="privacy_policy" type="checkbox" class="form-check-input" name="privacy_policy" required>
                        </div>
                    </div>

                    <div class="row d-flex justify-content-center mb-0">
                        <div class="col-md-12 d-flex justify-content-center">
                            <input type="hidden" name="redirect_to" value="{{ url()->previous() }}">
                            <button type="submit" class="btn btn-primary btn-block w-100 py-2 fs-5 rounded-3 shadow-sm">
                                {{ __('Зарегистрироваться') }}
                            </button>
                        </div>
                    </div>

                    <div class="row mt-3 text-center">
                        <div class="col-md-12">
                            <p class="text-muted mb-0">Уже есть аккаунт? <a href="{{ route('login') }}" class="text-decoration-none text-primary">Войти</a></p>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
