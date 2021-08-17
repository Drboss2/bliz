@extends('user.layouts.app')
@section('content')
    <div class="container">
        <div class="col-lg-6 mt-4" style="padding-left:20px">
           <a href="/">Home</a>
         </div>
        <div class="col-lg-6 mx-auto">
            <div class="cards">
                <form id="pinForm" autocomplete="off">
                    <p style="font-size:13px;color:grey" class='text-center'>Create your 4 Digit pin</p>
                    <p id="login_output"></p>
                    <div class="form-group">
                        <input type="password" name="pin" id="pin" maxlength="4" placeholder="Pin" required>
                    </div>
                    <div class="form-group">
                        <input type="password" name="pin2" id="pin2" maxlenght="4"  placeholder='Re enter Pin' required>
                    </div>
                    <div class="form-group">
                        <input id="submit" style="width:100%" type="submit" class="btn btn-dark btn-sm" value="Create">
                    </div>
                    <button style="width:100%;display:none" id="loading" class="btn btn-dark btn-block btn-sm" type="button" disabled>
                        <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                        <span class="visually-hidden">Loading...</span>
                    </button>
                </form>
            </div>
        </div>
    </div>
<script>
    $(document).ready(function(){
        pin();
        function pin(){
            $("#pinForm").on("submit",(e)=>{
                e.preventDefault();
                   $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                let pin      = $("#pin").val();
                let pin2     = $("#pin2").val();
                if(pin != pin2){
                    Swal.fire({
                        title: 'Ooops!',
                        text: 'Ooops! Pin mismatch',
                        icon: 'error',
                        timer:4000,
                    })
                }else{
                    $.ajax({
                        url:"/pin/create",
                        type:"POST",
                        async:true,
                        data:{
                            pin:pin,
                        },
                        beforeSend:function(){
                            $("#loading").show();
                            $("#submit").hide();
                        },
                        success:function(data){
                            $("#loading").hide();
                            $("#submit").show();
                            if(data == 1){
                                 Swal.fire({
                                    title: 'Ooops!',
                                    text: 'Ooops! Pin created successfully',
                                    icon: 'success',
                                    timer:4000,
                                })
                                location.href="/verified";
                            }else if(data == "pin already created"){
                                Swal.fire({
                                    title: 'Ooops!',
                                    text: 'Ooops! Pin already created',
                                    icon: 'error',
                                    timer:4000,
                                })
                            }else{
                                console.log(data);
                            }
                        },
                        error:function(error){
                            console.log(error);
                        }
                    });
                }
            });               
       }
    
    });
</script>
@endsection