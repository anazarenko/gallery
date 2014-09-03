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
    <script src="js/jquery.form.js"></script>
    <script src="js/gallery.js"></script>
    <script></script>
</head>
<body>

<section id="menu">
    <span class="btn upload">Загрузить фото</span>
    <span id="sortByDate" onclick="sort($(this), 1)" class="btn active">Сортировать по дате загрузки</span>
    <span id="sortBySize" onclick="sort($(this), 2)" class="btn">Сортировать по размеру изображения</span>
    <form action="add-photo.php" id="upload-form" method='post' enctype='multipart/form-data'>
        <fieldset>
            <legend>Загрузить фото</legend>
            <input type="FILE" name="fupload">
            <span class="help-block">Размер изображения не должен превышать 1 МБ. Доступные форматы jpg, jpeg или png.</span>
            <textarea name="comment" cols="40" placeholder="Введите описание…" maxlength="200"></textarea>
            <span class="help-block">Максимум 200 символов.</span>
            <input id="upload-btn" type="submit">
        </fieldset>
    </form>
</section>

<section id="main-container"></section>

<section id="showImage">
   <div></div>
</section>

</body>
</html>