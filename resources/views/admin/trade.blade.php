@extends('user.layouts.app2')
@section('content')
@section('page-title','Admin')
@section('active-admin_trade','active')

 <!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Trades</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/admin">Home</a></li>
                        <li class="breadcrumb-item active">Trades</li>
                    </ol>
                </div>
            </div>
       </div>
    </div>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="load">
                            <img src="{{asset('assets/img/clients/ajax-loader.gif')}}" alt="preloader" class="preloader__item" />
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-hover table-striped">
                                    <thead>
                                        <tr colspan='9'>
                                            <td>Trade Request </td>
                                        </tr>
                                        <tr>
                                            <th>#</th>
                                            <th scope="col">Assets</th>
                                            <th scope="col">Assets Proof</th>
                                            <th scope="col">Type</th>
                                            <th scope="col">Amount</th>
                                            <th scope="col">Rate</th>
                                            <th scope="col">Expected amount</th>
                                            <th scope="col">Status</th>
                                            <th scope="col">Action</th>
                                            <th scope="col">Date</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                       @if(count($data) > 0)
                                            @foreach($data as $val)
                                                <tr>
                                                    <td>{{$val->order_id}}</td>
                                                    <td>{{$val->assets_name}}</td>
                                                    <td style="cursor:pointer"><a href="{{route('download',$val->id)}}">
                                                    <img view="{{$val->id}}"  style="max-height:70px;" class='img-fluid img' src="{{url('storage/images/'.$val->assets_image)}}"></a></td>
                                                    <td>{{$val->assets_type}}</td>
                                                    <td>${{$val->denomination}}</td>
                                                    <td>₦{{$val->price}}</td>
                                                    <td>₦{{number_format($val->expected_amount,2,'.',',')}}</td>
                                                    <td>{{$val->status}}</td>
                                                    <td>
                                                        <a class="btn btn-success btn-sm approve" add="{{$val->id}}" href="javascript:void(0)"><i class="far fa-thumbs-up"></i></a>
                                                        <a class="btn btn-danger btn-sm delinced" del="{{$val->id}}" href="javascript:void(0)"><i class="fas fa-trash"></i></a>
                                                    </td>
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

<div class="modal  fade" id="view" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">View <span id="ds"></span></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            
            <a href=""><img class="img-thumbnail view" data-toggle="modal" data-target='#view' style="max-height:500px; max-width:100%"  class='img-fluid img' src="http://127.0.0.1:8000/storage/images/1626827566.png"></a>
          
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<script>
$(document).ready(function(){
    $(".load").hide()

    setHeader($('meta[name="csrf-token"]').attr('content'))
    function setHeader(data){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': data
            }
        });
    }
    refreshToken()
    function refreshToken(){
        $.get('../refresh',function(data){
            setHeader(data);
        })
    }
    $(document).on('click','.delinced',function(){
        if(confirm('Are you sure you want Declined this Trade')){
            let id = $(this).attr('del');
            $(this).parent().parent().remove();
            $.ajax({
                url:'/admin/trade/failed/'+id,
                method:'post',
                data:{
                    id:id,
                },
                beforeSend:function(){
                    $(".load").show()
                },
                success:function(data){
                    $(".load").hide()
                    if(data){
                        refreshToken()
                        Swal.fire({
                            title:'Trade Alert!',
                            text: "Trade Successful Declined",
                            icon:  'success',
                            timer: 3000, //timeOut for auto-close
                        })
                    }
                },
                error:function(error){
                    console.log(error);
                       refreshToken()
                }
            })
        }
    })
    $(document).on('click','.approve',function(){
        if(confirm('Are you sure you want Approved this Trade')){
            let id = $(this).attr('add');
            $(this).parent().parent().remove();
            $.ajax({
                url:'/admin/trade/success/'+id,
                method:'post',
                data:{
                    id:id,
                },
                beforeSend:function(){
                    $(".load").show()
                },
                success:function(data){
                    if(data){
                        $(".load").hide()

                        refreshToken()
                        Swal.fire({
                            title:'Trade Alert!',
                            text: "Trade Successful Approved",
                            icon:  'success',
                            timer: 3000, //timeOut for auto-close
                        })
                    }
                },
                error:function(error){
                    console.log(error);
                       refreshToken()
                }
            })
        }
    })

    $(document).on('click','.view',function(){
        let id = $(this).attr('view');
        $.get('/',function(data){
            console.log(data)
        })
    })
})

</script>

@endsection