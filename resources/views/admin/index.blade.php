@extends('user.layouts.app2')
@section('content')
@section('page-title','Admin')
@section('active-mode','active')

 <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Admin</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="/admin">Home</a></li>
              <li class="breadcrumb-item active">admin</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
            @if($pending > 0)
                <div class="col-lg-12">
                    <div class="alert alert-danger alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                        <strong>Attention!!</strong> You have {{$pending}} Pending Trades Request to attend to, Click <a  href="{{route('admin.trade')}}">here</a> now
                    </div>
                </div>
            @endif
             @if($pending_withdrawal  > 0)
                <div class="col-lg-12">
                    <div class="alert alert-primary alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                        <strong>Attention!!</strong> You have {{$pending_withdrawal }} Withdrawal Request to attend to, Click <a  href="/admin/withdraw">here</a> now
                    </div>
                </div>
            @endif
                <div class="col-lg-3 col-sm-6 col-md-6  col-12">
                    <!-- small box -->
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3>{{$pending}}</h3>
                            <p>Pending trades</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-bag"></i>
                        </div>
                        <a href="{{route('admin.trade')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                 <div class="col-lg-3 col-sm-6 col-md-6 col-12">
                    <!-- small box -->
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3>{{$paid}}</h3>
                            <p>Paid Trades</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-bag"></i>
                        </div>
                        <a href="/admin/trade/paid" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                 <div class="col-lg-3 col-sm-6 col-md-6 col-12">
                    <!-- small box -->
                    <div class="small-box text-light" style="background:grey">
                        <div class="inner">
                            <h3>{{$fail}}</h3>
                            <p>Failed/Rejected Trades</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-bag"></i>
                        </div>
                        <a href="/admin/trade/failed" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                 <div class="col-lg-3 col-sm-6 col-md-6  col-12">
                    <!-- small box -->
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3>{{$giftcard}}</h3>
                            <p>Total Giftcard Assets </p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-bag"></i>
                        </div>
                        <a href="/admin/gift" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6 col-md-6 col-12">
                    <!-- small box -->
                    <div style="background:purple" class="small-box text-light">
                        <div class="inner">
                            <h3>{{$crypto}}</h3>
                            <p>Total Crypto Assets </p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-bag"></i>
                        </div>
                        <a href="/admin/crypto" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                  <div class="col-lg-3 col-sm-6 col-md-6 col-12">
                    <!-- small box -->
                    <div style="background:pink" class="small-box text-light">
                        <div class="inner">
                            <h3>{{$paid_withdrawal}}</h3>
                            <p>Paid Withdrawal Request</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-bag"></i>
                        </div>
                        <a href="/admin/withdraw/paid" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6 col-md-6 col-12">
                    <!-- small box -->
                    <div style="background:green" class="small-box text-light">
                        <div class="inner">
                            <h3>{{$bank}}</h3>
                            <p>Total Banks</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-bag"></i>
                        </div>
                        <a href="/admin/bank" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6 col-md-6 col-12">
                    <!-- small box -->
                    <div style="background:black" class="small-box text-light">
                        <div class="inner">
                            <h3>{{$pending_withdrawal}}</h3>
                            <p>Withdrawal Request</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-bag"></i>
                        </div>
                        <a href="/admin/withdraw" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                @if(auth()->user()->isadmin== 2)
                <div class="col-lg-3 col-sm-6 col-md-6 col-12">
                    <!-- small box -->
                    <div class="small-box bg-success">
                    <div class="inner">
                        <h3>{{$admin}}</h3>

                        <p>Admin</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-stats-bars"></i>
                    </div>
                    <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
               
                <div class="col-lg-3 col-sm-6 col-md-6  col-12">
                    <!-- small box -->
                    <div class="small-box bg-warning">
                    <div class="inner">
                        <h3>{{$user}}</h3>
                        <p>Users</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-person-add"></i>
                    </div>
                    <a href="/admin/user" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6 col-md-6  col-12">
                    <!-- small box -->
                    <div class="small-box bg-danger">
                    <div class="inner">
                        <h3>₦{{number_format($total_wallet_balance,2,'.',',')}}</h3>

                        <p>User wallet Balance</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-pie-graph"></i>
                    </div>
                    <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                 @endif
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
    .inner h3{
        font-size:15px !important;
    }
</style>

@endsection