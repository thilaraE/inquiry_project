<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Processed</title>
<body>
<?php include("settings.php");
// Include the database connection settings


// Create a database connection
$conn = @mysqli_connect($host, $user, $pwd, $sql_db);

if (!$conn) {
    echo "Database connection error: " . mysqli_connect_error();
} else {
    // Check if a class_id is set in the POST request
    if (isset($_POST['class_id'])) {
        // Get the student_id (replace with the actual student_id)
        $student_id = 1; // Replace with the actual student_id

        // Get the class_id from the POST data
        $class_id = $_POST['class_id'];

        // Check if the student is already enrolled in the class
        $checkEnrollmentQuery = "SELECT * FROM enrollment WHERE student_id = $student_id AND class_id = $class_id";
        $enrollmentResult = mysqli_query($conn, $checkEnrollmentQuery);

        if (mysqli_num_rows($enrollmentResult) > 0) {
            echo "You are already enrolled in this class.";
        } else {
            // Insert the enrollment record
            $enrollQuery = "INSERT INTO enrollment (student_id, class_id) VALUES ($student_id, $class_id)";
            if (mysqli_query($conn, $enrollQuery)) {
                echo "Enrollment successful!";
            } else {
                echo "Error enrolling in the class: " . mysqli_error($conn);
            }
        }
    } else {
        echo "No class selected for enrollment.";
    }

    // Close the database connection
    mysqli_close($conn);
}
?>
</body>
</html>

