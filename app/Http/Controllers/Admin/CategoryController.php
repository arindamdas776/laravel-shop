<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use Carbon\Carbon;
use Storage;
use Intervention\Image\Facades\Image;
use Mckenziearts\Notify\LaravelNotifyServiceProvider;
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
        $categories = Category::all();
        return view('back-end/superAdmin/categories/index',compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('back-end/superAdmin/categories/create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryRequest $request)
    {
        $image = $request->image;
        $slug = str_slug($request->category_name);
            if (isset($image)) {
                $image_name = $slug.'.'.Carbon::now()->toDateString().'.'.uniqid().'.'.$image->getClientOriginalExtension();

                    if (! Storage::disk('public')->exists('category')) {
                        Storage::disk('public')->makeDirectory('category');
                    }
              $category_image = Image::make($image)->resize('700','400')->stream();
                Storage::disk('public')->put('category/'.$image_name,$category_image);
            }
        $category = new Category();
        $category->name = $request->category_name;
        $category->slug = $slug;
        $category->image = $image_name;
        $category->user_id  = Auth::user()->id;

        $category->save();
        notify()->success("category Register successfully");

        return redirect()->route('admincategories.store');
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
        $categories = Category::find($id);

        return view('back-end/superAdmin/categories/edit',compact('categories'));
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
        $slug = str_slug($request->title);
        $categories = Category::find($id);

            if (isset($image)) {
                $image_name = $slug.'.'.Carbon::now()->toDateString().'.'.uniqid().'.'.$image->getClientOriginalExtension();
                if (Storage::disk('public')->exists('category/'.$categories->image)) {
                    Storage::disk('public')->delete('category/'.$categories->image);
                }
                    if (! Storage::disk('public')->exists('category')) {
                        Storage::disk('public')->makeDirectory('category');
                    }
                $category_image = Image::make($image)->resize('700','400')->stream();
                Storage::disk('public')->put('category/'.$image_name,$category_image);
            }

                       $categories->name = $request->category_name;
        $categories->image = $image_name;
        $categories->slug = $slug;
        $categories->save();
       
        notify()->success("Category Updated successfully");
        return redirect()->route('admincategories.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = Category::findorFail($id);

            if ($category) {
                $category->delete();
            }
        notify()->error('Category Deleted successfully');
        return redirect()->back();
    }
}
