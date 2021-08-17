@component('mail::message')
# Welcome to Blizexchange

Dear {{$name}} ,Welcome to Blizexchange! We look forward to working with you.
<br>
<br>
Thank you for choosing Blizexchange

<br>
Thanks,
{{ config('app.name') }}
@endcomponent
