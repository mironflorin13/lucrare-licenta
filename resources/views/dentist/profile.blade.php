@extends('layouts.dentist')

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

            <a href="/dentist/profile/{{$user->id}}/edit" class="btn btn-info">Edit Profile</a>
            

        </div>
    </div>
</div>
@endsection
