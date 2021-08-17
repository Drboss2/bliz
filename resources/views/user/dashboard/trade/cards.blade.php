@extends('user.layouts.app2')
@section('content')
@section('page-title','GiftCard trades')
@section('active-gift','active')

 <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Giftcard Details</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{route('user.dashboard')}}">Home</a></li>
              <li class="breadcrumb-item active">Giftcard Details</li>
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
                   <p class='text-center' style='font-size:14px !important; margin-top:8px;font-weight: 900;line-height: 1.5;color: #32325d;margin-bottom:0;'>SELL GIFTCARD</p>
                    <hr>
                </div>
                @if(count($data) > 0)
                    <div class="col-lg-5">
                        <div id="cards" class="clearfix cards">
                            <div class="float-left">
                                <img id="img" src="{{url('storage/images/'.$data[0]->image)}}" alt="">
                            </div>
                            <div class="float-right">
                                <h2 style="font-size:20px;" id="h">{{$name}}</h2> 
                            </div>
                        </div>
                        <div id="card_details" class='mb-3'>
                            @foreach($data as $card)
                                <div class="clearfix card_details">
                                    <div class="float-left">
                                        <h2 cardtype="{{$card->id}}" id="card-type">{{$card->card_country}}(<span>{{$card->card_type}}</span>)</h2>
                                        (<small id="">{{$card->buying_min}}</small>-<small id="">{{$card->buying_max}}</small>)
                                        <small>₦{{$card->price}}</small>
                                        <input id="hidden_price" type="hidden" value="{{$card->price}}">
                                    </div>
                                    <div class="float-right"><button cardid="{{$card->id}}" id="selectcard" type="button" class='btn btn-primary'>Select</button></div>
                                </div>
                            @endforeach  
                        </div>
                    </div>
                    <div class="col-lg-7 mt-2" id="html">
                        <div class="card">
                            <div class='card-header'>
                                <div><h2 class='text-primary float-left' id="card_name"></h2></div>
                                <div class="float-right text-bold" id="price"></div>
                            </div>
                            <div class="card-body">
                                <p style='color:#32325d;' class='text-center text-bold selectingplan'>SELECT A PLAN</p>
                                <div class="text-center text-bold range">Buying range(<span id="min"></span>-<span id="max"></span>)</div>
                                <form method="post" action="{{route('sellgift')}}" autocomplete="off">
                                @csrf
                                    <div class="row mt-4 mb-4">
                                        <div class="col-lg-12 mt-4 mb-4">
                                            <label>Amount</label>
                                            <input id="amount" name="amount" class="form-group form-control" type="text" placeholder='0'>
                                        </div>
                                        <div class="form-group col-lg-12">
                                            <label>Expected Returns</label>
                                            <input type="text"   id="total" class="form-control" placeholder='₦0' readonly>
                                            <input type="hidden" name="prices" id="prices">
                                            <input type="hidden" name="total_price"  id="total_price">
                                            <input type="hidden" name="card_name"    id="card_name" value="{{$name}}">
                                            <input type="hidden" name="card_type"    id="card_type">
                                        </div>
                                    </div>
                                    <hr>
                                    <input id="removeDisabled" type="submit" class="btn btn-primary btn-block mt-3" value="Sell">
                                </form>
                            </div>
                        </div>
                    </div>
                @else
                     <div class="col-lg-12" style="padding-top:20px;">
                        <p class="text-center">Sorry this giftcard is not avaliable for trade </p>
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

        $(document).on('click','#selectcard',function(e){
            let car_id = $(this).attr('cardid');
            $(".selectingplan").hide()

            $("#removeDisabled").prop('disabled',true)
            $("#amount").prop('disabled',false)
            $(".range").show();
            $.get('/giftcard/'+car_id, function(data, status, err){
                if(status == 'success'){
                    $("#min").html(data[0].buying_min);
                    $("#max").html(data[0].buying_max);
                    $("#price").html('₦'+data[0].price);
                    $("#prices").val(data[0].price);
                    $("#amount").focus();
                    $("#card_name").html(data[0].card_type);
                    $("#card_type").val(data[0].card_type);
                }    
            })  
        })
         $("#amount").keyup(function(){
            let number = $("#amount").val();
            let price  = $("#hidden_price").val();
            if(number == "" ){
                $("#removeDisabled").prop('disabled',true)
            }else{
                $("#removeDisabled").prop('disabled',false)
            }
            let total =  number * price;
            $("#total_price").val(total);
            $("#total").val("₦"+ thousands_separators(total));
        })
        
        $("#removeDisabled").on('click',function(e){
            let number     = $("#amount").val();
            $("#removeDisabled").val('Loading....')
            if(number == ''){
                alert('enter amount');
                $("#amount").focus()
                return false
            }
        })

        function thousands_separators(num){
            var num_parts = num.toString().split(".");
            num_parts[0] = num_parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, ",");
            return num_parts.join(".");
        }
       
   })
</script>
@endsection
 