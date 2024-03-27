@extends('layouts.main')
@section('content')
<div class="row mt-5 d-flex justify-content-between">
<div class="col-4 img-container">
        <img src="{{asset('build/images/room1.jpg')}}" alt="" class='img-rounded w-100'>
    </div>
    <div class="col-8 border-top border-bottom border-black d-flex justify-content-between align-items-center   ">
        <p class='fs-3'>Крутое описание помещения Крутое описание помещения Крутое описание помещения Крутое описание помещения</p><a href="{{route('room.index')}}" class="custom-button fs-3">Подробнее</a>
    </div>
</div>
@endsection