@extends('layouts.patient')
@section ('content')
    @foreach ($doct as $item)
        <div style="margin-left:30px;">{{$item}}</div>
    @endforeach
@endsection
