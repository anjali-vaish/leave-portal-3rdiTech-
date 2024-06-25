<?php
$servername = "localhost";
$username = "root";
$password = "root"; // Use your actual password
$dbname = "leave_application_db";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the request method is POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Prepare and bind
    $stmt = $conn->prepare("UPDATE leave_requests SET status=? WHERE id=?");
    if ($stmt === false) {
        die("Prepare failed: " . $conn->error);
    }
    
    $stmt->bind_param("si", $status, $id);

    $status = $_POST['status'];
    $id = $_POST['id'];

    if ($stmt->execute()) {
        // Count the number of declined requests
        $result = $conn->query("SELECT COUNT(*) AS count FROM leave_requests WHERE status='declined'");
        $row = $result->fetch_assoc();
        echo $row['count'];
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
} else {
    echo "Invalid request method.";
}

$conn->close();
?>
