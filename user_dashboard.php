<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] != 'user') {
    header("Location: index.html");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard</title>
</head>
<body>
    <h1>Welcome User!</h1>
    <p>This is the user dashboard.</p>
</body>
</html>
