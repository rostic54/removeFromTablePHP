<?php

$conn = mysqli_connect("localhost", 'root', 'saymon', "employee");
mysqli_set_charset($conn, "utf8");


if(mysqli_connect_errno()){
	echo "Error";
}

$query = "SELECT * FROM list ;";

$info = mysqli_query($conn, $query);

$act = $_GET["del"];
echo "$act";
if( $act ){
    echo "$act";
	$queryDel = "DELETE FROM list WHERE id = $act; ";
	mysqli_query($conn, $queryDel); 
} 
//print_r($info);
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
	<style>
	table{
		border-collapse: collapse;
		font-size: 18px;
	}
	td{
		border: 1px solid gray;		
		margin: 0;
		padding: 10px;
	}
</style>
</head>
<body>
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
			echo"<td><a href='test2.php?del=$id'>Удалить</a></td>";
			echo "</tr>";
		}
		?>
	</table>	

	
</body>
</html>