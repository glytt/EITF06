<!DOCTYPE html> 
<html> 

<head> 
	<title>Checkout Page</title> 
	<link rel="stylesheet"
		type="text/css"
		href="css/index.css"> 
 
</head> 

<body> 
<script>
    fetch('http://localhost:8080/getwalletaddress')
        .then(response => response.json())
        .then(data => {
            document.getElementById('walletAddress').innerText = data.address;
        })
        .catch(error => {
            console.error('Error fetching wallet address:', error);
            document.getElementById('walletAddress').innerText = 'Error fetching wallet address';
        });
</script>

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
			$total = isset($_POST['total']) ? $_POST['total'] : 0;
			echo "Total: <td>$total $</td>";
			?>
			<p>Wallet address: 1GFGFNv7DwEm2xyQF6vthFEQ19JE4rHtEc</p>
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
