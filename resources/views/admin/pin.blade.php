@extends('user.layouts.app2')
@section('content')
@section('page-title','Admin')
@section('active-admin_pin','active')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Pin</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/admin">Home</a></li>
                        <li class="breadcrumb-item active">Change Pin</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <section class="content">
        <div class="container-fluid">
           <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-6">
                            <form id="form-Pin">
                                <div class="form-group">
                                    <label for="">Email</label>
                                    <input type="text" class="form-control" id="email" placeholder="enter user email">
                                    <input type="submit" value="search" class='btn btn-dark btn-sm mt-3'>
                                </div>
                            </form>
                        </div>
                        <div class="col-lg-6">
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <td colspan="2">User Pin</td>
                                        </tr>
                                        <tr>
                                            <th scope="col">Email</th>
                                            <th scope="col">User Pin</th>
                                        </tr>
                                    </thead>
                                    <tbody id="data">
                                      
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
           </div>
    </section>
</div>
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
            $.get('../../../../refresh',function(data){
                setHeader(data);
            })
        }
        $("#form-Pin").on('submit',function(e){
            e.preventDefault();
            let email = $('#email').val();
            if(email != ""){
                $.ajax({
                    url:"/admin/pin/"+email,
                    method:"get",
                    cache:false,
                    success:function(data){
                        refreshToken();

                        console.log(data)
                        if(data == ""){
                        let row = `
                             <tr colspan='2'>
                                <td>no record found</td>
                             </tr>`;
                            $('#data').html(row)

                        }else{

                        let row =`
                            <tr>
                                <td>${data[0].email}</td>
                                <td>${data[0].pin}</td>
                             </tr>`;
                            $('#data').html(row)

                        }
                        document.getElementById('form-Pin').reset();
                    },
                    error:function(err){
                        console.log(err);
                         refreshToken()
                    }
                })
            }else{
                alert('Please enter field');
            }
        });
    })
</script>
<style>
.table tr,th,td,label,.modal-title{
    font-size:14px;
    color:#32325d;
}
</style>
@endsection