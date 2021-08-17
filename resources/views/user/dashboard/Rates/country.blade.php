<option disabled selected>Select Country</option>
@foreach($rate_country as $rate)
    <option value="{{$rate->country}}">{{$rate->country}}</option>
@endforeach
