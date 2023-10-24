<?php
    require_once("settings.php");
    $conn = @mysqli_connect($host,$user,$pwd,$sql_db);
    echo "welome";
    if(!$conn){
        echo $host;
        echo $user;
        echo $pwd;
        echo mysqli_connect_error();
    }
    else{
        print_r($_POST);
        if(isset($_POST["formType"])){
            if($_POST["formType"]=="resetPassword"){
                $username = $_POST["username"];
                $oldPassword = $_POST["oldPassword"];
                $newPassword = $_POST["newPassword"];
                $confirmPassword = $_POST["confirmPassword"];
                if($newPassword != $confirmPassword){
                    echo '<script type="text/javascript">'; 
                    echo 'alert("Unsuccessful: Password is not the same as the confirmed password!");'; 
                    echo 'window.location.href = "resetPasswordStudent.php";';
                    echo '</script>';
                }
                else{
                    $queryOldPassword = "SELECT * FROM user WHERE username= '$username'";
                    $resultOldPassword = mysqli_query($conn,$queryOldPassword);
                    $userDetails = $resultOldPassword->fetch_assoc();
                    if (!password_verify($oldPassword, $userDetails["password"])){
                        echo '<script type="text/javascript">'; 
                        echo 'alert("Unsuccessful: The old password is incorrect!");'; 
                        echo 'window.location.href = "resetPasswordStudent.php";';
                        echo '</script>';
                    }
                    else{
                        $newhash = password_hash($newPassword, PASSWORD_DEFAULT);
                        $updateQuery = "UPDATE user SET password='$newhash' WHERE username='$username'";
                        $result = mysqli_query($conn,$updateQuery);
                        if($result){
                            echo '<script type="text/javascript">'; 
                            echo 'alert("Successfull: Password successfully added!");'; 
                            echo 'window.location.href = "resetPasswordStudent.php";';
                            echo '</script>';
                        }
                        else{
                            echo "Something wrong with the query";
                        }
                        
                    }
                }                
            }
            
        }
        
        else{
            echo "Error";
        }
    }


    
?>