<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\DentistService;
use Validator;
use Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\input;
use App\http\Requests;

class DentistsServicesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $user = Auth::user();
        $post=DentistService::all()->where('user_id',$user->id);
        return view('dentist.services.index',compact('post','user'));  
    }

    public function addService(Request $req)
    {
        $rules=array(
            'user_id'=>'required',
            'servicename'=>'required',
            'price'=>'required',
        );
          $post = new DentistService;
          $post->user_id= $req->user_id;
          $post->servicename = $req->servicename;
          $post->price = $req->price;
          $post->save();
          return response()->json($post);
    }

    public function editService(Request $req)
    {
        
          $post =DentistService::find($req->id);
          $post->servicename = $req->servicename;
          $post->price = $req->price;
          $post->save();
          return response()->json($post);
    }
    
    public function deleteService(request $request){
        $post = DentistService::find ($request->id)->delete();
        return response()->json();
      }

}
