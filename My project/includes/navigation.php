<?php
include_once 'data/data_pages.php';

//Десериализируем массив и сохраняем в новую переменную. 
$new_arr = array();
$new_arr = unserialize($data_pages);
 
foreach ($new_arr as $value) {
  if($value->visible == 1){//Проверяем параметр visible у эл-тов массива
    $url = $value->url;//переменная со ссылкой на страницу
  	echo "<li><a href=\"$url.php\">". $value->name ."</a></li>";//Вывод пункта меню со ссылкой на страницу
  }
}
  
?>