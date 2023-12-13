<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    $host = "localhost";
    $dbname = "test";
    $username_db = "root";
    $password_db = "";
    $salt = "salt";
    $hashed_password = hash('sha256', $salt . $password);

    try {
        $db = new PDO(
            "mysql:host=$host;dbname=$dbname",
            $username_db,
            $password_db
        );
        
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Making username and password vulnerable to SQL injection

        //for sql injection:
        //first user: '' OR 1=1 --
        //any user: '' OR username = '<username>' --

        $query = "SELECT * FROM users WHERE username = $username AND password = $hashed_password";

        echo "Query: " . $query . "<br>";
        
        $stmt = $db->query($query);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user) {
            session_start();
            $_SESSION["user"] = $user;

            echo '<script type="text/javascript"> 
                    window.onload = function () { 
                        alert("Successful login. Welcome to GFG shopping website"); 
                        window.location.href = "shop.php"; 
                    }; 
                </script>';
        } else {
            echo "<h2>Login Failed</h2>";
            echo "Invalid username or password.";
        }

    } catch (PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
    }
}

?>
