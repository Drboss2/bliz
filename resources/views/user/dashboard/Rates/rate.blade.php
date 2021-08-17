 @if(count($rates) > 0)
    @foreach($rates as $rate)
        <option value="{{$rate->id}}">{{$rate->giftcard}}</option>
    @endforeach
@endif