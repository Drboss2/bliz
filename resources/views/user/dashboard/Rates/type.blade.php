 @if(count($rate_type) > 0)
    <option disabled selected>Card Type</option>
    @foreach($rate_type as $rate)
        <option value="{{$rate->id}}">{{$rate->card_type}}</option>
    @endforeach
@endif