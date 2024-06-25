<?php
include 'db_connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $start_date = $_POST['start_date'];
    $end_date = $_POST['end_date'];
    $leave_type = $_POST['leave_type'];
    $reason = $_POST['reason'];

    try {
        // Prepare the SQL statement
        $stmt = $connection->prepare("INSERT INTO leave_requests (email, leave_type, start_date, end_date, status, reason) VALUES (?, ?, ?, ?, 'pending', ?)");

        // Bind the parameters
        $stmt->bindParam(1, $email);
        $stmt->bindParam(2, $leave_type);
        $stmt->bindParam(3, $start_date);
        $stmt->bindParam(4, $end_date);
        $stmt->bindParam(5, $reason);

        // Execute the statement
        $stmt->execute();

        // Return a success response
        echo json_encode(['status' => 'success', 'message' => 'Leave request submitted successfully.']);
    } catch (PDOException $e) {
        // Return an error response
        echo json_encode(['status' => 'error', 'message' => 'Failed to submit leave request: ' . $e->getMessage()]);
    }
} else {
    // Return an error response for invalid request method
    echo json_encode(['status' => 'error', 'message' => 'Invalid request method.']);
}
?>
