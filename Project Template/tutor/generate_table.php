<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "1234";
$dbname = "inquiryproject";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT tc.class_id, tc.subject, tc.content, tc.duration_in_hours, tc.day_of_the_week, tc.start_time, tc.fee, tc.syllabus_link
FROM tutorial_class tc
LEFT JOIN enrollment e ON tc.class_id = e.class_id
GROUP BY tc.class_id, tc.subject, tc.content, tc.duration_in_hours, tc.day_of_the_week, tc.start_time, tc.fee, tc.syllabus_link
HAVING COUNT(e.student_id) > 0;";

$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html>
<head>
    <title>Tutorial Class Enrollment Report</title>
</head>
<body>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Class ID</th>
                <th>Subject</th>
                <th>Fee</th>
                
            </tr>
        </thead>
        <tbody>
            <?php
            if ($result !== false && $result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo '<tr>';
                    echo '<td>' . $row['class_id'] . '</td>';
                    echo '<td>' . $row['subject'] . '</td>';
                    echo '<td>' . $row['fee'] . '</td>';
                    //echo '<td>' . $row['total_enrollment'] . '</td>';
                    echo '</tr>';
                }
            } else {
                echo '<tr><td colspan="9">No tutorial classes found with enrollment.</td></tr>';
            }

            $conn->close();
            ?>
        </tbody>
    </table>
</body>
</html>
