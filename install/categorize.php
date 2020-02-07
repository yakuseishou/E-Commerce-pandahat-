<?php

include("default_product.php");
$categories = [];
foreach ($products as $k => $v)
{
	foreach($v['categories'] as $kk => $vv)
	{
		$categories[$vv] = array();
	}
}

foreach($categories as $k => $v)
{
	foreach($products as $kk => $vv)
	{
		foreach($vv['categories'] as $kkk => $vvv)
		{
			if ($vvv == $k)
				$categories[$k][] = $vv;
		}
	}
}
?>
