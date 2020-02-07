<?php
session_start();
include_once('../install/tools.php');
include_once('../model/product.php');

if (isset($_GET['action']))
{
	if ($_GET['action'] == 'add_to_cart' && isset($_GET['product']) && isset($_GET['quantity']) && isset($_GET['login']) && isset($_SESSION['current_user']) && $_SESSION['current_user']['login'] == $_GET['login'])
	{
		$database = get_database();
		foreach($database['product'] as $product)
		{
			if ($product['name'] == $_GET['product'])
			{
				$basket = add_to_cart($_GET['product'], $_GET['quantity'], $_GET['login']);
			}
		}
		$_SESSION['basket'] = $basket;
		header('Location: ../views/shoppingcart.php');
	}
	
	else if ($_GET['action'] == 'add_to_cart' && isset($_GET['product']) && isset($_GET['quantity']) && $_GET['login'] == "")
	{
		$database = get_database();
		foreach($database['product'] as $product)
		{
			if ($product['name'] == $_GET['product'])
			{
				$item = $product;
				break ;
			}
		}
		if (!isset($_SESSION['basket']))
		{
			$_SESSION['basket'] = array(
			0 => array( 
       		   "product" => $product,
	          "quantity" => $_GET['quantity']
		  )
	  );
		} else {
			$_SESSION['basket'][] = array (
       		   "product" => $product,
	          "quantity" => $_GET['quantity']
		  );
		}
		header('Location: ../views/shoppingcart.php');
	}
	else if ($_GET['action'] == 'update' && isset($_GET['product']) && isset($_GET['quantity']) && isset($_GET['login']) && isset($_SESSION['current_user']) && $_SESSION['current_user']['login'] == $_GET['login'])
	{
		$database = get_database();
		$id = null;
		foreach($database['users'] as $k => $v)
		{
			if ($database['users'][$k]['login'] = $_GET['login'])
			{
				$id = $k;
				break ;
			}
		}
		foreach($database['users'][$id]['basket'] as $k => $v)
		{
			if ($database['users'][$id]['basket'][$k]['product']['name'] == $_GET['product'])
			{
				if ($_GET['quantity'] == 0)
				{
					unset($database['users'][$id]['basket'][$k]);
					unset($database['users'][$id]['quantity'][$k]);
				}
				$database['users'][$id]['basket'][$k]['quantity'] = $_GET['quantity'];
			}
		}
		$basket = $database['users'][$id]['basket'];
		update_database($database);
		$_SESSION['basket'] = $basket;
		header('Location: ../views/shoppingcart.php');
	}
	else if ($_GET['action'] == 'update' && isset($_GET['product']) && isset($_GET['quantity']))
	{
		foreach($_SESSION['basket'] as $k => $v)
		{
			if (isset($v['product']))
			{
				if ($v['product']['name'] == $_GET['product'])
				{
					if ($_GET['quantity'] == 0)
					{
						unset($_SESSION['basket'][$k]['product']);
						unset($_SESSION['basket'][$k]['quantity']);
					}
					$_SESSION['basket'][$k]['quantity'] = $_GET['quantity'];
				}
			}
		}	
		header('Location: ../views/shoppingcart.php');
	}
}?>
