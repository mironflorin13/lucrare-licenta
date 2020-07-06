
@extends('layouts.dentist')
@section('content')
<div <?php if ($reviews_nr==0){?>style="display:none"<?php } ?>>
    <div class="card ">
        <div class="card-header">
      
                Reviews 

        </div>
        <div class="card-body " > 
            <table id="table_t" class=" table text-center display ">
                @foreach ($reviews as $rev)
                <tr class="table_tr">
                    <td class="table_td">
                        <div class="div_circle">{{substr($rev->patient_name,0,2)}}</div>
                        <div class="div_name_date">
                            <div class="div_name"> {{$rev->patient_name}}</div>
                            <div class="div_date"> {{date('Y-m-d', strtotime($rev->created_at))}}</div>
                        </div>
                    </td>
                    <td class="td_review">{{$rev->review}}</td>
                </tr>
            @endforeach
            </table>
            
        </div>
    </div>
</div>
<div <?php if ($reviews_nr!=0){?>style="display:none"<?php } ?>>
    <div class="card ">
        <div class="card-header"> 
                Reviews 
        </div>
        <div class="card-body " > 
            You do not have any review!    
        </div>
    </div>
</div>


@endsection