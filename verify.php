<?php
$access_token = 'wBHvjHovGYM4KifyfM5PLgD6ypWoYU/lqofs92u2IF8zCkif9FidQseU88yTHs8cUG0egfLAS+zxGN4zOzl7yr764Z/KMq7Lch2KCT/hDRt2v6Uq/z5WLkw+DHqxluY1VKbBZw01xmmA6ohCESM6vAdB04t89/1O/w1cDnyilFU=';

$url = 'https://api.line.me/v1/oauth/verify';

$headers = array('Authorization: Bearer ' . $access_token);

$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
$result = curl_exec($ch);
curl_close($ch);

echo $result;
