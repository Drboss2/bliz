@component('mail::message')
# login to Blizexchange

Dear {{auth()->user()->name}} You just login to blizexchange,
<br>
<br>
Thank you for choosing Blizexchange as your as best Giftcards and Bitcoin exchange

Thanks in Regards,
<br>
{{ config('app.name') }}
@endcomponent
