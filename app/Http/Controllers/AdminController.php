<?php

namespace App\Http\Controllers;

use App\Models\Advertisement;
use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function admin()
    {
        $users = User::orderBy('id')->get();
        return view('admin.index', compact('users'));
    }
    public function admin2(Request $request)
    {
        $user = User::find($request->id);
        $user->Username = $request->Username;
        $user->Email = $request->Email;
        $user->Role = $request->Role;
        $user->save();

        return redirect()->back()->with('success', 'Данные успешно обновлены');
    }

    public function post()
    {
        $categories = Category::all();
        $posts = Advertisement::orderBy('AdID')->get();
        return view('admin.posts', compact('posts', 'categories'));
    }

    public function post2(Request $request)
    {
    $adID = $request->input('AdID');

    $advertisement = Advertisement::find($adID);

    if ($advertisement) {
        $advertisement->Status = 'confirmed'; 
        $advertisement->save();
        return redirect()->back()->with('success', 'Пост подтверждён');
    } else {
        return redirect()->back()->with('error', 'Не удалось найти объявление');
    }
    }

    public function post3(Request $request)
    {
        $AdID = $request->input('AdID');
    
    if($AdID) {
        DB::table('advertisements')->where('AdID', '=', $AdID)->delete();
        return redirect()->back()->with('success', 'Пост успешно удалён');
    } else {
        return redirect()->back()->with('error', 'Ошибка удаления поста');
    }

    }
}
