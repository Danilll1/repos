@extends('layouts.app')

@php

@endphp

<head>

</head>
@section('content')


    <div class="row">
        <div class="col-3">
            <div class="sidebar" id="sidebar">
                <div class="text-center">
                    <button type="button" class="btn btn-warning " data-bs-toggle="modal" data-bs-target="#createAdModal">
                        Создать объявление
                    </button>
                    @if (Auth::check() && Auth::user()->Role == 1)
                        <div class="admin">
                            <a class="btn btn-info m-2 w-100"
                                style="position: relative; left: -8px; border-radius: 0px!important;"
                                href="{{ route('admin') }}">Панель администратора</a>
                        </div>
                        <div class="postsCheck">
                            <a class="btn btn-info m-1 w-100"
                                style="position: relative; left: -4px; border-radius: 0px!important;"
                                href="{{ route('post.check') }}">Жалобы</a>
                        </div>
                    @endif



                </div>
                <h2>Категории</h2>
                <ul>
                    <li><a class="dropdown-item" href="{{ route('home') }}">Все категории</a></li>
                    @foreach ($categories as $category)
                        <li><a class="dropdown-item"
                                href="{{ route('home', ['category' => $category->CategoryID]) }}">{{ $category->CategoryName }}</a>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
        <div class="col-9">
            <div class="burger-menu" onclick="toggleSidebar()">
                <div class="line"></div>
                <div class="line"></div>
                <div class="line"></div>
            </div>
        </div>
    </div>
    <div class="container-fluid">

        <!--============================================================================================================================================-->


        @if (Auth::check())
            <div class="modal fade" id="createAdModal" tabindex="-1" aria-labelledby="createAdModalLabel"
                aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="createAdModalLabel">Создать объявление</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

                        </div>
                        <div class="modal-body">
                            <!-- Форма для создания объявления -->
                            <form action="{{ route('post.create') }}" method="POST" enctype='multipart/form-data'>
                                @csrf
                                <div class="mb-3">
                                    <label for="title" class="form-label">Заголовок</label>
                                    <input type="text" class="form-control" id="Title" name="Title" required>
                                </div>
                                <div class="mb-3">
                                    <label for="description" class="form-label">Описание</label>
                                    <textarea class="form-control" id="Description" name="Description" rows="3" required></textarea>
                                </div>

                                <label for="formFile" class="form-label">Изображение</label>
                                <input class="form-control" type="file" id="AdPhoto" name="AdPhoto">

                                <div class="mb-3">
                                    <label for="category" class="form-label">Категория</label>
                                    <select class="form-select" id="CategoryID" name="CategoryID" required>
                                        <option selected disabled>Выберите категорию</option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->CategoryID }}"
                                                href="{{ route('home', ['category' => $category->CategoryID]) }}">
                                                {{ $category->CategoryName }}</option>
                                        @endforeach


                                    </select>
                                </div>

                                <button type="submit" class="btn btn-warning">Создать</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @endif

        @if (Auth::check())
            <div class="modal fade" id="bookmarks" tabindex="-1" aria-labelledby="createAdModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-xl">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="createAdModalLabel">Закладки</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

                        </div>
                        <div class="modal-body">
                            <!--=====================================================================-->
                            <form action="{{ route('Delbookmark') }}" method="POST">
                                @csrf
                            <div class="row">
                                @foreach ($posts as $post)
                                    @if (in_array($post->AdID, $bookmarkedPosts))
                                    <input type="hidden" id="AdID" name="AdID" value="{{$post->AdID}}">
                                        <div class="col-md-4">
                                            <div class="card m-2 p-0 @if ($post->Status == 'confirmed') bg-light @endif"
                                                style="">
                                                <img src="{{ asset('storage/' . $post->AdPhoto) }}" alt="Avatar" 
                                                    height="200px" class="object-fit-fill">
                                                <div class="card-body">
                                                    <h5 class="card-title">{{ $post->Title }}</h5>
                                                    <p class="card-text">{{ $post->Description }}</p>
                                                </div>
                                                <ul class="list-group list-group-flush @if ($post->Status == 'confirmed') bg-light @endif">
                                                    <li class="list-group-item @if ($post->Status == 'confirmed') bg-light @endif">
                                                        {{ $post->category->CategoryName }}</li>
                                                        
                                                        <button type="submit" class="btn btn-danger">Удалить закладку</button>
                                                </ul>
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                            </form>
                            </div>
                            <!--==========================================================================-->
                        </div>
                    </div>
                </div>
            </div>
        @endif

        <!--============================================================================================================================================-->

        @if (session('success'))
            <div class="alert alert-success">
                {{ session()->pull('success') }}
            </div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger">
                {{ session()->pull('error') }}
            </div>
        @endif

        <div class="album py-5">
            <div class="container ">
                <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-4">
                    @foreach ($posts as $post)
                        <div class="card m-2 p-0 @if ($post->Status == 'confirmed') bg-light @endif" style="width: 25rem;">
                            <div class="card-body">
                                <h5 class="card-title">{{ $post->Title }}</h5>
                                <p class="card-text">{{ $post->Description }}</p>
                            </div>
                            <ul class="list-group list-group-flush @if ($post->Status == 'confirmed') bg-light @endif">
                                <li class="list-group-item @if ($post->Status == 'confirmed') bg-light @endif">
                                    {{ $post->created_at }}</li>
                                <li class="list-group-item @if ($post->Status == 'confirmed') bg-light @endif">
                                    {{ $post->category->CategoryName }}</li>
                            </ul>
                        </div>
                    @endforeach


                </div>
            </div>
        </div>

    </div>

    <script>
        function toggleSidebar() {
            var sidebar = document.getElementById('sidebar');
            sidebar.classList.toggle('active');
        }
    </script>

@endsection
