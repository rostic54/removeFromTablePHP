<?php

$conn = mysqli_connect("localhost", 'root', 'saymon', "employee");
mysqli_set_charset($conn, "utf8");



if(mysqli_connect_errno()){
	echo "Error";
}

$query = "SELECT * FROM list ;";

if( isset($_GET['del']) ){

	$queryDel = "DELETE FROM list WHERE id = " . $_GET['del']  ;
	mysqli_query($conn, $queryDel); 
} 

if( isset($_POST['name'])){

	$queryAdd = "INSERT INTO list (name, age, salary) VALUES ('" . $_POST['name'] ."', " .$_POST['age'] .", " .$_POST['salary'] .")  ;";
	mysqli_query($conn, $queryAdd);
	header("Location: http:/PHP_Start/test2.php");

}

if( isset($_GET['erase']) ){

	$arrId = $_GET['erase'];
	foreach ($arrId as $key => $value) {

		$queryGroupErase = "DELETE FROM list WHERE id IN (" . $value . ");";
		mysqli_query($conn, $queryGroupErase);
	}
}

$info = mysqli_query($conn, $query);

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
	<link rel="stylesheet" type="text/css" href="css/test2.css">
</head>
<body>
	<div class="search-block">
		<form action="test2.php" class="search" method="GET">
			<h4>Что бы узнать работников с интересующей зарплатой, введить сумму:</h4>
			<div><input type="text" placeholder="Сумма" name="find"></div>
			<div><button>Запрос</button></div>
		</form>
		<?php


		if( isset( $_GET['find'] ) ){
			$queryFind = " SELECT * FROM list WHERE salary = " . $_GET['find'] ;
			$found = mysqli_query($conn, $queryFind);
			echo "<table class='matches'>";

			while( $person = mysqli_fetch_assoc($found) ){
				echo "<tr>";
				foreach ($person as $key => $value) {
					echo "<td> $value </td>";	
				}		
				echo "</tr>";	
			}

			echo "</table>";
		}
		?>
	</div>
	<form action="test2.php" method="get" name="erase">
		<table>

			<tr>
				<th>ID</th>
				<th>name</th>
				<th>age</th>
				<th>salary</th>
				<th>remove</th>

			</tr>

			<?php
			while( $elem = mysqli_fetch_assoc($info) ){

				echo "<tr>";
				foreach ($elem as $key => $value) {
					echo "<td> $value </td>";
					$id = $elem['id'];
				}
				echo"<td><label><input type='checkbox' name='erase[]' value='$id'>Удалить</label></td>";
				echo "</tr>";
			}
			?>
			<tr><td colspan="5" class="table-btn"><button name="fire">Fire these neglegent!</button></td></tr>

		</table>	
	</form>
	<form action="test2.php" method="POST">
		<div><input type="text" name="name" placeholder="Имя"></div>
		<div><input type="text" name="age" placeholder="Возраст"></div>
		<div><input type="text" name="salary" placeholder="Зарплата"></div>
		<div><button>Добавить</button></div>
	</form>

	
</body>
</html>