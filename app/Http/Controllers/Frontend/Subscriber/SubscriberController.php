<?php

namespace App\Http\Controllers\Frontend\Subscriber;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;
use App\Model\Subscriber\Subscriber;

class SubscriberController extends Controller
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
    public function store(Request $request)
    {
        $input = $request->except('_token');

		$validator = Validator::make($input,[
                    'email' => 'required|email|min:5|max:150|unique:subscribers,email',
				]); 
		
			if($validator->fails()){
			   return redirect()->back()->withErrors($validator)->withInput();
            }
            $subscriber = new Subscriber();
            $subscriber->email = $request->email;
            $save = $subscriber->save();
            if($save){
                $notification = array(
                    'messege' => 'Subscriber Listed Successfully!',
                    'alert-type' => 'success'
                );
                return redirect()->back()->with($notification);
            }else{
                $notification = array(
                    'messege' => 'Subscriber Not Listed!',
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
