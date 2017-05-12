<?php
include_once 'data/data_products.php';

// Десериализируем массив и сохраняем в новую переменную.
$prod_arr = array();
$prod_arr = unserialize($data_products);
          
$count = 0;//счетчик
  foreach ($prod_arr as $value) {
    if($value->visible == 1){  //Проверяем параметр visible
      echo "<div class='product'>"; //Блок товара
        echo "<img class='prodimage' src='images/delivery.png' alt='Товар'>"; //Изображение товара
        echo "<div class='name'>".$value->name."</div>"; //Название товара
        echo "<div class='date'>"."Дата: ".date("M Y", strtotime($value->created))."</div>"; //Дата создания товара
        $arr_temp = $value->variants; //Вложенный массив
          foreach ($arr_temp as $value) {
            echo "<div class='price'>"."Цена: ". $value->price."</div>"; //Цена товара
          } 
          foreach ($arr_temp as $value) {
            echo "<div class='stock'>"."На складе: ". $value->stock." штук"."</div>"; //Остаток на складе
          }     
      echo "</div>";  
        
    //После каждого 3-его товара перенос строки
    $count++;
      if($count%3==0){
        echo "<br>";
      }
  }
}

?>