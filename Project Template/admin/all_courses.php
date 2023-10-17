<?php include('../navBar/adminNavBar.php'); ?>


    <?php
    include("settining.php");

    $conn = @mysqli_connect($host, $user, $pwd, $sql_db);
    $role = "stu";
    if (!$conn) {
        echo $host;
        echo $user;
        echo $pwd;
        echo mysqli_connect_error();
    }
    // get the total classes 
    $totalCoursesQ = "SELECT COUNT(*) as class_id FROM tutorial_class";
    $totalCourses = mysqli_query($conn, $totalCoursesQ);
    $totalCoursesRow = mysqli_fetch_assoc($totalCourses);

    // get the total student 
    $totalStudentsQ = "SELECT COUNT(*) as student_id FROM student";
    $totalStudents = mysqli_query($conn, $totalStudentsQ);
    $totalStudentsRow = mysqli_fetch_assoc($totalStudents);

    // get the total questions 
    $totalquestionsQ = "SELECT COUNT(*) as question_id FROM question";
    $totalquestions = mysqli_query($conn, $totalquestionsQ);
    $totalquestionsRow = mysqli_fetch_assoc($totalquestions);

    // get the total questions answerd 
    $totalquestionsAnsweredQ = "SELECT COUNT(*) AS question_id FROM question WHERE answered_by IS NOT NULL";
    $questionsAnswered = mysqli_query($conn, $totalquestionsAnsweredQ);
    $totalquestionsAnsweredRow = mysqli_fetch_assoc($questionsAnswered);



    // get courses table 
    $tableForAllCoursesQ = "SELECT
    tc.class_id,
    tc.subject AS tutorial_subject,
    COUNT(q.question_id) AS question_count,
    COUNT(DISTINCT e.student_id) AS student_count
    FROM
    tutorial_class tc
    LEFT JOIN
    question q ON tc.class_id = q.forum_id
    LEFT JOIN
    enrollment e ON tc.class_id = e.class_id
    GROUP BY
    tc.class_id, tc.subject";
    $tableForAllCourses = mysqli_query($conn, $tableForAllCoursesQ);
    ?>

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">All courses</h1>
                    </div>

                    <!-- Content Row -->
                    <div class="row">

                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                Total Courses</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                <?php echo $totalCoursesRow['class_id']; ?>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-cogs fa-2x text-black-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-success shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                Total students </div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                <?php echo $totalStudentsRow['student_id']; ?>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-user fa-2x text-black-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-success shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                Total answerd questions</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                <?php echo $totalquestionsAnsweredRow['question_id']; ?>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-comments fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Pending Requests Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-warning shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                                Total questions</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                <?php echo $totalquestionsRow['question_id']; ?>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-comments fa-2x text-black-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Content Row -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Course Statistics</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Class ID</th>
                                            <th>Class Name</th>
                                            <th>Questions</th>
                                            <th>Enrollments</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <?php
                                        while ($tableForAllCoursesRow = mysqli_fetch_assoc($tableForAllCourses)) {
                                            echo "<tr>";
                                            echo "<td>", $tableForAllCoursesRow["class_id"], "</td>\n";
                                            echo "<td>", $tableForAllCoursesRow["tutorial_subject"], "</td>\n";
                                            echo "<td>", $tableForAllCoursesRow["question_count"], "</td>\n";
                                            echo "<td>", $tableForAllCoursesRow["student_count"], "</td>\n";
                                            echo "</tr>";
                                        }
                                        ?>

                                    </tbody>
                                </table>
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