@extends('layouts.main')
@section('title')
<title>Главная</title>
@endsection
@section('content')

<!-- Слайдер (уменьшенный) -->
<div id="mainCarousel" class="carousel slide mb-3 w-75 mx-auto" data-bs-ride="carousel">
    <div class="carousel-inner rounded">
        <div class="carousel-item active">
            <img src="{{asset('build/images/cabinet1.jpg')}}" class="d-block w-100" alt="...">
        </div>
        <div class="carousel-item">
            <img src="{{asset('build/images/cabinet2.jpg')}}" class="d-block w-100" alt="...">
        </div>
        <div class="carousel-item">
            <img src="{{asset('build/images/cabinet3.jpg')}}" class="d-block w-100" alt="...">
        </div>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#mainCarousel" data-bs-slide="prev">
        <span class="carousel-control-prev-icon"></span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#mainCarousel" data-bs-slide="next">
        <span class="carousel-control-next-icon"></span>
    </button>
</div>

<!-- Основной текст -->
<div class="text-center py-4">
    <h2 class="russo-one-regular">Хочешь знаний? Нужен ментор?</h2>
    <p class="fs-4">Заходи на Мастер Лектор!</p>
</div>

<!-- Блок о мастер-классах и помещениях (в один столбец) -->
<div class="container text-center">
    <div class="mb-5">
        <img src="{{asset('build/images/mc1.jpg')}}" class="img-fluid rounded-4 mb-3" alt="..." width="70%">
        <p class="fs-5">Мы создаем атмосферу, где каждый участник может погрузиться в увлекательный мир новых навыков и знаний, под руководством опытных экспертов.</p>
        <a href="{{route('afisha.index', date('d.m.y'))}}" class="btn btn-primary">Выбрать мастер-класс</a>
    </div>
    <div class="mb-5">
        <img src="{{asset('build/images/mc2.jpg')}}" class="img-fluid rounded-4 mb-3" alt="..." width="70%">
        <p class="fs-5">Мы предлагаем помещения с современным оборудованием, чтобы обеспечить комфортное и продуктивное пребывание. Выберите помещение прямо сейчас!</p>
        <a href="{{route('cabinets.index')}}" class="btn btn-primary">Выбрать помещение</a>
    </div>
</div>
@endsection
