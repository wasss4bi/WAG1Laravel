@extends('layouts.main')
@section('title')
<title>Личный кабинет</title>
@endsection

@section('content')
    @if (auth()->user()->role == 'lector')
        @include('accounts.roles.lector')
    @elseif (auth()->user()->role == 'admin')
        @include('accounts.roles.admin')
    @else
        @include('accounts.roles.user')
    @endif
@endsection
