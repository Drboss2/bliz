@extends('user.layouts.app2')
@section('content')
@section('active-kyc','active')
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
                        <li class="breadcrumb-item active">Kyc</li>
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
                <br>
            </div>
            <div class="row">
                <div class="col-lg-12 col-12">
                    <h3 class=''>Verify Your Account</h3>
                    <br>
                    <div class="card">
                        <div class='card-body'>
                            <div class="row">
                                <div id="pro1" class="col-lg-4 col-sm-4 col-4  text-bold btn btn-primary">REASON</div>
                                <div id="pro2" class="col-lg-4 col-sm-4 col-4  text-bold btn btn-default">ID Card</div>
                                <div id="pro3" class="col-lg-4 col-sm-4 col-4 text-bold  btn btn-default">BVN</div>
                                <!-- <div id="pro3" class="col-lg-3 col-sm-4 col-4 text-bold  btn btn-default">PIN</div> -->
                            </div>
                            <hr>
                            <div id="profiles1" class="profile-form">
                                <p class='p-2'>REASON</p>
                                <p>Here is why we need the following</p>
                                <ul>
                                  <li class='text-bold'>1 No Kyc(level 1)withdrawal limit NGN 1,000,000</li>
                                    <p>This provide us with Indentity confirmation as to fight against impersonation.</p>

                                   <li class='text-bold'>2 Identity Verification (level 2)withdrawal limit NGN 5,000,000</li>
                                    <p>This provide us with Indentity confirmation as to fight against impersonation.</p>

                                   <li class='text-bold'>3 BVN Verification (level 3)withdrawal limit unlimited</li>
                                   <p>Your BVN is only use to confirm your identity and will not give us access to your Bank Account.</p>
                                </ul>
                            </div>
                            <div id="profiles2" class="profile-form ">
                                <p class='p-2 text-bold font-size_20'><u>ID INFORMATION</u></p>
                                <div class="row">
                                    <div class="col-lg-8">
                                        <p>To verify your account you must submit a valid personal data and a valid accepted ID card(National ID,Voter Card,Divers License,International Passport etc)</p>
                                        <p class='text-danger'><b>Note:</b> We will manually confirm your id information for approval or other wise.</p>
                                        <hr>
                                        <p id="geterror"></p>
                                        @if(count($data) > 0)
                                            @if($data[0]->status =='pending')
                                                <p>Your Kyc is awaiting Verification
                                                    <div class="spinner-grow spinner-grow-sm"></div>
                                                </p> 
                                            @elseif($data[0]->status == 'success')
                                                <p class='bg-success'>Your Kyc is Verified</p> 
                                            @endif
                                        @else
                                            <form id="id" enctype="multipart/form-data" >
                                                <div class="form-group">
                                                    <label for="">First Name</label>
                                                    <input type="text" class="form-control" name="first_name" id="first_name">
                                                </div>
                                                <div class="form-group">
                                                    <label for="">Last Name</label>
                                                    <input type="text" class="form-control" name="last_name" id="last_name">
                                                </div>
                                                <div class="form-group">
                                                    <label for="">Phone</label>
                                                    <input type="text" class="form-control" name="phone" id="phone">
                                                </div>
                                                <div class="form-group">
                                                    <label for="">State</label>
                                                    <input type="text" class="form-control" name="state" id="state">
                                                </div>
                                                <div class="form-group">
                                                    <label for="">Gender</label>
                                                    <select type="text" class="form-control" name="gender" id="gender">
                                                        <option>Male</option>
                                                        <option>Female</option>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label for="">Font of ID</label>
                                                    <input type="file" class="form-control" name="front_file" id="front_file">
                                                    <img style="width:60px;height:60px;" class="img-fluid "id="imgPreview" src="" alt="">

                                                </div>
                                                <div class="form-group">
                                                    <label for="">Back of ID</label>
                                                    <input type="file" class="form-control" name="back_file" id="back_file">
                                                    <img style="width:60px;height:60px;" class="img-fluid "id="imgPreview1" src="" alt="">
                                                </div>
                                                <div class="form-group">
                                                    <button type="submit" class='btn btn-dark btn-sm' name="submit" id="submit">Submit</button>
                                                </div>
                                            </form>
                                        @endif
                                    </div>
                                    <div class="col-lg-4"></div>
                                </div>
                            </div>
                            <div id="profiles3" class="profile-form text-center">
                                 <p class='p-2 text-center'>BVN INFORMATION</p>
                                <p>Coming soon</p>
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
        $("#imgPreview").hide();
        $("#imgPreview1").hide();


        $("#id").on('submit',function(e){
            e.preventDefault();
            let form  = new FormData();
            form.append('first_name',$("#first_name").val());
            form.append('last_name', $("#last_name").val());
            form.append('phone',     $("#phone").val());
            form.append('state',     $("#state").val());
            form.append('gender',    $("#gender").val());

            form.append('front_file', $('input[type=file]')[0].files[0]);
            form.append('back_file', $('input[type=file]')[1].files[0]);

            $.ajax({
                url:"{{route('kyc.create')}}",
                method: 'post',
                cache:false,
                processData:false,
                contentType:false,
                data:form,
                beforeSend:function(){
                    $('#submit').attr('disabled',true)
                    $('#submit').text('loading....')
                },
                success:function(data){
                    console.log(data)
                    if(data == 'save'){
                        $("#id").hide()
                        $("#geterror").html("<p class='alert alert-success text-light'>Your kyc has been submitted</p>")
                         $('#submit').attr('disabled',false)
                        $('#submit').text('submit')
                    }
                    refreshToken()
                },
                error:function(err){
                    $("#id").hide()
                    $('#submit').attr('disabled',true)
                    $("#geterror").html("<p class='alert alert-danger text-light'>An error has occured please reload the page, because You upload a wrong image format or input.</p>")
                    $('#submit').text('An error has occured please reload the page')
                    console.log(err) ; 
                }
            })
        })

        $('#front_file').change(function(){ // first image
            const file = this.files[0];
            if (file){
                let reader = new FileReader();
                reader.onload = function(event){
                    $('#imgPreview').attr('src', event.target.result);
                    $("#front_file").hide();
                    $("#imgPreview").show(); 
                }
            reader.readAsDataURL(file);
            }
        });
        $('#back_file').change(function(){ // last image
            const file = this.files[0];
            if (file){
                let reader = new FileReader();
                reader.onload = function(event){
                    $('#imgPreview1').attr('src', event.target.result);
                    $("#back_file").hide();
                    $("#imgPreview1").show(); 
                }
            reader.readAsDataURL(file);
            }
        });

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