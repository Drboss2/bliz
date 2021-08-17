@extends('user.layouts.app2')
@section('content')
@section('page-title','Admin Admin')
@section('active-admin_admin','active')

 <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Manage Admin</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Manage Admin</li>
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
                <div class="col-lg-3">
                    <form id="addAdmin" autocomplete="off">
                        <p class="text-center" style="font-size:14px;color:#32325d;">Add admin</p>
                        <p id="error"></p>
                        <div class="form-group">
                            <label for="">Make New Admin</label>
                            <input type="text" class="form-control" name="email" id="email" placeholder="email">
                        </div>
                       
                        <div class="form-group">
                            <button id="loading" class="btn btn-dark btn-block" type="submit">Add</button>
                        </div>
                    </form>
                </div>
                <div class="col-lg-9">
                    <div class="table-responsive">
                        <table class="table table-hover table-striped">
                            <thead>
                                <tr colspan='9'>
                                    <td>All Admin</td>
                                </tr>
                                <tr>
                                    <th scope="col">Name</th>
                                    <th scope="col">Phone</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody id="data">
                                @if(count($admin)> 0)
                                    @foreach($admin as $val)
                                        <tr>
                                            <td>{{$val->name}}</td>
                                            <td>{{$val->phone}}</td>
                                            <td>{{$val->email}}</td>
                                            @if(auth()->user()->id == $val->id)
                                                <td class="bg-success">Super Admin</td>
                                            @else
                                               <td>Admin</td>
                                            @endif
                                            <td><a remove="{{$val->id}}"class='btn btn-danger btn-sm remove' href="#"><i class='fa fa-trash'></i></a></td>
                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
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
    $("#addAdmin").on('submit',function(e){
          e.preventDefault();
         let email  = $("#email").val();

        if(email != ""){
            $.ajax({
                url:"/admin/add/admin/",
                method:"Post",
                cache:false,
                async:true,
                data:{
                    email: email,
                 },
                beforeSend:function(){
                    $("#loading").text('loading');
                    $("#loading").prop('disabled',true);
                },
                success:function(data){
                    $("#loading").text('submit');
                    $("#loading").prop('disabled',false);
                    $("#email").val('');
                    if(data =='not found'){
                        $("#error").html("<p class='alert alert-danger'>User not found</p>").fadeOut(5000)
                    }else{
                         let  row =`
                            <tr>
                                <td>${data.name}</td>
                                <td>${data.phone}</td>
                                <td>${data.email}</td>
                                <td>Admin</td>
                                <td><a remove="${data.id}"class='btn btn-danger btn-sm remove' href="#"><i class='fa fa-trash'></i></a></td>
                            </tr>`;
                          $('#data').append(row) 
                    }
                    refreshToken()
                 },
                error:function(err){
                    console.log(err);
                }
            })
         }else{
             alert('Please enter field');
         }
     });
     $(document).on('click','.remove',function(){
        if(confirm('Are you sure you want remove this user as Admin')){
            let id = $(this).attr('remove');
            $(this).parent().parent().remove();
            $.ajax({
                url:'/admin/add/remove/',
                method:'post',
                data:{
                    id:id,
                },
                success:function(data){
                    if(data){
                        refreshToken()
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