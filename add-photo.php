<?php
/**
 * Created by PhpStorm.
 * User: Sashko
 * Date: 31.08.14
 * Time: 15:41
 */

require 'include/config.inc.php';

$image = new Image();

$image->addPhoto($_FILES, $_POST['comment']);

?>