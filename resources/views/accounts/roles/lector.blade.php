<?php $countOfNonActualEvents = [];
$countOfActualEvents = []; ?>
@foreach ($seats as $seat)
    <?php
    $event = $events->find($seat->event_id);
    $date = DateTime::createFromFormat('d.m.y', $event->event_date);
    ?>
    @if (auth()->user()->id == $seat->user_id)
        @foreach ($masterclasses as $masterclass)
            @php
                $event->masterclass_id == $masterclass->id
                    ? ($date->format('d.m.Y') > date('d.m.Y', time() - 86400)
                        ? ($countOfActualEvents[] = '1')
                        : ($countOfNonActualEvents[] = '1'))
                    : '';
            @endphp
        @endforeach
    @endif
@endforeach
<?php
$masterclasses_times = [];

for ($h = 1; $h < 4; $h++) {
    $cabinet_masterclasses_times = [];
    $array = [];
    $events_array = [];
    foreach ($events->where('cabinet_id', $h)->all() as $event) {
        if ($masterclasses->find($event->masterclass_id)->status == 1) {
            $events_array[] = $event;
        }
    }
    if ($events_array) {
        foreach ($events_array as $event) {
            $array[] = 'rent_' . $event->event_date . '_' . $event->event_time;
        }
    } else {
        $array[] = 'rent_';
    }
    $masterclasses_times[] = $array;
}
?>
<input class="form-control" type="hidden" id="masterclasses-times" name='masterclasses-times'
    data-masterclasses-times="{{ json_encode($masterclasses_times) }}"
    value="{{ json_encode($masterclasses_times) }}">
<div class="d-flex">
    <!-- Sidebar Menu -->
    <nav class="sidebar p-3" style="width: 250px; min-height: 100vh;">
        <ul class="nav flex-column">
            <li class="nav-item">
                <button class="nav-link w-100 text-start" onclick="showContent('finished')">Пройденные
                    мастер-классы</button>
            </li>
            <li class="nav-item">
                <button class="nav-link w-100 text-start" onclick="showContent('actual')">Записи на
                    мастер-классы</button>
            </li>
            <li class="nav-item">
                <a class="nav-link w-100 text-start" href="{{ route('lector.index') }}">Создать
                    мастер-класс</a>
            </li>
            <li class="nav-item">
                <button class="nav-link w-100 text-start" onclick="showContent('my')">Мои
                    мастер-классы</button>
            </li>
        </ul>
    </nav>
    <!-- Content Area -->
    <div class="content p-3 w-100">
        <!-- Finished Masterclasses -->
        <div id="finished" class="content-section" style="display: none;">
            @if ($countOfNonActualEvents)
                <h3>Пройденные мастер-классы ({{ count($countOfNonActualEvents) }})</h3>
                @foreach ($seats as $seat)
                    <?php
                    $event = $events->find($seat->event_id);
                    $date = DateTime::createFromFormat('d.m.y', $event->event_date);
                    ?>
                    @if (auth()->user()->id == $seat->user_id)
                        @foreach ($masterclasses as $masterclass)
                            @if ($event->masterclass_id == $masterclass->id && $date->format('d.m.Y') <= date('d.m.Y', time() - 86400))
                                <div class='border p-3 my-2 rounded'>
                                    <h4>{{ $masterclass->title }}</h4>
                                    <p>{{ $event->event_date . ' ' . $event->event_time }}</p>
                                    <p>Кабинет: {{ $event->cabinet_id }}, Место: {{ $seat->seat_num }}</p>
                                    <a href="{{ route('masterclass', ['id' => $masterclass->id, 'event_id' => $event->id]) }}"
                                        class="btn btn-primary">Подробнее</a>
                                </div>
                            @endif
                        @endforeach
                    @endif
                @endforeach
            @else
                <h3>Нет пройденных записей на мастер-классы</h3>
            @endif
        </div>

        <!-- Actual Masterclasses -->
        <div id="actual" class="content-section" style="display: none;">
            @if (count($countOfActualEvents))
                <h3>Записи на мастер-классы ({{ count($countOfActualEvents) }})</h3>
                @foreach ($seats as $seat)
                    <?php
                    $event = $events->find($seat->event_id);
                    $date = DateTime::createFromFormat('d.m.y', $event->event_date);
                    ?>
                    @if (auth()->user()->id == $seat->user_id)
                        @foreach ($masterclasses as $masterclass)
                            @if ($event->masterclass_id == $masterclass->id && $date->format('d.m.Y') > date('d.m.Y', time() - 86400))
                                <div class='border p-3 my-2 rounded'>
                                    <h4>{{ $masterclass->title }}</h4>
                                    <p>{{ $event->event_date . ' ' . $event->event_time }}</p>
                                    <p>Кабинет: {{ $event->cabinet_id }}, Место: {{ $seat->seat_num }}</p>
                                    <a href="{{ route('masterclass', ['id' => $masterclass->id, 'event_id' => $event->id]) }}"
                                        class="btn btn-primary">Подробнее</a>
                                    <button class="btn btn-danger" data-event-id="{{ $seat->event_id }}"
                                        data-bs-toggle="modal" data-bs-target="#modalId">Отменить</button>
                                </div>
                            @endif
                        @endforeach
                    @endif
                @endforeach
            @else
                <h3>Нет актуальных записей на мастер-классы</h3>
            @endif
        </div>


        <!-- Actual Masterclasses -->
        <div id="my" class="content-section flex-wrap" style="display: flex;">
            @if (count($masterclasses->where('lector_id', auth()->user()->id)->all()))
                @foreach ($masterclasses as $masterclass)
                    @if ($masterclass->lector_id == auth()->user()->id)
                        <div class="w-50 p-3 m-0 border-end border-start border-2 rounded-4">
                            <div class="px-0">
                                <div
                                    class="bg-danger rounded-4 d-flex px-3 justify-content-between text-light fs-3 mt-3">
                                    @if ($masterclass->decline_message)
                                        <div class="d-flex">{{ $masterclass->decline_message }}</div>
                                        <div class="d-flex align-items-end russo-one-regular">Админ</div>
                                    @endif
                                </div>
                                <img src="{{ asset("storage/images/$masterclass->img_main") }}" alt=""
                                    class='mt-5 img-rounded w-100 img-fluid'
                                    style="object-fit: cover;">
                                <div class='fs-5 ms-3 mt-3 text-break'><span class="russo-one-regular my-2  ">Заголовок:
                                    </span>{{ $masterclass->title }}</div>
                                <div class='fs-5 ms-3 text-break'><span class="russo-one-regular my-2">Автор:
                                    </span>{{ $users->find($masterclass->lector_id)->name }}</div>
                                <div class='fs-5 ms-3 text-break'><span class="russo-one-regular my-2">Описание:
                                    </span>{{ $masterclass->description }}</div>
                                <div class='fs-5 ms-3 '><span class="russo-one-regular my-2">Помещение: </span>
                                    {{ $cabinets->find($events->where('masterclass_id', $masterclass->id)->first()->cabinet_id)->title }}
                                </div>
                                <div class='fs-5 ms-3 '><span class="russo-one-regular my-2">Статус: </span>
                                    @if ($masterclass->status == 0)
                                        <span class="bg-primary rounded-4 px-3 fs-5">Проверяется</span>
                                    @elseif($masterclass->status == 1)
                                        <span class="bg-success rounded-4 px-3 fs-5">Опубликовано</span>
                                    @else
                                        <span class="bg-danger rounded-4 px-3 fs-5">Отклонено</span>
                                    @endif
                                </div>

                                <div id="carouselExampleIndicators{{ $masterclass->id }}" class="carousel slide my-4">
                                    <div class="carousel-inner">
                                        <div class="carousel-indicators">
                                            <button type="button"
                                                data-bs-target="#carouselExampleIndicators{{ $masterclass->id }}"
                                                data-bs-slide-to="0" class="active carouselIndicator"
                                                aria-current="true" aria-label="Slide 1"></button>
                                            @for ($i = 1; $i < count($galleries->where('masterclass_id', $masterclass->id)->all()); $i++)
                                                <button type="button"
                                                    data-bs-target="#carouselExampleIndicators{{ $masterclass->id }}"
                                                    class="carouselIndicator" data-bs-slide-to="{{ $i }}"
                                                    aria-label="Slide {{ $i }}"></button>
                                            @endfor

                                        </div>
                                        <div class="carousel-item active">
                                            <img src="{{ asset('storage/images/' . $galleries->where('masterclass_id', $masterclass->id)->first()->img_name) }}"
                                                class="d-block img-rounded w-100 img-fluid "
                                                style=" object-fit: cover; " alt="...">
                                        </div>
                                        @foreach ($galleries->where('masterclass_id', $masterclass->id)->all() as $img)
                                            @if ($img->id !== $galleries->where('masterclass_id', $masterclass->id)->first()->id)
                                                <div class="carousel-item">
                                                    <img src="{{ asset('storage/images/' . $img->img_name) }}"
                                                        class="d-block img-rounded w-100 img-fluid "
                                                        style="object-fit: cover; " alt="...">
                                                </div>
                                            @endif
                                        @endforeach
                                    </div>
                                    <button class="carousel-control-prev" type="button"
                                        data-bs-target="#carouselExampleIndicators{{ $masterclass->id }}"
                                        data-bs-slide="prev">
                                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                        <span class="visually-hidden">Previous</span>
                                    </button>
                                    <button class="carousel-control-next" type="button"
                                        data-bs-target="#carouselExampleIndicators{{ $masterclass->id }}"
                                        data-bs-slide="next">
                                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                        <span class="visually-hidden">Next</span>
                                    </button>
                                </div>
                                <div class='fs-4 ms-3'><span class="russo-one-regular">Стоимость: </span> <span
                                        class="justify-content-center rounded-4">{{ $masterclass->price }}
                                        ₽/лекция</span>
                                </div>
                                <table class="table justify-content-center ">
                                    <thead>
                                        <tr class=''>
                                            <th scope="col" class='px-1'></th>
                                            @for ($k = 0; $k < count($dates); $k++)
                                                <th class='text-center p-0 pe-1' scope="col">
                                                    {{ $dates[$k] }}
                                                </th>
                                            @endfor
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @for ($i = 0; $i < 7; $i++)
                                            <tr>
                                                <th scope="row"
                                                    class='text-center p-0 justify-content-center d-flex py-1'>
                                                    {{ date('d.m', time() + 86400 * $i) }}</th>

                                                @foreach ($dates as $date)
                                                    <td class='p-0 justify-content-center text-center '>
                                                        @php
                                                            $eventFound = false;
                                                        @endphp
                                                        @foreach ($events->where('masterclass_id', $masterclass->id)->all() as $event)
                                                            @if ($event->event_time == $date && $event->event_date == date('d.m.y', time() + 86400 * $i))
                                                                @php
                                                                    $eventFound = true;
                                                                @endphp
                                                                <input type="checkbox" disabled
                                                                    class="form-check-input d-flex bg-secondary mx-auto p-2"
                                                                    name="rent_{{ date('d^m^y', time() + 86400 * $i) . '_' . $date }}">
                                                            @endif
                                                        @endforeach
                                                        @if (!$eventFound)
                                                            <input type="checkbox" disabled
                                                                class="form-check-input d-flex mx-auto p-2"
                                                                name="rent_{{ date('d^m^y', time() + 86400 * $i) . '_' . $date }}">
                                                        @endif
                                                    </td>
                                                @endforeach
                                            </tr>
                                        @endfor
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    @endif
                @endforeach
            @else
                <h3>Нет мастер-классов</h3>
            @endif
        </div>
    </div>
</div>

<script>
    function showContent(section) {
        document.querySelectorAll('.content-section').forEach(el => el.style.display = 'none');
        document.getElementById(section).style.display = 'flex';
    }
</script>
<script>
    $(document).ready(function() {

        $('.edit-button').click(function() {
            ;
            var userId = $(this).data('username-id');
            $('#userId').val(userId);
            console.log(userId);
        });

        var mcsTimes = $('#masterclasses-times').data('masterclasses-times');
        for (var i = 0; i < mcsTimes.length; i++) {

            $('.disable_checkboxes' + Number(i + 1) + ' input[type="checkbox"]').each(function() {
                var checkboxName = $(this).attr('name');
                if (mcsTimes[i].includes(checkboxName)) {
                    $(this).addClass('bg-secondary').prop('disabled', true);
                }
            });
        }

    });
</script>