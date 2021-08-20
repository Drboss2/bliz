@extends('user.layouts.app2')
@section('content')
@section('page-title','kyc')

 <!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Kyc</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/admin">Home</a></li>
                        <li class="breadcrumb-item active">Kyc</li>
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
                                            <td>Kyc Application </td>
                                        </tr>
                                        <tr>
                                            <th scope="col">First name</th>
                                            <th scope="col">Last name</th>
                                            <th scope="col">Phone</th>
                                            <!-- <th scope="col">Email</th> -->
                                            <th scope="col">state</th>
                                            <th scope="col">Gender</th>
                                            <th scope="col">Front of ID</th>
                                            <th scope="col">Back of ID</th>
                                            <th scope="col">Status</th>
                                            <th scope="col">Action</th>
                                            <th scope="col">Date</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                       @if(count($data) > 0)
                                            @foreach($data as $val)
                                                <tr>
                                                    <td>{{$val->first_name}}</td>
                                                    <td>{{$val->last_name}}</td>
                                                    <td>{{$val->phone}}</td>
                                                    <td>{{$val->state}}</td>
                                                    <td>{{$val->gender}}</td>
                                                    <td style="cursor:pointer"><a href="{{url('storage/images/'.$val->front_file)}}">
                                                    <img view="{{$val->id}}"  style="max-height:70px;" class='img-fluid img' src="{{url('storage/images/'.$val->front_file)}}"></a></td>

                                                    <td style="cursor:pointer"><a href="">
                                                    <img view="{{$val->id}}"  style="max-height:70px;" class='img-fluid img' src="{{url('storage/images/'.$val->back_file)}}"></a></td>
                                                    <td>{{$val->status}}</td>
                                                    <td>
                                                        <a class="btn btn-success btn-sm approve" approve="{{$val->id}}" href="javascript:void(0)"><i class="far fa-thumbs-up"></i></a>
                                                        <a class="btn btn-danger btn-sm delete" delete="{{$val->id}}" href="javascript:void(0)"><i class="fas fa-trash"></i></a>
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
    $(document).on('click','.delete',function(){
        if(confirm('Are you sure you want declined this kyc')){
            let id = $(this).attr('delete');
            $(this).parent().parent().remove();
            $.ajax({
                url:"{{route('admin.kyc.delete')}}",
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
                            text: "Kyc  Declined",
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
        if(confirm('Are you sure you want Approved user kyc')){
            let id = $(this).attr('approve');
            console.log(id)
            $(this).parent().parent().remove();
            $.ajax({
                url:"{{route('admin.kyc.approve')}}",
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
                            text: "Kyc approved",
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
})
</script>

@endsection