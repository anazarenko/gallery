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

<form action='add-photo.php' method='post' enctype='multipart/form-data'>
    <fieldset>
        <legend>Загрузить фото</legend>
        <input type="FILE" name="fupload">
        <span class="help-block">Размер изображения не должен превышать 1 МБ. Доступные форматы jpg, jpeg или png.</span>
        <textarea name="comment" cols="40" placeholder="Введите описание…" maxlength="200"></textarea>
        <span class="help-block">Максимум 200 символов.</span>
        <input type="submit" class="btn">
    </fieldset>
</form>
<section id="sortBy">
    <a href="index.php" <? if($_GET['sortBySize'] != 1) echo "class='active'" ?> >[Сортировать по дате загрузки]</a>
    <a href="index.php?sortBySize=1" <? if($_GET['sortBySize'] == 1) echo "class='active'" ?> >[Сортировать по размеру изображения]</a>
</section>
<section id="main-container">
    <? $image->main($_GET['sortBySize']); ?>
</section>

<section id="showImage">
   <div></div>
</section>

</body>
</html>