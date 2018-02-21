<?php

$conn = mysqli_connect("localhost", 'root', 'saymon', 'comments');
mysqli_set_charset($conn, "utf8");

if(mysqli_connect_errno()){
	echo "Error";
}

$query = "SELECT `name`, `text` FROM review LIMIT 10;";
$querytime = "SELECT DATE_FORMAT(date, '%d-%m-%Y %H:%i:%s') AS new_date FROM review;";

if( isset($_POST['name']) ){
	

	$queryadd = "INSERT INTO review (`name`, `text`) VALUES ('" . $_POST['name'] . "','" . $_POST['txt'] ."');";
	mysqli_query($conn, $queryadd);
	header("Location: http:/PHP_Start/comments.php");

	
}

$archive = mysqli_query($conn, $query);
$date = mysqli_query($conn, $querytime);
?>

<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="UTF-8">
	<title>comments</title>
	<link type="text/css" rel="stylesheet" href="css/comments.css">
</head>
<body>
	<section>
		<h2>Гостевая книга</h2>

		<?php
		while( $piece = mysqli_fetch_assoc($archive) ){
			$time = mysqli_fetch_assoc($date);
			
           /* echo "<pre>";  
			var_dump($piece);
			echo "</pre>";*/


			echo "<div><span>$time[new_date]</span>
			<span>$piece[name]</span>
			</div>
			<p>$piece[text]</p>";
		}

		?>

		<form action="comments.php" method="POST" name="main">
			<div class="success"></div>
			<div>
				<input type="text" placeholder="Ваше имя" name="name" required>
			</div>
			<div><textarea rows="10" placeholder="Ваш отзыв" name="txt" required></textarea></div>
			<div><button class="btn">Сохранить</button></div>			
		</form>
	</section>
	<script src="js/comments.js"></script>
</body>

</html>