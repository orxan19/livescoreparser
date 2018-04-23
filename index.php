<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</head>
<body>
 	<h4>Введите год рождения</h4>

	<?php 

 	$year = 1900;
 	echo "<select class='form-control' style='width:100px'>";
 	while ($year <= 2018) {
 		echo "<option value='$year'>$year</option>";
 		$year++;
 	}
 	echo "</select>";
 	echo "<br><br><br>";

 	echo "<table border='1' class='table table-striped table-hover'> ";
 $i = 1;
 while ($i <= 9) {
 	echo "<tr>";
 	$j = 1;
 	while ($j <= 9) {
 		echo "<td> $j * $i = " . $i * $j . "</td>";
 		$j++;
 	}
 	$i++;
 	echo "</tr>";
 }
?>


</body>
</html>

