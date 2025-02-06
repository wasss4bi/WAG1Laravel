@extends('layouts.main')
@section('title')
    <title>{{ $cabinet->title }}</title>
@endsection
@section('content')

<div class="container mt-5">
    <div class="row">
        <div class="col-md-8 mx-auto">
            <div class="card shadow-lg border-0 rounded-4">
                <img src="{{ asset("build/images/cabinet$id.jpg") }}" alt="" class='card-img-top rounded-top-4' style="height:400px; object-fit: cover;">
                <div class="card-body">
                    <h2 class='russo-one-regular'>{{ $cabinet->title }}</h2>
                    <p class='fs-5 text-muted'>{{ $cabinet->description }}</p>
                    <h4 class="text-primary">Стоимость: <span class="fw-bold">{{$cabinet->cost}}</span> / час</h4>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Блок с местами -->
<div class='container mt-5'>
    <h3 class='text-center mb-4'>Выбор мест</h3>
    <div class='d-flex flex-wrap justify-content-center gap-3'>
        @for ($i = 0; $i < 7; $i++)
            <button type="button" disabled class="seat-booked border border-3 border-dark rounded-pill p-3" data-bs-toggle="modal" data-bs-target="#exampleModal"></button>
        @endfor
    </div>
</div>

<!-- Модальное окно -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Детали бронирования</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Закрыть"></button>
            </div>
            <div class="modal-body">
                Здесь будет информация о выбранном месте.
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Закрыть</button>
                <button type="button" class="btn btn-primary">Подтвердить бронирование</button>
            </div>
        </div>
    </div>
</div>

<!-- Кнопка создания мастер-класса -->
<div class='d-flex justify-content-center my-5'>
    @if (auth()->check())
        @if (auth()->user()->role == 'lector')
            <a class='btn btn-primary btn-lg' href="{{ route('lector.create.form', $id) }}">Создать мастер-класс</a>
        @else
            <div class="d-flex flex-column text-center">
                <span class="text-muted">Только лектор может создавать мастер-классы</span>
                <button class='btn btn-secondary btn-lg' disabled>Создать мастер-класс</button>
            </div>
        @endif
    @endif
</div>

@endsection
