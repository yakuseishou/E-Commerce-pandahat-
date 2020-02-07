<?php

include_once("../install/tools.php");

function edit_product($data)
{
	$database = get_database();
	$found = 0;
	foreach($database['product'] as $k => $v)
	{
		if ($database['product'][$k]['name'] == $data['old'])
		{
		$database['product'][$k] = array(
			'name' => $data['name'],
			'desc' => $data['desc'],
			'price' => $data['price'],
			'photo' => $data['photo'],
			'category' => $data['category']
		);
		$found = 1;
		break ;
		}
	}
	if ($found == 1)
	{
		update_database($database);
		return ;
	}
		$database['product'][] = array(
			'name' => $data['name'],
			'desc' => $data['desc'],
			'price' => $data['price'],
			'photo' => $data['photo'],
			'category' => $data['category']
	);
		update_database($database);
	return ;
	
}

function edit_user($data)
{
	$database = get_database();
	$found = 0;
	foreach($database['users'] as $k => $v)
	{
		if ($database['users'][$k]['login'] == $data['old'])
		{
		$database['users'][$k] = array(
			'login' => $data['login'],
			'pass' => $data['pass'],
			'name' => $data['name'],
			'basket' => array(),
			'is_admin' => $data['is_admin']
		);
		$found = 1;
		break ;
		}
	}
	if ($found == 1)
	{
		unset($_SESSION['current_user']);
		$_SESSION['current_user'] = $database['users'][$k];
		update_database($database);
		return ;
	}
	$database['users'][] = array(
		'login' => $data['login'],
		'pass' => $data['pass'],
		'name' => $data['name'],
		'basket' => array(),
		'is_admin' => $data['is_admin']
	);
		update_database($database);
	return ;
}

function add_user($data)
{
	$database = get_database();
	$database['users'][] = array(
		'login' => $data['login'],
		'pass' => $data['pass'],
		'name' => $data['name'],
		'basket' => $data['basket'],
		'is_admin' => $data['is_admin']
	);
	update_database($database);
	return ;
}

function check_user_exists($login)
{
	$database = get_database();
	foreach($database['users'] as $user)
	{
		if ($user['login'] == $login)
			return (true);
	}
	return (false);
}

function match_credentials($login, $pass)
{
	$database = get_database();
	$hash = hash("whirlpool", $pass);
	foreach($database['users'] as $user)
	{
		if ($user['login'] == $login)
		{
			if ($user['pass'] == $hash)
				return ($user);
			return (false);
		}
	}
}

function set_basket($login, $basket)
{
	$database = get_database();
	foreach($database['users'] as $user => $value)
	{
		if ($value['login'] == $login)
		{
			echo "\nfound a match";
			$database['users'][$user]['basket'] = $basket;
			update_database($database);
			return ;
		}
	}
}

function del_product($name)
{
	echo $name;
	$database = get_database();
	foreach($database['product'] as $prod => $value)
	{
		if ($value['name'] == $name)
		{
			unset($database['product'][$prod]);
			update_database($database);
			return ;
		}
	}
}

function del_user($login)
{
	$database = get_database();
	foreach($database['users'] as $user => $value)
	{
		if ($value['login'] == $login)
		{
			unset($database['users'][$user]);
			update_database($database);
			return ;
		}
	}
}
?>
