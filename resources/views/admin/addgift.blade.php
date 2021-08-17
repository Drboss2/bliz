@extends('user.layouts.app2')
@section('content')
@section('page-title','Admin')
@section('active-admin_gift','active')

 <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Add Giftcards</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Add Giftcards</li>
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
                    <form id="addGift" enctype="multipart/form-data" autocomplete="off">
                        <p class="text-center" style="font-size:14px;color:#32325d;">Add Giftcards</p>
                        <div class="form-group">
                            <label for="">Giftcard Name</label>
                            <input type="text" class="form-control" name="name" id="name" placeholder="Amazon" required>
                        </div>
                        <div class="form-group">
                            <label for="">Image</label>
                            <input type="file" class="form-control" name="file" id="file" required>
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
                                        <tr colspan='5'>
                                            <td>All Giftcards</td>
                                        </tr>
                                        <tr>
                                            <th>Name</th>
                                            <th>Image</th>
                                            <th>Action</th>
                                            <th>View</th>
                                        </tr>
                                    </thead>
                                    <tbody id="data">
                                    @if(count($data)>0)
                                        @foreach($data as $val)
                                            <tr>
                                                <td id="card_name">{{$val->giftcard}}</td>
                                                <td><img style="max-height:50px;" class='img-fluid' src="{{url('storage/images/'.$val->image)}}"></td>
                                                <td>
                                                    <a class="btn btn-danger btn-sm del" del="{{$val->id}}" href="javascript:void(0)"><i class="fas fa-trash"></i></a>
                                                    <a class="btn btn-success btn-sm add" data-toggle="modal" data-target='#view' add="{{$val->id}}" href="javascript:void(0)"><i class="fas fa-plus"></i></a>
                                                </td>
                                                <td><a class="btn btn-primary btn-sm" href="/admin/gift/card_details/{{$val->id}}/{{$val->giftcard}}"><i class="fas fa-eye"></i></a></td>
                                            </tr>
                                        @endforeach
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
    $("#addGift").on('submit',function(e){
        e.preventDefault();
        let file = $('#file').val
        let name = $("#name").val();
        let formData = new FormData($(this)[0]);
        if(file && name != ""){
            $.ajax({
                url:"/admin/gift/store",
                method:"Post",
                cache:false,
                processData: false,
                contentType: false,
                data:formData,
            
                beforeSend:function(){
                    $("#loading").text('loading');
                    $("#loading").prop('disabled',true);
                },
                success:function(data){
                    $("#loading").text('submit');
                    $("#loading").prop('disabled',false);
                    $("#name").val('');
                    $("#file").val('');
                    Swal.fire({
                        title:"Image alert",
                        text:'New Giftcard Image Added',
                        icon:'success',
                        timer:3000
                    })
                    refreshToken()
                    let row =`
                    <tr>
                        <td>${name}</td>
                        <td><img style=max-height:50px;" class='img-fluid' src="http://127.0.0.1:8000/storage/images/${data.image}"></td>
                        <td>
                            <a class="btn btn-danger btn-sm del" del="${data.id}" href="javascript:void(0)"><i class="fas fa-trash"></i></a>
                            <a class="btn btn-success btn-sm add" data-toggle="modal" data-target='#view' add="${data.id}" href="javascript:void(0)"><i class="fas fa-plus"></i></a>
                        </td>
                        <td><a class="btn btn-primary btn-sm"  href=""><i class="fas fa-eye"></i></a></td>
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
        if(confirm('Are you sure you want Delete this Giftcard')){
            let id = $(this).attr('del');
            $(this).parent().parent().remove();
            $.ajax({
                url:'/admin/gift/delete/'+id,
                method:'post',
                data:{
                    id:id,
                },
                success:function(data){
                    if(data){
                        refreshToken()
                        Swal.fire({
                            title:'Image Alert',
                            text: "Giftcard image Deleted",
                            icon:  'success',
                            timer: 2000, //timeOut for auto-close
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
    $(document).on('click','.add',function(){
        let id = $(this).attr('add');
        $("#card_id").val(id);
        $.get("/admin/gift/name/"+id,function(data){
            $("#ds").text(data.giftcard);
        });
    })
    
});
</script>
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
                <form id="AddCardDetails">
                    <div class="form-group">
                        <label for="">Card Country</label>
                        <input type="text" class="form-control" name="card_country" id="card_country" required>
                    </div>
                    <div class="form-group">
                        <label for="">Card Type</label>
                        <input type="text" class="form-control" name="card_type" id="card_type" required>
                        <input type="hidden" class="form-control" name="card_id" id="card_id">
                    </div>
                    <div class="form-group">
                        <label for=""> Card Rate</label>
                        <input type="text" class="form-control" name="card_rate" id="card_rate" required>
                    </div>
                    <div class="form-group">
                        <label for=""> Card Min</label>
                        <input type="text" class="form-control" name="card_min" id="card_min" required>
                    </div>
                    <div class="form-group">
                        <label for=""> Card Max</label>
                        <input type="text" class="form-control" name="card_max" id="card_max" required>
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
<div class="modal fade" id="sview" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add <span id="dss"></span> Details</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="AddCardDetails">
                    <div class="form-group">
                        <label for="">Card Type</label>
                        <input type="text" class="form-control" name="card_type" id="card_type" required>
                        <input type="hidden" class="form-control" name="card_id" id="card_id">
                    </div>
                    <div class="form-group">
                        <label for=""> Card Rate</label>
                        <input type="text" class="form-control" name="card_rate" id="card_rate" required>
                    </div>
                    <div class="form-group">
                        <label for=""> Card Min</label>
                        <input type="text" class="form-control" name="card_min" id="card_min" required>
                    </div>
                    <div class="form-group">
                        <label for=""> Card Max</label>
                        <input type="text" class="form-control" name="card_max" id="card_max" required>
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
        $("#AddCardDetails").on('submit',function(e){
            e.preventDefault();
            let card_id   = $("#card_id").val();
            let card_type = $("#card_type").val();
            let card_rate = $("#card_rate").val();
            let card_min  = $("#card_min").val();
            let card_max  = $("#card_min").val();

            if(card_type && card_rate && card_min && card_max != ""){
                $.ajax({
                    url:'/admin/gift/details',
                    method:'post',
                    data:$(this).serialize(),
                    beforeSend:function(){
                        $("#load").val('loading');
                        $("#load").prop('disabled',true);
                    },
                    success:function(data){
                        $("#load").prop('disabled',false);
                        $("#load").val('add');
                        if(data){
                            refreshToken();
                            Swal.fire({
                                title:'Item Alert',
                                text: "Giftcard Details Added",
                                icon:  'success',
                                timer: 2000, //timeOut for auto-close
                            })
                            document.getElementById("AddCardDetails").reset();
                        }
                    },
                    error:function(error){
                        console.log(error);
                        refreshToken();
                    }
                })
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