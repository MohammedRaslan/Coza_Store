<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Contact;
use App\User;
use App\Product;
use App\Data;
use Illuminate\Http\Request;
use function GuzzleHttp\json_decode;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
   /* public function __construct()
    {
        $this->middleware('auth');
    }*/

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }

    public function test()
    {
        return view('FrontView.index');
    }

    public function admin()
    {
        $count = DB::table('contacts')->count();
        $notification = DB::table('contacts')->orderBy('id','desc')->get();

        $users = DB::table('users')->where('user_type',1)->count();
        $products = DB::table('products')->count();
        $employees = DB::table('users')->where('user_type',2)->count();
        $sold = DB::table('data')->count();
        return view('Admin_Portal.index')->with('count',$count)->with('notification', $notification)
        ->with('users',$users)->with('products',$products)->with('employees',$employees)->with('sold',$sold);
    }

}
