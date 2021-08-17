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
                <h3 class='text-center'>Change Password</h3>
                    <div class="form-group">
                        <input type="password" class="" name="pass1" id="pass1" placeholder="new password" required>
                        <input type="hidden" class="" name="email" id="email" value="{{$email}}">

                    </div>
                    <div class="form-group">
                        <input type="password" class="" name="pass2" id="pass2" placeholder="re enter password"required>
                    </div>
                    <div class="form-group">
                        <input id="load" style="width:100%" type="submit" class="btn btn-primary" value="Send">
                    </div>
                </form>
            </div>
        </div>
    </div>
      <script>
    $(document).ready(function(){
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
            let pass    = $("#pass1").val();
            let pass1    = $("#pass2").val();
            let email    = $("#email").val();

            if(pass !== pass1){
                alert('password not match');
            }else{
                $.ajax({
                    url:"/password/index/pass",
                    type:"POST",
                    data:{
                        pass:pass,
                        email:email
                    },
                    beforeSend:function(){
                        $("#load").val('Loading');
                        $("#load").prop('disabled',true);
                    },
                    success:function(response){
                        $("#load").val('Send Password rest link');
                        $("#load").prop('disabled',false);

                        if(response =="true"){
                            $("#login_output").html("<p class='alert alert-success'>Ooops! Successful </p>");
                               refreshToken() 
                               document.getElementById('pass').reset();
                              // location.href="{{route('user.login')}}";
                        }else if(response == "not found"){
                            $("#login_output").html("<p class='alert alert-danger'>Ooops! User not found</p>");
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