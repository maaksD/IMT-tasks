<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
	<style>
		ul{
			list-style-type: none;
		}
		li{
			padding: 0 10px;
		}
	</style>
</head>
<body>
	<!-- Задача 1. -->
<?php
	function getTable($col, $row, $color=null){
		echo "<table border='1'bordercolor='$color' cellspacing='0'>";
	  for($i=1; $i<=$row; $i++){
	  	echo "<tr>";
      	for($j=1; $j<=$col; $j++){
      		echo "<td>";
        	echo "<font color='$color'>$j*$i=".$j*$i." ";
        	echo "</td>";
      	}
      echo "</tr>";
	  }
	  echo "</table>";
	}
	getTable(5,7,green);
  getTable(7,8,red);
	getTable(10,10,blue);
?>

<!-- Задача 2. -->
<?php
$menu = array(
  'main' => 'Главная',
  'about' => 'О нас',
  'productions' => 'Товары',
  'contacts' => 'Контакты',
  'new' => 'Новинки'

);

function mainMenu($arr, $type){
	if ($type) {
		echo "<nav><ul>";
			foreach ($arr as $value) {
  			echo "<li><a href='#' alt=''>". $value. "</a></li>";
  		}
  	echo "</nav></ul>";
	} else {
 		echo "<nav><ul>";
	  	foreach ($arr as $value) {
  			echo "<li style='display: inline-block;'><a href='#' alt=''>". $value. "</a></li>";
    	}
  	echo "</nav></ul>";
  } 
}

mainMenu($menu, 1);
mainMenu($menu, 0);

?>


<!-- Задача 4 -->

<?

require_once 'data/categories_array.php';

$categories_data = unserialize($clear_categories);

$parent_arr = array();
$full_arr = array();

if($categories_data) {//Проверяем, есть ли данные
	foreach ($categories_data as $value) {//Переносим все данные в новый массив, ключ=id
		$full_arr[$value->id] = $value;
		unset($value);
	}
} 

//Переносим в новый массив родительские элементы, у которых parent_id=0
foreach ($full_arr as $alls) {
	if ($alls->parent_id==0) {
		$parent_arr[$alls->id] = $alls;
		unset($full_arr[$alls->id]);//Удаляем использованные из начального массива, что-бы уменьшить кол-во итераций
	}
	unset($value);
}

function makeTree(&$start, $finish){
	foreach ($finish as $value) {
		foreach ($start as $val) {
			if ($val->parent_id==$value->id) {
				$finish[$value->id]->subcategories[$val->id] = $val;
				unset($start[$val->id]);//Удаляем использованные из начального массива, что-бы уменьшить кол-во итераций
			} else if($finish[$value->id]->subcategories) {//Если 		подкатегория не пустая, то выполняем рекурсию
				makeTree($start, $finish[$value->id]->subcategories);
			}
		}
	}
	return $finish;
}

makeTree($full_arr, $parent_arr);

print_r($parent_arr);

?>



</body>
</html>