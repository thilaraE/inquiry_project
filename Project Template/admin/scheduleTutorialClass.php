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
                                    <h1 class="h4 text-gray-900 mb-4">Create a new tutorial class</h1>
                                </div>
                                <form class="user" method="post" action="adminForms.php">
                                    <div class="form-group row">
                                        <div class="col-sm-6 mb-3 mb-sm-0">
                                            <input type="text" class="form-control form-control-user" name="subject"
                                                placeholder="Subject" required>
                                        </div>
                                        <div class="col-sm-6">
                                            <input type="text" class="form-control form-control-user" name="duration"
                                                placeholder="Duration in hours" required>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-6 mb-3 mb-sm-0">
                                            <select class="form-control" id="day" name="day" required>
                                                <option class="dropdown-item" value="">Scheduled day</option>
                                                <option class="dropdown-item" value="Monday">Monday</option>
                                                <option class="dropdown-item" value="Tuesday">Tuesday</option>
                                                <option class="dropdown-item" value="Wednedsay">Wednesday</option>
                                                <option class="dropdown-item" value="Thursday">Thursday</option>
                                                <option class="dropdown-item" value="Friday">Friday</option>
                                            </select>
                                        </div>
                                        <div class="col-sm-6">
                                            <select class="form-control" id="time" name="time" required>
                                                <option class="dropdown-item" value="">Start time</option>
                                                <option class="dropdown-item" value="15:00:00">3:00 PM</option>
                                                <option class="dropdown-item" value="15:30:00">3:30 PM</option>
                                                <option class="dropdown-item" value="16:00:00">4:00 PM</option>
                                                <option class="dropdown-item" value="16:30:00">4:30 PM</option>
                                                <option class="dropdown-item" value="17:00:00">5:00 PM</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <input type="text" class="form-control form-control-user" name="fee"
                                            placeholder="Fee" required>
                                    </div>
                                    <div class="form-group">
                                        <input type="text" class="form-control form-control-user" name="content"
                                            placeholder="Content" required>
                                    </div>
                                    <div class="form-group">
                                        <input type="text" class="form-control form-control-user" name="syllabus"
                                            placeholder="Syllabus Link">
                                    </div>
                                    <input type="hidden" name="formType" value="scheduleClass">                                    
                                    <input class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" type="submit" value="Create tutorial class" />
                                    
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