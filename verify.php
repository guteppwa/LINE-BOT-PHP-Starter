<?php
$access_token = '/NSAPdEL4qw4NIYQvP0zxZfwRvv8Cq331Z9GUO6stPjb3VqzwwxE3MVFARvEMtny8RJL0j+6h1xTIy3ifB9jP3cL5hYG8GQfSTRU2RK6EAq06hxOvbZs+HkBC9R/m4TFJ4eRLoXTAD9umrOhGOzffAdB04t89/1O/w1cDnyilFU=';

$url = 'https://api.line.me/v1/oauth/verify';

$headers = array('Authorization: Bearer ' . $access_token);

$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
$result = curl_exec($ch);
curl_close($ch);

echo $result;
