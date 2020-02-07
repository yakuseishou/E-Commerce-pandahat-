<?php
session_start();
include_once('../install/tools.php');
include_once('../model/product.php');

if (isset($_GET['action']))
{
	if ($_GET['action'] == 'checkout' && isset($_GET['login']) && isset($_SESSION['basket']) && isset($_SESSION['current_user']) && $_SESSION['current_user']['login'] == $_GET['login'])
	{
		$order = $_SESSION['basket'];
		$database = get_database();
		$database['purchases'][] = array(
			'date' => date("Y-m-d"),
			'login' => $_GET['login'],
			'order' => $order
		);
		unset($_SESSION['basket']);
		foreach($database['users'] as $k => $v)
		{
			if ($database['users'][$k]['login'] == $_GET['login'])
				$database['users'][$k]['basket'] = array();
		}
		update_database($database);
		header('Location: ../views/login.php');
	}
}
?>
