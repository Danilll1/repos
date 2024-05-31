<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Экзамен</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

        <!-- Сайдбар -->
        <style>
            .navbar {
                z-index: 2;
            }
            .sidebar {
                height: 100%;
                width: 250px;
                position: fixed;
                z-index: 1;
                top: 0;
                left: 0;
                background-color: #111;
                padding-top: 70px;
                left: -250px;
                box-sizing: border-box; 
            }
    
            .sidebar h2 {
                color: white;
                text-align: center;
            }
    
            .sidebar ul {
                list-style-type: none;
                padding: 0;
            }
    
            .sidebar ul li {
                padding: 10px;
                text-align: center;
                
            }
    
            .sidebar ul li a {
                color: white;
                text-decoration: none;
                
                border-radius: 10%;
            }

            .burger-menu {
            z-index: 3;
            display: block;
            cursor: pointer;
            padding: 10px;
            width: 35px;
            position: fixed;
            top: 5px;
            left: 10px;
        }

        .line {
            width: 25px;
            height: 3px;
            background-color: black;
            margin: 5px 0;
        }

        .active {
    transform: translateX(250px);
    transition: transform 0.3s ease;
}
.sidebar:not(.active) {
    transform: translateX(0); 
    transition: transform 0.3s ease;
}

    li:hover {
        background-color: rgb(75, 75, 75);
    }

    .container {
        display: flex;
    }
        </style>
    

</head>
<body style="background-color: #e2e2e2">
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <a class="navbar-brand" href="{{ route('home') }}"></a>
            @php
            use App\Models\User;
                $user = User::find(Auth::id());
                $path = storage_path();
            @endphp
            
            <ul>
                @if(Auth::check()) 
                <a class="text-decoration-none text-black" href="{{ route('logout') }}">Logout</a>
                @endif
                <strong> @if(Auth::check()) 
                    {{ Auth::user()->Username }}
                    @else Гость
                    @endif</strong>
                    @if(!Auth::check()) 
                <a class="text-decoration-none text-black" href="{{ route('user.create') }}">Register</a>
                <a class="text-decoration-none text-black" href="{{ route('login.create') }}">Login</a>
                @endif
            </ul>
            
        </div>
    </nav>

    <div class="container mt-4">
        @yield('content')

        @if(session('success'))
    <div class="alert alert-success">
        {{session('success')}}
    </div>
@endif
@if(session('error'))
    <div class="alert alert-danger">
        {{session('error')}}
        @endif
    </div>
    </div>


    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</body>
</html>