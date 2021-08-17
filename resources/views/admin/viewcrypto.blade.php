@extends('user.layouts.app2')
@section('content')
@section('page-title','Admin')
@section('active-admin_crypto','active')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Crypto Details</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="/admin">Home</a></li>
                    <li class="breadcrumb-item active">Crypto Details</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <section class="content">
        <div class="container-fluid">
         <a class='mb-3'href="javascript:history.back()">Back</a>
         <hr>
           <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="table-responsive">
                                <table class="table table-hover table-striped">
                                    <thead>
                                        <tr colspan='5'>
                                            <td>{{$name}}</td>
                                        </tr>
                                        <tr>
                                            <th>Crypto name</th>
                                            <th>Rate</th>
                                            <th>Min</th>
                                            <th>Max</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody id="data">
                                    @if(count($data)>0 )
                                        @foreach($data as $val)
                                        <tr>
                                            
                                            <td>{{$val->crypto_name}}</td>
                                            <td>₦{{$val->rate}}</td>
                                            <td>{{$val->min}}</td>
                                            <td>{{$val->max}}</td>
                                            <td>
                                                <a class="btn btn-primary btn-sm edit" edit="{{$val->id}}" data-toggle="modal" data-target="#sview" href=""><i class="fas fa-plus"></i></a>
                                                <a class="btn btn-danger btn-sm del" del="{{$val->id}}" href="#"><i style=' color:white' class="fas fa-trash"></i></a>
                                            </td>
                                        </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td>No Crypto Details found</td>
                                        </tr>
                                    @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
           </div>
    </section>
</div>
<div class="modal fade" id="sview" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit <span id="dss"></span> Details</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="EditCryptoDetails">
                    <div class="form-group">
                        <label for="">Cryto name</label>
                        <input type="text" class="form-control" name="crypto_name" id="crypto_name" placeholder="B1" required>
                        <input type="hidden" class="form-control" name="id" id="id">
                    </div>
                   
                    <div class="form-group">
                        <label for="">Rate</label>
                        <input type="text" class="form-control" name="rate" id="rate" required  placeholder="500">
                    </div>
                    <div class="form-group">
                        <label for="">Min</label>
                        <input type="text" class="form-control" name="min" id="min" required  placeholder="50">
                    </div>
                    <div class="form-group">
                        <label for="">Max</label>
                        <input type="text" class="form-control" name="max" id="max" required  placeholder="1000">
                    </div>
                    <div class="form-group">
                        <input id="load" type="submit" class="btn btn-primary btn-sm btn-block" value="Edit">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
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
        $(document).on('click','.edit',function(){
            let id = $(this).attr('edit');
            $.get("/admin/crypto/single_crypto_details/"+id,function(data){
                $("#id").val(data[0].id);
                $("#crypto_name").val(data[0].crypto_name);

                $("#rate").val(data[0].rate);
                $("#min").val(data[0].min);
                $("#max").val(data[0].max)
            });
        })
        $(document).on('click','.del',function(){
            let id = $(this).attr('del');
            $(this).parent().parent().remove();

            $.post("/admin/delete",{id:id},function(data){
               console.log(data) 
            });
        })
        $("#EditCryptoDetails").on('submit',function(e){
            e.preventDefault();
            let id = $('#id').val();
            if(id != ""){
                $.ajax({
                    url:"/admin/crypto/edit/single_crypto_details/",
                    method:"Post",
                    cache:false,
                    data:$(this).serialize(),
                    beforeSend:function(){
                        $("#load").val('loading');
                        $("#load").prop('disabled',true);
                    },
                    success:function(data){
                        $("#load").val('Edit');
                        $("#load").prop('disabled',false);
                        Swal.fire({
                            text:'Crypto Details Edited',
                            icon:'success',
                            timer:3000
                        })
                        refreshToken()
                        console.log(data)
                        $("#sview").modal('hide');
                        
                        $('#data').prepend(row)
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