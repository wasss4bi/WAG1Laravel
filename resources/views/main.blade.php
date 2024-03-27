@extends('layouts.main')
@section('content')

<!-- slider -->
<div id="carouselExampleControlsNoTouching" class="carousel slide my-5" data-bs-touch="false">
    <div class="carousel-inner">
        <div class="carousel-item active">
            <img src="{{asset('build/images/room1.jpg')}}" class="d-block w-100 rounded-5" alt="...">
        </div>
        <div class="carousel-item">
            <img src="{{asset('build/images/room2.jpg')}}" class="d-block w-100 rounded-5" alt="...">
        </div>
        <div class="carousel-item">
            <img src="{{asset('build/images/room3.jpg')}}" class="d-block w-100 rounded-5" alt="...">
        </div>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControlsNoTouching" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControlsNoTouching" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>   
    </button>
</div>
<div class="mb-5 d-flex align-items-center justify-content-between flex-wrap">
    <img src="{{asset('build/images/mc1.jpg')}}" class="img-media-big w-100 rounded-5 mb-5" alt="...">
    <p class='fs-3 d-flex align-items-center justify-content-center flex-wrap justify-self-end text-media'>Мы создаем атмосферу, где каждый участник может погрузиться в увлекательный мир новых навыков и знаний, под руководством опытных экспертов в своей области.<span class="d-flex justify-content-center mt-5 align-items-center"><a href="{{route('afisha.index')}}" class='d-flex p-2 custom-button'>Посмотреть афишу!</a></span></p>
    <img src="{{asset('build/images/mc1.jpg')}}" class="img-rounded-right w-50 img-media-small" alt="...">
</div>
<div class="mb-5 d-flex align-items-center justify-content-between flex-wrap">
    <img src="{{asset('build/images/mc2.jpg')}}" class="img-media-big w-100 rounded-5 mb-5" alt="...">
    <img src="{{asset('build/images/mc2.jpg')}}" class="img-rounded-right w-50 img-media-small" alt="...">
    <p class='fs-3 d-flex align-items-center justify-content-center flex-wrap justify-self-end text-media text-media-right'>Мы предлагаем помещения с современным оборудованием, чтобы обеспечить комфортное и продуктивное пребывание. Выберите помещение для проведения своего мастер-класса прямо сейчас!<span class="d-flex justify-content-center mt-5"><a href="{{route('afisha.index')}}" class='p-2 custom-button'>Посмотреть помещения!</a></span></p>
</div>
@endsection