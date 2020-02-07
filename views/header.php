<?php

include_once('../install/tools.php');

$categories = get_categories();
$categories = array_unique($categories);

echo '<h1><img class="logo" src="../resources/logo.jpg">PandaHat<img class="logo" src="../resources/logo.jpg"></h1>
<ul>
    <li><a href="home.php">Home</a></li>
    <li class="dropdown">
        <a href="javascript:void(0)" class="dropbtn">Product</a>
		<div class="dropdown-content">
			<a href="product.php">view all</a>';
		foreach ($categories as $category)
		{
			echo '<a href="product.php?category='.$category.'">'.$category.'</a>';
		}
		echo'
        </div>
    </li>
    <li class="dropdown">
        <a href="javascript:void(0)" class="dropbtn">User</a>
        <div class="dropdown-content">
                <a href="login.php">Login/AccountSetting</a>
				<a href="newuser.php">NewUser</a>';
			if (isset($_SESSION['current_user']) && $_SESSION['current_user']['is_admin'] == 1)
			   echo '<a href="admin.php">Admin</a>';
echo '
        </div>
    </li>
    <li class="dropdown">
        <a class="cart" href="shoppingcart.php" class="dropbtn"><img src="../resources/mycart-md.png">Cart</a>'?>
        <div class="cart-content">
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
<?php
    echo    '</div>
    </li>		
</ul>';
?>
