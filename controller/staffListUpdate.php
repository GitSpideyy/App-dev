<!DOCTYPE html>
<html lang="en">
    
<?php 
session_start();
include "../authCheck.php";?>
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
    <!-- Toastr -->
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
                            <h1 class="m-0">Dashboard v2</h1>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">Dashboard v2</li>
                            </ol>
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
                                    <h3 class="card-title">Student Information</h3>
                                </div>
                                <!-- /.card-header -->

                                <!-- form start -->
                                <?php
                                include '../connect.php';
                                try {
                                    // Establish database connection
                                    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
                                    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                                    $staff_id = isset($_GET['staff_id']) ? $_GET['staff_id'] : null;
                                    // Fetch student record based on studentno
                                    $stmt = $conn->prepare("SELECT * FROM staff WHERE staff_id = :staff_id");
                                    $stmt->bindParam(':staff_id', $staff_id);
                                    $stmt->execute();

                                    $staff_id = $stmt->fetch(PDO::FETCH_ASSOC);
                                } catch (PDOException $e) {
                                    echo "Connection failed: " . htmlspecialchars($e->getMessage());
                                    exit;
                                }

                                // Check if student data exists
                                if (!$staff_id) {
                                    echo "No Person found.";
                                    exit;
                                }
                                ?>

                                <div class="container">
                                    <form id="updateForm" onsubmit="return validateForm()">

                                        <div class="form-group">
                                            <label for="staff_id">Person ID</label>
                                            <input type="text" class="form-control" id="staff_id"
                                                value="<?php echo htmlspecialchars($staff_id['staff_id']); ?>"
                                                placeholder="Enter Person ID" readonly>
                                        </div>
                                        <div class="form-group">
                                            <label for="firstname">First Name</label>
                                            <input type="text" class="form-control" id="firstname"
                                                value="<?php echo htmlspecialchars($staff_id['firstname']); ?>"
                                                placeholder="Enter First Name" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="middlename">Middle Name</label>
                                            <input type="text" class="form-control" id="middlename"
                                                value="<?php echo htmlspecialchars($staff_id['middlename']); ?>"
                                                placeholder="Enter Middle Name" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="lastname">Last Name</label>
                                            <input type="text" class="form-control" id="lastname"
                                                value="<?php echo htmlspecialchars($staff_id['lastname']); ?>"
                                                placeholder="Enter Last Name" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="contact">Contact</label>
                                            <input type="text" class="form-control" id="contact"
                                                value="<?php echo htmlspecialchars($staff_id['contact']); ?>"
                                                placeholder="Enter Contact" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="email">Email</label>
                                            <input type="email" class="form-control" id="email"
                                                value="<?php echo htmlspecialchars($staff_id['email']); ?>"
                                                placeholder="Enter Email" required>
                                        </div>
                                        <div class="card-footer">
                                            <button type="submit" class="btn btn-primary btn-block">Update</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <!-- /.card-body -->
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
      <!-- Toastr -->
      <script src="../plugins/toastr/toastr.min.js"></script>

    <!-- PAGE ../PLUGINS -->
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
                    alert('Please fill in all required fields.');
                    return false; // Prevent form submission
                }
            }
            // Handle AJAX call for updating the record here
            updateRecord();
            return false; // Prevent default form submission
        }

        function updateRecord() {
            // Collect data and send AJAX request to update the student information
            var staff_id = document.getElementById("staff_id").value;
            var firstname = document.getElementById("firstname").value;
            var middlename = document.getElementById("middlename").value;
            var lastname = document.getElementById("lastname").value;
            var contact = document.getElementById("contact").value;
            var email = document.getElementById("email").value;

            $.ajax({
                type: "POST",
                url: '../action/personListUpdate_action.php',
                data: {
                    staff_id: staff_id,
                    firstname: firstname,
                    middlename: middlename,
                    lastname: lastname,
                    contact: contact,
                    email: email,
                  
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