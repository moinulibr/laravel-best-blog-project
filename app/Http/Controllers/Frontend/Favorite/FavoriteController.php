<?php

namespace App\Http\Controllers\Frontend\Favorite;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Support\Facades\Auth;
use App\Model\Post\Post;

class FavoriteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function add(Request $request)
    {
       $post_id = $request->post_id;
       $user = Auth::user();
       
       $isFavorite = $user->favorite_posts()->where('post_id',$post_id)->count();
        if($isFavorite == 0){
           $attach =  $user->favorite_posts()->attach($post_id);
           $post_like = '<i class="addColor ion-heart"></i>   ';
           $post_like .= Post::findOrFail($post_id)->favorite_to_users()->count();
           return $post_like;
        }
        else{
            $user->favorite_posts()->detach($post_id);
            $post_like = '<i class="removeColor ion-heart"></i>   ';
            $post_like .= Post::findOrFail($post_id)->favorite_to_users()->count();
            return $post_like;
        }

    }



    public function remove($id)
    {
        $post_id = $id;
       $user = Auth::user();
       
       $isFavorite = $user->favorite_posts()->where('post_id',$post_id)->count();
        if($isFavorite == 0){
           $attach =  $user->favorite_posts()->attach($post_id);
            return redirect()->back();
           /*
           $post_like = '<i class="addColor ion-heart"></i>   ';
           $post_like .= Post::findOrFail($post_id)->favorite_to_users()->count();
           return $post_like;
           */
         
          $notification = array(
            'messege' => 'Post is added to your  favorite list',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
          
        }
        else{
            $user->favorite_posts()->detach($post_id);
            return redirect()->back();
            $notification = array(
                'messege' => 'Post is removed from your  favorite list',
                'alert-type' => 'success'
            );
            return redirect()->back()->with($notification);
              
           /*
            $post_like = '<i class="removeColor ion-heart"></i>   ';
            $post_like .= Post::findOrFail($post_id)->favorite_to_users()->count();
            return $post_like;
           */
        }
    }


    public function index()
    {
        //
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
