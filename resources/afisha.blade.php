@extends('layouts.main')
@section('content')
@section('title')
<title>Афиша</title>
@endsection
<div class='d-flex justify-content-start pt-5 flex-wrap'>
  @for($i = 0; $i < 7; $i++) @if($date==date('d.m.y',time()+86400*$i)) <a style='width:calc(100% / 7 - 10px); min-width:75px; max-width: 100px;' class="russo-one-regular fs-5 m-2 d-flex justify-content-center align-items-center custom-button-dark date-btn" href="{{route('afisha.index', date('d.m.y',time()+86400*$i))}}">{{date('d.m',time()+86400*$i)}}</a>
    @else
    <a style='width:calc(100% / 7 - 10px); min-width:75px; max-width: 100px;' class="russo-one-regular fs-5 m-2 d-flex justify-content-center align-items-center custom-button date-btn" href="{{route('afisha.index', date('d.m.y',time()+86400*$i))}}">{{date('d.m',time()+86400*$i)}}</a>
    @endif
    @endfor
    <span class='d-flex align-items-center opacity-50 '>Выберите дату проведения мастер-класса</span>
</div>
@if($masterclasses)
@foreach($masterclasses as $masterclass)
<div class="row mt-5 d-flex justify-content-between justify-content-md-center  img-container">
  <div class="col-lg-4 col-md-10 col-sm-12 img-container">
    <img src="{{asset("storage/images/".$masterclass->img_main)}}" alt="" class='img-rounded w-100 img-fluid ' style="height:250px; object-fit: cover;">
  </div>
  <div class="col-lg-8 col-md-10 col-sm-12 border-top border-bottom border-black d-flex justify-content-center flex-wrap align-items-start rounded-4 " style="min-height:250px;">
    <div class='d-flex flex-wrap w-100  justify-content-between'>
      <h2 class='d-flex w-100 mt-3 russo-one-regular justify-content-between'>{{$masterclass->title}}@if($masterclass->age_restriction == 1) <span class="custom-button-dark p-1 text-light  rounded-5 ">18+</span>@endif</h2>
    </div>
    <div class='d-flex flex-wrap w-100'>
    </div>
    <div class='d-flex flex-wrap justify-content-end align-items-center w-100 '>
      @foreach ($events->where('masterclass_id', $masterclass->id)->where('event_date', $date)->all() as $event)
      <a href="{{route('masterclass', ['id' => $masterclass->id, 'event_id' => $event->id])}}" class="russo-one-regular d-flex custom-button fs-6 w-50 justify-content-center text-nowrap my-1">{{$event->event_time}}</a>
      @endforeach
      @csrf
{{--       <button data-id="{{$masterclass->id}}" class="btn btn-primary post">бамбам</button> --}}
    </div>
  </div>
</div>
@endforeach
@else
<div class="d-flex justify-content-center fs-3 text-secondary">На {{$date}} ещё нет мастер-классов</div>
@endif
<div id="event-container"></div>
{{-- <script>
  $(document).ready(function() {
    $(".post").click(function() {
      post_id = $(this).data("id");
      console.log(post_id);
      token = "{{ csrf_token() }}";
      $.ajax({
        type: "DELETE",
        url: "/afisha/delete/"+post_id,
        headers: {
          'X-CSRF-TOKEN': token
        },
        success: function(data) {
          console.log(data);
        },
        error: function(data) {
          console.log(data);
        }
      });
    });
});
</script> --}}
@endsection
