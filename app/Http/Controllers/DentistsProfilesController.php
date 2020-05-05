<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Intervention\Image\Facades\Image;

class DentistsProfilesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index($user)
    {
        $user=User::findOrFail($user);

        return view('dentist.profile',[
            'user'=> $user
        ]);
    }
    public function edit($user)
    {
        $user=User::findOrFail($user);
        return view('dentist.editProfile',[ 
            'user'=>$user
        ]);
    }
    public function update(USer $user)
    {
        $data = request()->validate([
            'location'=>'required',
            'description'=>'',
            'address'=>'required',
            'image'=>'',
        ]); 
       
        if(request('image')){
            $imagePath=request('image')->store('profile','public');
            $image=Image::make(public_path("storage/{$imagePath}"))->fit(1000,1000);
            $image->save();
        }
        auth()->user()->dentist_profiles->update(array_merge(
            $data,
            ['image'=>$imagePath]
        ));
        return redirect("/profile/{$user->id}");
    }
}
