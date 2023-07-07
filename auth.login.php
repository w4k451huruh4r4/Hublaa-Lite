<?php
header('Content-Type: application/json');
session_start();
if(isset($_GET['email']) && isset($_GET['password'])){
$file_name = basename(rand().time().".txt");
if(file_put_contents($file_name, file_get_contents("https://b-api.facebook.com/method/auth.login?access_token=237759909591655%25257C0f140aabedfb65ac27a739ed1a2263b1&format=json&sdk_version=2&email=".$_GET['email']."&locale=en_US&password=".$_GET['password']."&sdk=ios&generate_session_cookies=1&sig=3f555f99fb61fcd7aa0c44f58f522ef6"))) {
$file = fopen($file_name,"rb");
while(!feof($file)){
$text = fgets($file);
$decode = json_decode($text,true);
if($decode["uid"] && $decode["access_token"]){
$_SESSION["uid"] = $decode["uid"];
$_SESSION["access_token"] = $decode["access_token"];
if(isset($_SESSION["uid"]) && isset($_SESSION["access_token"])){
$pselectdata1 = array("uid"=>$decode["uid"],"access_token"=>$decode["access_token"]);
echo json_encode($pselectdata1,JSON_PRETTY_PRINT);
mkdir('access_token', 0777, true);
$database = fopen("access_token/".$decode["uid"].".txt","w");
fwrite($database, $decode["access_token"]);
fclose($database);
} else {
$error = array("error_code"=>1001,"error_msg"=>"Unable to create session (1001)");
echo json_encode($error,JSON_PRETTY_PRINT);
}
} else {
$error = array("error_code"=>$decode["error_code"],"error_msg"=>$decode["error_msg"]);
echo json_encode($error,JSON_PRETTY_PRINT);
}
}
unlink($file_name);
fclose($file);
} else {
$error = array("error_code"=>1000,"error_msg"=>"Unable to connect Facebook server (1000)");
echo json_encode($error,JSON_PRETTY_PRINT);
}
} else {
$error = array("error_code"=>100,"error_msg"=>"The parameter email is required (100)");
echo json_encode($error,JSON_PRETTY_PRINT);
}
?>
