<?php
header('Content-Type: text/html; charset=utf-8');
define('DB_HOST', 'localhost');
define('DB_LOGIN', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'gallery');

$link = mysqli_connect(DB_HOST, DB_LOGIN, DB_PASSWORD, DB_NAME) or die(mysqli_connect_error());

mysqli_query($link, "SET NAMES 'utf8' COLLATE 'utf8_general_ci'");
mysqli_query($link, "SET CHARACTER SET 'utf8'");

require_once 'class/image.class.php';
?>
