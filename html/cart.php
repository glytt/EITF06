<!DOCTYPE html> 
<html> 

<head> 
	<title>Shopping Cart</title> 
	<link rel="stylesheet"
		type="text/css"
		href="css/index.css"> 
</head> 

<body> 
	<header> 
		<?php 
		session_start(); 
		$user = $_SESSION['user']; 
		echo "<h1>{$user['name']} Shopping Cart</h1>"; 
		?> 
	</header> 

	<nav> 
		<ul> 
			<li><a href="shop.php">Home</a></li> 
			<li><a href="cart.php">Cart</a></li> 
			<li><a href="logout.php">Logout</a></li> 
		</ul> 
	</nav> 

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
				$hostname = "localhost"; 
				$username = "root"; 
				$password = ""; 
				$database = "test"; 

				try {
					// Create PDO connection
					$conn = new PDO("mysql:host=$hostname;dbname=$database", $username, $password);
					$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

					$total = 0;

					// Loop through items in cart and display in table
					foreach ($_SESSION['cart'] as $product_id => $quantity) {
						$sql = "SELECT * FROM products WHERE id = :product_id";
						$stmt = $conn->prepare($sql);
						$stmt->bindParam(':product_id', $product_id);
						$stmt->execute();

						$row = $stmt->fetch(PDO::FETCH_ASSOC);

						if ($row) {
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
				} catch (PDOException $e) {
					echo "Error: " . $e->getMessage();
				} finally {
					$conn = null; // Close connection
				}
				?>
			</table>
			<form action="checkout.php" method="post">
				<input type="submit"
					value="Checkout"
					class="button" />
			</form>
		</section>
	</main>

	<footer>
		<p>&COPY;2023 GFG Shopping Web Application</p>
	</footer>
</body>

</html>
