<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<link rel="stylesheet" href="home.css">
		<title>
			Home
		</title>
	</head>
	<body>
		<?php require("header.php"); ?>
		<img class="home" src="../resources/home.jpg">
		<div class="new"><a name="new">
			New Customer?<br>
			'Create your accout here (〇*^_^)ゞ★☆'<br>
			<form method="POST" action="../controller/users.php">
				<input class="user_box" type="text" name="name"> Name<br>
				<input class="user_box" type="text" name="login"> Username<br>
				<input class="user_box" type="password" name="pass"> Password 
				<input class="user_ent" type="submit" value="Create" name="f">
			</form>
		</div>
	</body>
</html>
