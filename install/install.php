<?php

include("default_product.php");
include("categorize.php");
include("users.php");
include("tools.php");

$database = array (
	'product' => $products,
	'users' => $users,
	'categories' => $categories,
	'purchases' => array(
		0 => array(
			"date" => '2018-10-31',
			"login" => 'chford',
			"order" => array(
				0 => array (
					'product' => array(
						"name" => "Senpai1",
   		         		"description" => "sliver hat with black gliter letters",
       	    	 		"price" => "30.00",
       		     		"featured" => "1",
       	    	 		"photo" => "../resources/senpai/senpaisilver.jpg",
            			"categories" => array(
            			  0 => "anime",
             			 1 => "japanese"
		 				 ),
          			"quantity" => "1"
					 )
				 )
	  		)
	  )
	)
);
file_put_contents("database.txt", serialize($database));
?>
