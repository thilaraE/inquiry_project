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
            if($_POST["formType"]=="scheduleSession"){
                $tutorId = $_POST["tutorId"];
                $classId = $_POST["classId"];
                $query = "INSERT INTO `teaching_session`(`tutor_id`, `class_id`) VALUES ('$tutorId' , '$classId')";
                echo $query;
                $result = mysqli_query($conn,$query);
                if($result){
                    echo '<script type="text/javascript">'; 
                    echo 'alert("Successfull: Tutor successfully added!");'; 
                    echo 'window.location.href = "scheduleTutorialSession.php";';
                    echo '</script>';
                } 
            }
            elseif($_POST["formType"]=="scheduleClass"){
                $subject = $_POST["subject"];
                $duration = $_POST["duration"];
                $day = $_POST["day"];
                $time = $_POST["time"];
                $content = $_POST["content"];
                $fee = $_POST["fee"];
                $syllabus = $_POST["syllabus"];
                $query = "INSERT INTO `tutorial_class`(`subject`, `content`, `duration_in_hours`, `day_of_the_week`, `start_time`, `fee`, `syllabus_link`) VALUES ('$subject' , '$content','$duration','$day','$time','$fee','$syllabus')";
                echo $query;
                $result = mysqli_query($conn,$query);
                $queryClassId = "SELECT class_id FROM tutorial_class ORDER BY class_id DESC LIMIT 1";
                $resultClassId = mysqli_query($conn,$queryClassId);
                $classId = mysqli_fetch_assoc($resultClassId)["class_id"];
                $queryForum = "INSERT INTO `forum`(`class_id`) VALUES ('$classId')";
                $resultForum = mysqli_query($conn,$queryForum);
                if($result){
                    echo '<script type="text/javascript">'; 
                    echo 'alert("Successfull: Class successfully added!");'; 
                    echo 'window.location.href = "scheduleTutorialClass.php";';
                    echo '</script>';
                } 
            }
            elseif($_POST["formType"]=="createUser"){
                $firstname = $_POST["firstname"];
                $lastname = $_POST["lastname"];
                $role = $_POST["role"];
                $username = $_POST["username"];
                if(!isset($_POST["speciality"])){
                    $speciality=null;
                }
                else{
                    $speciality = $_POST["speciality"];
                }
                $password = rand_string(10);
                $hash = password_hash($password, PASSWORD_DEFAULT);
                $queryUsernameCheck = "SELECT * FROM user WHERE username='$username'";
                $resultUsernameCheck = mysqli_query($conn,$queryUsernameCheck);
                if(mysqli_num_rows($resultUsernameCheck)==0){
                    $userQuery = "INSERT INTO `user`(`username`, `password`, `first_name`, `last_name`, `role`) VALUES ('$username' , '$hash','$firstname','$lastname','$role');";
                    $userResult = mysqli_query($conn,$userQuery);
                    $userIdQuery = "SELECT user_id FROM user WHERE username='$username';";
                    $userIdResult = mysqli_query($conn,$userIdQuery);
                    $userId = mysqli_fetch_assoc($userIdResult)["user_id"];
                    if($role == "stu"){
                        $studentQuery = "INSERT INTO `student`(`student_id`, `date_of_birth`) VALUES ('$userId' , null)";
                        $studentResult = mysqli_query($conn,$studentQuery);
                    }
                    if($role == "tut"){
                        $tutorQuery = "INSERT INTO `tutor`(`tutor_id`, `speciality`, `added_by`) VALUES ('$userId' , '$speciality',1)";
                        $tutorResult = mysqli_query($conn,$tutorQuery);
                    }
                    if($userResult){

                        $msg = "Your account has been successfully created at Bright Boost! \n Please use to following credentials to log into the system:\n Username: $username \n Password: $password \n Have fun!";

                        // use wordwrap() if lines are longer than 70 characters
                        $msg = wordwrap($msg,70);
                        $headers = "From: Brightboost48@example.com";
                        echo "here";

                        // send email
                        if(mail($username,"User Account Created!",$msg,$headers)){
                            echo '<script type="text/javascript">'; 
                            echo 'alert("Successfull: User successfully added and emailed the credentials!");'; 
                            echo 'window.location.href = "addUser.php";';
                            echo '</script>';
                        }
                        echo "done";
                        
                    } 
                }
                else{
                    echo '<script type="text/javascript">'; 
                    echo 'alert("Unsuccessful: Username already exists!");'; 
                    echo 'window.location.href = "addUser.php";';
                    echo '</script>';
                   
                }
                // if($result){
                //     header("location: addUser.html");
                // } 
            }
            elseif($_POST["formType"]=="resetPassword"){
                $username = $_POST["username"];
                $oldPassword = $_POST["oldPassword"];
                $newPassword = $_POST["newPassword"];
                $confirmPassword = $_POST["confirmPassword"];
                if($newPassword != $confirmPassword){
                    echo '<script type="text/javascript">'; 
                    echo 'alert("Unsuccessful: Password is not the same as the confirmed password!");'; 
                    echo 'window.location.href = "resetPassword.php";';
                    echo '</script>';
                }
                else{
                    $queryOldPassword = "SELECT * FROM user WHERE username= '$username'";
                    $resultOldPassword = mysqli_query($conn,$queryOldPassword);
                    $userDetails = $resultOldPassword->fetch_assoc();
                    if (!password_verify($oldPassword, $userDetails["password"])){
                        echo '<script type="text/javascript">'; 
                        echo 'alert("Unsuccessful: The old password is incorrect!");'; 
                        echo 'window.location.href = "resetPassword.php";';
                        echo '</script>';
                    }
                    else{
                        $newhash = password_hash($newPassword, PASSWORD_DEFAULT);
                        $updateQuery = "UPDATE user SET password='$newhash' WHERE username='$username'";
                        $result = mysqli_query($conn,$updateQuery);
                        if($result){
                            echo '<script type="text/javascript">'; 
                            echo 'alert("Successfull: Password successfully added!");'; 
                            echo 'window.location.href = "resetPassword.php";';
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
            echo "here";
        }
    }


    function rand_string( $length ) {

        $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789*";
        return substr(str_shuffle($chars),0,$length);
    
    }
    
?>