<?php 
header('Content-Type: application/json');
require 'function/HublaaApi.php';
parse_str($_SERVER['QUERY_STRING'], $queryArray);
echo HublaaAPI('/me', 'GET', $queryArray, false);
?>
