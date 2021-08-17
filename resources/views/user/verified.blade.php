@extends('user.layouts.app')
@section('content')
 <div class="container">
    <div class="col-lg-8 mx-auto">
        <div class="cards p-3">
            <div class="card-body border">
                <h3 class='text-center pb-3 pt-3'>Welcome to Blizexchange</h3>
                <p>Thank you for Registering on Blizexchange! We look forward to working with you.</p>
                <p style="color:red">An Activation link has been sent your email, if the email did not arrive please make sure you check your span or junk folder.</p>
                <p>Thank you for choosing Blizexchange</p>
                <br>
                <p><a class="verified" href="javascript:void(0)">Re send activation link</a></p>
            </div>
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
     $(document).on('click','.verified',function(){
         $.ajax({
             url:"/re_verified",
             type:'post',
             async:true,

             beforeSend:function(){
               $(".verified").text('Loading....') 
             },
            success:function(data){
                 if(data =='sent'){
                       Swal.fire({
                            text: 'Ooops! Activation link Resent',
                            icon: 'success',
                            timer: 4000,
                        })
                        $(".verified").text('Activation link sent') 

                    refreshToken() 
                 }
            },
            error:function(error){
                if(error.status == 419){
                    refreshToken() 
                }

            }

         })
     });
 });
</script>

@endsection