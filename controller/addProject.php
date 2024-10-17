

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
                                <!-- /.card-header -->
                                <!-- form start -->
                                <form id="login" onsubmit="return validateForm()">
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label for="Project Name">Project Name</label>
                                            <input type="text" class="form-control" id="project_name" placeholder="Enter Project Name" required autocomplete="off">
                                        </div>
                                        <div class="form-group">
                                            <label for="Creation Date">Creation Date</label>
                                            <input type="date" class="form-control" id="project_created" value="<?php echo date('Y-m-d'); ?>" readonly>
                                        </div>
                                        <div class="form-group">
                                            <label for="Project Start">Project Start</label>
                                            <input type="date" class="form-control" id="start_date" placeholder="Enter Project Start" required autocomplete="off">
                                        </div>
                                        <div class="form-group">
                                            <label for="Project End">Project End</label>
                                            <input type="date" class="form-control" id="end_date" placeholder="Enter Project End" required autocomplete="off">
                                        </div>
                                    </div>
                                    <!-- /.card-body -->

                                    <div class="card-footer">
                                        <button type="submit" class="btn btn-primary btn-block">Submit</button>
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
        function validateForm() {
            // Check if all required fields are filled
            var requiredFields = document.querySelectorAll('input[required]');
            for (var i = 0; i < requiredFields.length; i++) {
                if (!requiredFields[i].value) {
                    toastr.error('Please fill in all required fields.');
                    return false; // Prevent form submission
                }
            }

            SaveRecord();
            return false; // Prevent form submission as we're handling it with AJAX
        }

        function SaveRecord() {
            var project_name = document.getElementById("project_name").value;
            var project_created = document.getElementById("project_created").value;
            var start_date = document.getElementById("start_date").value;
            var end_date = document.getElementById("end_date").value;
            var user_id = "<?php echo isset($_SESSION['userid']) ? $_SESSION['userid'] : ''; ?>"; // Get the session user ID

            $.ajax({
                type: "POST",
                url: '../action/addProject_action.php',
                data: {
                    project_name: project_name,
                    project_created: project_created,
                    start_date: start_date,
                    end_date: end_date,
                    user_id: user_id
                },
                success: function (data) {
                    const obj = JSON.parse(data);
                    if (obj.response == 'success') {
                        toastr.success(obj.message);
                        window.setTimeout(function () {
                            window.location.href = "../controller/projectList.php";
                        }, 1000);
                    } else {
                        toastr.error(obj.message);
                    }
                },
                error: function (xhr, textStatus, errorThrown) {
                    toastr.error("An error occurred. Please try again.");
                }
            })
        }
    </script>

</body>

</html>
