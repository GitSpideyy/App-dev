<!DOCTYPE html>
<html lang="en">
<?php include "../authCheck.php";?>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>TaskManagement | System </title>

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

        <!-- Preloader -->

      

        <!-- Main Sidebar Container -->
        <?php include '../sidebar.php'; ?>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0">Add a Staff</h1>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                           
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
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
                                    <h3 class="card-title">Person Information</h3>
                                </div>
                                <!-- /.card-header -->
                                <!-- form start -->
                                <form id="login" onsubmit="return validateForm()">
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label for="First Name">First Name</label>
                                            <input type="text" class="form-control" id="firstName" placeholder="Enter First Name" required autocomplete="off">
                                        </div>
                                        <div class="form-group">
                                            <label for="Middle Name">Middle Name</label>
                                            <input type="text" class="form-control" id="middleName" placeholder="Enter Middle Name" required autocomplete="off">
                                        </div>
                                        <div class="form-group">
                                            <label for="Last Name">Last Name</label>
                                            <input type="text" class="form-control" id="lastName" placeholder="Enter Last Name" required autocomplete="off">
                                        </div>
                                        <div class="form-group">
                                            <label for="contact">Contact</label>
                                            <input type="text" class="form-control" id="contact" placeholder="Enter Contact Number" required autocomplete="off">
                                        </div>
                                        <div class="form-group">
                                            <label for="email">Email</label>
                                            <input type="email" class="form-control" id="email" placeholder="Enter Email" required autocomplete="off">
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
                </div><!-- /.container-fluid -->
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
            var firstname = document.getElementById("firstName").value;
            var middlename = document.getElementById("middleName").value;
            var lastname = document.getElementById("lastName").value;
            var contact = document.getElementById("contact").value;
            var email = document.getElementById("email").value;

            $.ajax({
                type: "POST",
                url: '../action/addPerson_action.php',
                data: {
                    firstname: firstname,
                    middlename: middlename,
                    lastname: lastname,
                    contact: contact,
                    email: email
                },
                success: function (data) {
                    const obj = JSON.parse(data);
                    if (obj.response == 'success') {
                        toastr.success(obj.message);
                        window.setTimeout(function () {
                            window.location.href = "../controller/personList.php";
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
