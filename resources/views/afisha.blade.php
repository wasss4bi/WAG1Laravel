@extends('layouts.main')
@section('title')
    <title>Афиша</title>
@endsection

@section('content')

<!-- Блок выбора даты -->
<div class='d-flex flex-column align-items-center pt-5'>
    <span class='opacity-50 mb-3 fs-6'>Выберите дату проведения мастер-класса</span>
    <div class='d-flex flex-wrap justify-content-center gap-2'>
        @for ($i = 0; $i < 7; $i++)
            <a class="russo-one-regular fs-6 px-4 py-2 rounded-pill border border-dark text-dark {{ $date == date('d.m.y', time() + 86400 * $i) ? 'bg-secondary text-light' : 'bg-light' }}"
                href="{{ route('afisha.index', date('d.m.y', time() + 86400 * $i)) }}">{{ date('d.m', time() + 86400 * $i) }}</a>
        @endfor
    </div>
</div>

@if ($masterclasses)
    <div class="mt-5 container">
        <div class="row row-cols-1 row-cols-md-2 g-4">
            @foreach ($masterclasses as $masterclass)
                <div class="col">
                    <div class="card shadow-sm border-0 rounded-4">
                        <img src="{{ asset('storage/images/' . $masterclass->img_main) }}" class="card-img-top rounded-top-4" style="height:200px; object-fit:cover;">
                        <div class="card-body">
                            <h5 class="card-title russo-one-regular d-flex justify-content-between">
                                {{ $masterclass->title }}
                                @if ($masterclass->age_restriction == 1)
                                    <span class="badge bg-dark">18+</span>
                                @endif
                            </h5>
                            <div class="d-flex flex-wrap gap-2 mt-3">
                                @foreach ($events->where('masterclass_id', $masterclass->id)->where('event_date', $date)->all() as $event)
                                    <a href="{{ route('masterclass', ['id' => $masterclass->id, 'event_id' => $event->id]) }}" class="btn btn-outline-primary rounded-pill px-3 py-2">{{ $event->event_time }}</a>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@else
    <div class="d-flex justify-content-center fs-3 text-secondary mt-5">На {{ $date }} ещё нет мастер-классов</div>
@endif

@endsection
