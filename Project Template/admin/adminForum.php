<?php include('../navBar/adminNavBar.php'); ?>


                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Question Forum</h1>
                        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" onclick="openForm()"><i
                            class="fas fa-comments fa-sm text-white-50"></i> New Question</a>
                            
                            <script>
                                function openForm() {
                                  document.getElementById("myForm").style.display = "block";
                                }
                                function submit() {
                                  document.getElementById("questionForm").submit();

                                  document.getElementById("myForm").style.display = "none";
                                }
                                
                                function closeForm() {
                                  document.getElementById("myForm").style.display = "none";
                                }
                            </script>
                    </div>
                    <div class="hide" id="myForm">
                        <div class="card shadow mb-4" >
                            <div class="card-header py-3">
                            <div class="col-lg-7">
                        <div class="p-5">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">Add a new question to the forum</h1>
                            </div>
                                <form id="questionForm" class="user" method="post" action="forumProcessing.php" >
                                <div class="form-group">
                                <input type="text" class="form-control form-control-user" name="question"
                                                placeholder="Write your question here">
                                                </div>
                                                <input type="hidden" name="formType" value="submitQuestion" />                                                        
                                                <input type="submit" value="submit" />                                                        
                                </form>
                            </div>
                            <a href="#" class="btn btn-danger btn-icon-split btn-sm" onclick="closeForm()">
                                        <span class="icon text-white-50">
                                            <i class="fas fa-trash"></i>
                                        </span>
                                        <span class="text">Cancel</span>
                                    </a>
                            
                        </div>
                    </div>
                    </div></div></div>

                    <?php
                        require_once("settings.php");
                        $conn = @mysqli_connect($host,$user,$pwd,$sql_db);
                        if(!$conn){
                            echo $host;
                            echo $user;
                            echo $pwd;
                            echo mysqli_connect_error();
                        }
                        else{

                            $query_for_time = "SELECT SEC_TO_TIME(SUM(TIME_TO_SEC(time_taken))) as time_taken,first_name,last_name, answered_by FROM `question`,user WHERE user_id=answered_by group by answered_by";
                            $result_for_time = mysqli_query($conn,$query_for_time);
                            if(!$result_for_time){
                                echo "<p>Something wrong with the query</p>";
                            }
                            else{
                                echo "<div class=\"row\">";
                                while($row=mysqli_fetch_assoc($result_for_time)){
                                    echo "<div class=\"col-xl-3 col-md-6 mb-4\"><div class=\"card border-left-primary shadow h-100 py-2\"><div class=\"card-body\"><div class=\"row no-gutters align-items-center\"><div class=\"col mr-2\"><div class=\"text-xs font-weight-bold text-primary text-uppercase mb-1\">",$row["first_name"]," ",$row["last_name"],"</div><div class=\"h5 mb-0 font-weight-bold text-gray-800\">",$row["time_taken"],"</div></div><div class=\"col-auto\">",$row["answered_by"],"</div></div></div></div></div>";                                
                                }
                                echo "</div>";
                            }

                                $query = "SELECT * FROM forum,question WHERE forum.forum_id=question.forum_id and class_id=1 ORDER BY asked_timestamp DESC";
                                $result = mysqli_query($conn,$query);
                                if(!$result){
                                    echo "<p>Something wrong with the query</p>";
                                }
                                else{
                                    while($row=mysqli_fetch_assoc($result)){
                                        if($row["answer"]==null){
                                            echo "<div class=\"card shadow mb-4\"><div class=\"card-header py-3\"><h6 class=\"m-0 font-weight-bold text-primary\">",$row["question"],"</h6><small>Student ID:",$row["asked_by"],"</small></br><small>Posted at: ",$row["asked_timestamp"],"</small></div><div class=\"card-body\"><em>Sorry this question has not been answered yet :(</em></div> </div>";
                                        }
                                        else{
                                            echo "<div class=\"card shadow mb-4\"><div class=\"card-header py-3\"><h6 class=\"m-0 font-weight-bold text-primary\">",$row["question"],"</h6><small>Student ID:",$row["asked_by"],"</small></br><small>Posted at: ",$row["asked_timestamp"],"</small></div><div class=\"card-body\">",$row["answer"],"</br></br><small>Tutor ID:",$row["answered_by"],"</small></br><small>Answered at: ",$row["answered_timestamp"],"</small><br><small>Time taken to answer: ",$row["time_taken"],"</small></div> </div>";
                                        }
                                    }
                                }
                        }
                    ?>

                    <!-- Content Row -->
                    <div class="row" id="questionCards">

                        <!-- Basic Card Example -->
                        <div class="hide" id="myForm">
                        <div class="card shadow mb-4" >
                            <div class="card-header py-3">
                                    <input type="text" class="m-0 font-weight-bold text-primary" id="exampleFirstName"
                                            placeholder="Write your question here">
                            </div>
                            <a href="#" class="btn btn-primary btn-user btn-block" onclick="submitQuestion()">
                                Submit
                            </a>
                        </div>
                        </div>
                        
                        
                        
                        <div class="col-lg-6 mb-4">
                         
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