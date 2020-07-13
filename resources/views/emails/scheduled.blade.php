@component('mail::message')
# Introduction
It is a confirmation email.

You were successfully scheduled on {{$data['date']}} at {{$data['time']}} o'clock .
Dentist: {{$data['name']}}.<br>
City: {{$data['location']}}.<br>
Address: {{$data['address']}}.<br>

Thanks,<br>
{{ config('app.name') }}
@endcomponent
