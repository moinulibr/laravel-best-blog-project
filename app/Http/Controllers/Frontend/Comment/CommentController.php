<?php

namespace App\Http\Controllers\Frontend\Comment;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Comment\Comment;
use Illuminate\Support\Facades\Auth;
use Validator;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
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
    public function store(Request $request,$id)
    {
        $input = $request->except('_token');
        $validator = Validator::make($input,[
            'comment' => 'required|min:2',
        ]); 

        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();
         }

        $comment = new Comment();
        $comment->user_id = Auth::user()->id;
        $comment->post_id = $id;
        $comment->comment = $request->comment;
        $save = $comment->save();
        if($save){
            $notification = array(
                'messege' => 'Your Comment is Posted Successfully! It will be published after Admin approved ',
                'alert-type' => 'success'
            );
            return redirect()->back()->with($notification);
        }else{
            $notification = array(
                'messege' => 'Your Comment is not Posted !',
                'alert-type' => 'error'
            );
            return redirect()->back()->with($notification);
        }
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
