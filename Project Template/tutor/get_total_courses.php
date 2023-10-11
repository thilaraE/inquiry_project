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

// Query to count the total number of courses
$sql = "SELECT COUNT(*) AS total_courses FROM tutorial_class";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $total_courses = $row['total_courses'];
    echo $total_courses;
} else {
    echo "No courses found.";
}

// Close the database connection
$conn->close();
?>