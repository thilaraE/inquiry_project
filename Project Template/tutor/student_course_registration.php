<!DOCTYPE html>
<html>

<head>
    <title>Course Registration Form</title>
</head>

<body>
    <h2>Course Registration Form</h2>
    <form action="course_registration_process.php" method="POST">
        <label for="student_name">Student Name:</label>
        <select name="student_name" required>
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

            // Fetch student names from the database
            $sql = "SELECT student_name FROM student";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo '<option value="' . $row['student_name'] . '">' . $row['student_name'] . '</option>';
                }
            }

            // Close the database connection
            $conn->close();
            ?>
        </select><br><br>

        <label for="course_name">Select Course:</label>
        <select name="course_name" required>
            <?php
              $servername = "localhost";
			  $username = "root";
			  $password = "";
			  $dbname = "tutor";
  
			  // Create a database connection
			  $conn = new mysqli($servername, $username, $password, $dbname);
  
            // Fetch course names from the database
            $sql = "SELECT course_name FROM course";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo '<option value="' . $row['course_name'] . '">' . $row['course_name'] . '</option>';
                }
            }

            // Close the database connection (you may reuse the existing connection)
            ?>
        </select><br><br>

        <label for="grade">Grade:</label>
        <select name="grade" required>
            <?php
			  $servername = "localhost";
			  $username = "root";
			  $password = "";
			  $dbname = "tutor";
  
			  // Create a database connection
			  $conn = new mysqli($servername, $username, $password, $dbname);
  
            // Fetch grades from the database
            $sql = "SELECT DISTINCT grade FROM course";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo '<option value="' . $row['grade'] . '">' . $row['grade'] . '</option>';
                }
            }

            // Close the database connection (you may reuse the existing connection)
            $conn->close();
            ?>
        </select><br><br>

        <input type="submit" value="Register">
    </form>
</body>

</html>