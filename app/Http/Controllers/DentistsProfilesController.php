<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\DB;
use App\DentistProfile;
use Illuminate\Support\Facades\Auth;

class DentistsProfilesController extends Controller
{

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
    public function update(User $user)
    {
        $data = request()->validate([
            'location'=>'required',
            'address'=>'required',
            'description'=>'',
            'phone'=>'min:10|max:110',
            'schedule_m_f'=>'',
            'schedule_sat'=>'',
            'schedule_sun'=>'',
        ]); 
        if(request('image'))
        {
            $imagePath=request('image')->store('profile','public');
            $image=Image::make(public_path("storage/{$imagePath}"))->fit(1000,1000);
            $image->save();
        }
        else
        {
           $ma=DentistProfile::all()->where('user_id', $user->id);
           $imagePath=$ma[0]['image'];
        }
        auth()->user()->dentist_profiles->update(array_merge(
            $data,
  
            ['image'=>$imagePath]
        ));
        return redirect("/profile/{$user->id}");
    }
}