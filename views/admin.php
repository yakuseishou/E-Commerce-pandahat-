<!DOCTYPE html>
<?php session_start(); ?>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<link rel="stylesheet" href="home.css">
		<title>
			Admin
		</title>
	</head>
	<body>
		<?php require("header.php"); ?>
        <div class="admin">
		<?php
		if (isset($_SESSION['current_user']) && $_SESSION['current_user']['is_admin'] == 1)
		{
			require_once('../install/tools.php');
			$database = get_database();
			if (!isset($_SESSION['current_user'])) echo 
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
					'<br><br>Welcome '.$_SESSION['current_user']['name'].'   
					<a href="../controller/users.php?f=logout"><button class="blue user_ent">Log out</button></a>
					<br><br>
					Edit User information
					<div>
					<form method="POST" action="../controller/users.php">
						<input class="login_box" type="text" name="login"> Username<br>
						<input class="login_box" type="text" name="old">Old Login<br>
						<input class="login_box" type="text" name="name"> Name 
						<input class="login_box" type="password" name="pass"> Password 
						<input class="login_box" type="text" name="is_admin"> Admin 
						<input class="user_ent" type="submit" value="edit" name="f">
					</form></div>
					<form method="GET" action="../controller/users.php">
						<input class="login_box" type="text" name="login"> Username<br>
						<input class="user_ent" type="submit" value="del" name="f">
					</form>
					<br><br>Edit Product
					<div><form method="POST" action="../controller/users.php">
						<input class="login_box" type="text" name="old"> Old Name<br>
						<input class="login_box" type="text" name="name"> Name<br>
						<input class="login_box" type="text" name="desc"> Description<br>
						<input class="login_box" type="text" name="price"> Price<br>
						<input class="login_box" type="text" name="photo"> Photo<br>
						<input class="login_box" type="text" name="category"> Category 
						<input class="user_ent" type="submit" value="p_edit" name="f">
					</form></div>
					<br>
					<form method="GET" action="../controller/users.php">
						<input class="login_box" type="text" name="name"> Product name<br>
						<input class="user_ent" type="submit" value="del" name="f">
					</form>';
			foreach($database['purchases'] as $purchase)
			{
				echo '
<p> name: '.$purchase['login'].' date: '.$purchase['date'];
			}
				echo 	'</div>';
				}
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
