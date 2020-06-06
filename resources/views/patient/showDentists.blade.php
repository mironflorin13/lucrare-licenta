@extends('layouts.patient')
@section ('content')
    <div class="row justify-content-center w-100 " id="row">
        @foreach($medici as $medic) 
            <div class="col-4 dentistCard">
                <div class="card text-center">
                    <div class="overflow">
                        <img class="card-img-top" src="/storage/{{$medic->dentist_profiles->image}}" alt="Card image">  
                    </div>
                    <div class="card-body text-dark">                     
                        <h3 class="card-title">{{$medic->dentist_profiles->name}}</h3>
                        <p class="card-text">{{$medic->dentist_profiles->description}}</p>
                        <a href="allD/{{$medic->id}}" class="btn btn-outline-success">View profile</a>
                    </div>
                  </div>
            </div>
        @endforeach
    </div>
@endsection
