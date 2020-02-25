<?php

namespace App\Http\Controllers\Seller;

use App\Http\Requests\CategoryRequest;
use App\Http\Controllers\Controller;
use App\Category;
use App\User;
use Carbon\Carbon;
use Storage;
use Intervention\Image\Facades\Image;
use Auth;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $categories = Category::where('user_id',2)->get();
      return view('back-end/seller/category/index',compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return view('back-end/seller/category/create',compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryRequest $request)
    {
        $image = $request->file('image');
        $slug = str_slug($request->category_name);
            if (isset($image)) {
                $current_data = carbon::now()->toDateString();
                $image_name = $slug.'.'.$current_data.'.'.uniqid().'.'.$image->getClientOriginalExtension();

                    if (! Storage::disk('public')->exists('category')) {
                        Storage::disk('public')->makeDirectory('category');
                    }
                $category_image = Image::make($image)->resize('1600','789')->stream();
                Storage::disk('public')->put('category/'.$image_name,$category_image);
            }
        $category = new Category();
        $category->name = $request->category_name;
        $category->image = $image_name;
        $category->slug = $slug;
        $category->user_id = Auth::user()->id;
        $category->save();

        $category->children()->attach($request->cat_id);
        notify()->success("Category Added successfully");
        return redirect()->route('sellercategories.index');
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
        $category = Category::find($id);
        $categories = Category::all();

        return view('back-end/seller/category/edit',compact('categories','category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CategoryRequest $request, $id)
    {
        $image = $request->image;
        $category = Category::find($id);
        $slug = str_slug($request->name);
            if (isset($image)) {
                $current_date = carbon::now()->toDateString();
                $image_name = $slug.'.'.$current_date.'.'.uniqid().'.'.$image->getClientOriginalExtension();

                    if (Storage::disk('public')->exists('category/'.$category->image)) {
                        Storage::disk('public')->delete('category/'.$category->image);
                    }
                if (! Storage::disk('public')->exists('category')) {
                      Storage::disk('public')->makeDirectory('category');  
                    }    
                $category_image = Image::make($image)->resize('1600','789')->stream();
                Storage::disk('public')->put('category/'.$image_name,$category_image); 
            }
         $category->name = $request->category_name;
        $category->image = $image_name;
        $category->slug = $slug;
        $category->user_id = Auth::user()->id;
        $category->save();

        $category->children()->attach($request->cat_id);
        notify()->success("Category updated successfully");
        return redirect()->route('sellercategories.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $categories = Category::findorFail($id);
            if ($categories) {
                $categories->delete();
            }
        notify()->error('Category deleted successfully');
        return redirect()->back();

    }
}
