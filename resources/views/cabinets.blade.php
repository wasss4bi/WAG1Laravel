@extends('layouts.main')
@section('title')
    <title>Список помещений</title>
@endsection

@section('content')
<div class="container mt-5">
    <h1 class="text-center russo-one-regular mb-4">Выберите помещение</h1>
    <div class="row row-cols-1 row-cols-md-2 g-4">
        @foreach($cabinets as $cabinet)
            <div class="col">
                <div class="card shadow-sm border-0 rounded-4">
                    <img src="{{ asset('build/images/' . $cabinet->img) }}" alt="{{ $cabinet->title }}" class="card-img-top rounded-top-4" style="height: 200px; object-fit: cover;">
                    <div class="card-body d-flex flex-column align-items-center">
                        <h5 class="card-title russo-one-regular text-center">{{ $cabinet->title }}</h5>
                        <a href="{{ route('cabinet.index', $cabinet->id) }}" class="btn btn-outline-primary w-75 mt-3">Подробнее</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection