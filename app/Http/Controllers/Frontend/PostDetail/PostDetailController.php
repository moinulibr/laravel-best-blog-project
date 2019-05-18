<?php

namespace App\Http\Controllers\Frontend\PostDetail;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Post\Post;
use App\Model\Category\Category;
use App\Model\Tag\Tag;
use Illuminate\Support\Facades\Session;
use App\User;

class PostDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function postDetails($slug)
    {
        $data['categories'] = Category::all();
        $data['tags'] = Tag::all();
        $post = Post::where('is_approved',1)->where('status',1)->where('slug',$slug)->first();
        $data['post'] = $post;
        $blogKey = "blog_".$post->id;

        
        /*
        if(Session::has($blogKey)){
            echo "ase"; //session()->forget($blogKey);
        }
        */
        if(!Session::has($blogKey)){
            //echo "nai";
            $post->increment('view_count');
            Session::put($blogKey,1);
        }       
        
            /**->random(3)   $data['randomPosts'] */

    $totalPost = Post::where('is_approved',1)->where('status',1)->get();
       $count =  $totalPost->count();
       if($count > 2){
            $data['randomPosts'] = Post::where('is_approved',1)->where('status',1)->get()->random(3);
       }else{
            $data['randomPosts'] = Post::where('is_approved',1)->where('status',1)->get(); 
       }
       return view('frontend.post-details.post-detail',$data);
    }


    public function index()
    {
        $data['posts'] = Post::where('status',1)->where('is_approved',1)->latest()->paginate(12);  
       return view('frontend.post-details.all-post',$data);
    }

    public function postByCategoy($slug)
    {
        $data['category'] = Category::where('slug',$slug)->first();
        //return   $data['posts'] = $data['category']->Posts()->where('status',1)->where('is_approved',1)->latest()->paginate(12);  
        $data['posts'] = $data['category']->Posts()->active()->publish()->latest()->paginate(12);  
       return view('frontend.post-details.post-category',$data);
    }

    public function postByTag($slug)
    {
        $data['tag'] = Tag::where('slug',$slug)->first();
         //return   $data['posts'] = $data['tag']->Posts()->where('status',1)->where('is_approved',1)->latest()->paginate(12);  
         $data['posts'] = $data['tag']->Posts()->active()->publish()->latest()->paginate(12);  
         return view('frontend.post-details.post-tag',$data);
    }

    public function postByAuthor($id)
    {
        $data['author'] = User::where('username',$id)->first();
        //return   $data['posts'] = $data['author']->Posts()->where('status',1)->where('is_approved',1)->latest()->paginate(12);  
         $data['posts'] = $data['author']->Posts()->active()->publish()->latest()->paginate(12);  
         return view('frontend.post-details.post-author',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
