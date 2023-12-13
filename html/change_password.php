<?php
session_start();

 
if (!isset($_SESSION['user'])) {
   
    header("Location: login.html");
    exit();
}

 
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
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
    exit();
}

 
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_id = $_SESSION['user']['username']; 

    // Fetch the current user's information
    // $stmt = $db->prepare("SELECT * FROM users WHERE username = :username");
    // $stmt->bindParam(":username", $username);
    // $stmt->execute();
    // $user = $stmt->fetch(PDO::FETCH_ASSOC);

    // Validate current password
    // $current_password = $_POST['current_password'];
    //print_r($_SESSION['user']);
    // if (!password_verify($current_password, $user['password'])) {
    //     echo "Invalid current password";
    //     exit();
    // }

    // Validate and update new password
    $new_password = $_POST['new_password'];
    $confirm_password = $_POST['confirm_password'];

    if ($new_password !== $confirm_password) {
        echo "New password and confirm password do not match";
        exit();
    }

    
    $hashed_password = password_hash($new_password, PASSWORD_BCRYPT);

   
    try {
        print_r($_SESSION['user']);
        print_r($user_id);
        $update_stmt = $db->prepare("UPDATE users SET password = :hashed_password WHERE username = :username");
        $update_stmt->bindParam(":hashed_password", $hashed_password);
        $update_stmt->bindParam(":username", $user_id);
        $update_stmt->execute();

    } catch (PDOException $e) {
        echo "Update failed: " . $e->getMessage();
    }
   

    echo "Password changed successfully";
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Password Change</title>
</head>
<body>
    <h2>Change Password</h2>
    <form action="change_password.php" method="post">
        <!-- <label for="current_password">Current Password:</label>
        <input type="password" id="current_password" name="current_password" required><br> -->

        <label for="new_password">New Password:</label>
        <input type="password" id="new_password" name="new_password" required><br>

        <label for="confirm_password">Confirm New Password:</label>
        <input type="password" id="confirm_password" name="confirm_password" required><br>

        <input type="submit" value="Change Password">
    </form>
</body>
</html>