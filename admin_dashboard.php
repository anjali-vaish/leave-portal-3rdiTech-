<?php
session_start();

if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] !== 'admin') {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="style8.css">
</head>
<body>
    <h1>Welcome Admin!</h1>
    <p>This is the admin dashboard.</p>

    <?php include 'index8.html'; ?>
</body>
</html>
