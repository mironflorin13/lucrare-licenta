<?php

namespace App\Http\Controllers\Patient;

use Validator;
use App\DentistAppointment;
use App\User;
use App\Dentist;
use App\Mail\SuccessfullyScheduled;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Mail;

class PatientController extends Controller
{

    public function index(){
        
        return view('patient.index');
    }
    public function showDentists()
    {
        $medici=Dentist::all();

        return view('patient.showDentists',compact('medici'));
    }
    public function viewDentistProfile($u)
    {
        
        $user=Dentist::findOrFail($u);
        $services=DB::table('dentist_services')->where('dentist_id','=',$u)->orderBy('servicename')->get();
        return view('patient.viewProfile',compact('user','services'));
    }
    public function createAppointment(Request $request){
        $validator =Validator::make($request->all(), [
            'service_name'=>'required',
            'date'=>'required',
            'time'=>'required',
        ]);
        $dAt=$request['date'].' '.$request['time'];

        if ($validator->fails()) {
        	\Session::flash('warnning','Please enter the valid details');
            return Redirect::to("patient/allD/{{$request['id']}}")->withInput()->withErrors($validator);
        }
        $end_date=date('Y-m-d H:i:s', strtotime($request['start_date'] .' +1 hour'));

        $ap=new DentistAppointment;
        $ap->service_name=$request['service_name'];
        $ap->created_by=auth()->user()->name;
        $ap->start_date=$dAt;
        $ap->end_date=$end_date;
        $ap->dentist_id=$request['id'];
        $ap->save();
        $data=array(
            'date'=>$request['date'],
            'time'=>$request['time']
        );
        Mail::to(auth()->user()->email)->send(new SuccessfullyScheduled($data));
        \Session::flash('message',"You were successfully scheduled on ".$request['date']." at ".$request['time']." o'clock .");
        return Redirect::to('/patient');
    }
}
