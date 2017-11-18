<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
//    public function __construct()
//    {
//        $this->middleware('auth');
//    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if (Auth::check()) {
            return view('home', [
                'route' => '登录后跳转'
            ]);
        }
        else
            return view('home',[
                //反正登不登录首页都一样,就返回一样的route了
                'route'=>'登录后跳转',
                ]);
    }
}
