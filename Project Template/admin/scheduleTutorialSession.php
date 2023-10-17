<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Admin - Dashboard</title>

    <!-- Custom fonts for this template-->
    <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="../css/sb-admin-2.min.css" rel="stylesheet">
</head>

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
                <div class="sidebar-brand-text mx-3">Admin Dashboard</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item">
                <a class="nav-link" href="overview.php">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Overview</span></a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="courseStats.php">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Course Stats</span></a>
            </li>

            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link" href="all_courses.php">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>All Courses</span></a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="addUser.php">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Add User</span></a>
            </li>

            <li class="nav-item active">
                <a class="nav-link" href="scheduleTutorialSession.php">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Schedule Tutorial Session</span></a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="scheduleTutorialClass.php">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Schedule Tutorial Class</span></a>
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
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small">Douglas McGee</span>
                                <!-- <img class="img-profile rounded-circle" src="img/undraw_profile.svg"> -->
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Reset Password
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="../users/logout.php" >
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->

                

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Schedule class</h1>
                    </div>

                    <!-- Content Row -->
                    <div class="row">
                        <div class="col-lg-7">
                            <div class="p-5">
                                <div class="text-center">
                                    <h1 class="h4 text-gray-900 mb-4">Create a new tutorial session</h1>
                                </div>
                                <form class="user" method="post" action="adminForms.php">
                                    <div class="form-group row">
                                        <div class="col-sm-6">
                                            <select class="form-control" id="class" name="classId" required>
                                                <option class="dropdown-item" value="">Class Id</option>
                                                <?php
                                                    require_once("settings.php");
                                                    $conn = @mysqli_connect($host,$user,$pwd,$sql_db);
                                                    if(!$conn){
                                                        echo mysqli_connect_error();
                                                    }
                                                    else{
                                                            $query = "SELECT class_id,subject FROM tutorial_class";
                                                            $result = mysqli_query($conn,$query);
                                                            if(!$result){
                                                                echo "<p>Something wrong with the query</p>";
                                                            }
                                                            else{
                                                                while($row=mysqli_fetch_assoc($result)){
                                                                    echo "<option class=\"dropdown-item\" value=\"",$row["class_id"],"\">",$row["class_id"],"-",$row["subject"],"</option>";
                                                                }
                                                            }
                                                    }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="col-sm-6">
                                            <select class="form-control" id="tutor" name="tutorId" required>
                                                <option class="dropdown-item" value="">Tutor Id</option>
                                                <?php
                                                    require_once("settings.php");
                                                    $conn = @mysqli_connect($host,$user,$pwd,$sql_db);
                                                    if(!$conn){
                                                        echo mysqli_connect_error();
                                                    }
                                                    else{
                                                            $query = "SELECT tutor_id, first_name FROM tutor,user WHERE tutor_id=user_id";
                                                            $result = mysqli_query($conn,$query);
                                                            if(!$result){
                                                                echo "<p>Something wrong with the query</p>";
                                                            }
                                                            else{
                                                                while($row=mysqli_fetch_assoc($result)){
                                                                    echo "<option class=\"dropdown-item\" value=\"",$row["tutor_id"],"\">",$row["tutor_id"],"-",$row["first_name"],"</option>";
                                                                }
                                                            }
                                                    }
                                                ?>
                                            </select>
                                            <input type="hidden" name="formType" value="scheduleSession">
                                        </div>
                                    </div>
                                    <input class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" type="submit" value="Create tutorial session" />
                                    </div>
                                    
                                    
                                    
                                </form>
                                
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