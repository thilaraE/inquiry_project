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
            
        }
        
        else{
            echo "here";
        }
    }
    
?>