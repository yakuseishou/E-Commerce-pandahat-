<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<link rel="stylesheet" href="home.css">
		<title>
			Menu
		</title>
	</head>
	<body>
		<?php require("header.php"); ?>
		<div class="login">
			<br><br>
            New Customer?<br>
            'Create your accout here (〇*^_^)ゞ★☆'<br>
            <br>
			<form method="POST" action="../controller/users.php">
				<input class="user_box" type="text" name="name"> Name<br>
				<input class="user_box" type="text" name="login"> Username<br>
				<input class="user_box" type="password" name="pass"> Password 
				<input class="user_ent" type="submit" value="Create" name="f">
			</form>
            <br><br>
				Already a User?
                <a href="login.php">Click Here</a>
                To Login!
                <br><br>
		</div>
	</body>
</html>
