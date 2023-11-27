<html> 

<head> 
    <link rel="stylesheet"
            type="text/css"
            href="css/index.css"> 


    <nav> 
		<ul> 
			<li><a href="shop.php">Home</a> </li> 
			<li><a href="cart.php">Cart</a></li> 
			<li><a href="logout.php">Logout</a></li> 
		</ul> 
	</nav> 
</head> 

<?php 
// Start the session 
	session_start(); 

// Retrieve the customer name from the session variable 
	if (isset($_SESSION['user'])) { 
		$user = $_SESSION['user']; 
		$customerName = $user['name']; 
	} else { 
		$customerName = "Valued Customer"; 
	} 

// Display the thank you message 
	echo "<h1>Thank You, $customerName!</h1>"; 
	echo "<p>Your order has been received and will be delivered soon.</p>"; 
	?> 
</html>
