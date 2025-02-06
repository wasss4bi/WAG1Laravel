
@if(auth()->user()->discount)
<span class='d-flex justify-content-between text-white fs-3 p-2 rounded-4 mt-5 custom-button-dark'>Персональная скидка: {{auth()->user()->discount}}</span>
@endif
<a class="h3 custom-button my-5 ps-5 py-3 d-flex" href="{{route('lecturer.index')}}">Создать мастер-класс</a>
@if(count($mcs->where('author_id', auth()->user()->id)->all()) !== 0)
<a class="custom-button fs-3 custom-button-click w-100 d-flex mt-5 justify-content-between px-md-5 px-3" data-bs-toggle="collapse" href="#collapseMc" role="button" aria-expanded="false" aria-controls="collapseMc">
    <span class="d-flex  custom-button-pointer align-items-center">►</span>Мои мастер классы<span class='d-flex'>{{count($mcs->where('author_id', auth()->user()->id)->all())}}</span>
</a>
@else
<div class="custom-button fs-3 bg-secondary w-100 d-flex mt-5 justify-content-between px-md-5 px-0">
    <span class="d-flex">►</span>Мои мастер классы<span class='d-flex'>{{count($mcs->where('author_id', auth()->user()->id)->all())}}</span>
</div>
@endif

<div class="collapse w-100 justify-items-between px-md-5 px-0" id="collapseMc">
    @foreach($mcs as $mc)
    @if($mc->author_id==auth()->user()->id)
    <a class="custom-button fs-3 custom-button-click w-100 d-flex mt-5 justify-content-between px-md-5 px-3 flex-wrap collapse-img-sizing text-break" data-bs-toggle="collapse" href="#Mc{{$mc->id}}" role="button" aria-expanded="false" aria-controls="Mc{{$mc->id}}">
        <span class="custom-button-pointer align-items-center d-flex ">►</span>{{$mc->title}}

        @if ($mc->is_published==0)
        <span class="d-flex bg-primary rounded-4 px-3">На проверке</span>
        @elseif($mc->is_published==1)
        <span class="d-flex bg-success rounded-4 px-3">Опубликовано</span>
        @else
        <span class="d-flex bg-danger rounded-4 px-3">Отклонено</span>
        @endif
    </a>
    <div class="collapse w-100 justify-items-between px-md-5 px-0 " id="Mc{{$mc->id}}">
        <div class="bg-danger rounded-4 d-flex px-3 justify-content-between  text-light fs-3 mt-3">
            @if($mc->decline_message)
            <div class="d-flex">{{$mc->decline_message}}</div>
            <div class="d-flex align-items-end russo-one-regular">Админ</div>
            @endif
        </div>
        <img src="{{asset("storage/images/$mc->img_main")}}" alt="" class='mt-5 img-rounded w-100 img-fluid img-sizing' style="height:600px; object-fit: cover;">
        <div class='fs-4 ms-3 mt-3 text-break'><span class="russo-one-regular my-2  ">Заголовок: </span>{{$mc->title}}</div>
        <div class='fs-4 ms-3 text-break'><span class="russo-one-regular my-2">Автор: </span>{{$users->find($mc->author_id)->name}}</div>
        <div class='fs-4 ms-3 text-break'><span class="russo-one-regular my-2">Краткое описание: </span>{{$mc->short_description}}</div>
        <div class='fs-4 ms-3 text-break'><span class="russo-one-regular my-2">Подробное описание: </span>{{$mc->description}}</div>
        <div class='fs-4 ms-3 '><span class="russo-one-regular my-2">Помещение: </span> {{$rooms->find($events->where('mc_id', $mc->id)->first()->room_id)->title}}</div>

        <div id="carouselExampleIndicators{{$mc->id}}" class="carousel slide my-4">
            <div class="carousel-inner">
                <div class="carousel-indicators">
                    <button type="button" data-bs-target="#carouselExampleIndicators{{$mc->id}}" data-bs-slide-to="0" class="active carouselIndicator" aria-current="true" aria-label="Slide 1"></button>
                    @for($i=1;$i<count($galleries->where('mc_id', $mc->id)->all());$i++)
                    <button type="button" data-bs-target="#carouselExampleIndicators{{$mc->id}}" class="carouselIndicator" data-bs-slide-to="{{$i}}" aria-label="Slide {{$i}}"></button>
                    @endfor

                </div>
                <div class="carousel-item active">
                    <img src="{{asset("storage/images/".$galleries->where('mc_id', $mc->id)->first()->img_name)}}" class="d-block img-rounded w-100 img-fluid img-sizing" style=" max-height:600px; object-fit: cover; " alt="...">
                </div>
                @foreach($galleries->where('mc_id', $mc->id)->all() as $img)
                @if($img->id !== $galleries->where('mc_id', $mc->id)->first()->id)
                <div class="carousel-item">
                    <img src="{{asset("storage/images/".$img->img_name)}}" class="d-block img-rounded w-100 img-fluid img-sizing" style=" max-height:600px; object-fit: cover; " alt="...">
                </div>
                @endif
                @endforeach
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators{{$mc->id}}" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators{{$mc->id}}" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
        <div class='fs-4 ms-3'><span class="russo-one-regular">Стоимость: </span> <span class="justify-content-center rounded-4">{{$mc->price}} ₽/лекция</span></div>
        <table class="table justify-content-center table-fs ">
            <thead>
                <tr class=''>
                    <th scope="col" class='px-1'></th>
                    @for($k = 0; $k < count($dates); $k++) <th class='text-center p-0 pe-1' scope="col">{{$dates[$k]}}</th>
                        @endfor
                </tr>
            </thead>
            <tbody>
                @for($i = 0; $i < 7; $i++) <tr>
                    <th scope="row" class='text-center p-0 justify-content-center d-flex py-1'> {{date('d.m',time()+86400*$i)}}</th>

                    @foreach($dates as $date)
                    <td class='p-0 justify-content-center text-center '>
                        @php
                        $eventFound = false;
                        @endphp
                        @foreach($events->where('mc_id', $mc->id)->all() as $event)

                        @if($event->event_time == $date && $event->event_date == date('d.m.y', time()+86400*$i))
                        @php
                        $eventFound = true;
                        @endphp
                        <input type="checkbox" disabled class="form-check-input d-flex bg-secondary p-2 mx-auto p-md-3" name="rent_{{date('d^m^y',time()+86400*$i) . '_' . $date}}">
                        @endif
                        @endforeach
                        @if(!$eventFound)
                        <input type="checkbox" disabled class="form-check-input d-flex p-2  mx-auto p-md-3" name="rent_{{date('d^m^y',time()+86400*$i) . '_' . $date}}">
                        @endif
                    </td>
                    @endforeach
                    </tr>
                    @endfor
            </tbody>
        </table>
        <?php
        //если seat->event_time совпадает со значением из mc->event_time и seat->room_id совпадает с mc->room_id, то по seat->user_id выводятся пользователи;
        $user_count = 0;
        foreach ($events->where('mc_id', $mc->id)->all() as $event) {
            if ($seats->where('event_id', $event->id)->count()) {
                $user_count++;
            };
        }
        ?>
        @if($user_count !== 0)
        <a class="custom-button fs-3 custom-button-click w-100 d-flex mt-5 justify-content-between px-md-5 px-3" data-bs-toggle="collapse" href="#collapseMc{{$mc->id}}{{$mc->id}}" role="button" aria-expanded="false" aria-controls="collapseMc{{$mc->id}}{{$mc->id}}">
            <span class="custom-button-pointer align-items-center d-flex">►</span>Список пользователей<span class='d-flex'>{{$user_count}}</span>
        </a>
        @else
        <div class="custom-button fs-3 bg-secondary w-100 d-flex mt-5 justify-content-between px-md-5 px-3">
            <span class="">►</span>Список пользователей<span class='d-flex'>{{$user_count}}</span>
        </div>
        @endif

        <div class="collapse w-100 justify-items-between px-md-5 px-0" id="collapseMc{{$mc->id}}{{$mc->id}}">
            @foreach ($events->where('mc_id', $mc->id) as $event)
            @php
            $seat = $seats->where('event_id', $event->id)->first();
            $user = null;
            if ($seat && $seat->user_id) {
            $user = $users->firstWhere('id', $seat->user_id);
            }
            @endphp
            @if ($user)
            <div class="d-flex align-items-center fs-4 russo-one-regular mt-5 border-end border-start border-2 rounded-4 flex-wrap flex-md-wrap">
                <div class="d-flex">{{ $user->name }}</div>
                <div class="fs-3 d-flex rounded-4 align-items-center text-light custom-button-dark">
                    {{ $event->event_date . " " . $event->event_time . " каб: " . $event->room_id . " " . "место: " . $seat->seat_num }}
                </div>
            </div>
            @endif
            @endforeach
        </div>
    </div>
    @endif
    @endforeach
</div>
