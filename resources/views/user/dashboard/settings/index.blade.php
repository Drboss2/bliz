@extends('user.layouts.app2')
@section('content')
@section('active-setting','active')
 <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Dashboard</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('user.dashboard')}}">Home</a></li>
                        <li class="breadcrumb-item active">Settings</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
     <section class="content">
        <div class="container-fluid">
           <div class="col-lg-12">
                <a href="javascript:history.back()">Back</a>
                <hr>
            </div>
            <div class="row">
                <div class="col-lg-8 col-12">
                    <div class="card">
                        <h3 class='float-right card-header'>My Profile</h3>
                        <div class='card-body'>
                            <div class="row">
                                <div id="pro1" class="col-lg-4 col-sm-4 col-4  text-bold btn btn-primary">PROFILE</div>
                                <div id="pro2" class="col-lg-4 col-sm-4 col-4 text-bold  btn btn-default">PASSWORD</div>
                                <div id="pro3" class="col-lg-4 col-sm-4 col-4 text-bold  btn btn-default">PIN</div>
                            </div>
                            <hr>
                            <div id="profiles1" class="profile-form">
                                <p class='p-2 text-center'>USER INFORMATION</p>
                                <form id="user_settings">
                                    <div class="row">
                                        <div class='col-lg-6'>
                                            <label for="">Email Address</label>
                                            <input type="text" class='form-control' name="email" id="email" value="{{auth()->user()->email}}" readonly>

                                        </div>
                                        <div class='col-lg-6'>
                                            <label for="">Phone</label>
                                            <input type="text" class='form-control' name="phone" id="phone" value="{{auth()->user()->phone}}">
                                        </div>
                                        <div class='col-lg-12'>
                                            <label for="">Full Name</label>
                                            <input type="text" class='form-control' name="email" id="email" value="{{auth()->user()->name}}" readonly>
                                        </div>
                                    
                                        <div class='col-lg-12'>
                                            <input type="submit" class='btn btn-primary btn-block btn-sm mt-4' value="Update">
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div id="profiles2" class="profile-form">
                                <p class='p-2 text-center'>UPDATE PASSWORD</p>
                                <form id="user_password">
                                    <div class='form-group'>
                                        <label for="">New Password</label>
                                        <input type="password" class='form-control' name='new_password' id="new_password" required>
                                    </div>
                                    <div class='form-group'>
                                        <label for="">Confirm Password</label>
                                        <input type="password" class='form-control' name="confirm_password" id="confirm_password" required>
                                    </div>
                                    <div class='form-group'>
                                        <input type="submit" class='btn btn-primary btn-block btn-sm mt-4' value="Update">
                                    </div>
                                </form>
                            </div>
                            <div id="profiles3" class="profile-form">
                                <p class='p-2 text-center'>UPDATE/CREATE PIN</p>
                                <!-- <form id="user_pin">
                                    <div class='form-group'>
                                        <label for="">Pin</label>
                                        <input type="text" class='form-control' name="new_pin" id="new_pin">
                                    </div>
                                    <div class='form-group'>
                                        <label for="">Confirm Pin</label>
                                        <input type="text" class='form-control' name="confirm_pin" id="confirm_pin">
                                    </div>
                                    <div class='form-group'>
                                        <input type="submit" class='btn btn-primary btn-block btn-sm mt-4' value="Update">
                                    </div>
                                </form> -->
                                <p class="p-2 text-center">To change your four digits Pin please contact support on live chat</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-12 text-center">
                    <div class='card'>
                        <div class="card-body">
                            <img style="height:200px" class="img-fluid" src="dist/img/avatar.svg" alt="">
                            <div class='p-3 text-primary'> 
                                <i class="fas fa-user"> </i>
                                  {{auth()->user()->name}}
                            </div>
                            <div class='p-3 text-primary'> 
                                <i class="fas fa-envelope-square"> </i>
                                  {{auth()->user()->email}}
                            </div>
                            <div class='p-3 text-primary'> 
                                <i class="fas fa-phone-volume"> </i>
                                  {{auth()->user()->phone}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>            
        </div>
    </section>
</div>
<style>
.card h3{
    font-family: inherit;
    font-weight: 400;
    font-size:16px;
    line-height: 1.5;
    color: #32325d;
}
label,.profile-form p{
    color: #32325d;
    font-size:14px;
}
.card-body{
    background:#e9ecef;;
}
@media(max-width:700px){
    #pro1,#pro2,#pro3{
        font-size:13px;
    }
}

</style>
<script>
    $(document).ready(function(){
        $("#profiles2").hide()
        $("#profiles3").hide()
        $("#pro1").click(function(){
            $("#profiles1").show();
            $("#profiles2").hide()
            $("#profiles3").hide()
            $("#pro1").addClass("btn-primary");
            $("#pro1").removeClass("btn-default");

            $("#pro2").removeClass("btn-primary");
            $("#pro2").addClass("btn-default");
            $("#pro3").removeClass("btn-primary");
            $("#pro3").addClass("btn-default");
        })
        $("#pro2").click(function(){
            $("#profiles2").show();
            $("#profiles1").hide()
            $("#profiles3").hide();
            $("#pro2").addClass("btn-primary");
            $("#pro2").removeClass("btn-default");
            $("#pro1").removeClass("btn-primary");
            $("#pro1").addClass("btn-default");
            $("#pro3").removeClass("btn-primary");
            $("#pro3").addClass("btn-default");
        })
        $("#pro3").click(function(){
            $("#profiles2").hide();
            $("#profiles1").hide()
            $("#profiles3").show()
            $("#pro3").addClass("btn-primary");
            $("#pro3").removeClass("btn-default");
            $("#pro1").removeClass("btn-primary");
            $("#pro1").addClass("btn-default");
            $("#pro2").removeClass("btn-primary");
            $("#pro2").addClass("btn-default");
        })

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
        $.get('refresh',function(data){
             setHeader(data);
        })
    }
    $("#user_settings").on('submit',function(e){
        e.preventDefault()
        let phone = $("#phone").val();
        if(phone == ""){
            Swal.fire({
                title: 'Ooops!',
                text: 'Ooops! Phone number is empty',
                icon: 'error',
                timer: 4000,
            })
            $("#phone").addClass('border-danger')
        }else{
            $.ajax({
                url:"/settings/user_update",
                type:"post",
                data:{
                    phone:phone,
                },
                success:function(data){
                    if(data){
                         Swal.fire({
                           title: 'Good Job!',
                           text: 'Ooops! Phone number has been updated',
                           icon: 'success',
                           timer: 4000,
                        })
                        $("#phone").focus()
                    }
                }
            })
        }
    })
        
    $("#user_password").on('submit',function(e){
        e.preventDefault()

        let new_password     = $("#new_password").val();
        let confirm_password = $("#confirm_password").val()
        if(new_password == ""){
            Swal.fire({
                title: 'Ooops!',
                text: 'Ooops! Password is empty',
                icon: 'error',
                timer: 4000,
            })
            $("#new_password").addClass('border-danger');
        }else if(new_password != confirm_password){
            Swal.fire({
                title: 'Error!',
                text: 'Ooops! Password not match',
                icon: 'error',
                timer: 4000,
            });
            $("#new_password").addClass("border-danger")
        }else{
            $.ajax({
                url:"settings/user_password",
                type:"post",
                data:{
                    new_password:new_password
                },
                success:function(data){
                    console.log(data)
                    if(data){
                         Swal.fire({
                           text: 'Ooops! Password has been updated',
                           icon: 'success',
                           timer: 3000,
                        })
                        refreshToken()
                        $("#new_password").removeClass("border-danger")
                        $("#new_password").val("");
                        $("#confirm_password").val("");
                    }
                }
            })
        }
    })
      
    $("#user_pin").on('submit',function(e){
        e.preventDefault()

        let new_pin    = $("#new_pin").val();
        let confirm_pin = $("#confirm_pin").val()
        if(new_pin == ""){
            Swal.fire({
                title: 'Ooops!',
                text: 'Ooops! Password is empty',
                icon: 'error',
                timer: 4000,
            })
            $("#new_pin").addClass('border-danger');
        }else if(new_pin != confirm_pin){
            Swal.fire({
                title: 'Error!',
                text: 'Ooops! Pin not match',
                icon: 'error',
                timer: 4000,
            });
            $("#new_pin").addClass("border-danger")
        }else{
            $.ajax({
                url:"settings/user_pin",
                type:"post",
                data:{
                    new_pin:new_pin
                },
                success:function(data){
                    if(data){
                         Swal.fire({
                           title: 'Good Job!',
                           text: 'Ooops! Pin has been updated',
                           icon: 'success',
                           timer: 4000,
                        })
                        refreshToken()
                        $("#new_pin").removeClass("border-danger")

                    }
                },
                error:function(err){
                    console.log(err);
                }
            })
        }
    })

    })
</script>
@endsection