@extends('layouts.patient')

@section('content')

<div class="container">
    <div class="card-post mt-4">
        <div class="card-post__img">
            <img src="/storage/{{$user->dentist_profiles->image}}" alt="Profil Image">
        </div>
        <div class="card-post__info">
            
            <h1 class="card-post__title">{{$user->dentist_profiles->name}}</h1>
            
            
            <p class="card-post__description">
                {{$user->dentist_profiles->description}}
            </p>
            
            <div class="card-post__city">
                <span><b>City:    </b>{{$user->dentist_profiles->location}}</span>
                <span><b>Address: </b>{{$user->dentist_profiles->address}}</span>
                <span><b>Phone:   </b>{{$user->dentist_profiles->phone}}</span>
            </div>
            <div class="card-post__date" >
                <div><h4>Schedule:</h4></div>
                <div class="card-post__date_2" >
                    <div class="card-post__text">
                        <span>Monday-Friday:</span>   
                        <span>Saturday:     </span>   
                        <span>Sunday:       </span>   
                    </div>
                    <div class="card-post__text">
                        <span>{{$user->dentist_profiles->schedule_m_f}}</span>   
                        <span>{{$user->dentist_profiles->schedule_sat}}</span>   
                        <span>{{$user->dentist_profiles->schedule_sun}}</span>   
                    </div>
                </div>
                    
            </div>
        </div>
    </div>
    
    <div class="card ">
        <div class="card-header">Adauga o programare noua</div>
        <div class="card-body"> 
            <meta name="csrf-token" content="{{ csrf_token() }}">   
            <form action="{{route('createAppointment')}}" class="form-prevent-multiple-submit" method="POST" enctype="multipart/form-data">
                {{ csrf_field() }}

                <div class="row">
                    <div class="col-md-6" id="serviceName">
                        <div class="form-group">
                            <label for="service_name">Service name</label>
                            
                            <select name="service_name" class="form-control select2" required>
                                @foreach($services as $id => $service)
                                    <option value="{{ $service->servicename }}" >{{ $service->servicename }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
    
                    <div class="col-md-6 " id='appointmentDate'>
                        <div class="form-group">
                            <label for="service_name"> Select Date</label>
                            <div>
                                <input  id="date" name="date" class="form-control datetime" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 ore  hidd show1">
                        <div class="form-group">
                            <label for="ora">Availble Hours</label>
                            <select id='ora' name="ora" class="form-control">

                            </select>
                        </div>
                    </div>
                    <div class="col-md-4 mesaj  hidd show2">
                        <h4>No availble hours!</h4>
                    </div>
                    <div class="col-md-4 mesaj  hidd show3">
                        
                        <h4>Choose another day!</h4>
                    </div>
                </div>
                
                <input type="hidden"  name="id" value="{{$user->id}}">
                <div class="hidd show1"> &nbsp;<br/>
                    <button type="submit" class="btn btn-success button-prevent-multiple-submit" style="float: right;">Add Appointmet</button>
                </div>

            </form>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
           Services List 
        </div>
    
        <div class="card-body">
            <table id="table" class=" table text-center  table-bordered table-striped table-hover ajaxTable datatable datatable-Service">
                <thead>
                    <tr>
                        <th width="10"></th>
                        <th>Service name</>
                        <th>Price</th>

                    </tr>
                </thead>
                <?php $n=1 ?>
                @foreach ($services as $value)
                    <tr>
                        <td width="10">{{$n++}}</td>
                        <td>{{$value->servicename}}</td>
                        <td>{{$value->price}} lei</td>
                    </tr>
                @endforeach
            </table>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.6/jquery.min.js" type="text/javascript"></script>
    <script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/jquery-ui.min.js" type="text/javascript"></script>
    <link href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/themes/base/jquery-ui.css" rel="Stylesheet" type="text/css" />

<script type="text/javascript">
    $(document).ready( function(){
        $a = $(this).data('id');
        $('.hidd').hide();
        var today=new Date();
        var tomorrow=new Date(today.getTime() + 24 * 60 * 60 * 1000);
        $(".datetime").datepicker({
            
            dateFormat:'yy-mm-d',
            locale: 'en',
            minDate: tomorrow,
            daysOfWeekDisabled: [0,6],
            maxDate: '+2M',
            firstDay: 1 ,
            onSelect: function(dataTime) {
                $.ajax({
                    type: 'GET',
                    url: '/patient/hours',
                    data: { "date":dataTime,
                            'id': window.location.pathname.split('/allD/')[1]
                        },
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },    
                    success:function(data)
                    {
                        

                        var nrHours=data['hours'].length;
                        if(data['availableDay']==true)
                        {
                            
                            if(nrHours==0)
                            {   
                                $('#serviceName').removeClass('col-md-6');
                                $('#serviceName').removeClass('col-md-5');
                                $('#serviceName').addClass('col-md-4');

                                $('#appointmentDate').removeClass('col-md-6');
                                $('#appointmentDate').addClass('col-md-4');

                                $('.hidd').hide();
                                $('.show2').show();
                            }
                            else{
                                $('#serviceName').removeClass('col-md-6');
                                $('#serviceName').removeClass('col-md-4');
                                $('#serviceName').addClass('col-md-5');

                                $('#appointmentDate').removeClass('col-md-6');
                                $('#appointmentDate').addClass('col-md-4');

                                $('.hidd').hide();
                                $('.show1').show();
                            }
                        }
                        else{
                            $('#serviceName').removeClass('col-md-6');
                            $('#serviceName').removeClass('col-md-5');
                            $('#serviceName').addClass('col-md-4');

                            $('#appointmentDate').removeClass('col-md-6');
                            $('#appointmentDate').addClass('col-md-4');
                            $('.hidd').hide();
                            $('.show3').show();
                        }
                        
                        console.log(data['date']+" "+data['availableDay']);
                        $('#ora').html('');
                        for(var i=0; i<nrHours; i++)
                        {
                            console.log(data['hours'][i]+"\n");
                            $('#ora').append("<option value='"+data['hours'][i]+"'>"+data['hours'][i]+"</option>")
                        }
                    }        
                });
            }
        });
        
       
    });
</script>


@endsection
