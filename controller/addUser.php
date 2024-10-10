<!DOCTYPE html>
<html lang="en">
    session_start();
<?php
session_start();
 include "../authCheck.php"; ?>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>TaskManagement | System</title>

    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="../plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="../dist/css/adminlte.min.css">
    <!-- Toastr CSS -->
    <link rel="stylesheet" href="../plugins/toastr/toastr.min.css">
</head>

<body class="hold-transition dark-mode sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
    <div class="wrapper">

        <!-- Main Sidebar Container -->
        <?php include '../sidebar.php'; ?>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0">Add a Project</h1>
                        </div>
                        <div class="col-sm-6">
                            <!-- Optional right column content -->
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.content-header -->

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <!-- left column -->
                        <div class="col-md-6">
                            <!-- general form elements -->
                            <div class="card card-primary">
                                <div class="card-header">
                                    <h3 class="card-title">Project Information</h3>
                                </div>
                                <form id="login">
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="Enter Staff ID" id="staff_id" name="staff_id">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-user-tie"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="Username" id="username" name="username">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-user"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" class="form-control" placeholder="Password" id="password"
                            name="password">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                   
                    <div class="row">
                        <div class="col-12">
                            <button type="button" class="btn btn-primary btn-block"
                                onclick="SaveRecord()">Submit</button>
                        </div>
                        
                    </div>

                </form>
                            </div>
                            <!-- /.card -->
                        </div>
                        <!--/.col (right) -->
                    </div>
                    <!-- /.row -->
                </div>
                <!-- /.container-fluid -->
            </section>
            <!-- /.content -->

        </div>
        <!-- /.content-wrapper -->

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->

        <!-- Main Footer -->
        <footer class="main-footer">
            <!-- Footer content -->
        </footer>
    </div>
    <!-- ./wrapper -->

    <!-- REQUIRED SCRIPTS -->
    <!-- jQuery -->
    <script src="../plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap -->
    <script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- overlayScrollbars -->
    <script src="../plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
    <!-- AdminLTE App -->
    <script src="../dist/js/adminlte.js"></script>
    <!-- Toastr JS -->
    <script src="../plugins/toastr/toastr.min.js"></script>

    <!-- PAGE PLUGINS -->
    <!-- jQuery Mapael -->
    <script src="../plugins/jquery-mousewheel/jquery.mousewheel.js"></script>
    <script src="../plugins/raphael/raphael.min.js"></script>
    <script src="../plugins/jquery-mapael/jquery.mapael.min.js"></script>
    <script src="../plugins/jquery-mapael/maps/usa_states.min.js"></script>
    <!-- ChartJS -->
    <script src="../plugins/chart.js/Chart.min.js"></script>

    <script>
        function SaveRecord() {
            var staff_id = document.getElementById("staff_id").value;
            var UserName = document.getElementById("username").value;
            var Password = document.getElementById("password").value;
            var role_id = 1;
            
           

            $.ajax({
                type: "POST",
                url: '../action/createAccount_action.php',
                data: {
                    staff_id: staff_id,
                    UserName: UserName,
                    Password: Password,
                    role_id: role_id
                 
                },
                success: function (data) {
                    const obj = JSON.parse(data);
                    if (obj.response == 'success') {
                        toastr.success(obj.message);
                    } else {
                        toastr.error(obj.message);
                    }
                },
                error: function (xhr, textStatus, errorThrown) {
                    alert("An error occurred. Please try again.");
                }
            });
        }

        function goBack() {
            window.history.back();
        }
    </script>

</body>

</html>
