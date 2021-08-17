@extends('user.layouts.app2')
@section('content')
@section('page-title','Rates | Blizexhange')
@section('active-rates','active')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">My Rates area</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{route('user.dashboard')}}">Home</a></li>
              <li class="breadcrumb-item active">My Rates</li>
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
                    <div class="row">
                        <div class="col-lg-7 col-12 mx-auto">
                            <div style="padding:20px 20px;" class="small-box bg-light">
                                <ul class="nav nav-tabs text-center" style="padding:10px;">
                                    <li style="padding:10px;" class="active"><a id="tab1" href="javascript:void(0)">GIFTCARDS</a></li>
                                    <li style="padding:10px;"><a id="tab2" href="javascript:void(0)">CRYPTO</a></li>
                                </ul>
                                <div id="giftcards" class="inner">
                                    <form autocomplete="off">
                                        <div class="form-group">
                                            <select name="asset" id="asset" class="form-control">
                                                <option disabled selected>Select Assets</option>
                                                @if(count($rates) > 0)
                                                    @foreach($rates as $rate)
                                                        @if($rate->country != 'nill')
                                                            <option value="{{$rate->id}}">{{$rate->giftcard}}</option>
                                                        @endif
                                                    @endforeach
                                                @endif
                                            </select>
                                        </div>
                            
                                        <div class="form-group">
                                                <select name="asset_type" id="asset_type" class="form-control">
                                                <option disabled selected>Card Type</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <input type="text" class="form-control" name="amount" id="amount" placeholder="amount in usd"> 
                                            <input type="hidden" id="hidden_amount"> 
                                        </div>
                                    </form>
                                    <div class="icon">
                                        <i class="ion ion-stats-bars"></i>
                                    </div>
                                    <hr>
                                    <p><span class="font-weight-bolder">Rates</span> :<span id="span">₦0.00</span>/USD</p>
                                    <p> <span class="text-bold">PayOuts</span> :<span id="spanamount">₦0.00</span></p>
                                    <div class="d-flex flex-row-reverse">
                                        <button id="loading" class="btn btn-dark btn-block" disabled>
                                        Trade
                                        </button>
                                    </div>
                                </div>
                                <div id="bitcoin" class="inner">
                                    <form autocomplete="off">
                                        <div class="form-group">
                                            <select name="crypto_asset" id="crypto_asset" class="form-control">
                                                <option disabled selected>Select Crypto Assets</option>
                                                @if(count($crypto ) > 0)
                                                    @foreach($crypto  as $rate)
                                                        <option value="{{$rate->id}}">{{$rate->assets}}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <input type="text" class="form-control" name="amountbtc" id="amountbtc" placeholder="amount in usd"> 
                                            <input type="hidden" id="hidden_amountbtc"> 
                                        </div>
                                    </form>
                                    <div class="icon">
                                        <i class="ion ion-stats-bars"></i>
                                    </div>
                                    <hr>
                                    <p><span class="font-weight-bolder">Rates</span> :<span id="spanbtc">₦0.00</span>/USD</p>
                                    <p> <span class="text-bold">PayOuts</span> :<span id="spanamountbtc">₦0.00</span></p>
                                    <div class="d-flex flex-row-reverse">
                                        <button id="loadingbtc" class="btn btn-dark btn-block" type="button" disabled>
                                        Trade
                                        </button>
                                    </div>
                                </div>
                          </div>
                    </div>
                </div>
            </div>
           
        </div>
    </section>
  </div>

   <script>
    $(document).ready(function(){ // for giftcard rates
        $("#loading").on('click',function(){
            location.href="{{route('giftcard')}}";
        })
        $("#loadingbtc").on('click',function(){
            location.href="/crypto";
        })
        $("#asset").on('change',function(){
            let id   = $("#asset").val();
            $.get('gettype/'+id, function(data, status){
                $("#asset_type").html(data)
            })
        })

        $("#asset_country").on('change',function(){
            let country   = $("#asset_country").val();
            $.get('gettype/'+country, function(data, status){
                $("#asset_type").html(data)
            });
        })

        $("#asset_type").on('change',function(){
            let id   = $("#asset_type").val();
            $.get('/getamount/'+id, function(data, status){
                $('#span').text("₦ "+ data[0].price);
                $("#hidden_amount").val(data[0].price);
                $("#loading").removeAttr('disabled'); 
            });
        })

        $("#amount").on('keyup',function(e){
            let amount = $("#amount").val()
            let hidden_amount = $("#hidden_amount").val();

            let spanamount = amount * hidden_amount;
            $('#spanamount').text("₦ "+thousands_separators(spanamount));
        }) 

        /// for crypto rates
         $("#crypto_asset").on('change',function(){
            let id   = $("#crypto_asset").val();
            $.get('/getcamount/'+id, function(data, status){
                $('#spanbtc').text("₦ "+ 500);
                $("#hidden_amountbtc").val(500);
                $("#loadingbtc").removeAttr('disabled');
            });
        })

        $("#amountbtc").on('keyup',function(e){
            let amount = $("#amountbtc").val()
            let hidden_amount = $("#hidden_amountbtc").val();

            let spanamount = amount * hidden_amount;

            $('#spanamountbtc').text("₦ "+thousands_separators(spanamount));
        }) 

        function thousands_separators(num){
            var num_parts = num.toString().split(".");
            num_parts[0] = num_parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, ",");
            return num_parts.join(".");
        }
    })


    let giftcard = document.getElementById('tab1');
    let bitcoin = document.getElementById('tab2');


    window.addEventListener('load',()=>{
        document.getElementById('bitcoin').style.display='none'
    })
    giftcard.addEventListener('click',()=>{
        document.getElementById('giftcards').style.display='block'
        document.getElementById('bitcoin').style.display='none'

    })
    bitcoin.addEventListener('click',()=>{
        document.getElementById('bitcoin').style.display='block'
        document.getElementById('giftcards').style.display='none'
    })

   </script>
</div>
@endsection
