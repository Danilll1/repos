@extends('layouts.login')

@section('title')
    @parent - {{$title}}
@endsection

@section('login')  

<div class="container" style="max-width:500px;">
    <h2 class="mb-3 mt-5">Авторизация пользователя</h2>
    <form class="mt-5" action="{{route('login.store')}}" method="POST">
        @csrf
    <div class="mb-3 mt-5">
        @error('Email')
        <div class="alert alert-danger">{{$message}}</div>
        @enderror
        <label for="Email" class="form-label">Email</label>
        <input type="Email" name="Email" id="Email" class="form-control @error('Email') is-invalid @enderror" placeholder="Email"
        value="{{old('Email')}}">
    </div>
    
    <div class="mb-3 mt-5">
        @error('password')
        <div class="alert alert-danger">{{$message}}</div>
        @enderror
        <label for="password" class="form-label">Пароль</label>
        <input type="password" name="password" id="password" class="form-control" placeholder="password">
    </div>

    <button type="sudmit" class="btn btn-warning">Вход</button>
    </form>
    @php

    @endphp
</div>

@endsection