@extends('layouts.main')
@section('content')
<!-- @foreach ($posts as $post) -->
<div class="row mt-5 d-flex justify-content-between img-container">
    <div class="col-4 img-container">
        <img src="{{asset('build/images/mc1.jpg')}}" alt="" class='img-rounded w-100'>
    </div>
    <div class="col-8 border-top border-bottom border-black d-flex justify-content-between align-items-center">
        <p class='fs-3'>Крутое описание мастер-класса Крутое описание мастер-класса Крутое описание мастер-класса Крутое описание мастер-класса</p><a href="{{route('mc.index')}}" class="custom-button fs-3">Подробнее</a>
    </div>
</div>
<!-- @endforeach -->
@endsection