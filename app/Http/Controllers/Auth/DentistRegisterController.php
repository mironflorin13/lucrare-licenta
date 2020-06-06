<?php

namespace App\Http\Controllers\Auth;

use Auth;
use App\Dentist;
use App\Mail\WelcomeMail;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Mail;


class DentistRegisterController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest:dentist');
    }

    public function showRegisterForm()
    {
        return view('auth.dentist-register');
    }

    protected function create(Request $request)
    {
        $this->validate($request,[
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:dentists'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
           ]);
        
        $create=new Dentist();
        $create->name = $request->name;
        $create->email = $request->email;
        $create->password = Hash::make($request->password);

        if($create->save())
        {
            Mail::to($create->email)->send(new WelcomeMail());
            Auth::guard('dentist')->attempt(['email'=>$request->email,'password'=>$request->password],$request->remember);
            \Session::flash('message','Your account has created successfully .');
            return redirect()->intended(route('dentist.dashboard'));
        }
        else
        {
            \Session::flash('warning','Please enter the valid details');
            return redirect()->route('dentist.register')->withInput()->withErrors($validator);
        }
        
    }
}
