@extends('layouts.main')
@section('title')
<title>Админ-панель</title>
@endsection
@section('content')
@include('accounts.roles.user')

<a class="custom-button fs-3 custom-button-click-user w-100 d-flex mt-5 justify-content-between px-5 " data-bs-toggle="collapse" href="#collapseUser" role="button" aria-expanded="false" aria-controls="collapseUser">
  <span class="custom-button-pointer-user">►</span>Список пользователей<span class="d-flex custom-button-pointer-masterclass  "></span>
</a>

@foreach($users as $user)
<div class="collapse w-75 justify-items-between" id="collapseUser">
  <div class='d-flex fs-3 align-items-center mt-3 justify-content-between'>
    <div class='w-50 d-flex'>{{$user->name}}
      <div class='d-flex text-light bg-secondary fs-4 rounded ms-2 justify-content-center' style='width:100px'>{{$user->role}}</div>
    </div>
    <input type="hidden" value='{{$user->id}}'>
    @if($user->role=='lector')
    @if($user->discount)
    <span class='p-1 text-white fs-3 rounded-4' style="background-color:#00bfcf">Скидка: {{$user->discount}}</span>

    @endif
    <button type="button" class="d-flex ms-5 p-1 text-light custom-button edit-button" data-username-id="{{$user->id}}" data-bs-toggle="modal" data-bs-target="#userModal" data-bs-whatever="@mdo">Назначить скидку</button>
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
          <form action="{{route('admin.edit.user')}}" method='post' id="edit-form">
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

<a class="custom-button fs-3 custom-button-click-masterclass w-100 d-flex mt-5 justify-content-between px-5" data-bs-toggle="collapse" href="#collapseMasterclass" role="button" aria-expanded="false" aria-controls="collapseMasterclass">
  <span class="custom-button-pointer-masterclass">►</span>Неопубликованные мастер-классы<span class="d-flex custom-button-pointer-masterclass  "></span>
</a>
@foreach($masterclasses as $masterclass)
<div class="collapse w-100 justify-items-between" id="collapseMasterclass">
  <div class='fs-3 ms-3 my-3'>{{$masterclass->title}}</div>
  <img src="{{asset("storage/images/$masterclass->img_main")}}" alt="" class='w-100'>
  <div class='fs-4 ms-3'>{{$masterclass->description}}</div>


  <div id="carouselExampleIndicators" class="carousel slide">
    <div class="carousel-indicators">
      <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
      <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
      <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
    </div>
    <?php
    $gallery = json_decode($masterclass->gallery, true);
    ?>
    <div class="carousel-inner">

      <div class="carousel-item active">
        <img src="{{asset("storage/images/".$gallery[0])}}" class="d-block w-100" alt="...">
      </div>
      @for($i = 1; $i < count($gallery);$i++) <div class="carousel-item">
        <img src="{{asset("storage/images/".$gallery[$i])}}" class="d-block w-100" alt="...">
    </div>
    @endfor
  </div>
  <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Previous</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Next</span>
  </button>
</div>

<?php
$event_times = json_decode($masterclass->event_time, true);
$dates = [];
foreach ($event_times as $event_time) {
  $pattern = '/(\d{2})\^(\d{2})/';
  preg_match($pattern, $event_time, $matches);
  $event_date = $matches[1] . "." . $matches[2];

  $dates[] = $event_date;
}
?>
<div class='fs-3 ms-3'>{{$masterclass->price}}</div>
@foreach ($dates as $date)
<div class='fs-3 ms-3'>{{$date}}</div>
@endforeach



<div class="modal fade" id="declineModal" tabindex="-1" aria-labelledby="declineModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="declineModalLabel">Отклонение мастер-класса</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="mb-3">
          <form action="{{route('admin.decline.masterclass')}}" method='post' id="decline-form">
            @csrf
            <textarea name="decline_message" class="form-control" placeholder="Введите причину отклонения"></textarea>
            <input type='hidden' name='mcId' value='{{$masterclass->id}}'>
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


<button type='button' class='btn btn-danger' data-bs-toggle="modal" data-bs-target="#declineModal">Отклонить</button>

<form action="{{route('admin.publish.masterclass')}}" method="post">
  @csrf
  <input type='hidden' name='mcId' value='{{$masterclass->id}}'>
  <button type='submit' class='btn btn-primary'>Опубликовать</button>
</form>

@endforeach

<?php
$masterclasses_times = [];

for ($h = 1; $h < 4; $h++) {
  $cabinet_masterclasses_times = [];

  foreach ($publishedMasterclass as $masterclass) {
    if ($masterclass->cabinet_id == $h) {
      $masterclasses_time = json_decode($masterclass->event_time, true); // Указываем true для преобразования в массив
      $cabinet_masterclasses_times = array_merge($cabinet_masterclasses_times, $masterclasses_time);
    }
  }

  $masterclasses_times[] = $cabinet_masterclasses_times;
}
?>
<input class="form-control" type="hidden" id="masterclasses-times" name='masterclasses-times' data-masterclasses-times="{{json_encode($masterclasses_times)}}" value="{{json_encode($masterclasses_times)}}">
<a class="custom-button fs-3 custom-button-click-masterclass w-100 d-flex mt-5 justify-content-between px-5" data-bs-toggle="collapse" href="#collapseMasterclassTime" role="button" aria-expanded="false" aria-controls="collapseMasterclassTime">
  <span class="custom-button-pointer-masterclass">►</span>Расписание помещений<span class="d-flex custom-button-pointer-masterclass  "></span>
</a>



<div class="collapse w-100 px-5 justify-items-between" id="collapseMasterclassTime">
  @for($l=0; $l<3; $l++) <a class="custom-button fs-3 custom-button-click-masterclass w-100 d-flex mt-5" data-bs-toggle="collapse" href="#collapseMasterclassTime{{$l}}" role="button" aria-expanded="false" aria-controls="collapseMasterclassTime{{$l}}">
    <span class="custom-button-pointer-masterclass">►</span>Помещение {{$l+1}}
    </a>
    <div class="collapse w-75 justify-items-between" id="collapseMasterclassTime{{$l}}">
      <div class='d-flex fs-5 mt-3'>
        <table class="table justify-content-center">
          <thead>
            <tr class='px-5'>
              <th scope="col"></th>
              @for($k = 0; $k < count($dates); $k++) <th class='text-center' scope="col">{{$dates[$k]}}</th>
                @endfor
            </tr>
          </thead>
          <tbody>
            @for($i = 0; $i < 7; $i++) <tr>
              <th scope="row" class='text-center '>{{date('d.m',time()+86400*$i)}}</th>
              @for($j = 0; $j < count($dates); $j++) <td class='px-5 disable_checkboxes{{$l}}'><input type="checkbox" disabled class="form-check-input d-flex mx-auto p-3" name="rent_{{date('d^m^y',time()+86400*$i) . '_' . $dates[$j]}}"></td>
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

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
  $(document).ready(function() {
    $('.edit-button').click(function() {
      ;
      var userId = $(this).data('username-id');
      $('#userId').val(userId);
      console.log(userId);
    });

    var masterclassesTimes = $('#masterclasses-times').data('masterclasses-times');
    for (var i = 0; i < masterclassesTimes.length; i++) {
      var rentList = [];

      $.each(masterclassesTimes[i], function(key, value) {
        rentList.push(value);
      });

      $('.disable_checkboxes' + i + ' input[type="checkbox"]').each(function() {
        var checkboxName = $(this).attr('name');
        if (rentList.includes(checkboxName)) {
          $(this).addClass('bg-secondary').prop('disabled', true);
        }
      });
    }
  });
</script>
@endsection
