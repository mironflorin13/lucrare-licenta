<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DentistAppointment extends Model
{
    protected $fillable = [
        'service_name',
        'start_date',
        'dentist_id',
        'end_date',
        'created_by',
        'created_at',
        'updated_at',
        'deleted_at',
    ];
 

    public function user()
   { 
       return $this->belongsTo(Dentist::class);
   }
}
