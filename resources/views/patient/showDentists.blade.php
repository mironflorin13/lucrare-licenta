@extends('layouts.patient')
@section ('content')
    <div class="row justify-content-center w-100 " style="max-width:1400px;">

        @foreach($medici as $medic) 
            <div class="col-4 p-5" style="min-width: 20rem;">
                <div class="card" style="width: 100%;">
                    <img class="card-img-top" src="/storage/{{$medic->dentist_profiles->image}}" alt="Card image cap">
                    <div class="card-body">
                      <h5 class="card-title">Medic {{$medic->dentist_profiles->name}}</h5>
                      <p class="card-text" style="min-height:4rem;max-height:4rem;">{{$medic->dentist_profiles->description}}</p>
                      <a href="allD/{{$medic->id}}" class="btn btn-primary">View profile</a>
                    </div>
                  </div>
            </div>
        @endforeach
    </div>
@endsection
