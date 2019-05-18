<?php

namespace App\Http\Controllers\Admin\Category;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Category\Category;
use Validator;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $data['categories'] = Category::latest()->get();
       return view('admin.category.view',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.category.add');
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
                    'name' => 'required|min:2|max:50|unique:categories,name',
                    'description' => 'nullable|max:150',
                    'photo' => 'nullable|image|mimes:jpeg,jpg,png,gif',
				]); 
		
			if($validator->fails()){
			   return redirect()->back()->withErrors($validator)->withInput();
            }

            $slug = str_slug($request->name);
            $image = $request->file('photo');

            if(isset($image)){
                $ext = $image->getClientOriginalExtension();
                $rand = str_random(10);
                $date = Carbon::now()->toDateString();
                $image_name = $slug.'-'.$date.'-'.$rand .'.'.$ext;

                 //check Category file directy 
                 if(!Storage::disk('public')->exists('category')){
                    Storage::disk('public')->makeDirectory('category');
                 }
                 //resize image for upload
                 $imageSize = Image::make($image)->resize(1600,479)->save($ext);
                 //upload in the Storage folder..
                 Storage::disk('public')->put('category/'.$image_name,$imageSize);
                 

                 //check Category/slider file directy 
                 if(!Storage::disk('public')->exists('category/slider')){
                    Storage::disk('public')->makeDirectory('category/slider');
                 }
                 //resize image for upload
                 $imageSize = Image::make($image)->resize(500,333)->save($ext);
                 //upload in the Storage folder..
                 Storage::disk('public')->put('category/slider/'.$image_name,$imageSize);

            }else{
                $image_name ='default.png';
            }


            $category = new Category();
            $category->name = $request->name;
            $category->description = $request->description;
            $category->slug = $slug;
            $category->photo = $image_name;
            $save = $category->save();
            if($save){
                $notification = array(
                    'messege' => 'Category Inserted Successfully!',
                    'alert-type' => 'success'
                );
                return redirect()->route('admin.category.index')->with($notification);
            }else{
                $notification = array(
                    'messege' => 'Category Not Inserted!',
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
         $data['category'] = Category::findOrFail($id);
        return view('admin.category.edit',$data);
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

        $request->validate([
            'name' => 'required|min:2|max:50|unique:categories,name,'.$id,
            'description' => 'nullable|max:150',
            'photo' => 'nullable|image|mimes:jpeg,jpg,png,gif',
        ]);

            $slug = str_slug($request->name);
            $image = $request->file('photo');
            $category = Category::findOrFail($id);

            if(isset($image)){
                $ext = $image->getClientOriginalExtension();
                $rand = str_random(10);
                $date = Carbon::now()->toDateString();
                $image_name = $slug.'-'.$date.'-'.$rand .'.'.$ext;

                 //check Category file directy 
                 if(!Storage::disk('public')->exists('category')){
                    Storage::disk('public')->makeDirectory('category');
                 }

                //Old image check and Delete
                 if(Storage::disk('public')->exists('category/'.$category->photo)){
                    Storage::disk('public')->delete('category/'.$category->photo);
                 }

                 //resize image for upload
                 $imageSize = Image::make($image)->resize(1600,479)->save($ext);
                 //upload in the Storage folder..
                 Storage::disk('public')->put('category/'.$image_name,$imageSize);
                 
                 /*------------------Image Slider------------------- */

                 //check Category/slider file directy 
                 if(!Storage::disk('public')->exists('category/slider')){
                    Storage::disk('public')->makeDirectory('category/slider');
                 }

                  //Old image category/slider check and Delete
                  if(Storage::disk('public')->exists('category/slider/'.$category->photo)){
                    Storage::disk('public')->delete('category/slider/'.$category->photo);
                 }
                 //resize image for upload
                 $imageSize = Image::make($image)->resize(500,333)->save($ext);
                 //upload in the Storage folder..
                 Storage::disk('public')->put('category/slider/'.$image_name,$imageSize);

            }else{
                $image_name =$category->photo;
            }


            //$category = new Category();
            $category->name = $request->name;
            $category->description = $request->description;
            $category->slug = $slug;
            $category->photo = $image_name;
            $save = $category->save();
            if($save){
                $notification = array(
                    'messege' => 'Category Updated Successfully!',
                    'alert-type' => 'success'
                );
                return redirect()->route('admin.category.index')->with($notification);
            }else{
                $notification = array(
                    'messege' => 'Category Not Updated!',
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
        $category = Category::findOrFail($id);
         //check Category file directy 
         if(!Storage::disk('public')->exists('category')){
            Storage::disk('public')->makeDirectory('category');
         }

        //Old image check and Delete
         if(Storage::disk('public')->exists('category/'.$category->photo)){
            Storage::disk('public')->delete('category/'.$category->photo);
         }

         /*------------------Image Slider------------------- */

         //check Category/slider file directy 
         if(!Storage::disk('public')->exists('category/slider')){
            Storage::disk('public')->makeDirectory('category/slider');
         }

          //Old image category/slider check and Delete
          if(Storage::disk('public')->exists('category/slider/'.$category->photo)){
            Storage::disk('public')->delete('category/slider/'.$category->photo);
         }
         $category->delete();
    
    }
}
