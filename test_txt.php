<?php
$_path = "https://lineled.herokuapp.com/light.txt";
$txt = 	'{"light": "on"}';	
$file = fopen($_path, 'w');
fwrite($file, $txt);
fclose($file);
?>
