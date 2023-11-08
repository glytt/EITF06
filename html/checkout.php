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
					<a href="shop.php">Home</a> 
				</li> 
				<li> 
					<a href="shop.php">Shop</a> 
				</li> 
				<li> 
					<a href="cart.php">Cart</a> 
				</li> 
				<li> 
					<a href= 
"mailto:mae@dektis.se">Contact</a> 
				
					</li> 
			</ul> 
		</nav> 
	</header> 

	<section> 
		<h1>Checkout</h1> 
		<form action="thanks.php" method="post"> 
			<h2>Billing Information</h2> 
			<label for="name">Name:</label> 
			<input type="text"
				id="name"
				name="name" required> 

			<label for="email">Email:</label> 
			<input type="email"
				id="email"
				name="email" required> 

			<label for="address">Address:</label> 
			<input type="text"
				id="address"
				name="address" required> 

			<label for="city">City:</label> 
			<input type="text"
				id="city"
				name="city" required> 

			<label for="state">State:</label> 
			<input type="text"
				id="state"
				name="state" required> 

			<label for="zip">Zip Code:</label> 
			<input type="text"
				id="zip"
				name="zip" required> 

			<h2>Payment Information</h2> 
			<label for="cardholder">Name on Card:</label> 
			<input type="text" id="cardholder"
				name="cardholder" required> 

			<label for="cardnumber">Card Number:</label> 
			<input type="text"
				id="cardnumber"
				name="cardnumber" required 
				pattern="\d{4}-?\d{4}-?\d{4}-?\d{4}" required=> 


			<label for="expmonth">Expiration Month:</label> 
			<input type="text"
				id="expmonth"
				name="expmonth" required> 

			<label for="expyear">Expiration Year:</label> 
			<input type="text"
				id="expyear"
				name="expyear" required> 

			<label for="cvv">CVV:</label> 
			<input type="text"
				id="cvv"
				name="cvv" required> 

			<input type="submit"
				value="Place Order"> 
		</form> 
	</section> 

	<footer> 
		<p>&copy; 2023 GFG Shopping Web Application</p> 
	</footer> 
</body> 

</html>
