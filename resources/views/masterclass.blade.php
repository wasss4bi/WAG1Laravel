@extends('layouts.main')
@section('title')
    <title>{{ $masterclass->title }}</title>
@endsection
@section('content')
    <img src="{{ asset('storage/images/' . $masterclass->img_main) }}" alt="" class='mt-5 img-rounded w-100 img-fluid '
        style="max-height:600px; object-fit: cover;">
    <h2 class='russo-one-regular'>{{ $masterclass->title }}</h2>
    <h2 class='fs-5'>Автор: {{ $masterclass->author }}</h2>
    <input type="hidden" id="booked-seats" value="{{ json_encode($booked_seats) }}">
    @if (session('message'))
        <script>
            alert("{{ session('message') }}")
        </script>
    @endif
    <p class='fs-3'>{{ $masterclass->description }}</p>
    <div id="carouselExampleIndicators{{ $masterclass->id }}" class="carousel slide my-4">
        <div class="carousel-inner">
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#carouselExampleIndicators{{ $masterclass->id }}"
                    data-bs-slide-to="0" class="active carouselIndicator" aria-current="true" aria-label="Slide 1"></button>
                @for ($i = 1; $i < count($galleries->where('masterclass_id', $masterclass->id)->all()); $i++)
                    <button type="button" data-bs-target="#carouselExampleIndicators{{ $masterclass->id }}"
                        class="carouselIndicator" data-bs-slide-to="{{ $i }}"
                        aria-label="Slide {{ $i }}"></button>
                @endfor

            </div>
            <div class="carousel-item active">
                <img src="{{ asset('storage/images/' . $galleries->where('masterclass_id', $masterclass->id)->first()->img_name) }}"
                    class="d-block img-rounded w-100 img-fluid img-sizing" style=" max-height:600px; object-fit: cover; "
                    alt="...">
            </div>
            @foreach ($galleries->where('masterclass_id', $masterclass->id)->all() as $img)
                @if ($img->id !== $galleries->where('masterclass_id', $masterclass->id)->first()->id)
                    <div class="carousel-item">
                        <img src="{{ asset('storage/images/' . $img->img_name) }}"
                            class="d-block img-rounded w-100 img-fluid img-sizing"
                            style=" max-height:600px; object-fit: cover; " alt="...">
                    </div>
                @endif
            @endforeach
        </div>
        <button class="carousel-control-prev" type="button"
            data-bs-target="#carouselExampleIndicators{{ $masterclass->id }}" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button"
            data-bs-target="#carouselExampleIndicators{{ $masterclass->id }}" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
    <div class='fs-3 ms-3 my-5'>Цена: <span
            class="justify-content-center rounded-4 russo-one-regular">{{ $masterclass->price }}
            ₽/лекция</span></div>

    <div class="d-flex">

        <div class=" d-flex justify-items-center align-items-center me-5">
            <button type="button" class="seat-free border border-5 border-black rounded-4" disabled data-bs-toggle="modal"
                data-bs-target="#exampleModal"></button>
            <span class=' fs-4 ms-1 '>Свободно</span>
        </div>

        <div class="d-flex justify-items-center align-items-center">
            <button type="button" disabled class="seat-booked border border-5 border-black rounded-4"
                data-bs-toggle="modal" data-bs-target="#exampleModal"></button>
            <span class='fs-4 ms-1'>Занято</span>
        </div>

    </div>
    <div class='w-100 mt-5 class-padding class d-flex justify-content-center flex-wrap'>
        <div class='d-flex w-100 flex-wrap justify-content-center'>
            <div class='d-flex class-top justify-content-around w-75 seat-padding '>
                <button type="button"
                    class="seat-free border border-5 border-black rounded-4 russo-one-regular russo-one-regular "
                    data-seat_num='1' data-bs-toggle="modal" data-bs-target="#exampleModal">1</button>
                <button type="button"
                    class="seat-free border border-5 border-black rounded-4 russo-one-regular russo-one-regular "
                    data-seat_num='2' data-bs-toggle="modal" data-bs-target="#exampleModal">2</button>
                <button type="button" class="seat-free border border-5 border-black rounded-4 russo-one-regular"
                    data-seat_num='3' data-bs-toggle="modal" data-bs-target="#exampleModal">3</button>
            </div>
            <div class='d-flex class-right-top justify-content-end w-100'>
                <button type="button"
                    class="seat-free border border-5 border-black rounded-4 russo-one-regular seat-top-margin"
                    data-seat_num='4' data-bs-toggle="modal" data-bs-target="#exampleModal">4</button>
            </div>
        </div>
        <div class='d-flex w-100 flex-wrap justify-content-center'>
            <div class='d-flex class-right-bottom justify-content-end w-100 align-items-end seat-bottom-margin'>
                <button type="button" class="seat-free border border-5 border-black rounded-4 russo-one-regular"
                    data-seat_num='5' data-bs-toggle="modal" data-bs-target="#exampleModal">5</button>
            </div>
            <div class='d-flex class-bottom justify-content-around w-75 align-items-end seat-padding'>
                <button type="button" class="seat-free border border-5 border-black rounded-4 russo-one-regular"
                    data-seat_num='8' data-bs-toggle="modal" data-bs-target="#exampleModal">8</button>
                <button type="button" class="seat-free border border-5 border-black rounded-4 russo-one-regular"
                    data-seat_num='7' data-bs-toggle="modal" data-bs-target="#exampleModal">7</button>
                <button type="button" class="seat-free border border-5 border-black rounded-4 russo-one-regular"
                    data-seat_num='6' data-bs-toggle="modal" data-bs-target="#exampleModal">6</button>
            </div>
        </div>



    </div>
    @if (auth()->check())
        @if ($masterclass->age_restriction == 0 || strtotime('-18 year') > strtotime(auth()->user()->birthdate))
            <!-- Модальное окно -->
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Записаться на мастер-класс</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Закрыть"></button>
                        </div>
                        <div class="modal-body">
                            Вы уверены, что хотите записаться?
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Закрыть</button>
                            <form action="{{ route('seat.booking') }}" method='post'>
                                @csrf
                                <input type="hidden" value="" id="seat_num" name="seat_num">
                                <input type="hidden" value="{{ $event->id }}" id="event_id" name="event_id">
                                <input type="hidden" value="{{ auth()->user()->id }}" id="user_id" name="user_id">
                                <!-- <input type="hidden" value="{{ $masterclass->id }}" id="masterclass_id" name="masterclass_id"> -->
                                <input type="hidden" value="{{ $event->cabinet_id }}" id="cabinet_id" name="cabinet_id">
                                <button type="submit" class="btn btn-primary">Записаться</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @else
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel"></h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Закрыть"></button>
                        </div>
                        <div class="modal-body">
                            Этот мастер-класс только для совершеннолетних
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Закрыть</button>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    @else
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel"></h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Закрыть"></button>
                    </div>
                    <div class="modal-body">
                        Авторизуйтесь, чтобы записываться на мастер-классы
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Закрыть</button>
                        <a href="{{ route('login') }}" class="btn btn-primary">Войти</a>
                    </div>
                </div>
            </div>
        </div>
    @endif
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            /* Получаю данные из input с type='hidden' */
            var bookedSeats = JSON.parse($('#booked-seats').val());
            $('.seat-free').each(function() {
                var seatNum = $(this).data('seat_num');
                if (bookedSeats.includes(seatNum)) {
                    $(this).prop('disabled', true).addClass('seat-booked');
                    $(this).removeClass('seat-free');
                }
            });
            $('.seat-free').click(function() {
                var seat_num = $(this).data('seat_num');
                $('#seat_num').val(seat_num);
                var event_time = $(this).data('event_time');
                $('#event_time').val(event_time);
            });
        });
    </script>
@endsection
