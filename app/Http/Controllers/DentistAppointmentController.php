<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Calendar;
use App\User;
use Validator;
use Illuminate\Support\Facades\Auth;
use App\DentistAppointment;
use Illuminate\Support\Facades\DB;

class DentistAppointmentController extends Controller
{
    public function index(){
        $events = DentistAppointment::get();
    	$event_list = [];
    	foreach ($events as $key => $event) {
    		$event_list[] = Calendar::event(
                $event->event_name,
                true,
                new \DateTime($event->start_date),
                new \DateTime($event->end_date.' +1 day')
            );
    	}
    	$calendar_details = Calendar::addEvents($event_list); 
        $user = Auth::user();
        $appointments=DB::table('dentist_appointments')->where('dentist_id','=',$user->id)->orderByRaw('start_date')->get();
        $services=DB::table('dentist_services')->where('dentist_id','=',$user->id)->get();
        return view('dentist.appointments', compact('appointments','user','services','calendar_details') );
    }


    public function addAppointment(Request $request){
        $validator =Validator::make($request->all(), [
            'date'=>'required',
            'time'=>'required',
        ]);
        $dAt=$request['date'].' '.$request['time'];

        if ($validator->fails()) {
        	\Session::flash('warnning','Please enter the valid details');
            return Redirect::to('/dentist/appointments')->withInput()->withErrors($validator);
        }
        $end_date=date('Y-m-d H:i:s', strtotime($request['start_date'] .' +1 hour'));

        $ap=new DentistAppointment;
        $ap->service_name=$request['service_name'];
        $ap->created_by=auth()->user()->name;
        $ap->start_date=$dAt;
        $ap->end_date=$end_date;
        $ap->dentist_id=auth()->user()->id;
        $ap->save();
        \Session::flash('message','Appointment added successfully.');
        return Redirect::to('/dentist/appointments');
    }

    public function editAppointment(Request $req)
    {
        
          $post =DentistAppointment::find($req->id);
          $end_date=date('Y-m-d H:i:s', strtotime($req['start_date'] .' +1 hour'));
          $post->service_name = $req->service_name;
          $post->start_date = $req->start_date;
          $post->end_date=$end_date;
          $post->save();
          
          return response()->json($post);
    }
    
    public function deleteAppointment(request $request){
        $post = DentistAppointment::find($request->id)->delete();
        return response()->json();
    }
    public function calendar(){
        $events = DentistAppointment::get();
    	$event_list = [];
    	foreach ($events as $key => $event) {
    		$event_list[] = Calendar::event(
                $event->event_name,
                true,
                new \DateTime($event->start_date),
                new \DateTime($event->end_date.' +1 day')
            );
    	}
    	$calendar_details = Calendar::addEvents($event_list); 
        $user = Auth::user();
        return view('dentist.calendar',compact('user','calendar_details'));
    }

}
