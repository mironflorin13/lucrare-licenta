<?php

namespace App\Http\Controllers;

use App\Dentist;
use App\User;
use App\DentistProfile;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;

class DentistsProfilesController extends Controller
{

    public function index($user)
    {
        $user=Dentist::findOrFail($user);
        return view('dentist.profile',compact('user'));
    }

    public function edit($user)
    {
        $user=Dentist::findOrFail($user);
        return view('dentist.editProfile',compact('user'));
    }
    
    public function update(Dentist $user)
    {
        $data = request()->validate([
            'name'        => 'required | max:40',
            'location'    => 'required | max:40',
            'address'     => 'required | max:70', 
            'description' => 'required | max:170',
            'phone'       => 'required | numeric',
            'schedule_m_f'=> 'required | max:15',
            'schedule_sat'=> 'required | max:15',
            'schedule_sun'=> 'required | max:15',
        ]); 
        
        if(request('image'))
        {
            $imagePath=request('image')->store('profile','public');
            $image=Image::make(public_path("storage/{$imagePath}"))->fit(1000,1000);
            $image->save();
        }
        else
        {
           $ma=DentistProfile::all()->where('dentist_id', $user->id)->first();
           $imagePath=$ma['image'];
        }
        auth()->user()->dentist_profiles->update(array_merge(
            $data,
            ['image'=>$imagePath]
        ));
        return redirect("/dentist/profile/{$user->id}");
    }
}
