<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
	<link rel="stylesheet" href="style.css">
</head>
<body>

<div class="cl">
    <div class="left">
        <div>
            <h3>Загрузите изображение</h3>
                <form enctype="multipart/form-data" method="POST">
                  <input type="file" name="userfile[]" multiple>
                  <input type="submit" name="upload" value="Ok">
                </form>
        </div>

        <div class="res">

<?php

function translit($string) {
    $converter = array(
        'а' => 'a',   'б' => 'b',   'в' => 'v',
        'г' => 'g',   'д' => 'd',   'е' => 'e',
        'ё' => 'e',   'ж' => 'zh',  'з' => 'z',
        'и' => 'i',   'й' => 'y',   'к' => 'k',
        'л' => 'l',   'м' => 'm',   'н' => 'n',
        'о' => 'o',   'п' => 'p',   'р' => 'r',
        'с' => 's',   'т' => 't',   'у' => 'u',
        'ф' => 'f',   'х' => 'h',   'ц' => 'c',
        'ч' => 'ch',  'ш' => 'sh',  'щ' => 'sch',
        'ь' => '\'',  'ы' => 'y',   'ъ' => '\'',
        'э' => 'e',   'ю' => 'yu',  'я' => 'ya',
        'А' => 'A',   'Б' => 'B',   'В' => 'V',
        'Г' => 'G',   'Д' => 'D',   'Е' => 'E',
        'Ё' => 'E',   'Ж' => 'Zh',  'З' => 'Z',
        'И' => 'I',   'Й' => 'Y',   'К' => 'K',
        'Л' => 'L',   'М' => 'M',   'Н' => 'N',
        'О' => 'O',   'П' => 'P',   'Р' => 'R',
        'С' => 'S',   'Т' => 'T',   'У' => 'U',
        'Ф' => 'F',   'Х' => 'H',   'Ц' => 'C',
        'Ч' => 'Ch',  'Ш' => 'Sh',  'Щ' => 'Sch',
        'Ь' => '\'',  'Ы' => 'Y',   'Ъ' => '\'',
        'Э' => 'E',   'Ю' => 'Yu',  'Я' => 'Ya',
    );
    return strtr($string, $converter);
}

$arr_valid = array("png","gif","jpg","jpeg");

    if($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_FILES['userfile']['name'])) {
        for($i=0; $i<count($_FILES['userfile']['name']); $i++){
            if(!empty($_FILES['userfile']['tmp_name'][$i])){
                $finfo = finfo_open(FILEINFO_MIME_TYPE);
                $type = finfo_file($finfo, $_FILES['userfile']['tmp_name'][$i]);
                /* закрыть соединение */
                finfo_close($finfo);
                echo $type;

                $ext = strtolower(pathinfo($_FILES['userfile']['name'][$i],PATHINFO_EXTENSION));
                $base_name = pathinfo($_FILES['userfile']['name'][$i],PATHINFO_FILENAME);
                echo $ext;
                    if (strpos($type, 'image') === false) die('Можно загружать только изображения!');
                    if(!in_array($ext, $arr_valid)) die('Можно загружать только изображения - .png, .gif, .jpg, .jpeg');

                    $translit_name = md5(translit($base_name));

            }


            if(is_uploaded_file($_FILES['userfile']['tmp_name'][$i])) {
                echo "Файл успешно загружен в папку: <br>". $_FILES['userfile']['tmp_name'][$i] . "<br>";
            } else {
                echo "Ошибка загрузки файла!";
            }

            @mkdir("uploads", 0777);
            move_uploaded_file($_FILES['userfile']['tmp_name'][$i], "uploads/".$translit_name.".".$ext);
 
        }

    }
?>

        </div> <!--end div class="res"-->
    </div> <!--end div class="left"-->

    <div class="right">
        <h3>Папка с изображениями. </h3>
	       <div>
<?php

$dir = 'uploads/';
$files = scandir($dir);
	for ($i = 0; $i < count($files); $i++) { // Перебираем все файлы
        if (($files[$i] != ".") && ($files[$i] != "..")) { // Текущий каталог и родительский пропускаем
            $path = $dir.$files[$i]; // Получаем путь к картинке
            echo "<a href='$path'>"; // Делаем ссылку на картинку
            echo "<img src='$path' alt='' width='100' />"; // Вывод превью картинки
            echo "</a>"; 
        }
    }
?>
	       </div>
    </div> <!--end div class="right"-->
</div> <!--end div class="cl"-->
	
</body>
</html>