<?php
header('Content-Type: application/json');

function signed_request_url($email,$password) {
$query = array(
"api_key" => "882a8490361da98702bf97a021ddc14d",
"credentials_type" => "password",
"email" => $email,
"format" => "JSON",
//"generate_machine_id" => "1",
//"generate_session_cookies" => "1",
"locale" => "en_US",
"method" => "auth.login",
"password" => $password,
"return_ssl_resources" => "0",
"v" => "1.0"
);
$sig = "";
foreach($query as $key => $value) {
$sig .= "$key=$value";
}
$sig .= "62f8ce9f74b12f84c123cc23437a4a32";
$sig = md5($sig);
$query['sig'] = $sig;
return "https://api.facebook.com/restserver.php?". http_build_query($query)."&sig=".$query['sig'];
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
