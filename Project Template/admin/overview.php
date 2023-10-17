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

    // SQL query for enrollments
    $sql = "SELECT
tc.subject AS tutorial_subject,
COUNT(e.student_id) AS student_count
FROM
tutorial_class tc
LEFT JOIN
enrollment e ON tc.class_id = e.class_id
GROUP BY
tc.subject";

    $result = $conn->query($sql);

    // Fetch the data and format it as an associative array
    $data = array();
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }


        // SQL query for questions answered
        $sql2 = "SELECT
        tc.subject AS tutorial_subject,
        COUNT(q.question_id) AS question_count
        FROM
        tutorial_class tc
        LEFT JOIN
        forum f ON tc.class_id = f.class_id
        LEFT JOIN 
        question q ON f.forum_id = q.forum_id
        GROUP BY
        tc.subject";
        
            $result2 = $conn->query($sql2);
        
            // Fetch the data and format it as an associative array
            $data2 = array();
            while ($row2 = $result2->fetch_assoc()) {
                $data2[] = $row2;
            }

    // Close connection
    $conn->close();

    ?>

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Overview</h1>
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
                    <div class="row">

                        <div class="col-xl-8 col-lg-1">
                            <!-- Bar Chart -->
                            <div class="card shadow mb-10">
                                <div class="card-header py-2">
                                    <h6 class="m-0 font-weight-bold text-primary">Student Enrollments</h6>
                                </div>
                                <div class="card-body">
                                    <div class="chart-bar">
                                        <canvas id="enrollmentchart"></canvas>
                                    </div>
                                    <hr>
                                </div>
                            </div>
                        </div>
                    </div>
        </br>
                    <div class="row">

                        <div class="col-xl-8 col-lg-1">
                            <!-- Bar Chart -->
                            <div class="card shadow mb-10">
                                <div class="card-header py-2">
                                    <h6 class="m-0 font-weight-bold text-primary">Questions answered</h6>
                                </div>
                                <div class="card-body">
                                    <div class="chart-bar">
                                        <canvas id="questionsChart"></canvas>
                                    </div>
                                    <hr>
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
    <script src="../js/demo/chart-bar-demo.js"></script>
    <script src="../js/demo/chart-pie-demo.js"></script>
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.0/Chart.min.js"></script> -->

    <script>
        // Data from PHP
        document.addEventListener("DOMContentLoaded", function () {
            // Data from PHP
            var labels = <?php echo json_encode(array_column($data, 'tutorial_subject')); ?>;
            var values = <?php echo json_encode(array_column($data, 'student_count')); ?>;

            // Get the canvas element
            var canvas = document.getElementById('enrollmentchart');

            // Check if the canvas element exists and is a canvas
            if (canvas && canvas.getContext) {
                var ctx = canvas.getContext('2d');

                var myBarChart = new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: labels,
                        datasets: [{
                            label: 'Student Count',
                            label: "Enrollments",
                            backgroundColor: "#4e73df",
                            hoverBackgroundColor: "#2e59d9",
                            borderColor: "#4e73df",
                            data: values,
                        }]
                    },
                    options: {
                        scales: {
                            x: {
                                type: 'category',
                                labels: labels,
                            },
                            y: {
                                beginAtZero: true,
                            },
                        }
                    }

                });
            } else {
                console.error("Canvas element not found or is not a valid canvas.");
            }
        });

    </script>
    <script>
        // Data from PHP
        document.addEventListener("DOMContentLoaded", function () {
            // Data from PHP
            var labels = <?php echo json_encode(array_column($data2, 'tutorial_subject')); ?>;
            var values = <?php echo json_encode(array_column($data2, 'question_count')); ?>;

            // Get the canvas element
            var canvas = document.getElementById('questionsChart');

            // Check if the canvas element exists and is a canvas
            if (canvas && canvas.getContext) {
                var ctx = canvas.getContext('2d');

                var myBarChart = new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: labels,
                        datasets: [{
                            label: 'Questions Count',
                            label: "Questions",
                            backgroundColor: "#4e73df",
                            hoverBackgroundColor: "#2e59d9",
                            borderColor: "#4e73df",
                            data: values,
                        }]
                    },
                    options: {
                        scales: {
                            x: {
                                type: 'category',
                                labels: labels,
                            },
                            y: {
                                beginAtZero: true,
                            },
                        }
                    }

                });
            } else {
                console.error("Canvas element not found or is not a valid canvas.");
            }
        });

    </script>

</body>

</html>