 @extends('user.layouts.app2')
 @section('content')
 @section('page-title','Blizexchange Dashboard')
 @section('active-mode','active')
 <div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Dashboard</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                       <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
                       <li class="breadcrumb-item active">Dashboard</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <section class="content">
        <div class="container-fluid">
            <!-- Small boxes (Stat box) -->
            <div class="col-lg-12">
                <a href="javascript:history.back()">Back</a>
                <hr>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <p style="color: rgb(94, 114, 228); margin-bottom: 0.5rem; font-family: inherit;font-weight: 600;line-height: 1.5;">Welcome   {{auth()->user()->name}},</p>
                    @if(!auth()->user()->kyc)
                        <p style="color: rgb(94, 114, 228); margin-bottom: 0.5rem; font-family: inherit;font-weight: 900;line-height: 1.5;"><a href="/kyc">Click Here for KYC Verification,</a></p>
                    @elseif(auth()->user()->kyc->status == "success")
                        <p class='bg-success p-2'>Your Kyc is Verified</p> 
                    @else
                            <p style="color: rgb(94, 114, 228); margin-bottom: 0.5rem; font-family: inherit;font-weight: 900;line-height: 1.5;"><a href="/kyc">Click Here for KYC Verification,</a></p>
                    @endif
                    <p class="alert alert-warning">Click <a href="/wallet">Here</a> to Wallet Activities</p>
                </div>
            </div>
            <div class="row mb-3">
                <div  class="col-lg-4 col-sm-4 col-4 text-center" >
                    <div id="click1" class='p-3 text-bold custom' style="border-radius:10px;font-size:16px;">
                        Naira  Wallet
                    </div>
                </div>
                <div  class="col-lg-4 col-sm-4 col-4 text-center">
                    <div id="click2" class='white p-3 text-bold custom'style="border-radius:10px;font-size:16px;">
                        Bitcoin  Wallet
                    </div>
                </div>
                <div  class="col-lg-4 col-sm-4 col-4 text-center">
                    <div id="click3"class='white p-3 text-bold custom' style="border-radius:10px;font-size:16px;">
                        Ethereum Wallet
                    </div>
                </div>
                <div class="col-lg-12 mt-3">
                    <div class="card">
                        <div id="pro1" class="card-body">
                          <button class="btn btn-primary btn-block text-center custom" style="border-radius:10px;font-size:16px;">View Naira Wallet Wallet</button>
                             <hr>
                            <span style="font-size:18px;font-weight:bolder">Balance:</span><span style="font-size:16px;font-weight:bolder;color:green">₦{{number_format(auth()->user()->wallet->amount, 1, '.', ',')}}</span>
                        </div>
                        <div id="pro2" class="card-body">
                          <button class="btn btn-primary btn-block text-center custom" style="border-radius:10px;font-size:16px;">Create Bitcoin Wallet</button>
                             <hr>

                                <!-- <span style="font-size:17px;font-weight:bolder">Address :</span><span style='style="font-size:17px;font-weight:bolder'> bc1qxy2kgdygjrsqtzq2n0yrf2493p83kkfjhx0wlh </span> <a href="javascript:void(0)"><span class="far fa-copy far-lg"></span></a><br>
                                <span style="font-size:17px;font-weight:bolder">Balance :</span>BTC<span style="font-size:17px;font-weight:bolder;color:green">0.000($0.00)</span> -->
                        </div>
                         <div id="pro3" class="card-body">
                          <button class="btn btn-primary btn-block text-center custom" style="border-radius:10px;font-size:16px;">Create Ethereum Wallet</button>
                             <hr>
                            <!-- <span style="font-size:17px;font-weight:bolder">Address :</span><span style='style="font-size:17px;font-weight:bolder'> bc1qxy2kgdygjrsqtzq2n0yrf2493p83kkfjhx0wlh </span> <a href="javascript:void(0)"><span class="far fa-copy far-lg"></span></a><br>
                            <span style="font-size:17px;font-weight:bolder">Balance :</span>BTC<span style="font-size:17px;font-weight:bolder;color:green">0.000($0.00)</span> -->
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                @if(count($crypto) > 0)
                    @foreach($crypto as $c)
                        <div class="col-lg-4 col-12">
                            <!-- small box -->
                            <div class="card">
                                <h4 class="card-header">{{$c->assets}}</h4>
                                <div class="card-body">
                                    <h5 class="text-center"><img style="max-height:70px;" class='img-fluid' src="{{url('storage/images/'.$c->image)}}"></h5>
                                    <div class="card-footer text-center" ><a class="btn btn-dark btns-sm btn-block" href="/crypto">Trade</a>
                                    </div>
                                </div>
                                <!-- <div class="icon">
                                    <i class="fas fa-wallet"></i>
                                </div> -->
                            </div>
                        </div>
                    @endforeach
                @endif
                <div class="col-lg-4 col-12">
                    <!-- small box -->
                    <div class="card">
                        <h4 class="card-header">Giftcards</h4>
                        <div class="card-body">
                            <h5 class="text-center"><img style="max-height:70px;" class='img-fluid' src="{{('assets/img/cards.svg')}}"></h5>
                            <div class="card-footer text-center" ><a class="btn btn-dark btns-sm btn-block" href="/giftcard">Trade</a>
                            </div>
                        </div>
                        <!-- <div class="icon">
                            <i class="fas fa-wallet"></i>
                        </div> -->
                    </div>
                </div>
            </div>
            @if(Session::has('gift_success'))
                <script>
                    Swal.fire({
                        title: 'Congrats !',
                        text: "{{Session::get('gift_success')}}",
                        icon: 'success',
                        timer: 3000, //timeOut for auto-close
                    })
                </script>
            @endif
            @if(Session::has('crypto_success'))
                <script>
                    Swal.fire({
                        title: 'Congrats !',
                        text: "{{Session::get('crypto_success')}}",
                        icon: 'success',
                        timer: 3000, //timeOut for auto-close
                    })
                </script>
            @endif
            <div class="row">
                <div class="col-lg-9">
                    <div style="padding:10px;" class="card bg-white">
                       <div class="card-body">
                            <p class="card-text text-bold">Trade History</p>
                                <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <th>#</th>
                                        <th>Order ID</th>
                                        <th>Type</th>
                                        <th>Amout</th>
                                        <th>Status</th>
                                        <th>Date</th>
                                    </thead>
                                    <tbody>
                                    @if(count($trade)> 0)
                                        @foreach($trade as $trades)
                                        <tr>
                                            <td>{{$trades->assets_name}}</td>
                                            <td>{{$trades->order_id}}</td>
                                            <td>{{$trades->assets_type}}</td>
                                            <td>₦{{number_format($trades->expected_amount, 2,'.',',')}}</td>
                                            @if($trades->status =='failed')
                                                 <td class='text-danger text-bold'>{{$trades->status}}</td>
                                            @elseif($trades->status =='paid')
                                                <td class='text-success text-bold'>{{$trades->status}}</td>
                                            @else
                                                <td class="text-primary text-bold">{{$trades->status}}</td>
                                            @endif
                                            <td>{{$trades->created_at}}</td>

                                        </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td colspan="4">no record found</td>
                                        </tr>
                                    @endif
                                       
                                    </tbody>
                                </table>
                                {!! $trade->links() !!}
                            </div>
                       </div>
                    </div>
                </div>
                <div class="col-lg-3"> 
                    <div class="row">
                        <div class="col-lg-12 col-6">
                            <div style="padding:10px;" class="small-box bg-info">
                                <div class="inner">
                                    <p>{{$pending}}</p>
                                    <p>Pending Transactions</p>
                                </div>
                                <div class="icon">
                                    <i class="fas fa-wallet"></i>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12 col-6">
                            <div style="padding:10px;" class="small-box bg-primary">
                                <div class="inner">
                                    <p>{{$paid}}</p>
                                    <p>Paid Transactions</p>
                                </div>
                                <div class="icon">
                                    <i class="fas fa-wallet"></i>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12 col-6">
                            <div style="padding:10px;" class="small-box bg-dark">
                                <div class="inner">
                                    <p>{{$fail}}</p>
                                    <p>Failed Transactions</p>
                                </div>
                                <div class="icon">
                                    <i class="fas fa-wallet"></i>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12 col-6">
                            <div style="padding:10px;" class="small-box bg-success">
                                <div class="inner">
                                    <p>{{$wallet_count}}</p>
                                    <p>Wallet Transactions</p>
                                </div>
                                <div class="icon">
                                    <i class="fas fa-wallet"></i>
                                </div>
                            </div>
                        </div>
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

<script>
    $(document).ready(function(){
        $("#pro2").hide()
        $("#pro3").hide()
        $("#click1").addClass("btn-primary");

        $("#click1").click(function(){
            $("#pro1").show();
            $("#pro2").hide()
            $("#pro3").hide()
            $("#click1").addClass("btn-primary");
            $("#click1").removeClass("white");

            $("#click2").removeClass("btn-primary");
            $("#click2").addClass("white");
            $("#click3").removeClass("btn-primary");
            $("#click3").addClass("white");
        })
        $("#click2").click(function(){
            $("#pro1").hide();
            $("#pro2").show()
            $("#pro3").hide()

            $("#click1").addClass("white");
            $("#click1").removeClass("btn-primary");

            $("#click2").addClass("btn-primary");
            $("#click2").removeClass("white");
            
            $("#click3").removeClass("btn-primary");
            $("#click3").addClass("white");
        })
        $("#click3").click(function(){
            $("#pro1").hide();
            $("#pro2").hide()
            $("#pro3").show()

            $("#click1").addClass("white");
            $("#click1").removeClass("btn-primary");

          
            
            $("#click2").removeClass("btn-primary");
            $("#click2").addClass("white");

            $("#click3").addClass("btn-primary");
            $("#click3").removeClass("white");
        })


        $(window).on('load',function(){
            $.get('https://api.coinbase.com/v2/prices/BTC-USD/spot',function(data,status){
                if(status === 'success'){
                    console.log(data)
                }
            })
            .fail(function(err){
                console.log(err)
            })
            
        })
    })




</script>
  @endsection  