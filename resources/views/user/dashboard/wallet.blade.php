@extends('user.layouts.app2')
@section('content')
@section('page-title','Wallet | Blizexchange')
@section('active-wallet','active')

  <div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">My wallet area</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">My wallet</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
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
                        <div class="col-lg-4 col-12">
                        @if(Session::has('success'))
                            <script>   
                                Swal.fire({
                                    title:'Wallet funded!',
                                    text: "{{ Session::get('success') }}",
                                    icon:  'success',
                                    timer: 3000, //timeOut for auto-close
                                    buttons:{
                                        confirm: {
                                        text: "OK",
                                        value: true,
                                        visible: true,
                                        className: "",
                                        closeModal: true
                                        }
                                    }
                                })
                            </script>
                        @endif
                        @if(Session::has('erro'))
                            <script>   
                                Swal.fire({
                                    text: "{{ Session::get('erro') }}",
                                    icon:  'error',
                                    timer: 7000, //timeOut for auto-close

                                    buttons:{
                                        confirm: {
                                        text: "OK",
                                        value: true,
                                        visible: true,
                                        className: "",
                                        closeModal: true
                                        }
                                    }
                                })
                            </script>
                        @endif
                            <!-- small box -->
                            <div style="padding:10px;" class="small-box bg-info">
                            <div class="inner">
                                <h3>Naira Wallet</h3>
                                <h5>{{auth()->user()->name}}</h5>

                                <p>₦{{number_format(auth()->user()->wallet->amount, 2, '.', ',')}}</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-wallet"></i>
                            </div>
                                <a href="#" data-toggle="modal" data-target="#exampleModal" style="background-color:transparent" class="btn btn-info btn-sm">Fund <i class="fas fa-arrow-circle-right"></i></a>
                                <a href="#" data-toggle="modal" data-target="#example" style="background-color:transparent" class="btn btn-info btn-sm">Withdraw <i class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                        <!-- ./col -->
                        <div class="col-lg-4 col-12">
                            <!-- small box -->
                            <div style="padding:10px;" class="small-box bg-dark">
                            <div class="inner">
                                <h3>BTC Wallet</h3>
                                <h5>{{auth()->user()->name}}</h5>

                                <p>Wallet service coming soon<p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-stats-bars"></i>
                            </div>
                           
                             <a disabled href="#"  style="background-color:transparent" class="btn btn-info btn-sm">Send<i class="fas fa-arrow-circle-right"></i></a>
                            <a disabled href="#"  style="background-color:transparent" class="btn btn-info btn-sm">Sell <i class="fas fa-arrow-circle-right"></i></a> 
                            </div> 
                        </div>  
                          <!-- ./col -->
                        <div class="col-lg-4 col-12">
                            <!-- small box -->
                            <div style="padding:10px;" class="small-box bg-dark">
                            <div class="inner">
                                <h3>ETH Wallet</h3>
                                <h5>{{auth()->user()->name}}</h5>

                                <p>Wallet service coming soon<p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-stats-bars"></i>
                            </div>
                           
                             <a disabled href="#"  style="background-color:transparent" class="btn btn-info btn-sm">Send<i class="fas fa-arrow-circle-right"></i></a>
                            <a disabled href="#"  style="background-color:transparent" class="btn btn-info btn-sm">Sell <i class="fas fa-arrow-circle-right"></i></a> 
                            </div> 
                        </div> 
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div style="padding:10px;" class="card bg-white">
                       <div class="card-body">
                           <p class="card-text text-bold">Wallet History</p>
                            <div id="table">
                                @include('user.dashboard.pagination')
                             </div>
                       </div>
                    </div>
                </div>
             </div>
        </div>
    </section>
  </div>
    <div class="modal" id="exampleModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Make a Deposit</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{route('pay')}}">
                        <div class="form-group">
                            <input type="hidden" name="email" value="{{auth()->user()->email}}">
                            <input type="hidden" name="amount" id="amount"> 
                            <input type="hidden" name="first_name" value="{{auth()->user()->name}}">
                            <input type="hidden" name="currency" value="NGN">
                            <input type="hidden" name="metadata" value="{{ json_encode($array = ['reason' => 'fund account']) }}" >
                            <input type="hidden" name="reference" value="{{ Paystack::genTranxRef() }}">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}"> 
                            <input type="text" name="amounts" id="amounts" class="form-control" placeholder="enter amount to deposit">
                        </div>
                        <div class="form-group">
                            <input type="submit"  disabled class="btn btn-primary btn-sm" value="Pay">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
                </div>
                <script>
                    let cost = document.getElementById('amounts')
                        cost.addEventListener('keyup',()=>{
                        document.getElementById('amount').value = cost.value * 100;
                    })

                    $(document).ready(function(){
                        $(document).on('click','.pagination a',function(e){
                            e.preventDefault();
                            let page = $(this).attr('href').split('page=')[1];
                            fetch_page(page)
                        });

                        function fetch_page(page){
                            $.ajax({
                                url:"/pagination/fetch_data?page="+page,
                                success:function(data){
                                    $("#table").html(data)
                                }
                            });

                        }
                    });
                </script>
            </div>
        </div>
   </div>
    <div class="modal" id="example" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Make a Withdrawal</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{route('with')}}" autocomplete="off">
                       @csrf
                        <div class="form-group">
                            <label for="bank">Select Bank</label>
                            <input type="text" data-toggle="modal" data-target="#select" name="bank" id="bank" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="account_name">Account No</label>
                            <input type="text" name="account_no" id="account_no" class="form-control" maxlength="10">
                        </div>
                        <div class="form-group">
                            <label for="account_name">Account Name</label>
                            <input type="text" name="account_name" id="account_name" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="account_name">Amount</label>
                            <input type="text" name="a" id="a" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="account_name">Pin</label>
                            <input type="text" name="pin" id="pin" class="form-control">
                            <span id="pinerror"></span>
                        </div>
                        <div class="form-group">
                            <input id="withBtn" type="submit" class="btn btn-primary" value="Continue" disabled>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
                </div>
                <script>
                    $(document).ready(function(){
                        $('#pin').on('keyup',function(){
                            let pin = $("#pin").val();

                            $.get("/pin",function(data){
                                if(pin === data){
                                    $("#pinerror").html("");
                                    $("#withBtn").prop('disabled',false);
                                }else{
                                    $("#pinerror").html("<span class='text-danger'>Pin error</span>");
                                    $("#withBtn").prop('disabled', true);
                                }
                            })
                        });
                    })
                   
                </script>
                  @if(Session::has('error'))
                    <script>  
                        Swal.fire({
                            title:'Wallet issues!',
                            text: "{{ Session::get('error') }}",
                            icon:  'error',
                            timer:4000,
                            buttons:{
                                confirm: {
                                text: "OK",
                                value: true,
                                visible: true,
                                className: "",
                                closeModal: true
                                }
                            }
                        })
                    </script>
                @endif
                @if(Session::has('error_pin'))
                <script>  
                    Swal.fire({
                        title:'Wallet issues!',
                        text: "{{ Session::get('error_pin') }}",
                        icon:  'error',
                        timer:5000,
                        buttons:{
                                confirm: {
                                text: "OK",
                                value: true,
                                visible: true,
                                className: "",
                                closeModal: true
                            }
                        }
                    })
                </script>
                @endif
                  @if(Session::has('okay'))
                    <script>  
                        Swal.fire({
                            title:'Success!',
                            text: "{{ Session::get('okay') }}",
                            icon:  'success',
                            timer:4000,
                            buttons:{
                                confirm: {
                                text: "OK",
                                value: true,
                                visible: true,
                                className: "",
                                closeModal: true
                                }
                            }
                        })
                    </script>
                @endif
            </div>
        </div>
   </div>
   <div class="modal fade" id="select" tabindex="-1">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Select Bank</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" style="max-height:600px;overflow:auto">
                    <div id="selected">
                        @foreach($select as $bank )
                            <p id="s">{{$bank->bank_name}}</p>
                        @endforeach
                    </div>
                </div>
                <script>
                    $(document).ready(function(){
                        $("p#s").click(function(){
                            $("#bank").val($(this).text());
                            $("#select").modal('hide');
                        });
                    });
                </script>
                <style>
                    .modal-body div p{
                        padding-top: 1rem;
                        padding-bottom: 1rem;
                        padding-left:5px;
                        margin-bottom:10px;
                        margin-top:10px;
                        cursor:pointer;
                    }
                    .modal-body div p:hover{
                        background:lightgrey;
                    }
                </style>
            </div>
        </div>
   </div>
</div>
<style>
    .table tr,th,td{
        font-size:14px;
        color:#32325d;
    }
</style>
@endsection
