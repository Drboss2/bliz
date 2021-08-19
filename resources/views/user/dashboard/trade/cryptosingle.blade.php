@extends('user.layouts.app2')
@section('content')
@section('page-title','Crypto trades')
@section('active-crypto','active')

 <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Crypto Details</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{route('user.dashboard')}}">Home</a></li>
              <li class="breadcrumb-item active">Crypto Details</li>
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
                <div class="col-lg-12">
                   <a href="javascript:history.back()">Back</a>
                   <p class='text-center' style='font-size:14px !important; margin-top:8px;font-weight: 900;line-height: 1.5;color: #32325d;margin-bottom:0;'>SELL {{$name}}</p>
                    <hr>
                </div>
                @if(count($data) > 0)
                    <div class="col-lg-5">
                        <div id="cards" class="clearfix cards">
                            <div class="text-center">
                                <h2 style="font-size:20px;" id="h">{{$name}}</h2> 
                            </div>
                        </div>
                        <div id="card_details" class='mb-3'>
                            @foreach($data as $coin)
                                <div class="clearfix card_details">
                                    <div class="float-left">
                                        <h2 cardtype="{{$coin->id}}" id="card-type">(<span>{{$coin->crypto_name}}</span>)</h2>
                                        (<small id="">{{$coin->min}}</small>-<small id="">{{$coin->max}}</small>)
                                        <small>₦{{$coin->rate}}</small>
                                        <input id="hidden_price" type="hidden" value="{{$coin->rate}}">
                                    </div>
                                    <div class="float-right"><button coinid="{{$coin->id}}" id="selectcoin" type="button" class='btn btn-primary'>Select</button></div>
                                </div>
                            @endforeach  
                        </div>
                    </div>
                    <div class="col-lg-7 mt-2" id="html">
                      <p id="planselect"  style='color:#32325d;' class='text-center text-bold mt-4'>SELECT A PLAN</p>
                        <div id="planselected" class="card">
                            <div class='card-header'>
                                <div><h2 class='text-primary float-left' id="coin_name"></h2></div>
                                <div class="float-right text-bold" id="rate"></div>
                            </div>
                            <div class="card-body">
                                <p style='color:#32325d;' class='text-center text-bold selectingplan'>SELECT A PLAN</p>
                                <div class="text-center text-bold range">Buying range(<span id="min"></span>-<span id="max"></span>)</div>
                                <form method="post" action="{{route('sell.crypto')}}" enctype="multipart/form-data" autocomplete="off">
                                    @csrf
                                    <div class="form row mt-4 mb-4">
                                        <legend>Step 1 of 4</legend>

                                        <div class="col-lg-12 mt-2 mb-2">
                                            <label>Amount</label>
                                            <input id="amount" name="amount" class="form-group form-control" type="text" placeholder='0 '>
                                            <span id="error"></span>
                                        </div>
                                        <div class="form-group col-lg-12">
                                            <label>Expected Returns</label>
                                            <input type="hidden" id="id" value="{{$id}}">
                                            <input type="text" id="total" class="form-control" placeholder='₦0' readonly>
                                            <input type="hidden" name="prices" id="prices">
                                            <input type="hidden" name="total_price"  id="total_price">
                                            <input type="hidden" name="coin_name"  id="coin_name" value="{{$name}}">
                                        </div>
                                        <input id="removeDisabled" type="button" class="btn btn-primary btn-sm mt-3 open1 " value="Next">
                                    </div>
                                    <fieldset>
                                        <div id="form-2" class="form">
                                            <legend>Step 2 of 4</legend>
                                            <h3>READ BEFORE YOU PROCEED WITH <BR>THE TRANSACTION</h3>
                                            <p>Expected Amount <span id="expe"></span></p>
                                            <p>Do not send below the require amount <span id="expeamount"></span></p>

                                            <button type="button" class='back2 btn btn-primary btn-sm'>Prev</button>
                                            <button type="button" class='open2 btn btn-dark btn-sm'>Next</button>
                                        </div>
                                    </fieldset>
                                    <fieldset>
                                        <div id="form-3" class="form"> 
                                            <legend>Step 3 of 4</legend>
                                            <p>Please transfer <span id="expeamounts"></span> worth of {{$name}} to the wallet address below.</p>
                                            <hr>
                                            <b><span style="font-weight:bold">Please make sure you transfer the exact amount to avoid payment delinced</span></b><br>

                                            <input style="color:blue;font-size:23px;width:80%;border:none;outline:none" id="copy" type="text" readonly>
                                            <a onclick="myFunction()"  href="javascript:void(0)"><span class="far fa-copy far-lg"></span></a>
                                            <br>
                                            <br>
                                            <button type="button" class='back3 btn btn-primary btn-sm'>Prev</button>
                                            <button type="button" class='open3 btn btn-dark btn-sm'>Next</button>

                                            <!-- <input id="crysub" type="submit" value="Sell Now" class='btn btn-primary btn-sm'> -->
                                        </div>
                                        <script>
                                        function myFunction() {
                                            var copyText = document.getElementById("copy");
                                                copyText.select();
                                                copyText.setSelectionRange(0, 99999)
                                                document.execCommand("copy");
                                                alert("Wallet address Copied: " + copyText.value);
                                            }
                                        </script>
                                    </fieldset>
                                    <fieldset>
                                        <div id="form-4" class="form">
                                            <legend>Step 4 of 4</legend>
                                            <p>If you have made payment to our <span id="paidwallet"></span> Wallet, upload a screenshot as your successful payment  proof</p>
                                            <div class="form-group">
                                                <label for=""></label>
                                                <input type="file" name="image" id="file" class='form-control'>
                                            </div>
                                            <input type="hidden" name="assets_name" id="assets_name">
                                            <p class='text-primary'>Do not process with this process if you have not made payment</p>
                                            <p class='text-danger'>In case you sent a different, amount send us a message Blizexchange will update accordingly.</p>

                                            <button type="button" class='back4 btn btn-primary btn-sm'>Prev</button>
                                            <button id="endfinished" type="submit" class='btn btn-dark btn-sm '>Finish</button>
                                        </div>
                                    </fieldset>
                                  </form>
                            </div>
                        </div> 
                    </div>
                @else
                     <div class="col-lg-12" style="padding-top:20px;">
                        <p class="text-center">Sorry this cryptocurrency is not avaliable for trade </p>
                    </div>
                     <div class="col-lg-12 text-center">
                       <a href="javascript:history.back()">Go Back</a>
                     </div>
                @endif
            </div>
        </div>
    </section>
</div>
<style>
    .cards{
        border:1px solid #f7fafc;
        padding:10px;
        background:white;
        box-shadow:  0 3px 10px rgba(0,0,0, 0.2);
        margin-bottom:9px; 
            
    }
    .cards img{
        max-height:70px !important;
        max-width:70px;
    }
    .card_details{
        border:1px solid #f7fafc;
        padding:10px;
        background:white;
        box-shadow:  0 3px 10px rgba(0,0,0, 0.2);
        margin-bottom:12px;
    }
    
    .card_details,.cards, h2, label,.range{
        font-size:14px !important;
        margin-top:8px;
        font-weight: 900;
        line-height: 1.5;
        color: #32325d;
        margin-bottom:0;
    }
    .row .img{
        padding-top:5px;
    }
    .row div img{
        width:100%; 
    }
    @media(max-width:767.98px){
        .row div img{
            width:100%;
        }
        .text-center{
            font-size:14px;
        }  
    }
</style>
<script>
   $(document).ready(function(){
        $("#removeDisabled").prop('disabled',true)
        $("#amount").prop('disabled',true)
        $(".range").hide();
        $("#planselected").hide();
        $(document).on('click','#selectcoin',function(e){
            let coin_id = $(this).attr('coinid');
            $("#planselect").hide()
            $("#planselected").show();

            $("#removeDisabled").prop('disabled',true)
            $("#amount").prop('disabled',false)
            $(".range").show();
            $.get('/crypto/'+coin_id, function(data, status, err){
                if(status == 'success'){
                    $("#min").html(data.data[0].min);
                    $("#max").html(data.data[0].max);
                    $("#rate").html('₦'+data.data[0].rate);
                    $("#prices").val(data.data[0].rate);
                    $("#amount").focus();
                    $("#coin_name").html(data.data[0].crypto_name);
                }    
            })  
        })
        let coinid = $('#id').val()
        $.get('/cryptos/'+coinid, function(data, status, err){
            $("#copy").val(data[0].address);   
        }) 
        $("#amount").keyup(function(){
            let number = $("#amount").val();
            let price  = $("#prices").val();
             
            if(number == "" ){
                $("#removeDisabled").prop('disabled',true);
            }else if(isNaN(number) === true){
        
                $("#error").html("<p class='text-danger'>enter valid number</p>")
                $("#removeDisabled").prop('disabled',true)

            }else if(number < parseInt($("#min").text())){

                $("#error").html("<p class='text-danger'>amount is below minimum</p>")
                $("#removeDisabled").prop('disabled',true)

            }else if(number > parseInt($("#max").text())){
                $("#error").html("<p class='text-danger'>amount is above maximum</p>")
                $("#removeDisabled").prop('disabled',true);
                // $("#error").html(''); 
                // $("#removeDisabled").prop('disabled',false
            }else{
                $("#error").html(''); 
                $("#removeDisabled").prop('disabled',false)
            }

            let total =  number * price;
            $("#total_price").val(total);
            $("#total").val("₦"+ thousands_separators(total));
            $("#expe").html("₦"+ thousands_separators(total));
            $("#expeamount").html('$'+number);
            $("#expeamounts").html("$"+number);
        })

        $("#endfinished").prop('disabled',true);

        $("#file").on('change',function(){
            $("#endfinished").prop('disabled',false);
        })
        function thousands_separators(num){
            var num_parts = num.toString().split(".");
            num_parts[0] = num_parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, ",");
            return num_parts.join(".");
        } 
        
        $("#form-4").hide();
        $("#form-3").hide();
        $("#form-2").hide();

        $(".open1").click(function() {
            $(".form").hide();
            $("#form-2").show();
        });
          $(".open2").click(function() {
                $(".form").hide();
                $("#form-3").show();
            });
        $(".open3").click(function() {
            $(".form").hide();
            $("#form-4").show();
        });
    
        $(".back2").click(function() {
            $(".form").show();
             $("#form-2").hide();
            $("#form-3").hide();
            $("#form-4").hide();

        });
        $(".back3").click(function() {
            $(".form").hide();
            $("#form-2").show();
        });
        $(".back4").click(function() {
            $(".form").hide();
            $("#form-3").show();
        })
   })
</script>
@endsection
 