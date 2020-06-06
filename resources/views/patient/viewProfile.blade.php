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
                <span><b>City: </b>{{$user->dentist_profiles->location}}</span>
                <span><b>Address: </b>{{$user->dentist_profiles->address}}</span>
                <span><b>Phone: </b>{{$user->dentist_profiles->phone}}</span>
            </div>
            <div class="card-post__date" style="display: flex">
                <div><h4>Schedule:</h4></div>
                <div class="card-post__text">
                    <span>Monday-Friday:</span>   
                    <span>Saturday: </span>   
                    <span>Sunday:</span>   
                </div>
                <div class="card-post__text">
                    <span>{{$user->dentist_profiles->schedule_m_f}}</span>   
                    <span>{{$user->dentist_profiles->schedule_sun}}</span>   
                    <span>{{$user->dentist_profiles->schedule_sat}}</span>   
                </div>
            </div>
        </div>
    </div>
    
    <div class="card ">
        <div class="card-header">Adauga o programare noua</div>
        <div class="card-body">    
            <form action="{{route('createAppointment')}}" method="POST" enctype="multipart/form-data">
                {{ csrf_field() }}
                    <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="service_name">Service name</label>
                            <div class="">
                            <select name="service_name" class="form-control select2" required>
                                @foreach($services as $id => $service)
                                    <option value="{{ $service->servicename }}" >{{ $service->servicename }}</option>
                                @endforeach
                            </select>
                            </div>
                        </div>
                    </div>
    
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="service_name">Date</label>
                            <div class="">
                            <input type="date" id="date" name="date" class="form-control datetime" required>

                            </div>
                            
                        </div>
                        </div>
                        <div class="col-md-3">
                        <div class="form-group">
                            <label for="service_name">Hour</label>
                            <div class="">
                            <input type="time" id="time" name="time" class="form-control datetime" required>

                            </div>
                            
                        </div>
                        </div>
                        <input type="hidden"  name="id" value="{{$user->id}}">
                        <div class=" col-md-3 "> &nbsp;<br/>
                        <button type="submit" class="btn btn-success">Add appointment</button>
                        </div>
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
