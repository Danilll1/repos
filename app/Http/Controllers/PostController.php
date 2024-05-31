<?php

namespace App\Http\Controllers;
use App\Models\Advertisement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function create()
    {
        return redirect()->route('post.store');
    }
    public function store(Request $request)
{
    $user = Auth::user();
 // Проверка и валидация данных
 $validatedData = $request->validate([
    'Title' => 'required|string',
    'Description' => 'required|string',
    'CategoryID' => 'required|numeric',
    'AdPhoto' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // Пример валидации изображения
]);

if ($request->hasFile('AdPhoto')){
    $folder = 'post_' . date('Y-m-d');
    $avatar = $request->file('AdPhoto')->store("public/images/{$folder}");
    $image = str_replace('public/', '', $avatar);
}

// Создание нового объявления
$post = Advertisement::create([
    'UserID' => $user->id, 
    'CategoryID' => $validatedData['CategoryID'],
    'Title' => $validatedData['Title'],
    'Description' => $validatedData['Description'],
    // Добавление изображения
    'AdPhoto' => $image ?? null,
    'Status' => 'waiting',
]);

if ($post) {
    session()->flash('success', 'Объявление отправлено на проверку!');
    return redirect()->route('home');
} else {
    return redirect()->back()->withErrors(['error' => 'Не удалось сохранить объявление. Пожалуйста, попробуйте снова.']);
}
}
}
