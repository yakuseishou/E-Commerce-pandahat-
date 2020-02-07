<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" href="home.css">
	<title>
		Shopping Cart
	</title>
</head>
<body>
		<?php require("header.php"); ?>
		<div class="shopping-cart">
<?php
session_start();
	if (isset($_SESSION['current_user']))
	{
		$basket = get_basket($_SESSION['current_user']['login']);
		$total = 0;
			foreach($basket as $item)
			{
				if ($item['product']['price'] != null)
				{						
					echo '
					<div class="hat">
   		  	       <img src="'.$item['product']['photo'].'">
  		 	         <p>
						<span class="hat_name">'.$item['product']['name'].'<br></span>
  	  	    			   <span class="detail">Quantity: '.$item['quantity'].'<br></span>
							<form method="GET" action="../controller/cart.php">Quantity: 
								<input type="number" name="quantity" width:"10" min="0" value='.$item['quantity'].'>
								<input type="submit" value="Update">
								<input type="hidden" name="action" value="update">
								<input type="hidden" name="product" value="'.$item['product']['name'].'">
								<input type="hidden" name="login" value="'.$_SESSION['current_user']['login'].'">
							</form>
  	  	    			   <span class="detail">Price: '.$item['product']['price'].'<br></span>
  	  	    			   <span class="detail">Total '.$item['product']['price'] * $item['quantity'].'<br>
			            </span>
					</p>
					<p>
				</div>';
				$total += $item['product']['price'] * $item['quantity'];
				}
			}
			echo '<h1>Total: '.$total.'</h1>';
			echo '<br><a href="../controller/checkout.php?login='.$_SESSION['current_user']['login'].'&action=checkout"><button class="checkout">Checkout</button></a>
           </p>';
	}
	else
	{
		$basket = $_SESSION['basket'];
		$total = 0;
			foreach($basket as $item)
			{
				if (isset($item['product']))
				{
						echo '
						<div class="hat">
   		  		       <img src="'.$item['product']['photo'].'">
  		 		         <p>
							<span class="hat_name">'.$item['product']['name'].'<br></span>
  	  	   	 			   <span class="detail">Quantity: '.$item['quantity'].'<br></span>
								<form method="GET" action="../controller/cart.php">Quantity: 
									<input type="number" name="quantity" width:"10" min="0" value='.$item['quantity'].'>
									<input type="submit" value="Update">
									<input type="hidden" name="action" value="update">
									<input type="hidden" name="product" value="'.$item['product']['name'].'">
								</form>
  	  	   	 			   <span class="detail">Price: '.$item['product']['price'].'<br></span>
  	  	   	 			   <span class="detail">Total '.$item['product']['price'] * $item['quantity'].'<br>
				            </span>
						</p>
						<p>
					</div>';
					$total += $item['product']['price'] * $item['quantity'];
				}
			}
			echo '<h1>Total: '.$total.'</h1></p>';
	}?>
</div>
</body>
</html>
