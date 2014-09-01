<?php
/**
 * Created by PhpStorm.
 * User: Sashko
 * Date: 31.08.14
 * Time: 15:41
 */

require 'include/config.inc.php';

if (!empty($_FILES['fupload']['name'])) { // Отправлялись ли файлы
    $fupload = $_FILES['fupload']['name'];
} else {
    exit('Ошибка при загрузке изображения');
}

if ($_FILES['fupload']['size'] > 1048576) { // Размер файла
    exit('Большой размер файла');
}

if (preg_match('/[.](jpg)|(JPG)|(jpeg)|(JPEG)|(png)|(PNG)$/', $_FILES['fupload']['name'])) {

    // Каталог, в который мы будем принимать файл:
    $uploadfile = 'img/'.basename($_FILES['fupload']['name']);

    // Копируем файл из каталога для временного хранения файлов:
    if (copy($_FILES['fupload']['tmp_name'], $uploadfile)){
    } else {
        exit('Ошибка при загрузке изображения');
    }
} else {
    exit('Недопустимый формат данных');
}

$comment = addslashes(htmlspecialchars(strip_tags($_POST['comment'])));
if (empty($comment))
    $comment = 'Нет описания';
$imgSize = $_FILES['fupload']['size'];
$date = date("d-m-Y");

$query = "INSERT INTO gallery(img, comment, size, date)
                 VALUES('$uploadfile', '$comment', $imgSize, '$date')";
if (mysqli_query($link, $query)){
    header('Location: index.php');
} else {
    exit('Ошибка при загрузке изображения');
};

?>