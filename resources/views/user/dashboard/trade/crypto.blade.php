@extends('user.layouts.app2')
@section('content')
@section('page-title','Blizexchange Dashboard')
@section('active-crypto','active')

 <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h3 class="m-0">Crypto</h3>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
                        <li class="breadcrumb-item active">Crypto Assets</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
     <section class="content">
        <div class="container-fluid">
            <!-- Small boxes (Stat box) -->
                <div class="col-lg-12"> 
                    <div class="row">
                        <div class="col-lg-12">
                            <a href="javascript:history.back()">Back</a>

                            <div class="small-box card" style="border:1px solid #f7fafc;">
                                <div class="card-body">
                                   <p class='text-center text-bold text-primary'>SELL CRYPTOCURRENCY</p>
                                    <hr>
                                    <div class="row">
                                        @if(count($data) > 0)
                                            @foreach($data as $coin)
                                                <div class="col-lg-4">
                                                    <div id="cards" class="clearfix cards">
                                                        <div class="row">
                                                            <div class="col-lg-4 col-md-4 col-sm-4 col-4">
                                                                <div class="float-left">
                                                                    <img id="img" src="{{url('storage/images/'.$coin->image)}}" alt="">
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-4 col-md-4 col-sm-4 col-4">
                                                                <div>{{$coin->assets}}</div>
                                                            </div>
                                                            <div class="col-lg-4 col-md-4 col-sm-4 col-4">
                                                                <div class="float-right">
                                                                <a cardid="{{$coin->id}}" id="selectcard" href="/crypto/{{$coin->id}}/{{$coin->assets}}" class='btn btn-primary btn-sm'>Select
                                                                </a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach  
                                        @endif
                                   </div>
                                </div>
                                <div class="icon">
                                    <i class="fab fa-bitcoin"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
             </div>
        </div>
        <style>
            .cards{
                border:1px solid #f7fafc;
                padding:10px;
                background:white;
                box-shadow:  0 3px 10px rgba(0,0,0, 0.2);
                margin-bottom:9px; 
                 
            }
            .card img{
                height:45px !important;
                max-width:50px;
            }
            .card_details{
                border:1px solid #f7fafc;
                padding:10px;
                background:white;
                box-shadow:  0 3px 10px rgba(0,0,0, 0.2);
                margin-bottom:9px;
            }
          
             .card_details,.cards, h2{
                 font-size:14px !important;
                 margin-top:8px;
                 font-weight: 600;
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
            @media (max-width: 767.98px){
              .row div img{
                  width:100%;
               }  
            }
        </style>
    </section>
</div>
<style>
 /* label,.range,span,b{
    font-size:14px !important;
    margin-top:8px;
    font-weight: 900;
    line-height: 1.5;
    color: #32325d;
    margin-bottom:0;
    } */
    .fab,.far{
        font-size:24px !important
    }
    h1,legend{
       font-size:18px;  
    }
    legend{
      border-bottom:1px solid lightgrey; 
      margin-bottom:40px; 
    }
    select,option{
        font-size:15px !important;
    
    }
    @media(max-width:700px){
        h1,h3,p,b{
            font-size:14px;
        }
    }
</style>
<script>
 $(function(){
    $("#amount").prop('disabled',true)
    $("#final_amount").prop('disabled',true)
    $("#next").prop('disabled',true)
    $("#endfinished").prop('disabled',true)

    $('#asset').on('change',function(){
        let id = $("#asset").val();
        $.get('/crypto/'+id,function(data){
            $("#hidden_amount").val(data.data[0].price);
            $("#spanbtc").html('₦'+data.data[0].price);
            $("#amount").prop('disabled',false);
            $("#final_amount").prop('disabled',false)
            $("#assets").text(data.data[0].assets);
            $("#as").text(data.data[0].assets);
            $("#paidwallet").text(data.data[0].assets);
            $("#assets_name").val(data.data[0].assets);
            $("#copy").val(data.data[0].address)
        })
    })
    $("#amount").on('keyup',function(){
         let amount = $("#amount").val();
         let hidden_amount = $("#hidden_amount").val();
         if(amount >= 50){
            $("#next").prop('disabled',false)
            let total = amount*hidden_amount;
            $("#spanamountbtc").text('₦'+thousands_separators(total));
            $("#final_amount").val('₦'+thousands_separators(total));
            $("#expe").text('₦'+thousands_separators(total));
            $("#total_hidden_amount").val(total);
            $("#expeamount").text("$"+amount);
            $("#expeamounts").text("$"+amount);
        }else{
            return false;
        }
    })

    $("#file").on('change',function(){
        $("#endfinished").prop('disabled',false)
    })

    $("#loginloading").hide();
    $("#endfinished").click(function(){
        let file = $("#file").val();
        $("#loginloading").show();
        $("#endfinished").hide();
        if(file === ""){
            alert('Please enter image proof');
            $("#file").focus();
            return false;
        }
    })

    $("#form-4").hide();
    $("#form-3").hide();
    $("#form-2").hide();

    $(".open1").click(function() {
        $(".form").hide("fast");
        $("#form-2").show("slow");
   });
   $(".open2").click(function() {
        $(".form").hide("fast");
        $("#form-3").show("slow");
    });
    $(".open3").click(function() {
        $(".form").hide("fast");
        $("#form-4").show("slow");
    });
     
   
    $(".back2").click(function() {
      $(".form").hide("fast");
      $("#form-1").show("slow");
    });
    $(".back3").click(function() {
      $(".form").hide("fast");
      $("#form-2").show("slow");
    });
     $(".back4").click(function() {
      $(".form").hide("fast");
      $("#form-3").show("slow");
    })

    function thousands_separators(num){
        var num_parts = num.toString().split(".");
        num_parts[0] = num_parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, ",");
        return num_parts.join(".");
    }

 })
</script>
@endsection