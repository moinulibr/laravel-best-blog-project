<?php

namespace App\Http\Controllers\Admin\Tag;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;
use App\Model\Tag\Tag;
use Symfony\Component\Console\Helper\Table;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['tags'] = Tag::latest()->get();
        return view('admin.tag.view',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.tag.add');
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
                    'name' => 'required|min:2|max:50|unique:tags,name',
                    'description' => 'nullable|max:150',
				]); 
		
			if($validator->fails()){
			   return redirect()->back()->withErrors($validator)->withInput();
            }
        $tag = new Tag();
        $tag->name = $request->name;
        $tag->description = $request->description;
        $tag->slug = str_slug($request->name);
        $tag->save();
            if($tag->save()){
                $notification = array(
                    'messege' => 'Tag Added Successfully!',
                    'alert-type' => 'success'
                );
                return redirect()->route('admin.tag.index')->with($notification);
            }else{
                $notification = array(
                    'messege' => 'Tag Not Added!',
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
        $data['tag'] = Tag::findOrFail($id);
        return view('admin.tag.edit',$data);
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
                    'name' => 'required|min:2|max:50|unique:tags,name,'.$id,
                    'description' => 'nullable|max:150',
				]); 
		
			if($validator->fails()){
			   return redirect()->back()->withErrors($validator)->withInput();
            }
        $tag = Tag::findOrFail($id);
        $tag->name = $request->name;
        $tag->description = $request->description;
        $tag->slug = str_slug($request->name);
        $tag->save();
            if($tag->save()){
                $notification = array(
                    'messege' => 'Tag Updated Successfully!',
                    'alert-type' => 'success'
                );
                return redirect()->route('admin.tag.index')->with($notification);
            }else{
                $notification = array(
                    'messege' => 'Tag Not Updated!',
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
        //
    }
}
