@extends('user.layouts.app2')
@section('content')
@section('active-gift','active')
 <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Upload Cards </h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{route('user.dashboard')}}">Home</a></li>
              <li class="breadcrumb-item active">Upload Cards </li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- Small boxes (Stat box) -->
            <div class="row">
                <div class="col-lg-7 mx-auto">
                    <div class="card" style="margin-top:40px;">
                        <div class="card-body">
                            <div class="table-responsive">
                            <p class="p mb-2" style="color:red">NOTE: This transaction is currently pending.....</p>
                                <table class="table table-bordered table-striped">
                                   <tr style='text-align:center'>
                                        <td colspan='5' class='active'></h1>Confirm Your Trade Details</h1></td>
                                    </tr>
                                    <form id="sub" method="post" action="{{route('confirmgift')}}" enctype="multipart/form-data">
                                    @csrf
                                        <tr>
                                            <td style='font-weight:bold'>Giftcard Name</td>
                                            <td>{{$card_name}}</td>
                                        </tr>
                                        <tr>
                                            <td style='font-weight:bold'>Giftcard Type</td>
                                            <td>{{$card_type}}</td>
                                        </tr>
                                        <tr>
                                            <td style='font-weight:bold'>Unit Price</td>
                                            <td>₦{{$card_price}}</td>
                                        </tr style='text-align:center'>
                                        <tr>
                                            <td style='font-weight:bold'>Denomination</td>
                                            <td>${{$card_amount}}</td>
                                        </tr>
                                        <tr>
                                            <td style='font-weight:bold'>Amount Expected</td>
                                            <td>₦{{number_format($total_price,2,'.',',')}}</td>
                                        </tr>
                                        <tr>
                                            <td style='font-weight:bold'>Upload Card</td>
                                            <td>
                                                <div id="img-s">
                                                    <label>upload here 
                                                        <i style="cursor:pointer;font-size:20px;color:red;" class="fas fa-upload"></i>
                                                        <input value='Upload' name='img' id="file" type='file'multiples>
                                                    </label>
                                                </div>
                                                <img class="img-fluid "id="imgPreview" src="" alt="">
                                                @error('img')
                                                <p class='text-danger'>
                                                    {{message}}
                                                </p>
                                                @enderror
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan='6'>
                                                <div>
                                                    <input id="submit" value='Submit' type='submit' class='btn btn-primary btn-sm' name='Withdraw'>
                                                       <button id="loginloading" class="btn btn-dark btn-sm" type="button" disabled>
                                                            <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                                                            <span class="visually-hidden">Loading...</span>
                                                        </button>
                                                        <a href="javascript:history.back()" class='btn btn-danger btn-sm back'>Back</a>
                                                </div>
                                            </td>
                                        </tr>
                                    </form>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<style> 
    .table tr td,.p{
        font-size:13.5px !important;
        margin-top:8px;
        font-weight: 900;
        line-height: 1.5;
        color: #32325d;
        margin-bottom:0;
    }
    label{
        font-size:15px;
    }
     
    #file{
    display:none;
    }
    #imgPreview{
        max-height:60px;
        max-width:60px;
    }
</style>
<script>
    $(document).ready(function(){
        $("#submit").hide();
        $("#loginloading").hide();
        $("#sub").submit(function(){
            $("#loginloading").show();
            $(".back").hide();
            $("#submit").hide();
        })
        $('#file').change(function(){
            const file = this.files[0];
            if (file){
            let reader = new FileReader();
            reader.onload = function(event){
                $('#imgPreview').attr('src', event.target.result);
                $("#img-s").hide();
                $("#submit").show();
            }
            reader.readAsDataURL(file);
            }
        });
    })

</script>

@endsection
 