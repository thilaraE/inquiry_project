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
if (strlen($_POST["password"]) < 8) {
    die("Password must be at least 8 characters");
}

if ( ! preg_match("/[a-z]/i", $_POST["password"])) {
    die("Password must contain at least one letter");
}

if ( ! preg_match("/[0-9]/", $_POST["password"])) {
    die("Password must contain at least one number");
}

if ($_POST["password"] !== $_POST["password_confirmation"]) {
    die("Passwords must match");
}

$password_hash = password_hash($_POST["password"], PASSWORD_DEFAULT);


$mysqli = require __DIR__ . "/database.php";

$sql = "INSERT INTO user (name, lastname, email, state, role, password_hash)
        VALUES (?, ?, ?, ?, ?, ?)";
        
$stmt = $mysqli->stmt_init();

if ( ! $stmt->prepare($sql)) {
    die("SQL error: " . $mysqli->error);
}

$stmt->bind_param("ssssss",
                  $_POST["name"],
                  $_POST["lastname"],
                  $_POST["email"],
                  $_POST["state"],
                  $_POST["role"],
                  $password_hash);
                  
if ($stmt->execute()) {

    header("Location: signup-success.html");
    exit;
    
} else {
    
    if ($mysqli->errno === 1062) {
        die("email already taken");
    } else {
        die($mysqli->error . " " . $mysqli->errno);
    }
}

    


    