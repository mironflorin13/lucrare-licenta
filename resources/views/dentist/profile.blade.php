@extends('layouts.dentist')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-3">
            <img src="/storage/{{$user->dentist_profiles->image}}" alt="Imagine Profil" class="w-100">
        </div>
        <div class="col-9">
            <div>Nume: {{$user->name}}</div>
            
            <div>Locatie:{{$user->dentist_profiles->location}}</div>
            <div>Adresa:{{$user->dentist_profiles->address}}</div>
            <div>Descriere:{{$user->dentist_profiles->description}}</div>
            <a href="/profile/{{$user->id}}/edit">Edit Profile</a>

        </div>
    </div>
</div>
@endsection
