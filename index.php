<?php

require 'include/config.inc.php';

$image = new Image();

?>


<!DOCTYPE html>
<html>
<head>
    <title>Галерея</title>
    <meta charset="utf-8">
    <link href="style/reset.css" rel="stylesheet">
    <link href="style/bootstrap.css" rel="stylesheet">
    <link href="style/style.css" rel="stylesheet">
    <script src="js/jquery.js"></script>
    <script src="js/gallery.js"></script>
    <script></script>
</head>
<body>

<section id="menu">
    <span class="btn upload">Загрузить фото</span>
    <a href="index.php"><span class="btn <? if($_GET['sortBySize'] != 1) echo "active" ?>">Сортировать по дате загрузки</span></a>
    <a href="index.php?sortBySize=1"><span class="btn <? if($_GET['sortBySize'] == 1) echo "active" ?>">Сортировать по размеру изображения</span></a>
    <form action='add-photo.php' id="upload-form" method='post' enctype='multipart/form-data'>
        <fieldset>
            <legend>Загрузить фото</legend>
            <input type="FILE" name="fupload">
            <span class="help-block">Размер изображения не должен превышать 1 МБ. Доступные форматы jpg, jpeg или png.</span>
            <textarea name="comment" cols="40" placeholder="Введите описание…" maxlength="200"></textarea>
            <span class="help-block">Максимум 200 символов.</span>
            <input type="submit" class="btn">
        </fieldset>
    </form>
</section>

<section id="main-container">
    <? $image->main($_GET['sortBySize']); ?>
</section>

<section id="showImage">
   <div></div>
</section>

</body>
</html>