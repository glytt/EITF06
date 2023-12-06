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

<body>

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
	echo "<h2>Your order has been received and will be delivered soon.</h2>"; 
	?> 


<div class="invoice">
        <h2>Receipt:</h2>

    <main>
        <section>
		<table> 
				
				<tr> 
					<th>Product Name </th> 
					<th>Quantity </th> 
					<th>Price </th>
					<th>Total </th>
				</tr> 
				<?php 
				echo "Date: " . date("Y/m/d") . "<br>";
				// echo "Time: " . date("h:i:sa");
				$hostname = "localhost"; 
				$username = "root"; 
				$password = ""; 
				$database = "test"; 

				// Create connection 
				$conn = 
					new mysqli($hostname, $username, $password, $database); 

				// Check connection 
				if ($conn->connect_error) { 
					die("Connection failed: " . $conn->connect_error); 
				} 

				$total = 0; 

				// Loop through items in cart and display in table 
				foreach ($_SESSION['cart'] as $product_id => $quantity) { 
					$sql = "SELECT * FROM products WHERE id = $product_id"; 
					$result = $conn->query($sql); 

					if ($result->num_rows > 0) { 
						$row = $result->fetch_assoc(); 
						$name = $row['name']; 
						$price = $row['price']; 
						$item_total = $quantity * $price; 
						$total += $item_total; 

						echo "<tr>"; 
						echo "<td>$name</td>"; 
						echo "<td>$quantity</td>"; 
						echo "<td>$price $</td>"; 
						echo "<td>$item_total $</td>"; 
						echo "</tr>"; 
					} 
				} 
				// Display total 
				echo "<tr>"; 
				echo "<td colspan='3'>Total:</td>"; 
				echo "<td>$total $</td>"; 
				echo "</tr>";

				?> 
			</table> 
        </section>
    </main>
</div>
</body>
</html>
