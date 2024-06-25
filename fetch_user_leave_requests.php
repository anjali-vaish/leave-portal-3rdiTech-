<?php
include 'db_connection.php';

// Assuming you have a way to identify the logged-in user, e.g., from a session
session_start();
$user_email = $_SESSION['user_email'];

$stmt = $connection->prepare("SELECT leave_type, start_date, end_date, status FROM leave_requests WHERE email = ?");
$stmt->execute([$user_email]);
$leaveRequests = $stmt->fetchAll(PDO::FETCH_ASSOC);

header('Content-Type: application/json');
echo json_encode($leaveRequests);
?>
