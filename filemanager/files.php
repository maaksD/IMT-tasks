<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<body>

<!-- Задача 1 -->
<form method="POST">
	<input type="text" name="name">
	<input type="submit" value="Ok">
</form>

<?php
	$file = fopen("/OpenServer/domains/files/file.txt", "a+");
	fwrite($file, $_POST['name']." ");
	fwrite($file, date("Y-m-d H:i:s", time())." ");
	fwrite($file,"http://".$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI']. "\r\n");
	fclose($file);

?>

<!-- Задача 2 -->
<?php
$file2 = fopen("/OpenServer/domains/files/file2.txt", "w");
fclose($file2);
$file2 = fopen("/OpenServer/domains/files/file2.txt", "a+");
	for($i=0;$i<10;$i++){
		$numb = rand(1, 500);
		fwrite($file2, $numb."\r\n");
	}
fclose($file2);

$file2 = fopen("/OpenServer/domains/files/file2.txt", "a+");
$arr = file("/OpenServer/domains/files/file2.txt");
$even = fopen("/OpenServer/domains/files/even.txt", "a+");
$odd = fopen("/OpenServer/domains/files/odd.txt", "a+");

	foreach ($arr as $value) {
	 	if($value%2==0){
	 		fwrite($even, $value);
	 	} else {
	 		fwrite($odd, $value);
	 	}
	}

fclose($file2);
fclose($even);
fclose($odd);
	 



?>
	
</body>
</html>