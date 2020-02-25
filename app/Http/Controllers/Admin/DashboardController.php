<?php

namespace App\Http\Controllers\Admin;

use Auth;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index(){
    	return view('back-end/superAdmin/Dashboard');
    }
    public function userDetails(){
    	$user = Auth::user()->where('role_id',3)->get();

    	return view('back-end/superAdmin/userDetails/UserIndex',compact('user'));
    }
    public function confirmation($id){
    	$user = User::where('id',$id)->get();
    		$user = User::find($id);
    		$user->role_name = 'seller';
    		$user->save();
    		return redirect()->back();
    }
    public function sellerDetails(){
    	$sellers = User::where('role_name','seller')->get();

    	return view('back-end/superAdmin/userDetails/sellerDetails',compact('sellers'));
    }
}
