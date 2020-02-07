<!DOCTYPE html>
<?php
session_start();
include "../install/tools.php";
$database = get_database();
$products = $database['product'];
$filtered = array();
if (isset($_GET['category']))
{
	foreach ($products AS $product)
	{
		foreach ($product['categories'] as $k => $v)
		{
			if ($v == $_GET['category'])
				$filtered[] = $product;
		}
	}
}
else
	$filtered = $products;
?>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<link rel="stylesheet" href="home.css">
		<title>
			Menu
		</title>
	</head>
	<body>
		<?php require("header.php"); ?>
		<?php
		foreach ($filtered as $product)
		{
			echo'
        <div class="hat">
            <img src="'.$product['photo'].'">
            <p>
            <span class="hat_name">'.$product['name'].'<br></span>
            <span class="detail">Description - '.$product['description'].'<br>
            Price - '.$product['price'].'
            </span>
            </p>
			<p>
				<div class="add_cart">
					<form method="GET" action="../controller/cart.php">Quantity: 
						<input type="number" name="quantity" width:"10" min="0">
  						<input type="submit" value="Add to cart">
  						<input type="hidden" name="login" value="'.$_SESSION['current_user']['login'].'">
  						<input type="hidden" name="action" value="add_to_cart">
  						<input type="hidden" name="product" value="'.$product['name'].'">
					</form>
				</div>
            </p>
		</div>';
		} ?> 
	</body>
</html>
