<!DOCTYPE html> 
<html> 

<head> 
	<title>Checkout Page</title> 
	<link rel="stylesheet"
		type="text/css"
		href="css/index.css"> 
 
</head> 

<body> 

	<header> 
		<nav> 
			<ul> 
			
				<li> 
					<a href="shop.php">Shop</a> 
				</li> 
				<li> 
					<a href="cart.php">Cart</a> 
				</li> 
				<li> 
					<a href= "mailto:mae@dektis.se">Contact</a> 
					</li> 
			</ul> 
		</nav> 
	</header> 

	<section> 
		<h1>Checkout</h1> 
		<form action="thanks.php" method="post"> 
			<h4>Pay total to wallet address, then state the transaction ID below</h4> 

			<?php
			//session_start();

			include 'config.php';
			$total = isset($_SESSION['total']) ? $_SESSION['total'] : 0;

			echo "Total price: $total $";

			?>
			<p>Wallet address: 1KnSepAPnhzoqzCsvesCuG52kWKrcgXjtj</p>
			</p>
			<label for="transID">Transaction ID:</label> 
			<input type="text"
				id="transID"
				name="transID"
				pattern="[a-fA-F0-9]{64}"
				title="Please enter a valid transaction ID (64 hex characters)"
				required>

			<input type="submit" value="Place Order"> 
		</form> 
	</section> 

	<footer> 
		<p>&copy; 2023 GFG Shopping Web Application</p> 
	</footer> 
</body> 

</html>
