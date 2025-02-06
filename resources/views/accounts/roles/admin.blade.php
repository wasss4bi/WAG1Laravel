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
<div class="d-flex">
    <!-- Sidebar Menu -->
    <nav class="sidebar p-3" style="width: 250px; min-height: 100vh;">
        <ul class="nav flex-column">
            <li class="nav-item">
                <button class="nav-link w-100 text-start" onclick="showContent('users')">Все
                    пользователи</button>
            </li>
            <li class="nav-item">
                <button class="nav-link w-100 text-start" onclick="showContent('unpublic_masterclasses')">Неопубликованные
                    мастер-классы</button>
            </li>
            <li class="nav-item">
                <button class="nav-link w-100 text-start" onclick="showContent('grafic_cabinets')">Расписание
                    помещений</button>
            </li>
        </ul>
    </nav>
    <!-- Content Area -->
    <div class="content p-3 w-100">
        <div id="users" class="content-section" style="display: block;">
            @foreach ($users as $user)
                <div
                    class='d-flex fs-3 align-items-center mt-3 justify-content-center justify-content-md-start border-end border-start border-2 rounded-4 flex-wrap flex-md-wrap '>
                    <div class="d-flex align-items-center russo-one-regular justify-content-center flex-wrap my-2">
                        <div class='d-flex '>{{ $user->name }}</div>
                        <div class='d-flex text-light fs-4 ms-2  custom-button-dark'>
                            @if ($user->role == 'user')
                                Слушатель
                            @elseif($user->role == 'lector')
                                Лектор
                            @elseif($user->role == 'admin')
                                Админ
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <div id="unpublic_masterclasses" class="content-section" style="display: none;">
            <div class="d-flex flex-wrap">
                @if (count($masterclasses))
                    @foreach ($masterclasses as $masterclass)
                        @if ($masterclass->status == 0)
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
                                    <div class='fs-5 ms-3 mt-3 text-break'><span
                                            class="russo-one-regular my-2  ">Заголовок:
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

                                    <div id="carouselExampleIndicators{{ $masterclass->id }}"
                                        class="carousel slide my-4">
                                        <div class="carousel-inner">
                                            <div class="carousel-indicators">
                                                <button type="button"
                                                    data-bs-target="#carouselExampleIndicators{{ $masterclass->id }}"
                                                    data-bs-slide-to="0" class="active carouselIndicator"
                                                    aria-current="true" aria-label="Slide 1"></button>
                                                @for ($i = 1; $i < count($galleries->where('masterclass_id', $masterclass->id)->all()); $i++)
                                                    <button type="button"
                                                        data-bs-target="#carouselExampleIndicators{{ $masterclass->id }}"
                                                        class="carouselIndicator"
                                                        data-bs-slide-to="{{ $i }}"
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
                                                            style=" object-fit: cover; "
                                                            alt="...">
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
                                    <div class="d-flex justify-content-around russo-one-regular fs-5 ">
                                        <form action="{{ route('admin.publish.masterclass') }}" method="post">
                                            @csrf
                                            <input type='hidden' name='masterclassId' value='{{ $masterclass->id }}'>
                                            <button type='submit' class='custom-button'>Опубликовать</button>
                                        </form>
                                        <button type='button' class='custom-button bg-danger' data-bs-toggle="modal"
                                            data-bs-target="#declineModal">Отклонить</button>
                                    </div>
                                </div>
                            </div>
                            <div class="modal fade" id="declineModal" tabindex="-1"
                                aria-labelledby="declineModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="declineModalLabel">Отклонение
                                                мастер-класса
                                            </h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="mb-3">
                                                <form action="{{ route('admin.decline.masterclass') }}"
                                                    method='post' id="decline-form">
                                                    @csrf
                                                    <textarea name="decline_message" class="form-control" placeholder="Введите причину отклонения"></textarea>
                                                    <input type='hidden' name='masterclassId'
                                                        value='{{ $masterclass->id }}'>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Закрыть</button>
                                            <button type="submit" class="btn btn-primary"
                                                id="saveChangesButton">Сохранить
                                                изменения</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endforeach
                @else
                    <h3>Нет неопубликованных мастер-классов</h3>
                @endif
            </div>
        </div>
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
        <div id="grafic_cabinets" class="content-section" style="display: none;">
            @for ($l = 1; $l <= 3; $l++)
                <div class="border-end border-start border-2 rounded-4 my-4">
                    <h3 class="custom-button-pointer align-items-center d-flex">{{ $cabinets->find($l)->title }}</h3>
                    <div class='d-flex fs-5 mt-3'>
                        <table class="table justify-content-center table-fs ">
                            <thead>
                                <tr class=''>
                                    <th scope="col" class='px-1'></th>
                                    @for ($k = 0; $k < count($dates); $k++)
                                        <th class='text-center p-0 pe-1' scope="col">{{ $dates[$k] }}</th>
                                    @endfor
                                </tr>
                            </thead>
                            <tbody>
                                @for ($i = 0; $i < 7; $i++)
                                    <tr>
                                        <th scope="row"
                                            class='text-center p-0 justify-content-center d-flex py-1 '>
                                            {{ date('d.m', time() + 86400 * $i) }}
                                        </th>
                                        @for ($j = 0; $j < count($dates); $j++)
                                            <td
                                                class='p-0 justify-content-center text-center disable_checkboxes{{ $l }}'>
                                                <input type="checkbox" disabled
                                                    class="form-check-input form-check-input d-flex p-2  mx-auto p-md-3"
                                                    name="rent_{{ date('d.m.y', time() + 86400 * $i) . '_' . $dates[$j] }}">
                                            </td>
                                        @endfor
                                    </tr>
                                @endfor
                            </tbody>
                        </table>
                    </div>
                </div>
            @endfor
        </div>
    </div>
</div>
<script>
    function showContent(section) {
        document.querySelectorAll('.content-section').forEach(el => el.style.display = 'none');
        document.getElementById(section).style.display = 'block';
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