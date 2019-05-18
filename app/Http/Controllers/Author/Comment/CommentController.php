<?php

namespace App\Http\Controllers\Author\Comment;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Comment\Comment;
use Illuminate\Support\Facades\Auth;
class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['posts'] =Auth::user()->posts;
        return view('author.comment.comment',$data);
    }

    public function delete($id = null)
    {
       $comment =  Comment::findOrFail($id);
       if($comment->post->user->id == Auth::user()->id){
            $delete = $comment->delete();
            if($delete){
                $notification = array(
                    'messege' => 'Comment is Deleted Successfully!',
                    'alert-type' => 'success'
                );
                return redirect()->back()->with($notification);
            }else{
                $notification = array(
                    'messege' => 'Comment is Not Deleted!',
                    'alert-type' => 'error'
                );
                return redirect()->back()->with($notification);
            }
       }else{
        $notification = array(
            'messege' => 'You are not authorized to delete this comment!',
            'alert-type' => 'error'
        );
        return redirect()->back()->with($notification);
       }
       
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
