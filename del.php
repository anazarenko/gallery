<?php

require 'include/config.inc.php';

$image = new Image();
$image->removePhoto($_GET['id']);

?>