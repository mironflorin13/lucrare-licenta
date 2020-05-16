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
use Illuminate\Support\Facades\DB;

class DentistsServicesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $user = Auth::user();
        $post=DB::table('dentist_services')->where('dentist_id','=',$user->id)->orderBy('servicename')->get();
        return view('dentist.services',compact('post','user'));  
    }

    public function addService(Request $req)
    {
        $rules=array(
            'user_id'=>'required',
            'servicename'=>'required',
            'price'=>'required',
        );
          $post = new DentistService;
          $post->dentist_id= $req->user_id;
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
