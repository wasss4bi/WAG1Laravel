<a class="custom-button fs-3 custom-button-click w-100 d-flex mt-5 justify-content-between px-md-5 px-3 "
    data-bs-toggle="collapse" href="#users" role="button" aria-expanded="false" aria-controls="users">
    <span class="custom-button-pointer align-items-center d-flex">►</span>Список пользователей<span
        class="d-flex align-items-center ">{{ count($users) }}</span>
</a>

@foreach ($users as $user)
<div class="collapse w-100 justify-items-between px-md-5 px-0" id="users">
    <div
        class='d-flex fs-3 align-items-center mt-3 justify-content-center justify-content-md-start   border-end border-start border-2 rounded-4 flex-wrap flex-md-wrap '>
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
        <input type="hidden" value='{{ $user->id }}'>
        @if ($user->role == 'lector')
        <div class="d-flex align-items-center justify-content-center flex-wrap m-2">
            @if ($user->discount)
            <span class='d-flex text-white fs-3 custom-button-dark'>Скидка: {{ $user->discount }}</span>
            @endif
            <button type="button" class="d-flex text-light custom-button edit-button"
                data-username-id="{{ $user->id }}" data-bs-toggle="modal" data-bs-target="#userModal"
                data-bs-whatever="@mdo">Назначить скидку</button>
        </div>
        @endif
    </div>
</div>
@endforeach

<div class="modal fade" id="userModal" tabindex="-1" aria-labelledby="userModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="userModalLabel">Назначить скидку</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <form action="{{ route('admin.edit.user') }}" method='post' id="edit-form">
                        @csrf
                        <input type="hidden" class="form-control" id="userId" name='userId'>
                        <label for="discount" class="col-form-label">Введите скидку</label>
                        <input type="number" class="form-control" id="discount" name='discount'>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Закрыть</button>
                <input type="submit" class="btn btn-primary" id="saveChangesButton" value='Отправить'>
                </form>
            </div>
        </div>
    </div>
</div>

<?php $unpublishedMasterclasssCount = []; ?>
@foreach ($masterclasses as $masterclass)
@if ($masterclass->status == 0)
<?php $unpublishedMasterclasssCount[] = 1; ?>
@endif
@endforeach

@if (count($unpublishedMasterclasssCount) !== 0)
<a class="custom-button fs-3 custom-button-click w-100 d-flex mt-5 justify-content-between px-md-5 px-3"
    data-bs-toggle="collapse" href="#unpublishedMasterclasss" role="button" aria-expanded="false"
    aria-controls="unpublishedMasterclasss">
    <span class="custom-button-pointer align-items-center d-flex">►</span>Неопубликованные мастер-классы<span
        class="d-flex align-items-center">{{ count($unpublishedMasterclasssCount) }}</span>
</a>
@else
<div class="custom-button fs-3 bg-secondary w-100 d-flex mt-5 justify-content-between px-md-5 px-3">
    <span class="">►</span>Неопубликованные мастер-классы<span
        class="d-flex">{{ count($unpublishedMasterclasssCount) }}</span>
</div>
@endif

<div class="collapse w-100 justify-items-between px-md-5 px-0" id="unpublishedMasterclasss">
    @foreach ($masterclasses as $masterclass)
    @if ($masterclass->status == 0)
    <a class="custom-button fs-3 custom-button-click w-100 d-flex mt-5 justify-content-between px-md-5 px-0 collapse-img-sizing"
        data-bs-toggle="collapse" href="#unpublishedMasterclass{{ $masterclass->id }}" role="button"
        aria-expanded="false" aria-controls="unpublishedMasterclass{{ $masterclass->id }}">
        <span class="custom-button-pointer align-items-center">►</span>{{ $masterclass->title }}<span
            class="d-flex align-items-center"></span>
    </a>
    <div class="collapse w-100 justify-items-between px-lg-5 px-0"
        id="unpublishedMasterclass{{ $masterclass->id }}">

        <img src="{{ asset("storage/images/$masterclass->img_main") }}" alt=""
            class='mt-5 img-rounded w-100 img-fluid img-sizing' style="height:600px; object-fit: cover;">
        <div class='fs-4 ms-3 mt-3'><span class="russo-one-regular my-2">Заголовок:
            </span>{{ $masterclass->title }}</div>
        <div class='fs-4 ms-3 '><span class="russo-one-regular my-2">Автор: </span>{{ $masterclass->author }}
        </div>
        <div class='fs-4 ms-3'><span class="russo-one-regular my-2">Описание:
            </span>{{ $masterclass->description }}</div>
        <div class='fs-4 ms-3'><span class="russo-one-regular my-2">Помещение: </span>
            {{ $cabinets->find($events->where('masterclass_id', $masterclass->id)->first()->cabinet_id)->title }}
        </div>


        <div id="carouselExampleIndicators{{ $masterclass->id }}" class="carousel slide my-4">
            <div class="carousel-inner">
                <div class="carousel-indicators">
                    <button type="button" data-bs-target="#carouselExampleIndicators{{ $masterclass->id }}"
                        data-bs-slide-to="0" class="active carouselIndicator" aria-current="true"
                        aria-label="Slide 1"></button>
                    @for ($i = 1; $i < count($galleries->where('masterclass_id', $masterclass->id)->all()); $i++)
                        <button type="button"
                            data-bs-target="#carouselExampleIndicators{{ $masterclass->id }}"
                            class="carouselIndicator" data-bs-slide-to="{{ $i }}"
                            aria-label="Slide {{ $i }}"></button>
                        @endfor

                </div>
                <div class="carousel-item active">
                    <img src="{{ asset('storage/images/' . $galleries->where('masterclass_id', $masterclass->id)->first()->img_name) }}"
                        class="d-block img-rounded w-100 img-fluid img-sizing"
                        style=" max-height:600px; object-fit: cover; " alt="...">
                </div>
                @foreach ($galleries->where('masterclass_id', $masterclass->id)->all() as $img)
                @if ($img->id !== $galleries->where('masterclass_id', $masterclass->id)->first()->id)
                <div class="carousel-item">
                    <img src="{{ asset('storage/images/' . $img->img_name) }}"
                        class="d-block img-rounded w-100 img-fluid img-sizing"
                        style=" max-height:600px; object-fit: cover; " alt="...">
                </div>
                @endif
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
        <div class='fs-4 ms-3'><span class="russo-one-regular">Стоимость: </span> <span
                class="justify-content-center rounded-4">{{ $masterclass->price }} ₽/лекция</span></div>
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
                    <th scope="row" class='text-center p-0 justify-content-center d-flex py-1'>
                        {{ date('d.m', time() + 86400 * $i) }}
                    </th>
                    @for ($j = 0; $j < count($dates); $j++)
                        <td class='p-0 justify-content-center text-center '>
                        @if ($events->where('event_date', date('d.m.y', time() + 86400 * $i))->where('event_time', $dates[$j])->where('masterclass_id', $masterclass->id)->all())
                        <input type="checkbox" disabled
                            class="form-check-input d-flex bg-secondary p-2 mx-auto p-md-3"
                            name="rent_{{ date('d^m^y', time() + 86400 * $i) . '_' . $dates[$j] }}">
                        </td>
                        @else
                        <input type="checkbox" disabled
                            class="form-check-input d-flex p-2  mx-auto p-md-3"
                            name="rent_{{ date('d^m^y', time() + 86400 * $i) . '_' . $dates[$j] }}"></td>
                        @endif
                        </td>
                        @endfor
                        </tr>
                        @endfor
            </tbody>
        </table>
        <div class="d-flex justify-content-around russo-one-regular fs-5 ">
            <form action="{{ route('admin.publish.masterclass') }}" method="post">
                @csrf
                <input type='hidden' name='mcId' value='{{ $masterclass->id }}'>
                <button type='submit' class='custom-button'>Опубликовать</button>
            </form>
            <button type='button' class='custom-button bg-danger' data-bs-toggle="modal"
                data-bs-target="#declineModal">Отклонить</button>
        </div>
    </div>
    <div class="modal fade" id="declineModal" tabindex="-1" aria-labelledby="declineModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="declineModalLabel">Отклонение мастер-класса</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <form action="{{ route('admin.decline.masterclass') }}" method='post' id="decline-form">
                            @csrf
                            <textarea name="decline_message" class="form-control" placeholder="Введите причину отклонения"></textarea>
                            <input type='hidden' name='mcId' value='{{ $masterclass->id }}'>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Закрыть</button>
                    <button type="submit" class="btn btn-primary" id="saveChangesButton">Сохранить изменения</button>
                    </form>
                </div>
            </div>
        </div>

    </div>
    @endif
    @endforeach
</div>

<?php
$masterclasses_times = [];

for ($h = 1; $h < 4; $h++) {
    $cabinet_masterclasses_times = [];

    /* foreach ($publishedMasterclasss as $masterclass) {
        if ($masterclass->cabinet_id == $h) {
            $masterclasses_time = json_decode($masterclass->event_time, true);
            $cabinet_masterclasses_times = array_merge($cabinet_masterclasses_times, $masterclasses_time);
        }
    } */
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

<a class="custom-button fs-3 custom-button-click w-100 d-flex mt-5 justify-content-between px-md-5 px-0"
    data-bs-toggle="collapse" href="#collapseMasterclassTime" role="button" aria-expanded="false"
    aria-controls="collapseMasterclassTime">
    <span class="custom-button-pointer align-items-center d-flex">►</span>Расписание помещений<span
        class="d-flex align-items-center"></span>
</a>

<div class="collapse w-100  justify-items-between px-md-3 px-0" id="collapseMasterclassTime">
    @for ($l = 1; $l < 4; $l++)
        <a class="custom-button fs-3 custom-button-click w-100 d-flex mt-5 px-md-5 px-3" data-bs-toggle="collapse"
        href="#collapseMasterclassTime{{ $l }}" role="button" aria-expanded="false"
        aria-controls="collapseMasterclassTime{{ $l }}">
        <span class="custom-button-pointer align-items-center d-flex">►</span>{{ $cabinets->find($l)->title }}
        </a>
        <div class="collapse w-75 justify-items-between" id="collapseMasterclassTime{{ $l }}">
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
                            <th scope="row" class='text-center p-0 justify-content-center d-flex py-1 '>
                                {{ date('d.m', time() + 86400 * $i) }}
                            </th>
                            @for ($j = 0; $j < count($dates); $j++)
                                <td
                                class='p-0 justify-content-center text-center disable_checkboxes{{ $l }}'>
                                <input type="checkbox" disabled
                                    class="form-check-input form-check-input d-flex p-2  mx-auto p-md-3"
                                    name="rent_{{ date('d.m.y', time() + 86400 * $i) . '_' . $dates[$j] }}">
                                </td>
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