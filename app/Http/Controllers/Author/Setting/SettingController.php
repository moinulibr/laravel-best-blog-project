<?php

namespace App\Http\Controllers\Author\Setting;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;
use App\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Hash;

class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('author.setting.setting');
    }


    public function profileUpdate(Request $request ,$id)
    {
        $input = $request->except('_token');
	
     	$validator = Validator::make($input,[
                    'name' => 'required|min:2|max:50',
                    'username' => 'required|min:2|max:30|unique:users,username,'.$id,
                    'email' => 'required|max:150|unique:users,email,'.$id,
                    'photo' => 'nullable|image|mimes:jpeg,jpg,png,gif',
                    'about' => 'nullable|max:150',
				]); 
        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();
            }
            $slug = str_slug($request->name);
            $image = $request->file('photo');
            $user = User::findOrFail(Auth::user()->id);
            if(isset($image)){
                $ext = $image->getClientOriginalExtension();
                $rand = str_random(10);
                $date = Carbon::now()->toDateString();
                $image_name = $date.'-'.$rand .'.'.$ext;

                 //check Category file directy 
                 if(!Storage::disk('public')->exists('user')){
                    Storage::disk('public')->makeDirectory('user');
                 }
                 //resize image for upload
                 $imageSize = Image::make($image)->resize(500,500)->save($ext);
                 //upload in the Storage folder..
                 Storage::disk('public')->put('user/'.$image_name,$imageSize);
                 
            }else{
                $image_name =$user->image;
            }


           
            $user->name = $request->name;
            $user->username = $request->username;
            $user->email = $request->email;
            $user->about = $request->about;
            $user->image = $image_name;
            $save = $user->save();
            if($save){
                $notification = array(
                    'messege' => 'Updated Successfully!',
                    'alert-type' => 'success'
                );
                return redirect()->back()->with($notification);
            }else{
                $notification = array(
                    'messege' => 'Not Updated!',
                    'alert-type' => 'error'
                );
                return redirect()->back()->with($notification);
            }


    }

    public function changePassword(Request $request)
    {
        $input = $request->except('_token');
	
        $validator = Validator::make($input,[
                    'password' => 'required|min:6|confirmed|max:150',
                    'password_confirmation' => 'required|min:6',
               ]); 

        $currentPassword = Auth::user()->password;  //[its user current password]
        $oldPassword = $request->oldPassword;
        $newpassword = $request->password;

        if($request->password_confirmation == "" || $newpassword != $request->password_confirmation){
            $notification = array(
                'messege' => 'Password and Confirm Password Not Matched!',
                'alert-type' => 'error'
              );
            return Redirect()->back()->with($notification);	 
        }

        if(Hash::check($oldPassword,$currentPassword)){
            $user = User::find(Auth::id());
            $user->password = Hash::make($request->password);	//[new password]
            $user->save();
            Auth::logout();
                    if($user->save()){
                        $notification = array(
                            'messege' => 'Your Password Change Successfully!',
                            'alert-type' => 'success'
                        );
                        return Redirect()->back()->with($notification);	
                    }	
           }  
        else{
          $notification = array(
                'messege' => 'Password Not Matched!',
                'alert-type' => 'error'
              );
            return Redirect()->back()->with($notification);	
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
