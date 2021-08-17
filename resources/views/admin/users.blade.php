@extends('user.layouts.app2')
@section('content')
@section('page-title','Admin')
@section('active-admin_users','active')

 <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">All users</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/admin">Home</a></li>
                        <li class="breadcrumb-item active">Users</li>
                    </ol>
                </div>
           </div>
        </div>
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-hover table-striped">
                                        <thead>
                                            <tr colspan='9'>
                                                <td>All users</td>
                                            </tr>
                                            <tr>
                                                <th scope="col">#</th>
                                                <th scope="col">Name</th>
                                                <th>Phone no</th>
                                                <th scope="col">Email</th>
                                                <th scope="col">Wallet Balance</th>
                                                <th scope="col">Date</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if(count($data) > 0)
                                                    @foreach($data as $val)
                                                        <tr>
                                                            <td>{{$val->id}}</td>
                                                            <td>{{$val->name}}</td>
                                                            <td>{{$val->phone}}</td>
                                                            <td>{{$val->email}}</td>
                                                            <td>₦{{number_format($val->amount)}}</td>

                                                        
                                                            <!-- <td><a class='btn btn-danger btn-sm delinced' del="{{$val->id}}" href="javascript:void(0)"><i class="fa fa-trash"></i></a>
                                                                <a class="btn btn-success btn-sm approve" add="{{$val->id}}" href="javascript:void(0)"><i class="far fa-thumbs-up"></i></a>
                                                            </td> -->
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
        </section>
  </div>
   
</div>
<style>
    .table tr,th,td{
        font-size:14px;
        color:#32325d;
    }
</style>

<script>
$(document).ready(function(){
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
                url:'',
                method:'post',
                data:{
                    id:id,
                },
                success:function(data){
                    if(data){
                        refreshToken()
                        Swal.fire({
                            title:'Paid Alert!',
                            text: "Request Paid out Successful ",
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
     $(document).on('click','.approve',function(e){
        if(confirm('Are you sure you Paid this Withdrawal Request')){
            let id = $(this).attr('add');
            $(this).parent().parent().remove();
            $.ajax({
                url:'/admin/withdraw/'+id,
                method:'post',
                data:{
                    id:id,
                },
                success:function(data){
                    if(data){
                        refreshToken()
                        Swal.fire({
                            title:'Paid Alert!',
                            text: "Request Paid Successfully",
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
        }else{

        }
    })
})

</script>
@endsection