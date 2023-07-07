<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Hublaa-Lite</title>
<script src="https://code.jquery.com/jquery-3.7.0.js"></script>
</head>
<body>
<div name="hublaa-alert" id="hublaa-alert" class="hublaa-alert"></div>
<div name="hublaa-login" id="hublaa-login" class="hublaa-login"></div>
<div name="hublaa-home" id="hublaa-home" class="hublaa-home"></div>
<script>
$(document).ready(function(){
$("#hublaa-login").html('<input type="text" name="email" id="email" class="email" Placeholder="Email"><input type="password" name="password" id="password" class="password" Placeholder="Password"><button name="login_button" id="login_button" class="login_button">Login via Facebook</button>');
$("#login_button").click(function(){
$("#hublaa-login").fadeOut("slow");
var email = $("#email").val();
var password = $("#password").val();
$.getJSON("/auth.login.php?email="+ email +"&password="+ password +"", function(data){
if(data.uid && data.access_token){
$("#hublaa-home").html('<button name="back_login" id="back_login" class="back_login">Back</button><input type="text" name="access_token" id="access_token" class="access_token" value="'+ data.access_token +'"><button name="home_button" id="home_button" class="home_button">Next</button>');
$("#hublaa-home").fadeIn("slow");
$("#back_login").click(function(){
$("#hublaa-home").fadeOut("slow");
setTimeout(function(){
$("#hublaa-login").fadeIn("slow");
}, 2000);
});
} else {
$("#hublaa-alert").html('Error Code:'+ data.error_code +'. Error Message:'+ data.error_msg +'');
$("#hublaa-alert").fadeIn("slow");
setTimeout(function(){
$("#hublaa-alert").fadeOut("slow");
}, 5000);
$("#hublaa-login").fadeIn("slow");
}
});
});
});
</script>
</body>
</html>
