<?php include('../navBar/adminNavBar.php'); ?>


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