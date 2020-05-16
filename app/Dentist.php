<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Auth;

class Dentist extends Authenticatable
{
    use Notifiable;
    protected $guard='dentist';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    protected static function boot()
    {
        
        parent::boot(); 
        
        static::created(function($dentist){
            $dentist->dentist_profiles()->create([
                'name'=>'No Name',             
                'location'=>'Iasi',
                'phone'=>'0123456789',
                'schedule_m_f'=>'8AM-5PM',
                'schedule_sat'=>'CLOSE',
                'schedule_sun'=>'CLOSE',
                'description'=>"I'm a dentist",
                'image'=>'profile/profil.png',
            ]);
        }

        );
    }
    public function dentist_Profiles()
    {
        return $this->hasOne(DentistProfile::class);
    }
    public function dentist_Services()
    {
        return $this->hasMany(DentistService::class);
    }
    public function dentist_Appointments()
    {
        return $this->hasMany(dentistAppointment::class);
    }

}
