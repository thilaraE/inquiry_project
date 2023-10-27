<?php
session_start();

require_once("settings.php");
// Create connection
$connect = mysqli_connect($servername, $username, $password, $database);
$tutorId=$_SESSION["user_id"];

// Check connection
if (!$connect) {
    die("Connection failed: " . mysqli_connect_error());
}

$query1 = "SELECT student_id, COUNT(student_id) AS student_count FROM student GROUP BY student_id";
$result1 = mysqli_query($connect, $query1);

if (!$result1) {
    die("Query 1 failed: " . mysqli_error($connect));
}

$chart_data = '';

while ($row = mysqli_fetch_array($result1)) {
    $chart_data .= "{ student_id:'" . $row["student_id"] . "', total_enrollment:" . $row["student_id"] . "}, ";
}


// Close the database connection
?>

<?php
                                                // Database connection parameters
                                                require_once("settings.php");

                                                // Create a database connection
                                                $conn = new mysqli($servername, $username, $password, $dbname);

                                                // Check if the connection was successful
                                                if ($conn->connect_error) {
                                                    die("Connection failed: " . $conn->connect_error);
                                                }

                                                // // Query to count the total number of students
                                                // $sql = "SELECT COUNT(student_id) AS total_students FROM student";
                                                // $result = $conn->query($sql);

                                                // if ($result->num_rows > 0) {
                                                //     $row = $result->fetch_assoc();
                                                //     $total_students = $row['total_students'];
                                                //     echo  $total_students;
                                                // } else {
                                                //     echo "No students found.";
                                                // }

                                                $sql = "SELECT tutorial_class.class_id, tutorial_class.subject, count(enrollment.student_id) as number_of_students FROM (tutorial_class JOIN teaching_session on tutorial_class.class_id=teaching_session.class_id) JOIN enrollment  on tutorial_class.class_id=enrollment.class_id WHERE teaching_session.tutor_id=$tutorId GROUP by tutorial_class.class_id;";
                                                $tutorClasses = $conn->query($sql);

                                                $sql = "SELECT tutorial_class.class_id,tutorial_class.subject, count(question.question_id) as asked, sum(case when question.answered_by is not null then 1 else 0 end) as answered FROM `question` JOIN ((forum JOIN tutorial_class on forum.class_id= tutorial_class.class_id) JOIN teaching_session on forum.class_id=teaching_session.class_id ) on question.forum_id = forum.forum_id where teaching_session.tutor_id=$tutorId GROUP by tutorial_class.class_id;";
                                                $questionCount = $conn->query($sql);

                                                $sql = "SELECT count(question.question_id) as asked, sum(case when question.answered_by is not null then 1 else 0 end) as answered FROM `question` JOIN (forum JOIN teaching_session on forum.class_id=teaching_session.class_id ) on question.forum_id = forum.forum_id where teaching_session.tutor_id=$tutorId;";
                                                $totalQuestionCount = $conn->query($sql);
                                                // Close the database connection
          $conn->close();
    ?>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Tutor  Dashboard</title>

    <!-- Custom fonts for this template-->
    <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="../css/sb-admin-2.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/calendar.css">
    <link rel="stylesheet" href="../css/chat.css">
    <link rel="stylesheet" href="../css/chart.css">


    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>

</head>

<body id="page-top">

<!-- Page Wrapper -->
<div id="wrapper">

<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
        <div class="sidebar-brand-text mx-3">Tutor Dashboard</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">
        <!-- Nav Item - Dashboard -->
        <li class="nav-item active">
                <a class="nav-link" href="overview.php">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Overview</span></a>
            </li>
    <!-- Nav Item - Dashboard -->
    <li class="nav-item">
        <a class="nav-link" href="my_courses.php">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>My Courses</span></a>
    </li>

    

    
    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
<!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>


                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                        <a class="dropdown-item" href="resetPasswordTutor.php">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Reset Password
                                </a>
                                
                        </li>
                        <li class="nav-item dropdown no-arrow">
                        
                                <a class="dropdown-item" href="../users/logout.php" >
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Overview</h1>
                    </div>

                    <!-- Content Row -->
                    <div class="row ">

                        <!-- Earnings (Monthly) Card Example -->
                        
                                                <!-- Earnings (Monthly) Card Example -->
                        <div class="col-12 col-md-3 mb-3">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                Total Courses
                                            </div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                <?php include("get_total_courses.php"); ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-12 col-md-3 mb-3">
                            <div class="card border-left-success shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                Total Student Enrollment
                                            </div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                <?php include("get_total_students.php"); ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                                                <!-- Earnings (Monthly) Card Example -->
                        <div class="col-12 col-md-3 mb-3">
                            <div class="card border-left-warning shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                                Total answered questions
                                            </div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                <?php 
                                                if ($totalQuestionCount->num_rows > 0) {
                                                    $row = $totalQuestionCount->fetch_assoc();
                                                    $total_q = $row['asked'];
                                                    $total_awd_q= $row['answered'];
                                                    echo  $total_awd_q ." of ".  $total_q;
                                                } else {
                                                    echo "No students found.";
                                                }
                                                
                                                ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Content Row -->

                    <div class="row justify-content-between">

                        <!-- Area Chart -->
                        <div class="col-xl-6 col-lg-7">
                            <div class="card shadow mb-4">
                                <!-- Card Header - Dropdown -->
                                <div
                                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary">Student Enrollments</h6>

                                </div>
                                <!-- Card Body -->
                                <div class="card-body">
                                    <table class="table">
                                        <theader>
                                            <tr>
                                                <th>Class Id</th>
                                                <th>Subject</th>
                                                <th>Students Enrolled</th>
                                            </tr>
                                        </theader>
                                        <tbody>
                                            <?php
                                                if ($tutorClasses->num_rows > 0) {
                                                  while($row = $tutorClasses->fetch_assoc()){
                                                    ?>
                                                     <tr>
                                                        <td><?=$row["class_id"]?></td>
                                                        <td><?=$row["subject"]?></td>
                                                        <td><?=$row["number_of_students"]?></td>
                                                    </tr>
                                                    <?php
                                                  }
                                                } else {
                                                    // echo "No students found.";
                                                }
                                            
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <!-- Pie Chart -->
                        <div class="col-xl-6 col-lg-7">
                            <div class="card shadow mb-4">
                                <!-- Card Header - Dropdown -->
                                <div
                                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary">Questions Answered</h6>
                                    
                                </div>
                                <!-- Card Body -->
                                <div class="card-body">
                                    <table class="table">
                                        <theader>
                                            <tr>
                                                <th>Class Id</th>
                                                <th>Subject</th>
                                                <th>Question</th>
                                                <th>Answered questions</th>
                                            </tr>
                                        </theader>
                                        <tbody>
                                            <?php
                                                if ($questionCount->num_rows > 0) {
                                                  while($row = $questionCount->fetch_assoc()){
                                                    ?>
                                                     <tr>
                                                        <td><?=$row["class_id"]?></td>
                                                        <td><?=$row["subject"]?></td>
                                                        <td><?=$row["asked"]?></td>
                                                        <td><?=$row["answered"]?></td>
                                                    </tr>
                                                    <?php
                                                  }
                                                } else {
                                                    // echo "No students found.";
                                                }
                                            
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Your Website 2021</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="login.html">Logout</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="../vendor/jquery/jquery.min.js"></script>
    <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="../vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="../js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="../vendor/chart.js/Chart.min.js"></script>

    <!-- Page level custom scripts -->

    <script src="../js/demo/chart-area-demo-bar-2.js"></script>
    <script src="../js/demo/chart-pie-demo.js"></script>
    <script src="../js/demo/calendar.js"></script>
    <script src="../js/demo/chat.js"></script>


    <script>
    Morris.Bar({
        element: 'chart',
        data: [<?php echo $chart_data; ?>],
        xkey: 'course_name',
        ykeys: ['total_enrollment'],
        labels: ['Total Enrollment'],
        hideHover: 'auto',
        stacked: true,
        gridTextColor: '#666666', // Change grid text color
        gridLineColor: 'rgb(234, 236, 244)', // Change grid line color
        gridStrokeWidth: 1, // Change grid line width
        barColors: ['#4e73df']
    });
    </script>
    <script>
    Morris.Bar({
        element: 'chart2',
        data: [<?php echo $chart2_data; ?>],
        xkey: 'week_number',
        ykeys: ['total_questions'],
        labels: ['Total Questions'],
        hideHover: 'auto',
        barColors: ['#4e73df']
    });
    </script>


</body>

</html>