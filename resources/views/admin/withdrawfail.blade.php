@extends('user.layouts.app2')
@section('content')
@section('page-title','Admin')
@section('with-admin_trade_fails','active')

 <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Declined Withdrawal</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="/admin">Home</a></li>
              <li class="breadcrumb-item active">Declined Withdrawal</li>
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
                                            <td>Declined Withdrawal Request</td>
                                        </tr>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th>Phone no</th>
                                            <th scope="col">Bank</th>
                                            <th scope="col">Acc no</th>
                                            <th scope="col">Acc name</th>
                                            <th scope="col">Amount</th>
                                            <th scope="col">Status</th>
                                            <th scope="col">Declined At</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                       @if(count($data) > 0)
                                            @foreach($data as $val)
                                                <tr>
                                                    <td>{{$val->trans_id}}</td>
                                                    <td>1312322</td>
                                                    <td>{{$val->bank}}</td>
                                                    <td>{{$val->account_no}}</td>
                                                    <td>{{$val->account_name}}</td>
                                                    <td>₦{{number_format($val->amount,2,'.',',')}}</td>
                                                    <td>{{$val->status}}</td>
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