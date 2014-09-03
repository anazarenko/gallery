<?
class Image{

    public $link;

    function __construct(){
        $this->link = mysqli_connect("localhost", "root", "", "gallery") or die(mysqli_connect_error());
    }
    function __destruct(){
        mysqli_close($this->link);
    }
    function main(){

        $query = "SELECT * FROM gallery ORDER BY timestamp DESC";
        $result = $this->db($query);
        $photos = mysqli_fetch_all($result, MYSQLI_ASSOC);

        echo json_encode($photos);

    }
    function addPhoto($file, $comment){
        if (!empty($file['fupload']['name'])) { // Отправлялись ли файлы
            $fupload = $file['fupload']['name'];
        } else {
            exit('Ошибка при загрузке изображения');
        }

        if ($file['fupload']['size'] > 1048576) { // Размер файла
            exit('Большой размер файла');
        }

        if (preg_match('/[.](jpg)|(JPG)|(jpeg)|(JPEG)|(png)|(PNG)$/', $file['fupload']['name'])) {

            // Каталог, в который мы будем принимать файл:
            $uploadfile = 'img/'.basename($file['fupload']['name']);

            // Копируем файл из каталога для временного хранения файлов:
            if (copy($file['fupload']['tmp_name'], $uploadfile)){
            } else {
                exit('Ошибка при загрузке изображения');
            }
        } else {
            exit('Недопустимый формат данных');
        }

        $comment = addslashes(htmlspecialchars(strip_tags($comment)));
        if (empty($comment))
            $comment = 'Нет описания';
        $imgSize = $_FILES['fupload']['size'];
        $date = date("d-m-Y");

        $query = "INSERT INTO gallery(img, comment, size, date)
                 VALUES('$uploadfile', '$comment', $imgSize, '$date')";
        $result = $this->db($query);
        if ($result){
            echo "1";
        }
    }
    function removePhoto($id){
        $query = "DELETE FROM gallery WHERE id = $id";
        $result = $this->db($query);

        if ($result){
            echo 1;
        } else {
            echo 0;
        }
    }
    function editComment($id, $newComment){
        $newComment = addslashes(htmlspecialchars(strip_tags($newComment)));
        if (empty($newComment))
            $newComment = 'Нет описания';
        $query = "UPDATE gallery SET comment='$newComment' WHERE id = $id";
        $result = $this->db($query);
        if ($result){
            header('Location: index.php');
        } else {
            exit('Ошибка при редактировании описания');
        };
    }
    function showPhoto($row){
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
        <span class="del-button del" onclick='removePhoto($(this), $row[id])'>Удалить</span>
    </div>

HERE;
    }
    function db($query){
        $result = mysqli_query($this->link, $query);
        return $result;
    }
}
