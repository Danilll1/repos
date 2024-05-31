<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function create()
    {
        $title = 'Регистрация';
        return view('user.create', compact('title'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'Username'=>'required',
            'phone'=> 'required|integer',
            'Email'=>'required|email|unique:users',
            'Password'=>'required',
            'UserPhoto'=> 'nullable|image',
        ]);

        $user = User::create([
            'Username' => $request->Username,
            'phone' => $request->phone,
            'Email' => $request->Email,
            'Password' =>Hash::make($request->Password),
        ]);
        if ($request->hasFile('UserPhoto')){
            $folder = date('Y-m-d');
            $avatar = $request->file('UserPhoto')->store("public/images/{$folder}");
            $image = str_replace('public/', '', $avatar);
            $user->UserPhoto = $image;
        }
        
        $user->save();

        session()->flash('success', 'Регистрация пройдена!');
        Auth::login($user);
        
        return redirect()->route('home');
        
    }
    public function LoginCreate()
    {
        $title = 'Авторизация';
        return view('user.login.create', compact('title'));
    }



public function LoginStore(Request $request)
{
    $request->validate([
        'Email' => 'required|email',
        'password' => 'required',
    ]);

    // Получаем хэшированный пароль из базы данных по введенной электронной почте
    $user = User::where('Email', $request->Email)->first();

    // Проверяем, совпадает ли хэшированный введенный пароль с хэшированным паролем из базы данных
    if ($user && Hash::check($request->password, $user->Password)) {
        // Аутентификация прошла успешно
        Auth::login($user);
        return redirect()->route('home');
    } 
    
    return redirect()->back()->with('error', 'Некоректный Логин или Пароль');
}

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login.create');
    }
}


