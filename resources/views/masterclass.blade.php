@extends('layouts.main')

@section('title')
    <title>{{ $masterclass->title }}</title>
@endsection

@section('content')
    <div class="container py-5">
        <div class="row justify-content-center">
            <!-- Главный блок с изображением мастер-класса -->
            <div class="col-12 col-md-8 text-center mb-5">
                <img src="{{ asset('storage/images/' . $masterclass->img_main) }}" alt="Masterclass Image"
                    class="img-fluid rounded shadow" style="max-height:600px; object-fit: cover;">
            </div>
            <div class="col-12 text-center">
                <h2 class="russo-one-regular">{{ $masterclass->title }}</h2>
                <h4 class="text-muted">Автор: {{ $masterclass->author }}</h4>
                <p class="fs-3">{{ $masterclass->description }}</p>
                <div id="carousel-container">
                    @php
                        $carouselImages = $galleries->where('masterclass_id', $masterclass->id)->all();
                    @endphp
                    @if (count($carouselImages) > 0)
                        <div id="carouselExampleIndicators{{ $masterclass->id }}" class="carousel slide my-4">
                            <div class="carousel-inner">
                                <div class="carousel-indicators">
                                    <button type="button" data-bs-target="#carouselExampleIndicators{{ $masterclass->id }}"
                                        data-bs-slide-to="0" class="active" aria-current="true"
                                        aria-label="Slide 1"></button>
                                    @for ($i = 1; $i < count($carouselImages); $i++)
                                        <button type="button"
                                            data-bs-target="#carouselExampleIndicators{{ $masterclass->id }}"
                                            class="carouselIndicator" data-bs-slide-to="{{ $i }}"
                                            aria-label="Slide {{ $i }}"></button>
                                    @endfor
                                </div>
                                @foreach ($carouselImages as $index => $img)
                                    <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                                        <img src="{{ asset('storage/images/' . $img->img_name) }}"
                                            class="d-block w-100 img-fluid" style="max-height:600px; object-fit: cover;"
                                            alt="...">
                                    </div>
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
                    @endif
                </div>
                <input type="hidden" id="booked-seats" value="{{ json_encode($booked_seats) }}">
                <div class="fs-3 my-5">Цена: <span
                        class="justify-content-center rounded-4 russo-one-regular">{{ $masterclass->price }}
                        ₽/лекция</span></div>

                <!-- Отображение свободных/занятых мест -->
                <div class="d-flex justify-content-center mb-4">
                    <div class="d-flex justify-items-center align-items-center me-5">
                        <button type="button" class="seat-free border border-5 border-dark rounded-4" disabled
                            data-bs-toggle="modal" data-bs-target="#exampleModal"></button>
                        <span class="fs-4 ms-1">Свободно</span>
                    </div>
                    <div class="d-flex justify-items-center align-items-center">
                        <button type="button" disabled class="seat-booked border border-5 border-dark rounded-4"
                            data-bs-toggle="modal" data-bs-target="#exampleModal"></button>
                        <span class="fs-4 ms-1">Занято</span>
                    </div>
                </div>

                <!-- Список мест -->
                <div class="w-100 mt-5 class-padding d-flex justify-content-center flex-wrap">
                    @foreach (range(1, 8) as $seatNum)
                        <div class="d-flex justify-content-center">
                            <button type="button"
                                class="seat-free border border-5 border-dark rounded-4 russo-one-regular m-2"
                                data-seat_num="{{ $seatNum }}" data-bs-toggle="modal"
                                data-bs-target="#exampleModal">{{ $seatNum }}</button>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    @if (auth()->check())
        @if ($masterclass->age_restriction == 0 || strtotime('-18 year') > strtotime(auth()->user()->birthdate))
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Записаться на мастер-класс</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Закрыть"></button>
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
                                <input type="hidden" value="{{ $event->cabinet_id }}" id="cabinet_id"
                                    name="cabinet_id">
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
                            <h5 class="modal-title" id="exampleModalLabel">Ошибка</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Закрыть"></button>
                        </div>
                        <div class="modal-body">
                            Этот мастер-класс только для совершеннолетних.
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
                        <h5 class="modal-title" id="exampleModalLabel">Ошибка авторизации</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Закрыть"></button>
                    </div>
                    <div class="modal-body">
                        Авторизуйтесь, чтобы записываться на мастер-классы.
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
            var bookedSeats = $('#booked-seats').val();

            // Ensure 'bookedSeats' is defined and valid JSON
            if (bookedSeats) {
                try {
                    bookedSeats = JSON.parse(bookedSeats);
                    $('.seat-free').each(function() {
                        var seatNum = $(this).data('seat_num');
                        if (bookedSeats.includes(seatNum)) {
                            $(this).prop('disabled', true).addClass('seat-booked');
                            $(this).removeClass('seat-free');
                        }
                    });
                } catch (e) {
                    console.error("Error parsing booked seats:", e);
                }
            }

            $('.seat-free').click(function() {
                var seat_num = $(this).data('seat_num');
                $('#seat_num').val(seat_num);
                var event_time = $(this).data('event_time');
                $('#event_time').val(event_time);
            });
        });
    </script>
@endsection
