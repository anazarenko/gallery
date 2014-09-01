<?php

require 'include/config.inc.php';

$image = new Image();
$image->editComment($_POST['id'], $_POST['comment']);

?>