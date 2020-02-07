<?php

include_once("../model/users.php");
session_start();

if (isset($_POST['f']))
{
	 if ($_POST['f'] == "p_edit")
	{
		if (isset($_POST['old']) && isset($_POST['desc']) && isset($_POST['name']) && isset($_POST['price']) && isset($_POST['photo']) && isset($_POST['category']) && $_SESSION['current_user']['is_admin'] == 1 && $_SESSION['current_user']['login'])
		{
			$data = array(
				'old' => trim(strip_tags($_POST['old'])),
				'name' => trim(strip_tags($_POST['name'])),
				'desc' => trim(strip_tags($_POST['desc'])),
				'price' => trim(strip_tags($_POST['price'])),
				'photo' => trim(strip_tags($_POST['photo'])),
				'category' => array(
					0 => trim(strip_tags($_POST['category']))
				)
			);
			edit_product($data);
		}
	}
	else if ($_POST['f'] == 'edit')
	{
		if (isset($_POST['login']) && isset($_POST['pass']) && isset($_POST['name']) && !check_user_exists($_POST['login']) && $_SESSION['current_user']['is_admin'] != 1 && $_SESSION['current_user']['login'] == $_POST['login'])
		{
			$data = array(
				'login' => trim(strip_tags($_POST['login'])),
				'old' => $_SESSION['current_user']['login'],
				'pass' => hash("whirlpool", trim(strip_tags($_POST['pass']))),
				'name' => trim(strip_tags($_POST['name'])),
				'is_admin' => 0
			);
			edit_user($data);
		}
		else if (isset($_POST['login']) && isset($_POST['pass']) && isset($_POST['name']) && !check_user_exists($_POST['login']))
		{
			$data = array(
				'login' => trim(strip_tags($_POST['login'])),
				'old' => $_POST['old'],
				'pass' => hash("whirlpool", trim(strip_tags($_POST['pass']))),
				'name' => trim(strip_tags($_POST['name'])),
				'is_admin' => $_POST['is_admin']
			);
			edit_user($data);
		}
	}
	else if ($_POST['f'] == 'Create')
	{
		if (isset($_POST['login']) && isset($_POST['pass']) && isset($_POST['name']) && !check_user_exists($_POST['login']))
		{
			$data = array(
				'login' => trim(strip_tags($_POST['login'])),
				'pass' => hash("whirlpool", trim(strip_tags($_POST['pass']))),
				'name' => trim(strip_tags($_POST['name'])),
				'is_admin' => 0
			);
			add_user($data);
		}
	}

	else if($_POST['f'] == 'Login')
	{
		if (isset($_POST['login']) && isset($_POST['pass']) && ($user = match_credentials($_POST['login'], $_POST['pass'])))
		{
			$_SESSION['current_user'] = $user;
			if (isset($_SESSION['basket']))
				$basket = $_SESSION['basket'];
			else
				$basket = $array;
			set_basket($user['login'], $basket);
		}
		else
		{
			if (isset($_SESSION['current_user']))
				unset($_SESSION['current_user']);	
		}
	}
	header('Location: ../views/login.php');
}

else if (isset($_GET['f']))
{
	if($_GET['f'] == 'logout' && isset($_SESSION['current_user']))
	{
		unset($_SESSION['current_user']);
	}
	else if ($_GET['f'] == 'del')
	{
		if (isset($_GET['login']) && isset($_SESSION['current_user']) && $_SESSION['current_user']['login'] == $_GET['login'])
		{
			del_user($_GET['login']);
			unset($_SESSION['current_user']);
		}
		else if (isset($_GET['login']) && isset($_SESSION['current_user']) && $_SESSION['current_user']['is_admin'] == 1)
		{
			del_user($_GET['login']);
			unset($_SESSION['current_user']);
		}
		else if (isset($_GET['name']) && isset($_SESSION['current_user']) && $_SESSION['current_user']['is_admin'] == 1)
		{
			del_product($_GET['name']);
		}
	}
	header('Location: ../views/login.php');
}
?>
