<?php 


if ($_SERVER["REQUEST_METHOD"] == "POST") { 

	$name = $_POST["name"]; 
	$username = $_POST["username"]; 
	$email = $_POST["email"]; 
	$password = $_POST["password"]; 
	
	$hashed_password = password_hash($password, PASSWORD_BCRYPT); 
	$host = "localhost"; 
	$dbname = "test"; 
	$username_db = "root"; 
	$password_db = ""; 

	try { 
		$db = new PDO( 
		"mysql:host=$host;dbname=$dbname", 
		$username_db, 
		$password_db);
		$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
		
		$check_stmt = $db->prepare("SELECT * FROM users WHERE username = :username");
        $check_stmt->bindParam(":username", $username);
        $check_stmt->execute();
        $existing_user = $check_stmt->fetch(PDO::FETCH_ASSOC);

        if ($existing_user) {
            echo "<h2>Registration Failed</h2>";
            echo "Username already exists. Please choose a different username.";
        } else {

		$stmt = $db->prepare( 
		"INSERT INTO users (name,username,email, password, loginattempts) 
			VALUES (:name, :username, :email,:password, :loginattempts)"); 
		$stmt->bindParam(":name", $name); 
		$stmt->bindParam(":username", $username); 
		$stmt->bindParam(":email", $email); 
		$stmt->bindParam(":password", $hashed_password); 
		$stmt->bindValue(":loginattempts", 0, PDO::PARAM_INT);
		$stmt->execute(); 
		echo "<h2>Registration Successful</h2>"; 
		echo "Thank you for registering, " . $name . "!<br>"; 
		echo "You'll be redirected to login page in 3 seconds"; 
		header("refresh:3;url=login.html"); 
	} }
	catch(PDOException $e) { 
		echo "Connection failed: " . $e->getMessage(); 
	} 
}

?>
