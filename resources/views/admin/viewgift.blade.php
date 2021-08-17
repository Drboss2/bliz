@extends('user.layouts.app2')
@section('content')
@section('page-title','Admin')
@section('active-admin_gift','active')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Giftcard Details</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="/admin">Home</a></li>
                    <li class="breadcrumb-item active">Giftcard Details</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <section class="content">
        <div class="container-fluid">
         <a class='mb-3' href="/admin/gift">Back</a>
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
                                            <th>Card Country</th>

                                            <th>Card Type</th>
                                            <th>Rate</th>
                                            <th>Minimum Qty</th>
                                            <th>Maximum Qty</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody id="data">
                                    @if(count($data)>0)
                                        @foreach($data as $val)
                                        <tr>
                                            
                                            <td>{{$val->card_country}}</td>
                                            <td>{{$val->card_type}}</td>
                                            <td>₦{{$val->price}}</td>
                                            <td>{{$val->buying_min}}</td>
                                            <td>{{$val->buying_max}}</td>
                                            <td><a class="btn btn-primary btn-sm edit" edit="{{$val->id}}" data-toggle="modal" data-target="#sview" href=""><i class="fas fa-plus"></td>
                                        </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td>No Giftcard Details found</td>
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
                <h5 class="modal-title">Add <span id="dss"></span> Details</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="EditCardDetails">
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
            $.get("/admin/gift/single_card_details/"+id,function(data){
                $("#card_id").val(data.id);
                $("#card_country").val(data.card_country);

                $("#card_type").val(data.card_type);
                $("#card_rate").val(data.price);
                $("#card_min").val(data.buying_min);
                $("#card_max").val(data.buying_max)
            });
        })
        $("#EditCardDetails").on('submit',function(e){
            e.preventDefault();
            let id = $('#card_id').val();
            if(id != ""){
                $.ajax({
                    url:"/admin/gift/edit/single_card_details/"+id,
                    method:"Post",
                    cache:false,
                    data:$(this).serialize(),
                    beforeSend:function(){
                        $("#loading").text('loading');
                        $("#loading").prop('disabled',true);
                    },
                    success:function(data){
                        $("#loading").text('submit');
                        $("#loading").prop('disabled',false);
                        Swal.fire({
                            title:"Alert",
                            text:'Giftcard Details Edited',
                            icon:'success',
                            timer:3000
                        })
                        refreshToken()
                        // let row =`
                        // <tr>
                        //     <td>${name}</td>
                        //     <td><img style=max-height:50px;" class='img-fluid' src="http://127.0.0.1:8000/storage/images/${data.image}"></td>
                        //     <td>
                        //         <a class="btn btn-danger btn-sm del" del="${data.id}" href="javascript:void(0)"><i class="fas fa-trash"></i></a>
                        //         <a class="btn btn-success btn-sm add" data-toggle="modal" data-target='#view' add="${data.id}" href="javascript:void(0)"><i class="fas fa-eye"></i></a>
                        //     </td>
                        //     <td><a class="btn btn-primary btn-sm"  href=""><i class="fas fa-plus"></i></a></td>
                        // </tr>`;
                        // $('#data').prepend(row)
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