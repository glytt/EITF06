<?php
include 'config.php';

 
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
    // if (!isset($_POST["csrf_token"]) || $_POST["csrf_token"] !== $_SESSION["csrf_token"]) {
    //     die("CSRF token validation failed.");           
    // }
    $user_id = $_SESSION['user']['username'];  
 
    $new_email = $_POST['new_email'];

     
    try {
        print_r($_SESSION['user']);
        print_r($user_id);
        $update_stmt = $db->prepare("UPDATE users SET email = :new_email WHERE username = :username");
        $update_stmt->bindParam(":new_email", $new_email);
        $update_stmt->bindParam(":username", $user_id);
        $update_stmt->execute();
        

        echo "Email changed successfully";
    } catch (PDOException $e) {
        echo "Update failed: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Email Change</title>
</head>
<body>
    <h2>Change Email</h2>
    <form action="change_email.php" method="post">
        <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']?>">
        <label for="new_email">New Email:</label>
        <input type="email" id="new_email" name="new_email" required><br>
        <input type="submit" value="Change Email">
        
    </form>
</body>
</html>
