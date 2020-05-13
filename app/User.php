<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

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
        'function',
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
    //cu functia boot creez un profil
    protected static function boot()
    {
        parent::boot(); 
        static::created(function($user){
            $user->dentist_profiles()->create([
                'location'=>'no location',
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
