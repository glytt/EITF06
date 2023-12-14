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

		$stmt = $db->prepare("SELECT * FROM users WHERE username = :username"); //username placeholder in the prepared statement
		$stmt->bindParam(":username", $username); //binds the user input to the placeholder 
		$stmt->execute(); //carries out the a statement
		$user = $stmt->fetch(PDO::FETCH_ASSOC); 

		if ($user) { 
			if (password_verify($password, $user["password"]) && $user["loginattempts"] < 5 ) { 
				$_SESSION["user"] = $user; 
				$update_stmt = $db->prepare("UPDATE users SET loginattempts = 0 WHERE username = :username");
                $update_stmt->bindParam(":username", $username);
                $update_stmt->execute();

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
				echo $user["loginattempts"];
				$update_stmt = $db->prepare("UPDATE users SET loginattempts = loginattempts + 1 WHERE username = :username");
                $update_stmt->bindParam(":username", $username);
                $update_stmt->execute();
			}
		} else {
			 
			echo "<h2>Login Failed</h2>"; 
			echo "Invalid username or password.";  
			
			
		} 
	} catch (PDOException $e) { 
		echo "Connection failed: " . $e->getMessage(); 
	} 
} 
?>
