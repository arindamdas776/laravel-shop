<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Product;
use App\Cart;
use Session;
use  Illuminate\Notifications\notify;

class FrontEndController extends Controller
{
    public function index(){
    	$products = Product::all()->random(3);
    	$categories = Category::all()->random(3);
    	
    	return view('front-end/content',compact('categories','products'));
    }
    public function category_products($slug){
    	 $categories = Category::where('slug',$slug)->first();
    	 $products = Product::all();
    	 $category = Category::all();
    	 return view('front-end/productByCategory',compact('categories','products','category'));
    	
    }
    public function allProducts(){
        $products = Product::all();
        return view ('front-end/products',compact('products'));
    }
    public function singleProduct($id){
        $singleProduct = Product::find($id);
        $fetchersProdudct = Product::latest()->take(3)->get();
        return view('front-end/singleproducts',compact('singleProduct','fetchersProdudct'));
    }
    public function showCart(){

        if(!Session::has('cart')){
            return redirect()->route('product.page');
        }else{
            $oldCart = Session::get('cart');
            $cart = new Cart($oldCart);

            return view('front-end/cart',['products' => $cart->groupItems,'totalPrice' => $cart->totalPrice]);
        }
       
    }
    public function addCart(Request $request,$id){
        $products = Product::find($id);
        $qty = $request->qty;
        $oldCart = Session::has('cart') ? Session::get('cart') : Null;
        $cart = new Cart($oldCart);
        $cart->add($products,$qty);
        $request->session()->put('cart',$cart);
        
        return redirect()->route('cart.show');
    }
    public function cardRemove(Request $request,$id){
        $product  = Product::find($id);

            if (!Session::has('cart')) {
                return redirect()->route('product.page');
            }else{

                $oldCart = Session::get('cart');
                $cart = new Cart($oldCart);
                $cart->delete($product);

              $request->session()->put('cart',$cart);

              return redirect()->route('product.page');
              Illuminate\Notifications\notify()->success('Cart has been remove successfully');
            }
    }
    public function checkout(){
        if (!Session::has('cart')) {
            return redirect()->route('product.page');
        }else{
            $oldCart = Session::get('cart');
            $cart = new Cart($oldCart);

             return view('front-end/checkout',['products' => $cart->groupItems,'totalPrice' => $cart->totalPrice]);
        }
       
    }
    public function postCheckout(Request $request){

    }
}
