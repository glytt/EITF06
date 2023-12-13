<?php 
 
 include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") { 

	$username = $_POST["username"]; 
	$password = $_POST["password"]; 
 
	$host = "localhost"; 
	$dbname = "test"; 
	$username_db = "root"; 
	$password_db = ""; 

	try { 
		$db = new PDO( 
			"mysql:host=$host;dbname=$dbname", 
			$username_db, 
			$password_db
		); 
		$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 

		$stmt = $db->prepare("SELECT * FROM users WHERE username = :username"); 
		$stmt->bindParam(":username", $username); 
		$stmt->execute(); 
		$user = $stmt->fetch(PDO::FETCH_ASSOC); 

		if ($user) { 
			if (password_verify($password, $user["password"]) && $_SESSION["login_counter"] < 5 ) { 
				$_SESSION["user"] = $user; 
				$_SESSION["login_counter"] = 0; 

				echo '<script type="text/javascript"> 
						window.onload = function () { 
							alert("Successful login. Welcome to GFG shopping website"); 
							window.location.href = "shop.php"; 
						}; 
					</script> 
'; 
			} else {
				echo "<h2>Login Failed</h2>"; 
				echo "Invalid username or password."; 
				$_SESSION["login_counter"] += 1;
			}
		} else {
			echo $_SESSION["login_counter"];
			echo "<h2>Login Failed</h2>"; 
			echo "Invalid username or password."; 
			$_SESSION["login_counter"] += 1;
			 
			
			
		} 
	} catch (PDOException $e) { 
		echo "Connection failed: " . $e->getMessage(); 
	} 
} 
?>
