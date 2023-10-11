<?php
// Database connection parameters
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "technologyInquiryProject";

// Create a database connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check if the connection was successful
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Query to count the total number of students
$sql = "SELECT COUNT(student_id) AS total_students FROM student";
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