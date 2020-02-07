<?php

include_once("../install/tools.php");

function add_to_cart($product_name, $quantity, $login)
{
	$database=get_database();
	$index = null;
	$basket = null;
	foreach($database['product'] as $k => $v)
	{
		if ($v['name'] == $product_name)
		{
			$index = $k;
			break ;
		}
	}
	if ($index === null)
		return (false);
	foreach ($database['users'] as $k => $v)
	{
		if ($v['login'] == $login)
		{
			$database['users'][$k]['basket'][] = array(
				'product' => $database['product'][$index],
				'quantity' => $quantity
			);
			$basket = $database['users'][$k]['basket'];
		}
	}
	update_database($database);
	return ($basket);
}
?>
