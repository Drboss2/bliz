@component('mail::message')
# Thank you for Registering on Blizexchange! 

{{$name}}
<br>

@component('mail::button', ['url' => route('user.isverified')])
Activate
@endcomponent

<br>

Thank you for choosing Blizexchange

<br>

Happy Trading,

{{ config('app.name') }}
@endcomponent
