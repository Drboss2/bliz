@extends('user.layouts.app2')
@section('content')
@section('page-title','Admin')
@section('active-admin_bank','active')

 <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Add Bank</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Add Bank</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-5">
                    <form id="addBank" autocomplete="off">
                        <p class="text-center" style="font-size:14px;color:#32325d;">Add Bank</p>
                        <div class="form-group">
                            <label for="">Bank Name</label>
                            <input type="text" class="form-control" name="bank_name" id="bank_name" placeholder="Add ed Eco-Bank">
                        </div>
                       
                        <div class="form-group">
                            <button id="loading" class="btn btn-dark btn-block" type="submit">Add</button>
                        </div>
                    </form>
                </div>
                <div class="col-lg-7">
                    <div class="">
                        <div class="">
                           <div class="table-responsive">
                                <table class="table table-hover table-striped">
                                    <thead>
                                        <tr colspan='9'>
                                            <td>All Bank</td>
                                        </tr>
                                        <tr>
                                            <th scope="col">Assets</th>
                                            <th scope="col">Action</th>
                                            <th scope="col">Date</th>
                                        </tr>
                                    </thead>
                                    <tbody id="data">
                                        @if(count($data) > 0)
                                            @foreach($data as $val)
                                                <tr>
                                                    <td>{{$val->bank_name}}</td>
                                                    <td>
                                                        <a class="btn btn-danger btn-sm del" del="{{$val->id}}" href="javascript:void(0)"><i class="fas fa-trash"></i></a>
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
                                   {{$data->links()}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        </div>
    </div>
</div>
<style>
    .table tr,th,td,label{
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
    $("#addBank").on('submit',function(e){
          e.preventDefault();
         let bank_name  = $("#bank_name").val();

        if(bank_name != ""){
            $.ajax({
                url:"/admin/bank/store",
                method:"Post",
                cache:false,
                data:{
                    bank_name: bank_name,
                 },
                beforeSend:function(){
                    $("#loading").text('loading');
                    $("#loading").prop('disabled',true);
                },
                success:function(data){
                    $("#loading").text('submit');
                    $("#loading").prop('disabled',false);
                    $("#bank_name").val('');
                 
                    Swal.fire({
                        title:"Asset alert",
                        text:'New Bank added',
                        icon:'success',
                        timer:3000
                    })
                    refreshToken()
                   let  row =`<tr>
                            <td>${bank_name}</td>
                            <td>
                                <a class="btn btn-danger btn-sm del" del="{{$val->id}}" href="javascript:void(0)"><i class="fas fa-trash"></i></a>
                            </td>
                            <td>{{$val->created_at}}</td>
                        </tr>`;

                        $('#data').prepend(row)

                 },
                error:function(err){
                    console.log(err);
                }
            })
         }else{
             alert('Please enter field');
         }
     });
     $(document).on('click','.del',function(){
        if(confirm('Are you sure you want Delete this Bank')){
            let id = $(this).attr('del');
            $(this).parent().parent().remove();
            $.ajax({
                url:'/admin/bank/delete/'+id,
                method:'post',
                data:{
                    id:id,
                },
                success:function(data){
                    if(data){
                        refreshToken()
                        Swal.fire({
                            title:'Bank Alert',
                            text: "Bank Deleted",
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