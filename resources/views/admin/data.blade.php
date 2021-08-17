@if(count($data) > 0)
    @foreach($data as $val)
        <tr>
            <td>{{$val->assets}}</td>
            <td>{{$val->price}}</td>
            <td>{{$val->address}}</td>
            <td>
                <a class="btn btn-danger btn-sm delinced" del="{{$val->id}}" href="javascript:void(0)"><i class="fas fa-trash"></i></a>
            </td>
            <td>{{$val->created_at}}</td>
        </tr>
    @endforeach
@else
<tr>
    <td colspan="4">no record found</td>
</tr>
@endif