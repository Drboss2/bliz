@extends('user.layouts.app2')
@section('content')
@section('active-wallet','active')
 <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Confirm Withdrawal</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{route('user.dashboard')}}">Home</a></li>
              <li class="breadcrumb-item active">Confirm Withdrawal</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- Small boxes (Stat box) -->
            <div class="row">
                <div class="col-lg-7 mx-auto">
                    <div class="card" style="margin-top:40px;">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped">
                                   <tr style='text-align:center'>
                                        <td colspan='5' class='active'></h1>Confirm Your Withdrawal</h1></td>
                                    </tr>
                                    <form method="post" action="{{route('paywith')}}">
                                    @csrf
                                        <tr>
                                            <td style='font-weight:bold'>Bank Name</td>
                                            <td>{{$bank}}</td>
                                        </tr>
                                        <tr>
                                            <td style='font-weight:bold'>User Email</td>
                                            <td>{{auth()->user()->email}}</td>
                                        </tr>
                                        <tr>
                                            <td style='font-weight:bold'>Bank Account</td>
                                            <td>{{$account_name}}</td>
                                        </tr>
                                        <tr>
                                            <td style='font-weight:bold'>Bank Account No</td>
                                            <td>{{$account_no}}</td>
                                        </tr>
                                        <tr>
                                            <td style='font-weight:bold'>Amount</td>
                                            <td>NGN {{number_format($a)}}</td>
                                        </tr>
                                        <tr>
                                            <td colspan='6'>
                                                <div>
                                                    <input value='Withdraw' type='submit' class='btn btn-dark' name='Withdraw'>
                                                    <a href="javascript:history.back()" class='btn btn-danger'>Back</a>
                                                </div>
                                            </td>
                                        </tr>
                                    </form>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
 