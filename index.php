<?php

require 'include/config.inc.php';
if ($_GET['sortBySize'] == 1){
    $query = "SELECT * FROM gallery ORDER BY size DESC";
} else {
$query = "SELECT * FROM gallery ORDER BY timestamp DESC";
}
$result = mysqli_query($link, $query);

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
    <?
        while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
PRINT <<<HERE

    <div class="pic">
        <div class="pic-area"><img src="$row[img]"></div>
        <div class="date"><strong>Дата загрузки: </strong>$row[date]</div>
        <div class="comment"><strong>Описание: </strong>$row[comment]</div>
        <form action='edit.php' method='post'>
            <textarea name="comment" cols="20" rows="2" maxlength="200">$row[comment]</textarea><br>
            <input type="hidden" name="id" value="$row[id]">
            <input type="submit" class="btn">
        </form>
        <span class="edit">Редактировать</span>
        <a href="del.php?id=$row[id]"><span class="del">Удалить</span></a>
    </div>

HERE;
        }
        mysqli_free_result($result);
        mysqli_close($link);
    ?>

</section>

<section id="showImage">
   <div></div>
</section>

</body>
</html>