<?php
include 'db_connection.php';

$stmt = $connection->query("SELECT id, email, leave_type, start_date, end_date, status, reason FROM leave_requests");
$leaveRequests = $stmt->fetchAll(PDO::FETCH_ASSOC);

header('Content-Type: application/json');
echo json_encode($leaveRequests);
?>
