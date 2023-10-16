<?php

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $username = $_POST["exampleInputUsername"];
    $firstName = $_POST["exampleFirstName"];
    $lastName = $_POST["exampleLastName"];
    $password = $_POST["exampleInputPassword"];
    $repeatPassword = $_POST["exampleRepeatPassword"];

    include("settining.php");

    $conn = @mysqli_connect($host, $user, $pwd, $sql_db);
    if (!$conn) {
        echo $host;
        echo $user;
        echo $pwd;
        echo mysqli_connect_error();
    }

    // Validate form data (you may want to add more validation)
    if (empty($username) || empty($firstName) || empty($lastName) || empty($password) || empty($repeatPassword)) {
        echo "All fields are required.";
    } elseif ($password != $repeatPassword) {
        echo "Passwords do not match.";

        
    } else {

        // Insert into the user table with role as 'tut'
        $sqlInsertUser = "INSERT INTO user (username, password, first_name, last_name, role) VALUES ('$username', '$password', '$firstName', '$lastName', 'tut')";

        if ($conn->query($sqlInsertUser) === TRUE) {
            // Get the user_id of the inserted user
            $user_id = $conn->insert_id;

            // Insert into the tutor table with the same user_id
            $sqlInsertTutor = "INSERT INTO tutor (tutor_id, added_by) VALUES ($user_id, $user_id)";

            if ($conn->query($sqlInsertTutor) === TRUE) {
                echo "Tutor added successfully!";
            } else {
                echo "Error adding tutor: " . $conn->error;
            }
        } else {
            echo "Error adding user: " . $conn->error;
        }

        // Close connection
        $conn->close();
    }
}
?>