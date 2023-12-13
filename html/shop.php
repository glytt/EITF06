<?php 
include 'config.php';

// Start the session 
// Check if the add to cart button is clicked 
if (isset($_POST["add_to_cart"])) { 
	if (!isset($_POST["csrf_token"]) || $_POST["csrf_token"] !== $_SESSION["csrf_token"]) {
        die("CSRF token validation failed.");
    }
	
	// Get the product ID from the form 
	$product_id = $_POST["product_id"]; 
	
	// Get the product quantity from the form 
	$product_quantity = $_POST["product_quantity"]; 

	// Initialize the cart session variable 
	// if it does not exist 
	if (!isset($_SESSION["cart"])) { 
		$_SESSION["cart"] = []; 
		header("location:cart.php"); 
	} 

	// Add the product and quantity to the cart 
	$_SESSION["cart"][$product_id] = $product_quantity; 
	header("location:cart.php"); 
} 
?> 
<!DOCTYPE html> 
<html> 
	<head> 
		<title>Totally legal pharmacy</title> 
		<link rel="stylesheet"
				href="css/index.css"> 
	</head> 
	<body> 
		<header> 
			<h1>Welcome <?php 
			$user = $_SESSION["user"]; 
			echo $user["name"]; 
			?> to a Totally Legal Pharmacy</h1> 
			<form action="search.php" method="get">
    			<input type="text" name="query" placeholder="Search...">
    			<button type="submit">Search</button>
			</form>
		</header> 
		<nav> 
			<ul> 
				<li><a href="shop.php">Home</a></li> 
				<li><a href="cart.php">Cart</a></li> 
				<li><a href="change_password.php">Change password</a></li> 
				<li> <a href="change_email.php">Change email</a></li>
				<li><a href="logout.php">Logout</a>Search</li> 

			</ul> 
		</nav> 
		<main> 
			<section> 
				
				<h2>Products</h2> 
				<ul> 
					<li> 
						<h3>Heroin</h3> 
						<img src= "images/heroin.jpg" 
						alt="Product 1"> 
						<p>Needle not included</p> 
						<p><span>500 kr/g</span></p> 

						<form method="post" action="shop.php"> 
						<input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token'];?>">
							<input type="hidden"
								name="product_id"
								value="1"> 
							<label for="product1_quantity"> 
								Quantity: 
							</label> 
							<input type="number"
								id="product1_quantity"
								name="product_quantity"
								value=""
								min="0"
								max="10"> 
							<button type="submit"
									name="add_to_cart"> 
								Add to Cart</button> 
						</form> 
					</li> 
					<li> 
						<h3>LSD</h3> 
						<img src= "images/lsd.jpg"
							alt="Product 2"> 
						<p>100% epicness</p> 
						<p> 
							<span>400 kr/st</span> 
						</p> 

						<form method="post" action="shop.php"> 
						<input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token'];?>">
							<input type="hidden"
								name="product_id"
								value="2"> 
							<label for="product2_quantity"> 
								Quantity: 
							</label> 
							<input type="number"
								id="product2_quantity"
								name="product_quantity"
								value=""
								min="0"
								max="10"> 
							<button type="submit"
									name="add_to_cart"> 
								Add to Cart 
						</button> 
						</form> 
					</li> 
					
								
					<!-- Add forms for the other products here --> 
				</ul> 
			</section> 
		</main> 
		<footer> 
			<p>&copy; Totally Legal Pharmacy Inc</p> 
		</footer> 
		<script src="shop.php"></script> 
	</body> 
</html>
