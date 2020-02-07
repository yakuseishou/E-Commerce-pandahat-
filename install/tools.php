<?php
function get_database()
{
	return (unserialize(file_get_contents($_SERVER['DOCUMENT_ROOT']."/install/database.txt")));
}

function update_database($database)
{
	file_put_contents($_SERVER['DOCUMENT_ROOT']."/install/database.txt", serialize($database));
}

function get_categories()
{
	$database = get_database();
	$categories = [];
	foreach($database['product'] as $product)
	{
		foreach ($product['categories'] as $k => $v)
		{
			$categories[] = $v;
		}
	}
	return ($categories);
}

function get_basket($login)
{
	$database=get_database();
	foreach ($database['users'] as $k => $v)
	{
		if ($v['login'] == $login)
		{
			$database['users'][$k]['basket'][] = array(
				'product' => $database['product'][$index],
				'quantity' => $quantity
			);
			$basket = $database['users'][$k]['basket'];
			return ($basket);
		}
	}
}
?>
