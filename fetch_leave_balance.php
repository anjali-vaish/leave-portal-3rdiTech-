<?php
// Include your database connection code

// Fetch user's leave balance from the database
// You need to adjust this part according to your database structure and logic

// Example data (replace this with your actual database query)
$data = [
    'annual_leave_used' => 10,
    'annual_leave_total' => 30,
    'sick_leave_used' => 1,
    'sick_leave_total' => 3,
    'maternity_leave_used' => 0,
    'maternity_leave_total' => 84,
    'family_leave_used' => 0,
    'family_leave_total' => 3,
    'bereavement_leave_used' => 1,
    'bereavement_leave_total' => 3
];

header('Content-Type: application/json');
echo json_encode($data);
?>
