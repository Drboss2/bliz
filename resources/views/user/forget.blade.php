@extends('user.layouts.app')
@section('content')
    <div class="container">
        <div class="col-lg-6 mt-4" style="padding-left:20px">
         <a href="/">Home</a>
         </div>
        <div class="col-lg-5 mx-auto">
            <div class="cards">
                <form id="pass" autocomplete="off">
                    <p id="login_output"></p>
                    <h3 class='text-center'>Reset Password</h3>
                    <div class="form-group">
                        <input type="email"  name="email" id="email" placeholder="enter email" required>
                    </div>
                    <div class="form-group">
                        <input id="load" style="width:100%" type="submit" class="btn btn-primary" value="Send Password rest link">
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>
    $(document).ready(function(){

       $("#loginloading").hide();
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
        $('#pass').on('submit',function(e){ 
            e.preventDefault();
            let email     = $("#email").val();
            if(email == ''){
                alert('enter email');
            }else{
                $.ajax({
                    url:"/password",
                    type:"POST",
                    data:{
                        email:email,
                    },
                    beforeSend:function(){
                        $("#load").val('Loading...');
                        $("#load").prop('disabled',true);
                    },
                    success:function(response){
                        $("#load").val('Send Password rest link');
                        $("#load").prop('disabled',false);
                        console.log(response)
                        if(response =="sent"){
                            $("#login_output").html("<p class='alert alert-success'>Ooops! A Password reset link has been sent to your email </p>");
                               refreshToken() 
                               document.getElementById('pass').reset();
                        }else if(response == "notfound"){
                            $("#login_output").html("<p class='alert alert-danger'>Ooops! Email not found</p>");
                            document.getElementById('pass').reset();
                        }
                            
                    },
                    error:function(error){
                        $("#login_output").html("<p class='alert alert-danger'>Ooops! An error has occured please reload the page to retry</p>");
                    }
                })
            }
        })
                
    });
    </script>
@endsection