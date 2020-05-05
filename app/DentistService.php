<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DentistService extends Model
{
    protected $fillable = [
        'user_id',
        'servicename',
        'price',
        'created_at',
        'updated_at',
        'deleted_at',
    ];
    public function user()
    { 
        return $this->belongsTo(User::class);
    }
}
