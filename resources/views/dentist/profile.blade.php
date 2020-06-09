@extends('layouts.dentist')

@section('content')

    {{-- <div class="row pt-4">
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
    </div> --}}
<div class="card-content">
    <div class="card-post">
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
                    <span>{{$user->dentist_profiles->schedule_sat}}</span>   
                    <span>{{$user->dentist_profiles->schedule_sun}}</span>   
                </div>
            </div>
            
            <a href="/dentist/profile/{{$user->id}}/edit" class="card-post__btn">Edit Profile</a>
        </div>
    </div>
</div>


@endsection
