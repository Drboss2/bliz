<div class="table-responsive">
    <table class="table">
        <thead>
            <th>#</th>
            <th>Transactions ID</th>
            <th>Type</th>
            <th>Amout</th>
            <th>Status</th>
            <th>Date</th>
        </thead>
        <tbody>
            @if(count($data) > 0)
                @foreach($data as $val)
                    @if($val->type === "wallet")
                        <tr>
                            <td>{{$val->type}}</td>
                            <td>{{$val->order_id}}</td>
                            <td>{{$val->reason}}</td>
                            <td>₦{{number_format($val->amount,2,'.',',')}}</td>
                            @if($val->status =='pending')
                                <td class='text-danger text-bold'>{{$val->status}}</td>
                            @else
                                <td class="text-primary text-bold">{{$val->status}}</td>
                            @endif
                            <td>{{$val->created_at}}</td>
                        </tr>
                    @endif
                @endforeach
            @else

             <tr>
                <td colspan="4">no record found</td>
            </tr>

            @endif
        </tbody>
    </table>
    {!! $data->links() !!}
</div>
 