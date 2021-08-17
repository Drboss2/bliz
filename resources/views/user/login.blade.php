@extends('user.layouts.app')
@section('content')
    <div class="container">
         <div class="col-lg-6 mt-4" style="padding-left:20px">
         <a href="/">Home</a>
         </div>
        <div class="col-lg-6 mx-auto">
           <div class="cards">
                @if(Session::has('admin_status'))
                    <div class="col-lg-12">
                        <div class="alert alert-danger alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                            <strong>Attention!!</strong> You have {{Session::get('admin_status')}}
                        </div>
                    </div>
                @endif
            <form id="loginForm" autocomplete="off">
                <h1>Let's Sign You In</h1>
                <p>Welcome back, we have missed you!</p>
                <p id="login_output"></p>
                <div class="form-group">
                    <input type="text" name="login_email" id="login_email" placeholder="Email">
                </div>
                <div class="form-group">
                    <input type="password" name="login_password" id="login_password" placeholder="Password">
                </div>
                <div class="float-end"><small><a style="color:red;" href="/forgetpassword">Forget password?</a></small></div>
                <div><small><a href="/register">Create new Account</a></small></div>
                
                <div class="form-group">
                    <input id="loginSubmit" style="width:100%" type="submit" class="btn btn-dark" value="Login">
                </div>
                <button id="loginloading" style="width:100%" class="btn btn-dark" type="button" disabled>
                    <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                    <span class="visually-hidden">Loading...</span>
                </button>
            </form>
        </div>
        </div>
    </div>
<script>
    $(document).ready(function(){
     login()
     function setHeader(data){
         $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': data
                }
            });
       }
       setHeader($('meta[name="csrf-token"]').attr('content'))
       function refreshToken(){
           $.get('refresh',function(data){
               setHeader(data);
           })
       }
       function login(){
            $("#loginloading").hide();
            $('#loginForm').on('submit',function(e){ // login script
                e.preventDefault();
                let email     = $("#login_email").val();
                let password  = $("#login_password").val();
                // let _token    = $('input[name=_token]').val();
                if(email === ''){
                    $("#login_output").html("<span class='text-danger'>Ooops! Email is required.</span>");
                }else if(password === ''){
                    $("#login_output").html("<span class='text-danger'>Ooops! Password is required.</span>");
                }else{
                    $.ajax({
                        url:"{{route('user.login')}}",
                        type:"POST",
                        cache:false,
                        dataType:"json",
                        async:true,
                        data:{
                            email:email,
                            password:password,
                        },
                        beforeSend:function(){
                            $("#loginloading").show();
                            $("#loginSubmit").hide();
                        },
                        success:function(response){
                            $("#loginloading").hide();
                            $("#loginSubmit").show();
                            if(response.status == "invalid"){
                                Swal.fire({
                                    title: 'Ooops!',
                                    text: 'Ooops! user credentials not correct',
                                    icon: 'error',
                                    timer: 3000
                                })
                                $("#login_output").html("<p class='text-danger'>Ooops! user credentials not correct</p>");
                                   refreshToken()  
                                $("#login_password").addClass("border-danger");
                            }else if(response.status == "login"){
                                Swal.fire({
                                    text: 'login approved!',
                                    icon:  'success',
                                    buttons:{
                                        confirm: {
                                        text: "OK",
                                        value: true,
                                        visible: true,
                                        className: "",
                                        closeModal: true
                                        }
                                    }
                                })
                                window.location.href="{{route('user.dashboard')}}"; // for users

                            }else if(response.status =='admin_login'){
                                window.location.href="/admin"; // for admin
                            }else{
                                console.log(response)
                            }
                        },
                        error:function(error){
                            
                            if(error.status === 419){
                                Swal.fire({
                                    title: 'Ooops!',
                                    text: 'Ooops! user session is invalid relogin to continue',
                                    icon: 'error',
                                    timer: 4000,
                                })
                                refreshToken()  
                                $("#login_output").html("<p class='text-danger'>user session is invalid relogin to continue'</p>");
                            }
                            $("#loginloading").hide();
                            $("#loginSubmit").show();                           
                        }
                    })
                }
                
            });
       }
    });
</script>
@endsection