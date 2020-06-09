<?php

namespace App\Http\Controllers\Patient;

use Validator;
Use DateTime;
Use DateInterval;
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
            'ora'=>'required',
            'id'=>'required'
        ]);
        $dAt=$request['date'].' '.$request['ora'].":00";
        
        if ($validator->fails()) {
        	\Session::flash('warnning','Please enter the valid details');
            return Redirect::to("patient/allD/{{$request['id']}}")->withInput()->withErrors($validator);
        }
        $end_date=new Datetime($dAt);
        $end_date->add(new DateInterval('PT' . 60 . 'M'));
        

        $ap=new DentistAppointment;
        $ap->service_name=$request['service_name'];
        $ap->created_by=auth()->user()->name;
        $ap->start_date=$dAt;
        $ap->end_date=$end_date;
        $ap->dentist_id=$request['id'];
        $ap->phone ="123456789";
        $ap->patient_name = auth()->user()->name;
        $ap->duration = "1:00:00";
        $ap->save();
        $data=array(
            'date'=>$request['date'],
            'time'=>$request['ora']
        );
        Mail::to(auth()->user()->email)->send(new SuccessfullyScheduled($data));
        \Session::flash('message',"You were successfully scheduled on ".$request['date']." at ".$request['ora']." o'clock .");
        return Redirect::to('/patient/allD');
    }
    public function checkAvailableHours(Request $request)
    {
        $validator =Validator::make($request->all(), [
            'service_name'=>'required',
            'date'=>'required',
            'ora'=>'required',
            'id'=>'required'
        ]);
        $aa=array();
        $interval=DB::table('dentist_profiles')->where('dentist_id','=',$request->id)->first();
        $timestamp = strtotime($request->date);
        $day = date('D', $timestamp);
        $availableDay=true;
        if($day=="Sat")
        {
            if($interval->schedule_sat=="CLOSE")
            {
                $availableDay=false;
                $open=0;
                $close=0;
            }
            else {
                list($first, $last)=explode("-",$interval->schedule_sat);
                list($open)=explode(":",$first);
                list($close)=explode(":",$last);
            }
            
        }
        elseif($day=="Sun"){
            if($interval->schedule_sun=="CLOSE")
            {
                $availableDay=false;
                $open=0;
                $close=0;
            }
            else {
                list($first, $last)=explode("-",$interval->schedule_sun);
                list($open)=explode(":",$first);
                list($close)=explode(":",$last);
            }
        }
        else {
            list($first, $last)=explode("-",$interval->schedule_m_f);
            list($open)=explode(":",$first);
            list($close)=explode(":",$last);
        }
        
        
        
        for($i=$open;$i<$close;$i++)
        {
            $start_date=$request->date." ".$i.":00:00";
            $end_date = new DateTime($start_date);
            $end_date->add(new DateInterval('PT' . 60 . 'M'));
            $end=$end_date->sub(new DateInterval('PT1M'));
            $a=$end_date->format('Y-m-d H:i:s');
            $start=new DateTime($start_date);
            $start->add(new DateInterval('PT1M'));
            $b=$end->format('Y-m-d H:i:s');
            $c=$start->format('Y-m-d H:i:s');
            
            $result=DB::table('dentist_appointments')->where('dentist_id','=',$request->id)
                                                    ->where(function($query)use($request,$end,$start,$end_date)
                                                    {  
                                                    return $query->whereBetween('start_date',[$request['time'],$end])
                                                        ->orWhereBetween('end_date',[$start,$end_date])
                                                        ->orWhereRaw('? BETWEEN start_date and end_date', $start) 
                                                        ->orWhereRaw('? BETWEEN start_date and end_date', $end);
                                                    })->first();
            // var_dump($result,$start_date);
            
            if($result==null)
            {
                array_push($aa,$i.":00");
            }
            
        }
        $data=array(
            'date'=>$request->date,
            'id'=>$request->id,
            'hours'=>$aa,
            'availableDay'=>$availableDay,
        );
        return response()->json($data);
    }
}
