@component('mail::message')
<u>Station Reservation</u>

{{ $reserver->name}} made a reservation
{{-- For the team of ....... --}}

Station: <b>{{ $station->stationName}} </b><br>
Date and Time: <b>{{explode(' ',$booking->start_date)[0]}} 
    ({{explode(' ',$booking->start_date)[1]}}-{{explode(' ',$booking->end_date)[1]}}) </b>

@component('mail::button', ['url' => route('frontend.stations.station', $station->id)])
    View Station
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
