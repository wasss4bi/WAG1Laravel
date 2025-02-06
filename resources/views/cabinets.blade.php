@extends('layouts.main')
@section('title')
<title>Список помещений</title>
@endsection
@section('content')
@foreach($cabinets as $cabinet)
<div class="row mt-5 d-flex justify-content-between">
    <div class="col-lg-4  col-sm-12 img-container">
        <img src="{{asset("build/images/$cabinet->img")}}" alt="" class='img-rounded w-100 img-fluid ' style="height:250px; object-fit: cover;">
    </div>
    <div class="col-lg-8  col-sm-12 border-top border-bottom border-black d-flex flex-md-nowrap flex-wrap  py-2 my-2 justify-content-between align-items-center">
        <div class='d-flex flex-wrap'>
            <h2 class='d-flex w-100 mt-3 russo-one-regular '>{{$cabinet->title}}</h2>
        </div>
        <div class="d-flex justify-content-center w-100" ><a href="{{route('cabinet.index',$cabinet->id)}}" class="d-flex  custom-button fs-3">Подробнее</a></div>
    </div>
</div>
@endforeach
@endsection
