<?php
// Database connection parameters
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "technologyInquiryProject";

$tutor_id=1;
// Create a database connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check if the connection was successful
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Query to count the total number of students
$sql = "SELECT count(DISTINCT enrollment.student_id) as total_students FROM `enrollment` join teaching_session on enrollment.class_id= teaching_session.class_id WHERE teaching_session.tutor_id=$tutor_id;";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $total_students = $row['total_students'];
    echo $total_students;
} else {
    echo "No students found.";
}

// Close the database connection
$conn->close();
?>