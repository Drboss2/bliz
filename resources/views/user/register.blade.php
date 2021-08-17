@extends('user.layouts.app')
@section('content')
    <div class="container">
        <div class="col-lg-6 mt-4" style="padding-left:20px">
         <a href="/">Home</a>
        </div>
        <div class="col-lg-6 mx-auto"  style="padding-top:50px;padding-bottom:20px">
            <div class="cards">
                <form id="registerForm" autocomplete="off">
                <p id="output"></p>
                 <p>Create an account and trade your gift card in mins!</p>
                    <div class="form-group">
                        <input type="text" name="name" id="name" placeholder="Full Name same as in your Govenment ID" required>
                        <small style="display:none;" id="namen">full name is required</small>
                    </div>
                    <div class="form-group">
                        <input type="text" name="phone" id="phone" placeholder="Phone" required>
                        <small style="display:none;" id="namep">phone number is required</small>
                    </div>
                    <div class="form-group">
                        <input type="email" name="email" id="email" placeholder="Email address" required>
                        <span style="display:none;" id="namee">email address not valid</span>
                    </div>
                    <div class="form-group">
                        <input type="password" name="password" id="password" placeholder="Password" required>
                        <span style="display:none;" id="nameps">password is required</span>
                    </div>
                    <small><a href="/login">Have an account?</a></small>
                    <div class="form-group">
                        <input id="submit" style="width:100%" type="submit" class="btn btn-primary" value="Sign up">
                    </div>
                    <button id="loading" style="width:100%" class="btn btn-primary" type="button" disabled>
                        <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                        <span class="visually-hidden">Loading...</span>
                    </button>
                </form>
            </div>
        </div>
    </div>
<script>
    $(document).ready(function(){
        signup();
        function signup(){
            $("#loading").hide();
            $("#registerForm").on("submit",(e)=>{
                e.preventDefault();

                let name      = $("#name").val();
                let phone     = $("#phone").val();

                let email     = $("#email").val();
                let password  = $("#password").val();
                let _token   ="";

                if(name === ''){
                    $("#namen").show().fadeOut(3000);
                    $("#name").addClass("border-danger");
                }else if(phone == ''){
                    $("#namep").show().fadeOut(3000);
                    $("#phone").addClass("border-danger");
                    $("#name").removeClass("border-danger");
                }else if(!IsEmail(email)){
                    $("#namee").show().fadeOut(3000);
                    $("#email").addClass("border-danger");
                    $("#username").removeClass("border-danger");
                }else if(password === ""){
                    $("#nameps").show().fadeOut(3000);
                    $("#password").addClass("border-danger");
                    $("#email").removeClass("border-danger");
                }else{
                    $("#password").removeClass("border-danger")
                    $("#confirm_password").removeClass("border-danger");

                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        url: "{{route('user.register')}}",
                        type:"POST",
                        async:true,
                        data:{
                            name:name,
                            email:email,
                            phone:phone,
                            password:password,
                        },
                        beforeSend:function(){
                            $("#loading").show();
                            $("#submit").hide();
                        },
                        success:function(data){
                            $("#loading").hide();
                            $("#submit").show();
                            if(data){
                                Swal.fire({
                                    title: 'Success!',
                                    text: 'Redirecting to Pin Creation',
                                    icon: 'success',
                                    timer:3000,
                                })
                                location.href="/pin/index";
                                $("#output").html("<p class='alert alert-success'>user account created successfully</p>");
                                $("#registerForm")[0].reset();
                            }else{
                                console.log(data);
                            }
                        },
                        error:function(error){
                            if(error.status == '422'){
                                $("#loading").hide();
                                $("#submit").show();
                                if(error.responseJSON.errors.phone){
                                    $("#output").html("<p class='text-danger'>"+ error.responseJSON.errors.phone +"</p>");
                                }else if(error.responseJSON.errors.email){
                                    $("#output").html("<p class='text-danger'>"+error.responseJSON.errors.email +"</p>");
                                }
                            }else{
                                console.log(error);
                            }
                        }
                    });
                }
            });               
            function IsEmail(email) {
                var regex = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
                if(!regex.test(email)) {
                    return false;
                }else{
                    return true;
                }
            }
       }
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
      
    });
</script>
@endsection