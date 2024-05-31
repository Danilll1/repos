<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Advertisement;
use App\Models\Category;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    
    public function index(Request $request) {
        $title = "Домашняя страница";
        $search = $request->search;
        $selectedCategory = $request->input('category');
    
        $posts = Advertisement::query();
    
        if ($selectedCategory) {
            $posts->where('CategoryID', $selectedCategory);
        } 
        
        if ($search) {
            $posts->where('Title', 'like', '%' . $search . '%');
        }
    
        $posts = $posts->where('Status', 'confirmed')
                       ->orderBy('AdID')
                       ->get();
    
        $categories = Category::all();
    
        // Получаем закладки пользователя из сессии
        $bookmarkedPosts = $request->session()->get('bookmarkedPosts', []);
    
        return view('home', compact('title', 'categories', 'posts', 'selectedCategory', 'search', 'bookmarkedPosts'));
    }
    public function bookmarks(Request $request) {
    $postId = $request->post_id;
    $bookmarkedPosts = $request->session()->get('bookmarkedPosts', []);

    if (!in_array($postId, $bookmarkedPosts)) {
        $bookmarkedPosts[] = $postId;
        $request->session()->put('bookmarkedPosts', $bookmarkedPosts);
        return redirect()->back()->with('success', 'Объявление добавлено в закладки.');
    } else {
        return redirect()->back()->with('error', 'Объявление уже существует в закладках.');
    }
    }

    public function Delbookmarks(Request $request) {
    $bookmarkId = $request->AdID;
    $bookmarkedPosts = $request->session()->get('bookmarkedPosts', []);
    $index = array_search($bookmarkId, $bookmarkedPosts);

    
    if ($index !== false) {
        unset($bookmarkedPosts[$index]);
       
        $request->session()->put('bookmarkedPosts', $bookmarkedPosts);
        return redirect()->back()->with('success', 'Закладка удалена.');
    } else {
        return redirect()->back()->with('error', 'Закладка не найдена.');
    }
    }
}
