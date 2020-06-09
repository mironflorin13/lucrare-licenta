<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
class DentistLoginController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest:dentist');
    }
    public function showLoginForm(){
        return view('auth.dentist-login');
    }
    public function login(Request $request)
    {
       $this->validate($request,[
           'email'=>'required|email',
           'password'=>'required|min:6'
       ]);
       if(Auth::guard('dentist')->attempt(['email'=>$request->email,'password'=>$request->password],$request->remember))
       {
            return redirect()->intended(route('dentist.dashboard'));
       }
       \Session::flash('message','Email or password do not mach!');
       return redirect()->back()->withInput($request->only('email','remember'),);
    }

}
