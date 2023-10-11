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
            if($_POST["formType"]=="submitQuestion"){
                if(isset($_POST["question"])){
                    date_default_timezone_set('Australia/Melbourne');
                    $question = $_POST["question"];
                    $date = date('Y-m-d H:i:s');
                    $query = "INSERT INTO `question` (`question_id`, `forum_id`, `asked_by`, `answered_by`, `question`, `answer`, `asked_timestamp`, `answered_timestamp`) VALUES (NULL, '1', '3', NULL, '$question' , NULL, '$date', NULL)";
                    echo $query;
                    $result = mysqli_query($conn,$query);
                    if($result){
                        header("location: studentForum.php");
                    } 
                }
            }
            elseif($_POST["formType"]=="submitAnswer"){
                if(isset($_POST["answer"])){
                    date_default_timezone_set('Australia/Melbourne');
                    $questionId = $_POST["questionId"];
                    $answer = $_POST["answer"];
                    echo $questionId,$answer;
                    $date = date('Y-m-d H:i:s');
                    $time_post = microtime(true);
                    $exec_time = $time_post - $_POST["startTime"];
                    $query = "UPDATE question SET answer= '$answer', answered_timestamp='$date', answered_by='2', time_taken='$exec_time' WHERE question_id='$questionId'";
                    echo $query;
                    $result = mysqli_query($conn,$query);
                    if($result){
                        header("location: forum.php");
                    } 
                }
            }
            
        }
        
        else{
            echo "here";
        }
    }
    
?>