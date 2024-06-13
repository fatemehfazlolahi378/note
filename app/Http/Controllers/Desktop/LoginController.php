<?php

namespace App\Http\Controllers\Desktop;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    protected User $user;
    public function __construct(User $user)
    {
        $this->user = $user;
    }
    public function checkUser(Request $request)
    {
        $request->validate([
            'mobile' => 'required|iran_mobile'
        ]);
        $mobile = $request->get('mobile');
        $user = $this->user->whereMobile($mobile)->exists();
        if($user){
            return response()->json(['login' => true]);
        }else{
            $user = User::create([
                'mobile' => $mobile,
            ]);
            return  response()->json(['login' => false]);

        }


    }
    public function register()
    {
        $mobile = \request()->get('mobile');
        $user = User::whereMobile($mobile)->first();
        $password = \request()->get('password');
        $repeatPass = \request()->get('repeat-password');

        if( $password == $repeatPass){
            $user->mobile_confirmation = 1;
            $user->full_name = \request()->get('full_name');
            $user->password = Hash::make(\request()->get('password'));
            $user->save();
            \Auth::login($user);
            return response()->json(['login' => 'success'],200);
        }else{
            return response()->json(['errors' => ['password','تایید رمز نادرست است']],422);
        }
    }
    public function loginPassword()
    {
        $mobile = \request()->get('mobile');
        $password = request()->get('password');
        $user = User::whereMobile($mobile)->first();
        if(Hash::check($password , $user->password)){
            $user->mobile_confirmation = 1;
            $user->save();
            \Auth::login($user);
            return response()->json(['login'=>'success'],200);
        }else{
            return response()->json(['errors' => ['password','رمز عبور وارد شده اشتباه است']],422);
        }

    }


}
