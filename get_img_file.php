<?php
ini_set("display_errors",1);
//error_report(E_ALL);
//$id = $_GET['id'];
$img_url = $_GET['img_url'];;
$img = file_get_contents($img_url);
echo $img;
?>
