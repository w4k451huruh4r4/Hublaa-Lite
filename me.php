<?php 
header('Content-Type: application/json');
require '/function/FBapi.php';
parse_str($_SERVER['QUERY_STRING'], $queryArray);
echo FBapi('/me', 'GET', $queryArray, false);
?>
