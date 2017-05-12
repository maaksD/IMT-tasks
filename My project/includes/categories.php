<?php
include_once 'data/data_categories.php';

$categories_data = unserialize($data_categories);
$full_arr = array();

	if($categories_data) {//Проверяем, есть ли данные
		foreach ($categories_data as $value) {//Переносим все данные в новый массив, ключ=id
			$full_arr[$value->id] = $value;
			unset($value);
		}
	} 

$parent_arr = array();
	//Переносим в новый массив родительские элементы, у которых parent_id=0
	foreach ($full_arr as $alls) {
		if ($alls->parent_id==0) {
			$parent_arr[$alls->id] = $alls;
			//Удаляем использованные элементы из начального массива, что-бы уменьшить кол-во итераций
			unset($full_arr[$alls->id]);
		}
		unset($value);
	}

function makeTree(&$start, $finish){
	foreach ($finish as $value) {
		foreach ($start as $val) {
			if ($val->parent_id==$value->id) {
				$finish[$value->id]->subcategories[$val->id] = $val;
				//Удаляем использованные элементы из начального массива, что-бы уменьшить кол-во итераций
				unset($start[$val->id]);
			} else if($finish[$value->id]->subcategories) {
			  //Если подкатегория не пустая, то выполняем рекурсию
			  makeTree($start, $finish[$value->id]->subcategories);
			}
		}
	}
	return $finish;
}

makeTree($full_arr, $parent_arr);

function printTree($data_arr){
	echo "<ul>";
		foreach ($data_arr as $key => $value) {
			echo "<li>".$value->name."</li>";
				if($value->subcategories){
					printTree($value->subcategories);
				}
		}
	echo "</ul>";
}

printTree($parent_arr);

?>