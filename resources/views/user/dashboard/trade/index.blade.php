 @extends('user.layouts.app2')
 @section('content')
 @section('page-title','GiftCard trades')
 @section('active-gift','active')
 <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">GiftCards</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('user.dashboard')}}">Home</a></li>
                        <li class="breadcrumb-item active">Our GiftCards</li>
                    </ol>
                </div>
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
                            <div class="small-box card">
                                <div class="card-body">
                                   <p class='text-center text-bold text-primary'>SELL GIFTCARD</p>
                                    <hr>
                                    <div class="row">
                                        @if(count($data) > 0)
                                            @foreach($data as $card)
                                                <div class="col-lg-4">
                                                    <div id="cards" class="clearfix cards">
                                                        <div class="row">
                                                            <div class="col-lg-4 col-md-4 col-sm-4 col-4">
                                                                <div class="float-left">
                                                                    <img id="img" src="{{url('storage/images/'.$card->image)}}" alt="">
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-4 col-md-4 col-sm-4 col-4">
                                                                <div>{{$card->giftcard}}</div>
                                                            </div>
                                                            <div class="col-lg-4 col-md-4 col-sm-4 col-4">
                                                                <div class="float-right">
                                                                <a cardid="{{$card->id}}" id="selectcard" href="/giftcard/{{$card->id}}/{{$card->giftcard}}" class='btn btn-primary btn-sm'>Select
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
                                    <i class="fas fa-gift"></i>
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
                max-height:70px !important;
                max-width:70px;
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
  @endsection  