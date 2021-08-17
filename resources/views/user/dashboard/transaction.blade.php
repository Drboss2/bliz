@extends('user.layouts.app2')
@section('content')
@section('active-trans','active')
 <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">My transactions area</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{route('user.dashboard')}}">Home</a></li>
              <li class="breadcrumb-item active">My transactions</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="col-lg-12">
                <a href="javascript:history.back()">Back</a>
                <hr>
            </div>
            <!-- Small boxes (Stat box) -->
            <div class="row">
                <div class="col-lg-12">
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
                                        <tr>
                                            <td>{{$val->type}}</td>
                                            <td>{{$val->order_id}}</td>
                                            <td>{{$val->reason}}</td>
                                            <td>₦{{number_format($val->amount,2,'.',',')}}</td>
                                            <td>{{$val->status}}</td>
                                            <td>{{$val->created_at}}</td>
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
    </section>
</div>
<style>
    .table tr,th,td{
        font-size:14px;
        color:#32325d;
    }
</style>
@endsection
 