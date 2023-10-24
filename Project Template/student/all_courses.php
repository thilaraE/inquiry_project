<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Student - Dashboard</title>

    <!-- Custom fonts for this template-->
    <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
		<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">

    <!-- Custom styles for this template-->
    <link href="../css/sb-admin-2.min.css" rel="stylesheet">

</head>


    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
                <div class="sidebar-brand-text mx-3">Student Dashboard</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item">
                <a class="nav-link" href="my_courses.php">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>My Courses</span></a>
            </li>

            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item active">
                <a class="nav-link" href="all_courses.php">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>All Courses</span></a>
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
                        <a class="dropdown-item" href="resetPasswordStudent.php">
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
                        <h1 class="h3 mb-0 text-gray-800">All Courses</h1>
                    </div>

                    <!-- Content Row -->
                    <div class="row">
                    <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Enrollment</h6>
                                </div>
                                <div class="card-body">
                                    <p>Here, you can enroll into courses if you have not yet enrolled or if you want to enroll to specific course. 
                                    <p class="mb-0">Below we have the Enroll option for each grade and it's subjects. </p>
                                </div>
                            </div> 

                    <?php include("settings.php");

                    $conn = @mysqli_connect($host, $user, $pwd, $sql_db);
                    $role = "stu";
                    if (!$conn) {
                        echo $host;
                        echo $user;
                        echo $pwd;
                        echo mysqli_connect_error();
                    }
                    else{
                        $query="SELECT * FROM tutorial_class";
                        $result = mysqli_query($conn,$query);
                        $studentId=$_SESSION["user_id"];
                        $queryEnrollment="SELECT * FROM enrollment where student_id=$studentId";
                        if(!$result){
                            echo "error in query";
                        }
                        else{
                            while($row=mysqli_fetch_assoc($result)){
                                $enrolFlag = false;
                                $resultEnrollment = mysqli_query($conn,$queryEnrollment);
                                while($row2=mysqli_fetch_assoc($resultEnrollment)){
                                    if($row["class_id"]==$row2["class_id"]){
                                        echo "<div class=\"col-lg-6 mb-4\"><div class=\"card bg-primary text-white shadow\"><div class=\"card-body\">",$row["subject"],"<div class=\"text-white-50 small\">Fee: ",$row["fee"],"</div><form method=\"post\" action=\"allcoursesaction.php\"><input type=\"hidden\" name=\"class_id\" value=",$row["class_id"],"> <!-- Replace with the actual class ID --><button type=\"submit\" name=\"classid\" class=\"btn btn-primary\" style=\"color:#4e73df\"> Enroll</button></form>";
                                        echo '<form method="post" action="allcoursedetails.php">';
                                        echo '<input type="hidden" name="class_id" value="' . $row["class_id"] . '">';
                                        echo '<button type="submit" name="classid" class="btn btn-primary">View Details</button>';
                                        echo '</form>';
                                        echo "</div></div></div>";
                                        $enrolFlag = true;
                                    }
                                }
                                if($enrolFlag == false){
                                    echo "<div class=\"col-lg-6 mb-4\"><div class=\"card bg-primary text-white shadow\"><div class=\"card-body\">",$row["subject"],"<div class=\"text-white-50 small\">Fee: ",$row["fee"],"</div><form method=\"post\" action=\"allcoursesaction.php\"><input type=\"hidden\" name=\"class_id\" value=",$row["class_id"],"> <!-- Replace with the actual class ID --><button type=\"submit\" name=\"classid\" class=\"btn btn-primary\">Enroll</button></form>";
                                    echo '<form method="post" action="allcoursedetails.php">';
                                    echo '<input type="hidden" name="class_id" value="' . $row["class_id"] . '">';
                                    echo '<button type="submit" name="classid" class="btn btn-primary">View Details</button>';
                                    echo '</form>';
                                    echo "</div></div></div>";

                                }
                            }
                        }
                    }
                    
                ?>
                        
                                        </div>
                                    </div>
                                </div>         
                    </div>

                </div>
                <!-- /.container-fluid -->

            </div>
	
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Your Website 2023</span>
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
    <script src="../js/demo/chart-area-demo.js"></script>
    <script src="../js/demo/chart-pie-demo.js"></script>

</body>

</html>