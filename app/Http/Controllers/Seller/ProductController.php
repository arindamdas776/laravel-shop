<?php

namespace App\Http\Controllers\Seller;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Product;
use App\User;
use App\Category;
use Carbon\Carbon;
use Storage;
use Intervention\Image\Facades\Image;
use Auth;
use App\Notifications\SellerNotification;
use Illuminate\Support\Facades\Notification;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::where('user_id',2)->get();
        return view('back-end/seller/products/index',compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return view('back-end/seller/products/create',compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
          $image = $request->select_image;
        $slug = str_slug($request->title);
            if (isset($image)) {
                   $current_data = carbon::now()->toDateString();
                   $image_name = $slug.'.'.$current_data.'.'.uniqid().'.'.$image->getClientOriginalExtension();
                if (! Storage::disk('public')->exists('product')) {
                    Storage::disk('public')->makeDirectory('product');
                }
            $product_image = Image::make($image)->resize('1600','789')->stream();
            Storage::disk('public')->put('product/'.$image_name,$product_image);
               }   
        $products = new Product();
        $products->title = $request->title;
        $products->price = $request->price;
        $products->image = $image_name;
        $products->description = $request->description;
        $products->user_id = Auth::user()->id;

        $products->save();
        $products->categories()->attach($request->cat_id);

        $sellerNotification = User::where('role_id','2')->get();
        Notification::send($sellerNotification,new SellerNotification($products));

        notify()->success('Product hasbeen successfully Register');
        return redirect()->route('sellerproducts.index');
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
        $products = Product::find($id);
        $categories = Category::all();
        return view('back-end/seller/products/edit',compact('products','categories'));
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
        $image_name = $request->hidden_image;
        $image = $request->image;
        $products = Product::find($id);

        $slug = str_slug($request->title);
            if (isset($image)) {
                $current_date = carbon::now()->toDateString();
                $image_name = $slug.'.'.$current_date.''.uniqid().'.'.$image->getClientOriginalExtension();
                    if (Storage::disk('public')->exists('product/'.$product->image)) {
                        Storage::disk('public')->delete('product/'.$product->image);
                    }
                        if (! Storage::disk('public')->exists('product')) {
                            Storage::disk('public')->makeDirectory('product');
                        }
                    $product_image = Image::make($image)->resize('1600','789')->stream();
                    Storage::disk('public')->put('product/'.$image_name,$product_image);
            }else{
                $products->image = $image_name;
            }
        $products->title = $request->title;
        $products->description = $request->description;
        $products->price = $request->price;

        $products->save();
        $products->categories()->attach($request->cat_id);

        notify()->success("Product hasbeen updated successfully");
        return redirect()->route('sellerproducts.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $products = Product::findorFail($id);
            if ($products) {
                 $products->delete();
            }
     notify()->error('Product Deleted successfully');
        return redirect()->back();

    }
}
