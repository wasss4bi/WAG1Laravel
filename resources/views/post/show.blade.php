@extends('layouts.main')
@section('content')
<div>
<div>{{$post->id}}. {{$post->title}}</div>
<div>{{$post->content}}</div>
</div>
@endsection