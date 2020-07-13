<?php

namespace App\Http\Controllers;

Use DateTime;
use Calendar;
use Carbon\Carbon;
use Validator;
Use DateInterval;
use App\User;
use App\Dentist;
use App\DentistAppointment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DentistAppointmentController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $appointments=DB::table('dentist_appointments')->where('dentist_id','=',$user->id)->where('end_date','>',Carbon::now('UTC')->addHour(3))->orderByRaw('start_date')->get();
        $services=DB::table('dentist_services')->where('dentist_id','=',$user->id)->get();
        
        return view('dentist.appointments', compact('appointments','user','services') );
    }


    public function store(Request $request)
    {
        $validator =Validator::make($request->all(), [
            'time'         =>'required',
            'service_name' =>'required | max:100',
            'patient_name' =>'required | max:35',
            'phone'        =>'required | numeric',
            'duration'     =>'required | numeric',
        ]);

        if ($validator->fails())
        {
        	\Session::flash('warning','Please enter the valid details');
            return Redirect::to('/dentist/appointments')->withInput()->withErrors($validator);
        }
        //creez end_date;
        $a=$request['time'].":00";
        $end_date = new DateTime($a);
        $end_date->add(new DateInterval('PT' . $request['duration'] . 'M'));
        $end=$end_date->sub(new DateInterval('PT1M'));
        
        $start=new DateTime($a);
        $start->add(new DateInterval('PT1M'));

        $minutes=$request['duration'];
        $hours = intdiv($minutes, 60).':'. ($minutes % 60);
        
        $result=DB::table('dentist_appointments')->where('dentist_id','=',auth()->user()->id)
                                                 ->where(function($query)use($request,$end,$start,$end_date)
                                                 {  
                                                   return $query->whereBetween('start_date',[$request['time'],$end])
                                                        ->orWhereBetween('end_date',[$start,$end_date])
                                                        ->orWhereRaw('? BETWEEN start_date and end_date', $start) 
                                                        ->orWhereRaw('? BETWEEN start_date and end_date', $end);
                                                 })->first();
       
        if($result==null)
        {
            $ap = new DentistAppointment;
            $ap->service_name = $request['service_name'];
            $ap->created_by = "You";
            $ap->created_by_id=0;
            $ap->start_date = $request['time'];
            $ap->end_date=$end_date;
            $ap->review=0;
            $ap->dentist_id=auth()->user()->id;
            $ap->phone = $request['phone'];
            $ap->patient_name = $request['patient_name'];
            $ap->duration = $hours;

            if($ap->save())
            {
                \Session::flash('message','Appointment added successfully.');
                return Redirect::to('/dentist/appointments');
            }
            else
            {
                \Session::flash('warning','Please enter the valid details');
                return Redirect::to('/dentist/appointments')->withInput()->withErrors($validator);
            }
        }
        else{
            \Session::flash('warning',' At that time you already have an appointment made!');
            return Redirect::to('/dentist/appointments');
        }
            
        

    }

    public function update(Request $request)
    {
        
        $minutes = $request->duration;
        $hours = intdiv($minutes, 60).':'. ($minutes % 60);
        $post =DentistAppointment::find($request->id);
        $post->service_name = $request->service_name;
        $post->start_date = $request->start_date;
        $post->duration =$hours;
        $post->save();
        $post->duration=$minutes;
        return response()->json($post);
    }
    
    public function destroy(request $request){
        $post = DentistAppointment::find($request->id)->delete();
        return response()->json();
    }

    public function calendar(){
        $user = Auth::user();;

        $events = DB::table('dentist_appointments')->where('dentist_id','=',$user->id)->get();
        $events_list = [];
        
    	foreach ($events as $event) {
            if (!$event->start_date) {
                continue;
            }
            $ore=$event->duration[0].$event->duration[1];
            $minute=$ore*60;
            
            $min=$event->duration[3].$event->duration[4];
            $minute=$minute+$min;

    		$events_list[]=[
                'title' => $event->service_name,
                'start' => $event->start_date,
                'end' => date('Y-m-d H:i:s',strtotime('+'.$minute.'minutes',strtotime($event->start_date)))
            ];
            
        }
        


        return view('dentist.calendar',['events_list'=>$events_list,'user'=>$user]);
    }
    public function reviews(){ 
        $user = Auth::user();
        $reviews= DB::table('reviews')->where('dentist_id','=',auth()->user()->id)->get();
        $reviews_nr=count($reviews);
        
        return view('dentist.reviews',compact('reviews','user','reviews_nr'));
    }
}
