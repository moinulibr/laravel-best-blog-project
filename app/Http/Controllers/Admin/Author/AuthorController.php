<?php

namespace App\Http\Controllers\Admin\Author;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
class AuthorController extends Controller
{
    public function index(){
        $data['users'] = User::authors()
                    ->withCount('posts')
                    ->withCount('comments')
                    ->withCount('favorite_posts')
                    ->get();
        return view('admin.author.author',$data);
    }


    public function delete($id = null){
        $user  = User::findOrFail($id);

        //Old image check and Delete
        if(Storage::disk('public')->exists('post/'.$user->image)){
            Storage::disk('public')->delete('post/'.$user->image);
         }
        $delete = $user->delete();
        if($delete){
            $notification = array(
                'messege' => 'Author Deleted Successfully!',
                'alert-type' => 'success'
            );
            return redirect()->back()->with($notification);
        }else{
            $notification = array(
                'messege' => 'Author is Not Deleted!',
                'alert-type' => 'error'
            );
            return redirect()->back()->with($notification);
        }
    }
}
