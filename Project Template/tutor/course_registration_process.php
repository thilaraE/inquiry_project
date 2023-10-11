<?php
// Database connection parameters
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "tutor";

// Create a database connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check if the connection was successful
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve form data
$student_name = $_POST['student_name'];
$course_name = $_POST['course_name'];
$grade = $_POST['grade'];

// Get the corresponding student_id based on the selected student_name
$sql = "SELECT student_id FROM student WHERE student_name = '$student_name'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $student_id = $row['student_id'];
} else {
    echo "Error: Student not found.";
    exit;
}

// Get the corresponding course_id based on the selected course_name
$sql = "SELECT course_id FROM course WHERE course_name = '$course_name'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $course_id = $row['course_id'];
} else {
    echo "Error: Course not found.";
    exit;
}

// Insert data into the "course_registration" table
$sql = "INSERT INTO course_registration (student_id, student_name, course_id, course_name, grade) VALUES ('$student_id', '$student_name', '$course_id', '$course_name', '$grade')";

if ($conn->query($sql) === TRUE) {
    echo "Registration successful!";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// Close the database connection
$conn->close();
?>
