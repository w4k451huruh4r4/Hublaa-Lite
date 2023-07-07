<?php 
function FBapi($url, $method, $data) {
$curl = curl_init();
switch ($method) {
case "POST":
curl_setopt($curl, CURLOPT_POST, 1);
if ($data)
curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
break;
case "PUT":
curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "PUT");
if ($data)
curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
break;
default:
if ($data)
$url = sprintf("%s?%s", "https://graph.facebook.com".$url, http_build_query($data));
}
curl_setopt($curl, CURLOPT_URL, $url);
curl_setopt($curl, CURLOPT_HTTPHEADER, array(
'Content-Type: application/json',
));
curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
$result = curl_exec($curl);
if($result) {
$decode = json_decode($result, true);
return json_encode($decode,JSON_PRETTY_PRINT);
} else {
$error = array("error_code"=>1000,"error_msg"=>"Unable to connect Facebook server (1000)");
return json_encode($error,JSON_PRETTY_PRINT);
}
curl_close($curl);
}
?>
