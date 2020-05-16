<?php

namespace App\Http\Controllers\Dentist;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class DentistController extends Controller
{
    public function __construct(){
        $this->middleware('auth:dentist');
    }
    public function index(){
        $user = Auth::user();
        return view('dentist.index',compact('user'));
    }
}
