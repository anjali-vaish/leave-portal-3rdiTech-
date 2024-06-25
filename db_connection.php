<?php
// db_connection.php
$servername = "localhost";
$username = "root";
$password = "root"; // Use your actual password
$dbname = "leave_application_db";

try {
    $connection = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
?>
