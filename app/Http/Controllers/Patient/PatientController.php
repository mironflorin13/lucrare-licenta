<?php

namespace App\Http\Controllers\Patient;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\User;

class PatientController extends Controller
{
    
    public function index(){
        $doc=User::select('id')->where('function','=','patient')->first();
        $doct=$doc->id;
        return view('patient.index',compact('doct'));
    }
}
