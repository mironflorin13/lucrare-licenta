<?php

namespace App\Http\Controllers\Auth;

use App\Dentist;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Redirect;

class DentistRegisterController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest:dentist');
    }
    public function showRegisterForm(){
        return view('auth.dentist-register');
    }
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }
    protected function create(Request $request)
    {
        $this->validate($request,[
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
           ]);
        $create=new Dentist();
        $create->name = $request->name;
        $create->email = $request->email;
        $create->password = Hash::make($request->password);
        if($create->save())
        {
            \Session::flash('message','Your account has created successfully .');
            return redirect()->route('dentist.login');
        }
        else{
            \Session::flash('warnning','Please enter the valid details');
            return redirect()->route('dentist.register')->withInput()->withErrors($validator);
        }
        
    }
}
