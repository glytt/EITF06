<?php

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

 
//$search_query = isset($_GET['query']) ? $_GET['query'] : '';

$search_query = isset($_GET['query']) ? htmlspecialchars($_GET['query'], ENT_QUOTES, 'UTF-8') : '';


// Perform the search in your database
// Adjust the query based on your database schema and search criteria
$stmt = $db->prepare("SELECT * FROM products WHERE name LIKE :search_query");
$stmt->bindValue(':search_query', '%' . $search_query . '%', PDO::PARAM_STR);
$stmt->execute();
$results = $stmt->fetchAll(PDO::FETCH_ASSOC);

//echo "<p>" . $search_query . "</p>";


foreach ($results as $result) {
    echo "<p>" . htmlspecialchars($result['product_name'], ENT_QUOTES, 'UTF-8') . "</p>";
}

// foreach ($results as $result) {
//     echo "<p>" . $result['name'] . "</p>";
// }
// ?>

 

 