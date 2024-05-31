@extends('layouts.layout')

@section('register')
<div class="container container-fluid ">
    
<div class="card mt-5 bg-dark text-white rounded w-75 p-3 mx-auto">
    <div class="card-body mb-3">
        <form action="{{ route('user.store') }}" class="mt-5" method="POST" id="registrationForm" enctype="multipart/form-data">
            @csrf
            <div class="mb-3 mt-5">
                @error('name')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                <label for="Username" class="form-label">Имя</label>
                <input type="text" name="Username" class="form-control @error('name') is-invalid @enderror" id="Userame" placeholder="Имя" value="{{old('title')}}">
                
            </div>
            
            <!-- Phone -->
            <div class="mb-3 mt-3">
                @error('phone')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                <label for="Phone" class="form-label">Телефон</label>
                <input type="text" name="phone" class="form-control @error('phone') is-invalid @enderror" id="phone" placeholder="Телефон" value="{{old('phone')}}">
                
            </div>

            <div class="mb-3 mt-2">
                @error('email')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                <label for="Email" class="form-label">Почта</label>
                <input type="email" name="Email" class="form-control @error('email') is-invalid @enderror" id="email" placeholder="Почта" value="{{old('title')}}">
                
            </div>
            <div class="mb-3 mt-2">
                @error('password')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                <label for="Password" class="form-label">Пароль</label>
                <input type="password" name="Password" class="form-control @error('password') is-invalid @enderror" id="Password" placeholder="Введите пароль" value="">
                
            </div>

            <div class="mb-3 mt-2">
                @error('password')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                <label for="password_confirmation" class="form-label">Подтверждение пароля</label>
                <input type="password" name="password_confirmation" class="form-control @error('password') is-invalid @enderror" id="password_confirmation" placeholder="Повторно введите пароль" value="">
                
            </div>
            
            <div class="mb-3">
                <label for="formFile" class="form-label">Аватар</label>
                <input class="form-control" name='UserPhoto' type="file" id="formFile">
              </div>

            <button type="submit" class="btn btn-warning" id="submit">Отправить</button>
            
            <button id="loadingButton" class="btn btn-warning d-none" type="button" disabled>
                <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                Загрузка...
            </button>
    </div>
</div>

</div>
<script>
    document.getElementById('registrationForm').addEventListener('submit', function() {
        document.getElementById('loadingButton').classList.remove('d-none');
        document.getElementById('submit').classList.add('d-none');
    });
    </script>
@endsection

