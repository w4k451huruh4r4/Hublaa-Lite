<?php 
header('Content-Type: application/json');
require 'fbGraphExplorer.php';
parse_str($_SERVER['QUERY_STRING'], $queryArray);
echo fbGraphExplorer('GET', 'https://graph.facebook.com/me', $queryArray, false);
?>
