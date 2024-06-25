<?php
$servername = "localhost";
$username = "root";
$password = "root"; // Update password if needed
$dbname = "leave_application_db";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $role = $_POST['role'];

    // Check if the user exists
    $sql = "SELECT * FROM users WHERE email = '$email'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Fetch the user's data
        $row = $result->fetch_assoc();
        // Verify password (use password_verify() if passwords are hashed)
        if ($password == $row['password']) {
            // Check if the selected role matches the user's role
            if ($row['role'] == $role) {
                // Start session and set session variables
                session_start();
                $_SESSION['user_id'] = $row['id'];
                $_SESSION['user_email'] = $row['email'];
                $_SESSION['user_role'] = $row['role'];

                // Redirect based on role
                if ($role == 'admin') {
                    header("Location: index6.html"); // Redirect to admin dashboard
                } else {
                    header("Location: index1.html"); // Redirect to user dashboard
                }
                exit();
            } else {
                echo "Role mismatch. Please select the correct role.";
            }
        } else {
            echo "Invalid password.";
        }
    } else {
        echo "No user found with this email.";
    }
}

$conn->close();
?>
