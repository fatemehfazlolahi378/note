<?php

namespace App\Http\Controllers\Desktop;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SiteController extends Controller
{
    public function index()
    {
        $cookie_name = 'user';
        $cookie_value = 'fatemeh';
//        setcookie($cookie_name , $cookie_value , time() + 3600);
//
//        if(isset($_COOKIE[$cookie_name])){
//            dd('is set '.$cookie_name) ;
//        }else{
//            dd('is not set'. $cookie_name);
//        }

//        session_start();
//
//        if(isset($_SESSION[$cookie_name])){
//            dd('set session ' . $cookie_name);
//        }else{
//            $_SESSION[$cookie_name] = $cookie_value;
//            dd('start session');
//        }

        return view('desktop.index');

    }
}
