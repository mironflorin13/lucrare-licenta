<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reviews extends Model
{
    protected $fillable = [
        'dentist_id',
        'patient_id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

}
