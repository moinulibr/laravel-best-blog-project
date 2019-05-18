<?php

namespace App\Http\Controllers\Admin\Post;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Category\Category;
use App\Model\Tag\Tag;
use App\Model\Post\Post;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Validator;
use Carbon\Carbon;
use App\Notifications\Notification\Notification\AuthorPostApproved;
use Illuminate\Support\Facades\Notification;
use App\Model\Subscriber\Subscriber;
use App\Notifications\Notification\Subscriber\NewPostNotify;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['tags'] = Tag::latest()->get();

        $data['categories'] = Category::latest()->get();
        $auth_id = Auth::user()->id;
        $data['posts'] = Post::where('user_id',$auth_id)->latest()->get();
        return view('admin.post.view',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['tags'] = Tag::latest()->get();
        $data['categories'] = Category::latest()->get();
        return view('admin.post.add',$data);
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
                    'title' => 'required|min:2|max:150',
                    'photo' => 'nullable|image|mimes:jpeg,jpg,png,gif',
                    'body' => 'required',
                    'categories' => 'required',
                    'tags' => 'required',
                    'status' => 'nullable',
				]); 
		
			if($validator->fails()){
			   return redirect()->back()->withErrors($validator)->withInput();
            }

            $slug = str_slug($request->title);
            $image = $request->file('photo');

            if(isset($image)){
                $ext = $image->getClientOriginalExtension();
                $rand = str_random(10);
                $date = Carbon::now()->toDateString();
                $image_name = $slug.'-'.$date.'-'.$rand .'.'.$ext;

                 //check Category file directy 
                 if(!Storage::disk('public')->exists('post')){
                    Storage::disk('public')->makeDirectory('post');
                 }
                 //resize image for upload
                 $imageSize = Image::make($image)->resize(1600,1066)->save($ext);
                 //upload in the Storage folder..
                 Storage::disk('public')->put('post/'.$image_name,$imageSize);
                 
            }else{
                $image_name ='default.png';
            }


            $post = new Post();
            $post->user_id = Auth::user()->id;
            $post->title = $request->title;
            $post->body = $request->body;
            $post->slug = $slug.'-'.str_random(1);
            $post->photo = $image_name;
            if(isset($request->status)){
                $post->status = 1;    
            }else{
                $post->status = 0; 
            }
            $post->is_approved = 1; 
            $save = $post->save();

            $post->categories()->attach($request->categories);
            $post->tags()->attach($request->tags);

            $subscribers = Subscriber::all();
            foreach($subscribers as $subscriber){
                Notification::route('mail',$subscriber->email)
                        ->notify(new NewPostNotify($post));
            }                                                   //[mail == chanel]

            if($save){
                $notification = array(
                    'messege' => 'Post Created Successfully!',
                    'alert-type' => 'success'
                );
                return redirect()->route('admin.post.index')->with($notification);
            }else{
                $notification = array(
                    'messege' => 'Post Not Created!',
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
        $data['post'] = Post::where('user_id',Auth::user()->id)->findOrFail($id); 
        return view('admin.post.show',$data);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['tags'] = Tag::latest()->get();
        $data['categories'] = Category::latest()->get();
        $data['post'] = Post::where('user_id',Auth::user()->id)->findOrFail($id); 
        return view('admin.post.edit',$data);
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
        $input = $request->except('_token');

		$validator = Validator::make($input,[
                    'title' => 'required|min:2|max:150',
                    'photo' => 'nullable|image|mimes:jpeg,jpg,png,gif',
                    'body' => 'required',
                    'categories' => 'required',
                    'tags' => 'required',
                    'status' => 'nullable',
				]); 

            $slug = str_slug($request->title);
            $image = $request->file('photo');
            $post = Post::findOrFail($id);
            if(isset($image)){
                $ext = $image->getClientOriginalExtension();
                $rand = str_random(10);
                $date = Carbon::now()->toDateString();
                $image_name = $slug.'-'.$date.'-'.$rand .'.'.$ext;

                 //check Category file directy 
                 if(!Storage::disk('public')->exists('post')){
                    Storage::disk('public')->makeDirectory('post');
                 }
                    //Check and delete
                 if(Storage::disk('public')->exists('post/'.$post->photo)){
                    Storage::disk('public')->delete('post/'.$post->photo);
                 }

                 //resize image for upload
                 $imageSize = Image::make($image)->resize(1600,1066)->save($ext);
                 //upload in the Storage folder..
                 Storage::disk('public')->put('post/'.$image_name,$imageSize);
                 
            }else{
                $image_name = $post->photo;
            }


            //$post = new Post();
            $post->user_id = Auth::user()->id;
            $post->title = $request->title;
            $post->body = $request->body;
            $post->slug = $slug.'-'.str_random(1);
            $post->photo = $image_name;
            if(isset($request->status)){
                $post->status = 1;    
            }else{
                $post->status = 0; 
            }
            $post->is_approved = 1; 
            $save = $post->save();

            $post->categories()->sync($request->categories);
            $post->tags()->sync($request->tags);

            if($save){
                $notification = array(
                    'messege' => 'Post Updated Successfully!',
                    'alert-type' => 'success'
                );
                return redirect()->route('admin.post.index')->with($notification);
            }else{
                $notification = array(
                    'messege' => 'Post Not Updated!',
                    'alert-type' => 'error'
                );
                return redirect()->back()->with($notification);
            }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       return redirect()->route('admin.post.index');
    }

    

    public function pending()
    {
        $data['tags'] = Tag::latest()->get();

        $data['categories'] = Category::latest()->get();
        $data['posts'] = Post::where('is_approved',0)->latest()->get();
        return view('admin.post.pending',$data);
    }

    public function showPending($id)
    {
        $data['post'] = Post::where('is_approved',0)->findOrFail($id); 
        return view('admin.post.show',$data);
    }

    public function approve($id)
    {
       $post = Post::findOrFail($id);
       $post->is_approved = 1;
       $approved = $post->save();

       $post->user->notify( new AuthorPostApproved($post));
       
       $subscribers = Subscriber::all();
       foreach($subscribers as $subscriber){
           Notification::route('mail',$subscriber->email)
                   ->notify(new NewPostNotify($post));
       }                                                   //[mail == chanel]


        if($approved){
            $notification = array(
                'messege' => 'Post is Approved Successfully!',
                'alert-type' => 'success'
            );
            if($post->user_id == Auth::user()->id){
                return redirect()->route('admin.post.index')->with($notification);
            }
            return redirect()->route('admin.post.pending')->with($notification);
        }else{
            $notification = array(
                'messege' => 'Post is Not Approved!',
                'alert-type' => 'error'
            );
            return redirect()->back()->with($notification);
        }
    }
    public function delete($id)
    {
 
       $post = Post::where('user_id',Auth::user()->id)->findOrFail($id);
        if(Storage::disk('public')->exists('post/'.$post->photo)){
            Storage::disk('public')->delete('post/'.$post->photo);
        }
        $post->categories()->detach();
        $post->tags()->detach();
      $delete = $post->delete();
            if($delete){
                $notification = array(
                    'messege' => 'Post is Deleted Successfully!',
                    'alert-type' => 'success'
                );
                return redirect()->route('admin.post.index')->with($notification);
            }
            else{
                $notification = array(
                    'messege' => 'Post is Not Deleted!',
                    'alert-type' => 'error'
                );
                return redirect()->back()->with($notification);
            }
    }

}
