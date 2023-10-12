<?php

 $host = "localhost";
 $uname = "root";
 $password = "";

 $db_name = "inquiry_project";

 $conn = @mysqli_connect($host, $uname, $password, $inquiry_project);

 if(!$conn) {
    echo "Connection Failed";
 }
 ?>