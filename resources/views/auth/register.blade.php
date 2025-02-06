@extends('layouts.main')
@section('title')
    <title>Регистрация</title>
@endsection
@section('content')
    <div class="row justify-content-center mt-5">
        <div class="col-md-12 ">
            <div class="card rounded-4 ">
                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf
                        <div class="row justify-content-end align-items-center">
                            <div class="col-md-5 col-12 justify-content-end">
                                <h2 class="russo-one-regular text-center">Регистрация</h2>
                            </div>

                            <div class="col-md-7 col-12">
                                <p>Уже есть аккаунт? <a class="text-decoration-none" href="{{ route('login') }}">Войти</a>
                                </p>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="name" class="col-md-3 col-form-label text-md-center">{{ __('Имя') }}</label>

                            <div class="col-md-9">
                                <input id="name" maxlength="40" type="text"
                                    class="form-control @error('name') is-invalid @enderror" name="name"
                                    value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="birthdate"
                                class="col-md-3 col-form-label text-md-center">{{ __('Дата рождения') }}</label>

                            <div class="col-md-9">
                                <input id="birthdate" type="date" name='birthdate'
                                    class="form-control @error('birthdate') is-invalid @enderror" required max="{{date("Y-m-d")}}">
                                @error('birthdate')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>


                        <div class="row mb-3">
                            <label for="role" class="col-md-3 col-form-label text-md-center">{{ __('Роль') }}</label>

                            <div class="col-md-9">

                                <select class="form-select form-select-lg @error('role') is-invalid @enderror"
                                    name="role" id="role" required autocomplete="role">
                                    <option value="user" selected>Слушатель</option>
                                    <option value="lector">Лектор</option>
                                </select>
                                @error('role')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>



                        <div class="row mb-3">
                            <label for="email" class="col-md-3 col-form-label text-md-center">{{ __('Email') }}</label>

                            <div class="col-md-9">
                                <input id="email" type="email"
                                    class="form-control @error('email') is-invalid @enderror" name="email"
                                    value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password"
                                class="col-md-3 col-form-label text-md-center">{{ __('Пароль') }}</label>

                            <div class="col-md-9">
                                <input id="password" type="password"
                                    class="form-control @error('password') is-invalid @enderror" name="password" required
                                    autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password-confirm"
                                class="col-md-3 col-form-label text-md-center">{{ __('Подтвердите пароль') }}</label>

                            <div class="col-md-9">
                                <input id="password-confirm" type="password" class="form-control"
                                    name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="privacy_policy" class="col-md-3 col-form-label text-md-center">Вы согласны с нашей
                                <a href="#" data-bs-toggle="modal" data-bs-target="#modalId">политикой конфиденциальности</a></label>
                            <!-- Modal Body -->
                            <!-- if you want to close by clicking outside the modal, delete the last endpoint:data-bs-backdrop and data-bs-keyboard -->
                            <div class="modal fade" id="modalId" tabindex="-1" data-bs-backdrop="static"
                                data-bs-keyboard="false" role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-lg"
                                    role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="modalTitleId">
                                                Политика конфиденциальности
                                            </h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">@include('auth.privacy_policy')</div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                                Закрыть
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-9">
                                <input id="privacy_policy" type="checkbox" class="form-check-input p-3"
                                    name="privacy_policy" required>
                            </div>
                        </div>

                        <div class="row d-flex justify-content-center mb-0">
                            <div class="col-md-9 col-12  d-flex justify-content-center offset-md-3">
                                <input type="hidden" name="redirect_to" value="{{url()->previousPath()}}">
                                <button type="submit" class=" justify-content-center custom-button fs-5">
                                    {{ __('Зарегистрироваться') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
