<?php
header('Content-Type: application/json');

function signed_request_url($email,$password) {
$query = array(
"format" => "JSON",
"sdk_version" => "2",
"email" => $email,
"locale" => "en_US",
"password" => $password,
"sdk" => "ios",
"generate_session_cookies" => "1",
"sig" => "3f555f99fb61fcd7aa0c44f58f522ef6",
);
return "https://b-api.facebook.com/method/auth.login?access_token=237759909591655%25257C0f140aabedfb65ac27a739ed1a2263b1&". http_build_query($query);
}

if(empty($_GET['email'])) {
$error = array("error_code"=>100,"error_msg"=>"The parameter email is required (100)");
echo json_encode($error,JSON_PRETTY_PRINT);
} elseif(empty($_GET['password'])) {
$error = array("error_code"=>100,"error_msg"=>"The parameter password is required (100)");
echo json_encode($error,JSON_PRETTY_PRINT);
} elseif(strlen($_GET['email']) < 4 || strlen($_GET['email']) > 50 || strlen($_GET['password']) < 6 ) {
$error = array("error_code"=>100,"error_msg"=>"Invalid email or password (100)");
echo json_encode($error,JSON_PRETTY_PRINT);
} else {
$json = array("url"=>signed_request_url($_GET['email'],$_GET['password']));
echo json_encode($json,JSON_PRETTY_PRINT);
}
?>
