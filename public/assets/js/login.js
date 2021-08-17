$(document).ready(function(){
    $("#registerForm").on("submit",(e)=>{
        e.preventDefault();

        let name      = $("#name").val();
        let phone     = $("#phone").val();
        let username  = $("#username").val();

        let email     = $("#email").val();
        let password  = $("#password").val();
        let password_confirm = $("#confirm_password").val();
        let _token   = $('input[name=_token]').val();

        if(name === ''){
            $("#namen").show().fadeOut(3000);
            $("#name").addClass("border-danger");
        }else if(phone == ''){
            $("#namep").show().fadeOut(3000);
            $("#phone").addClass("border-danger");
            $("#name").removeClass("border-danger");
        }else if(username == ''){
            $("#nameu").show().fadeOut(3000);
            $("#username").addClass("border-danger");
            $("#phone").removeClass("border-danger");
        }else if(!IsEmail(email)){
            $("#namee").show().fadeOut(3000);
            $("#email").addClass("border-danger");
            $("#username").removeClass("border-danger");
        }else if(password === ""){
            $("#nameps").show().fadeOut(3000);
            $("#password").addClass("border-danger");
            $("#email").removeClass("border-danger");
        }else if(password != password_confirm){
             $("#namepss").show().fadeOut(3000);
             $("#password").addClass("border-danger");
             $("#confirm_password").addClass("border-danger");
        }else{
            $("#password").removeClass("border-danger")
             $("#confirm_password").removeClass("border-danger");
        }

        $.ajax({
            url: "{{route('user.register')}}",
            type:"POST",
            async:true,
            data:{
                'name':name,
                'email':email,
                'username':username,
                'phone': phone,
                'password':password,
                '_token': _token
            },
            // beforeSend:function(){
            //     $("#loading").show();
            //     $("#submit").hide();
            // },
            success:function(data){
                console.log(data);
            }

        });
    });
                         
    function IsEmail(email) {
        var regex = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
        if(!regex.test(email)) {
            return false;
        }else{
            return true;
        }
    }
})