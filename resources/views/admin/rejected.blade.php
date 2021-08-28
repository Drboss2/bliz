@extends('user.layouts.app2')
@section('content')
@section('page-title','Admin')
@section('rejected-admin_trade','active')

 <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Failed Trades</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="/admin">Home</a></li>
              <li class="breadcrumb-item active">Trades</li>
            </ol>
          </div>
      </div>
    </div>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                           <div class="table-responsive">
                                <table class="table table-hover table-striped">
                                    <thead>
                                        <tr colspan='9'>
                                            <td>Rejected Trade </td>
                                        </tr>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Assets</th>
                                            <th scope="col">Assets Proof</th>
                                            <th scope="col">Type</th>
                                            <th scope="col">Amount</th>
                                            <th scope="col">Rate</th>
                                            <th scope="col">Expected amount</th>
                                            <th scope="col">Status</th>
                                            <th scope="col">Rejected By</th>
                                            <th scope="col">Rejected At</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                       @if(count($data) > 0)
                                            @foreach($data as $val)
                                                <tr>
                                                    <td>{{$val->order_id}}</td>
                                                    <td>{{$val->assets_name}}</td>
                                                    <td><img style="max-height:50px;" class='img-fluid' src="{{url('storage/images/'.$val->assets_image)}}"></td>
                                                    <td>{{$val->assets_type}}</td>
                                                    <td>${{$val->denomination}}</td>
                                                    <td>₦{{$val->price}}</td>
                                                    <td>₦{{number_format($val->expected_amount,2,'.',',')}}</td>
                                                    <td><a class='text-red' href="">{{$val->status}}</a></td>
                                                    <td>{{$val->admin}}</td>
                                                    <td>{{$val->updated_at}}</td>
                                                </tr>
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
                        </div>
                    </div>
                </div>
            </div>
    </section>
  </div>
   
</div>
<style>
    .table tr,th,td{
        font-size:14px;
        color:#32325d;
    }
</style>
@endsection