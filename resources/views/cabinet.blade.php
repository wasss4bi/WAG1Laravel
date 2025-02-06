@extends('layouts.main')
@section('title')
    <title>{{ $cabinet->title }}</title>
@endsection
@section('content')

    <img src="{{ asset("build/images/cabinet$id.jpg") }}" alt="" class='mt-5 img-rounded w-100 img-fluid img-sizing '
        style="height:600px; object-fit: cover;">
    <h2 class='d-flex w-100 mt-3 russo-one-regular '>{{ $cabinet->title }}</h2>
    <p class='fs-3'>{{ $cabinet->description }}</p>
    <h3>Стоимость: {{$cabinet->cost}}/час</h3>
    <div class="d-flex">
        <div class="d-flex justify-items-center align-items-center">
            <button type="button" disabled class="seat-booked border border-5 border-black rounded-4" data-bs-toggle="modal"
                data-bs-target="#exampleModal"></button>
            <span class='fs-3 ms-3'>Место посетителя</span>
        </div>
    </div>
    <div class='w-100 mt-5 class-padding class d-flex justify-content-center flex-wrap'>
        <div class='d-flex w-100 flex-wrap justify-content-center'>
            <div class='d-flex class-top justify-content-around w-75 seat-padding'>
                <button type="button" disabled class="seat-booked border border-5 border-black rounded-4"
                    data-bs-toggle="modal" data-bs-target="#exampleModal"></button>
                <button type="button" disabled class="seat-booked border border-5 border-black rounded-4"
                    data-bs-toggle="modal" data-bs-target="#exampleModal"></button>
                <button type="button" disabled class="seat-booked border border-5 border-black rounded-4"
                    data-bs-toggle="modal" data-bs-target="#exampleModal"></button>
            </div>
            <div class='d-flex class-right-top justify-content-end w-100'>
                <button type="button" disabled class="seat-booked border border-5 border-black rounded-4"
                    data-bs-toggle="modal" data-bs-target="#exampleModal"></button>
            </div>
        </div>
        <div class='d-flex w-100 flex-wrap justify-content-center'>
            <div class='d-flex class-right-bottom justify-content-end w-100 align-items-end seat-bottom-margin'>
                <button type="button" disabled class="seat-booked border border-5 border-black rounded-4"
                    data-bs-toggle="modal" data-bs-target="#exampleModal"></button>
            </div>
            <div class='d-flex class-bottom justify-content-around w-75 align-items-end seat-padding'>
                <button type="button" disabled class="seat-booked border border-5 border-black rounded-4"
                    data-bs-toggle="modal" data-bs-target="#exampleModal"></button>
                <button type="button" disabled class="seat-booked border border-5 border-black rounded-4"
                    data-bs-toggle="modal" data-bs-target="#exampleModal"></button>
                <button type="button" disabled class="seat-booked border border-5 border-black rounded-4"
                    data-bs-toggle="modal" data-bs-target="#exampleModal"></button>
            </div>
        </div>
    </div>


    <!-- Модальное окно -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Заголовок модального окна</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Закрыть"></button>
                </div>
                <div class="modal-body">
                    ...
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Закрыть</button>
                    <button type="button" class="btn btn-primary">Сохранить изменения</button>
                </div>
            </div>
        </div>
    </div>
    <div class='d-flex justify-content-center my-5'>
        @if (auth()->check())
            @if (auth()->user()->role == 'lector')
                <a class='custom-button fs-3 d-flex' href="{{ route('lector.create.form', $id) }}">Создать
                    мастер-класс</a>
            @else
                <div class="d-flex flex-column justify-content-center" >
                    <span class="d-flex">Только лектор может создавать мастер-классы</span>
                    <span class='custom-button bg-secondary fs-3 d-flex justify-content-center'>Создать
                        мастер-класс</span>
                </div>
            @endif
        @endif
    </div>
@endsection
