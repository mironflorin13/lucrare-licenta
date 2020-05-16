@extends('layouts.patient')

@section('content')
<div class="container">
    <div class="row pt-4">
        <div class="col-4 " style='min-width:300px;'>
            <img src="/storage/{{$user->dentist_profiles->image}}" alt="Imagine Profil" class="w-100" >
        </div>
        <div class="col-8" >
            <div class='p-1'><h1>{{$user->dentist_profiles->name}}</h1></div>
            
            <div class='p-1' ><h2 class='d-inline'><b>City: </b></h2><h3 class='d-inline'>{{$user->dentist_profiles->location}}</h3></div>
            <div class='p-1'><h4 class='d-inline'><b>Address: </b></h4><h5 class='d-inline'>{{$user->dentist_profiles->address}}</h5></div>
            <div class='p-1'><h4 class='d-inline'><b>Phone Number: </b></h4><h5 class='d-inline'>{{$user->dentist_profiles->phone}}</h5></div>
            <div class='p-1'><h5 class='d-inline'><b>Description: </b></h5><h5 class='d-inline'>{{$user->dentist_profiles->description}}</h5></div>
            <div class='p-1'><h6 class='d-inline'><b>Schedule Monday to Friday: </b></h6><h5 class='d-inline'>{{$user->dentist_profiles->schedule_m_f}}</h5></div>
            <div class='p-1'><h6 class='d-inline'><b>Schedule Saturay:</b></h6><h5 class='d-inline'>{{$user->dentist_profiles->schedule_sat}}</h5></div>
            <div class='p-1'><h6 class='d-inline'><b>Schedule Sunday: </b></h6><h5 class='d-inline'>{{$user->dentist_profiles->schedule_sun}}</h5></div>
        </div>
    </div>
    <div class="card mt-5">
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
    
                @foreach ($services as $value)
                    <tr class="post{{$value->id}}">
                        <th width="10">-</th>
                        <th>{{$value->servicename}}</th>
                        <th>{{$value->price}} lei</th>
                    </tr>
                @endforeach
            </table>
        </div>
    </div>
</div>
@endsection
