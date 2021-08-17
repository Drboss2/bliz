@extends('user.layouts.app2')
@section('content')
@section('page-title','Admin')
@section('active-admin_crypto','active')

 <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Add Crypto Assests</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
              <li class="breadcrumb-item active">Add Crypto</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <a class='mb-3'href="javascript:history.back()">Back</a>
            <div class="row">
                <div class="col-lg-5">
                    <form id="addCrypto" autocomplete="off">
                        <p class="text-center" style="font-size:14px;color:#32325d;">Add Crypto Assets</p>
                        <div class="form-group">
                            <label for="">Crypto Assets</label>
                            <input type="text" class="form-control" name="assets" id="assets" placeholder="eg Bitcoin" required>
                        </div>
                        <div class="form-group">
                            <label for="">Image</label>
                            <input type="file" class="form-control" name="file" id="file"  required> 
                        </div>
                        <div class="form-group">
                            <label for="">Crypto Address</label>
                            <input type="text" class="form-control" name="address" id="address" placeholder="E.g thyfyrrg66ffftrhgvvvbhfgt67fhg"> 
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
                                            <td>All Crypto Assest</td>
                                        </tr>
                                        <tr>
                                            <th scope="col">Assets</th>
                                            <th>Address</th>
                                            <th scope="col">Image</th>

                                            <th scope="col">Action</th>
                                            <th>View</th>
                                        </tr>
                                    </thead>
                                    <tbody id="data">
                                        @if(count($data) > 0)
                                            @foreach($data as $val)
                                                <tr>
                                                    <td>{{$val->assets}}</td>
                                                    <td><a class="addr" data-toggle="modal" data-target='#addrs' addr="{{$val->id}}" href="javascript:void(0)">{{$val->address}}</a></td>

                                                    <td><img style="max-height:50px;" class='img-fluid' src="{{url('storage/images/'.$val->image)}}"></td>

                                                    <td>
                                                        <a class="btn btn-danger btn-sm del" del="{{$val->id}}" href="javascript:void(0)"><i class="fas fa-trash"></i></a>
                                                        <a class="btn btn-success btn-sm view" data-toggle="modal" data-target='#view' view="{{$val->id}}" href="javascript:void(0)"><i class="fas fa-plus"></i></a>

                                                    </td>
                                                    <td><a class="btn btn-primary btn-sm" href="/admin/crypto/crypto_details/{{$val->id}}/{{$val->assets}}"><i class="fas fa-eye"></i></a></td>

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
<div class="modal fade" id="addrs" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit<span id="ds"></span> Address</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="EditCryptoAddress">
                    <div class="form-group">
                        <label for="">Address</label>
                        <input type="text" class="form-control" name="ad" id="ad" required>
                        <input type="hidden" class="form-control" name="addrid" id="addrid" required>

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
<div class="modal fade" id="view" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add <span id="ds"></span> Details</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="AddCryptoDetails">
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
                        <input id="load" type="submit" class="btn btn-primary btn-sm btn-block" value="Add">
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
        $.get('../refresh',function(data){
            setHeader(data);
        })
    }
    $("#addCrypto").on('submit',function(e){
        e.preventDefault();
        let assets  = $("#assets").val();
        let address = $("#address").val();

        let formData = new FormData($(this)[0]);

        if(assets && address != ""){
            $.ajax({
                url:"/admin/crypto/store",
                method:"Post",
                cache:false,
                processData:false,
                contentType:false,
                data: formData,
                beforeSend:function(){
                    $("#loading").text('loading');
                    $("#loading").prop('disabled',true);
                },
                success:function(data){
                    $("#loading").text('submit');
                    $("#loading").prop('disabled',false);
                    $("#assets").val('');
                    $("#file").val('');
                    $("#address").val('');
                    Swal.fire({
                        text:'New Crypto asset added',
                        icon:'success',
                        timer:3000
                    })
                    refreshToken()
                   let  row =`<tr>
                            <td>${assets}</td>
                            <td><a class="addr" data-toggle="modal" data-target='#addr' addr="${data.id}" href="javascript:void(0)">${address}</a></td>
                            <td><img style=max-height:50px;" class='img-fluid' src="http://127.0.0.1:8000/storage/images/${data.image}"></td>
                            <td>
                                <a class="btn btn-danger btn-sm del" del="${data.id}" href="javascript:void(0)"><i class="fas fa-trash"></i></a>
                                <a class="btn btn-success btn-sm view" data-toggle="modal" data-target='#view' view="${data.id}" href="javascript:void(0)"><i class="fas fa-plus"></i></a>
                            </td>
                            <td><a class="btn btn-primary btn-sm" href="/admin/crypto/crypto_details/${data.id}/${data.assets}}"><i class="fas fa-eye"></i></a></td>

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
        if(confirm('Are you sure you want Delete this Assets')){
            let id = $(this).attr('del');
            $(this).parent().parent().remove();
            $.ajax({
                url:'/admin/crypto/delete/'+id,
                method:'post',
                data:{
                    id:id,
                },
                success:function(data){
                    if(data){
                        refreshToken()
                        Swal.fire({
                            text: "Assets Deleted",
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
        $("#id").val(id);
    })

    $("#AddCryptoDetails").on('submit',function(e){
        e.preventDefault();
        $.ajax({
            url:'/admin/crypto/details',
            method:'post',
            data:$(this).serialize(),
            beforeSend:function(){
                $("#load").val('loading');
                $("#load").prop('disabled',true);
            },
            success:function(data){
                $("#load").prop('disabled',false);
                $("#load").val('add');
                console.log(data)
                if(data){
                    refreshToken();
                    Swal.fire({
                        text: "Crypto Details Added",
                        icon:  'success',
                        timer: 3000, //timeOut for auto-close
                    })
                    $("#view").modal('hide');
                    document.getElementById("AddCryptoDetails").reset();
                }
            },
            error:function(error){
                console.log(error);
                refreshToken();
            }
        })
    });
    $(document).on('click','.addr',function(){
        let id = $(this).attr('addr');
         $("#addrid").val(id);

         $.get('/admin/crypto/'+id,function(data){
             $("#ad").val(data);
            //  console.log(data)
         })
    })

    $("#EditCryptoAddress").on('submit',function(e){
        e.preventDefault();
        let add = $("#ad").val();
        $.ajax({
            url:'/admin/crypto/address',
            method:'post',
            data:$(this).serialize(),
            beforeSend:function(){
                $("#load").val('loading');
                $("#load").prop('disabled',true);
            },
            success:function(data){
                $("#load").prop('disabled',false);
                $("#load").val('edit');
                if(data){
                    refreshToken();
                    Swal.fire({
                        text:  'Address Updated',
                        icon: 'success',
                        timer: 3000, //timeOut for auto-close
                    })

                    $("#addrs").modal('hide');
                    // $("#addr").val(add)
                }
            },
            error:function(error){
                console.log(error);
                refreshToken();
            }
        })
    });
})
</script>
@endsection