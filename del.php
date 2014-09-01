<?php
/**
 * Created by PhpStorm.
 * User: Sashko
 * Date: 31.08.14
 * Time: 19:45
 */

require 'include/config.inc.php';

$id = $_GET['id'];
$query = "DELETE FROM gallery WHERE id = $id";

if (mysqli_query($link, $query)){
    header('Location: index.php');
} else {
    exit('Ошибка при удалении фотографии');
};

?>