<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Category\Category;
use App\Model\Post\Post;

class HomeController extends Controller
{
    

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $data['categories'] = Category::all();
        $data['posts'] = Post::where('is_approved',1)->where('status',1)->latest()->take(6)->get();
        return view('welcome' ,$data);
    }
}
