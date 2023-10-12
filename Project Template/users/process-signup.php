<?php

if (empty($_POST["name"])) {
    die("Name is required");
}
if (empty($_POST["lastname"])) {
    die("Last Name is required");
}
if (empty($_POST["email"])) {
    die("email is required");
}
if (empty($_POST["state"])) {
    die("state is required");
}

$mysqli = require __DIR__ . "/database.php";

$sql = "INSERT INTO user1 (name, lastname, email, state)
        VALUES (?, ?, ?, ?)";
        
$stmt = $mysqli->stmt_init();

if ( ! $stmt->prepare($sql)) {
    die("SQL error: " . $mysqli->error);
}

$stmt->bind_param("ssss",
                  $_POST["name"],
                  $_POST["lastname"],
                  $_POST["email"],
                  $_POST["state"]);
                  


    


    