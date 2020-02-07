<!DOCTYPE html>
<?php session_start(); ?>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<script type="text/javascript">
			let reveal_confirm = () => {
				document.querySelector("div.hidden").classList.remove("hidden");
				}
		</script>
		<link rel="stylesheet" href="home.css">
		<title>
			Menu
		</title>
	</head>
	<body>
		<?php require("header.php"); ?>
		<div class="login">
		<?php if (!isset($_SESSION['current_user'])) echo 
			'<br><br>Please enter your Username and Password:<br><br>
			<form method="POST" action="../controller/users.php">
				<input class="login_box" type="text" name="login"> Username<br>
				<input class="login_box" type="password" name="pass"> Password 
				<input class="user_ent" type="submit" value="Login" name="f">
			</form>
			<br><br>
				Not a User?
				<a href="newuser.php">Click Here</a>
				To create a New Account!
			<br><br>';
			else
			{
				echo
				'<br><br>Welcome '.$_SESSION['current_user']['name'].'<br><br>
				Edit information
				<div><form method="POST" action="../controller/users.php">
					<input class="login_box" type="text" name="login"> Username<br>
					<input class="login_box" type="text" name="name"> Name 
					<input class="login_box" type="password" name="pass"> Password 
					<input class="user_ent" type="submit" value="edit" name="f">
				</form></div><br><br>
				<button onclick="reveal_confirm()" class="red user_ent">Delete Account</button>
				<button class="user_ent">View cart</button>
			<br><br>
				<a href="../controller/users.php?f=logout"><button class="blue user_ent">Log out</button></a>';
			}
?>
		</div>
		<?php
		if (isset($_SESSION['current_user']))
		{
			$login = trim($_SESSION['current_user']['login']);
			echo'
			<div class="login hidden">
				<p class="centered">Are you sure?</p>
				<a href="../controller/users.php?f=del&login='.$login.'"><button class="red user_ent">Confirm</button></a>
			</div>'; }?>
	</body>
</html>
