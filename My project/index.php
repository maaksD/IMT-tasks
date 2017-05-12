<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
	<link rel="stylesheet" href="design/css/style.css">
</head>
<body>

<nav>
  <ul class="menu">
    <?php
      include_once 'includes/navigation.php';
    ?>
  </ul>
</nav>  

<div class="leftblock">
  <?php
    include_once 'includes/categories.php';
  ?>
</div>

<div class="prod">
  <?php
    include_once 'includes/products.php';
  ?>
</div>

</body>
</html>

