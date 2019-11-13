<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    //
    /**
     * login the users
     *
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request)
    {
        //
        
        if($request->isMethod('get'))
        {
            return view('auth.login');
        }
        else{
            if(auth()->attempt([
                'user_name'=>$request->username,
                'password'=>$request->password
            ] , $request->has('remember'))){

                return redirect()->route('home');
            
            }

            else{
                flash('هذه البيانات غير صحيحة')->error();                
                return back();
            }


        }
        
    }

    public function logout()
    {
        auth()->logout();
        return redirect()->route('login');
    }
}
