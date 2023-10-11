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
                    header("location: scheduleTutorialSession.php");
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
                if($result){
                    header("location: scheduleTutorialClass.html");
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

                        // send email
                        mail($username,"User Account Created!",$msg);

                        echo '<script type="text/javascript">'; 
                        echo 'alert("Successfull: User successfully added!");'; 
                        echo 'window.location.href = "addUser.html";';
                        echo '</script>';
                    } 
                }
                else{
                    echo '<script type="text/javascript">'; 
                    echo 'alert("Unsuccessful: Username already exists!");'; 
                    echo 'window.location.href = "addUser.html";';
                    echo '</script>';
                   
                }
                // if($result){
                //     header("location: addUser.html");
                // } 
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