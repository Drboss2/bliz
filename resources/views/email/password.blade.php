@component('mail::message')
# Change Your Password

Dear {{$name['m']}}
<br>
@component('mail::button', ['url' => route('pass.change',$email)])
Change Password
@endcomponent

<br>

Thank you for choosing Blizexchange

<br>
Thanks,
{{ config('app.name') }}
@endcomponent
