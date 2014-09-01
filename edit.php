<?php
/**
 * Created by PhpStorm.
 * User: Sashko
 * Date: 31.08.14
 * Time: 19:33
 */

require 'include/config.inc.php';

$comment = addslashes(htmlspecialchars(strip_tags($_POST['comment'])));
if (empty($comment))
    $comment = 'Нет описания';
$id = $_POST['id'];
$query = "UPDATE gallery SET comment='$comment' WHERE id = $id";

if (mysqli_query($link, $query)){
    header('Location: index.php');
} else {
    exit('Ошибка при изменении описания');
};

?>