<?php

namespace App\Http\Controllers;

use Validator;
use Response;
use App\User;
use App\DentistService;
use App\http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\input;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class DentistsServicesController extends Controller
{
 
    public function index()
    {
        $user = Auth::user();
        $post = DB::table('dentist_services')->where('dentist_id','=',$user->id)->orderBy('servicename')->get();

        return view('dentist.services',compact('post','user'));  
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'servicename'=>'required | string',
            'price'=>'required | max:6 ',
        ]);
        
        $exist=DB::table('dentist_services')->where('servicename','=', $request->servicename)->where('dentist_id','=',$request->user_id)->first();
        if($exist==null)
        {
            if ($validator->passes()) {

                $post = new DentistService;
                $post->dentist_id= $request->user_id;
                $post->servicename = $request->servicename;
                $post->price = $request->price;
                $post->save();
                return response()->json($post);
            }
            return response()->json(['error'=>$validator->errors()->all()]);
        }
        else
        {
            return response()->json(['error'=>["You already have a service white this name!"]]);
        }
        
        
    }

    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'price'=>'required | max:6 ',
        ]);
        if ($validator->fails()) {
        	\Session::flash('warning','Please enter the valid details');
            return Redirect::to('/dentist/services')->withInput()->withErrors($validator);
        }
        $post =DentistService::find($request->id);
        $post->price = $request->price;
        $post->save();
        return response()->json($post);
        
    }

    public function destroy(request $request)
    {
        $post = DentistService::find ($request->id)->delete();
        return response()->json();
    }

}
