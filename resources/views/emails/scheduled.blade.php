@component('mail::message')
# Introduction

You were successfully scheduled on {{$data['date']}} at {{$data['time']}} o'clock .

Thanks,<br>
{{ config('app.name') }}
@endcomponent
