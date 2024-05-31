<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <H1>ЛОХ</H1>
    @if(Auth::check()) 
                <a class="text-decoration-none text-black" href="{{ route('logout') }}">Logout</a>
                @endif
</body>
</html>