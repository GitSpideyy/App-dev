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
    <!-- DataTables -->
    <link rel="stylesheet" href="../plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="../plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="../plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
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
                            <h1 class="m-0">Task List</h1>
                        </div><!-- /.col -->

                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Task Information</h3>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <table id="example2" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>Task ID</th>
                                                <th>Task Name</th>
                                                <th>Person ID</th>
                                                <th>Project ID</th>
                                                <th>Start Date</th>
                                                <th>End Date</th>
                                                <th>Status</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            include "../connect.php";
                                            try {
                                                // Establish database connection
                                                $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
                                                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                                                // Fetch records from the database using JOIN
                                                $stmt = $conn->prepare("
                                                    SELECT 
                                                        task.task_id, 
                                                        task.task_name, 
                                                        task.task_created, 
                                                        task.due_date, 
                                                        task.status, 
                                                        staff.staff_id, 
                                                        staff.firstname, 
                                                        staff.lastname, 
                                                        project.project_id, 
                                                        project.project_name 
                                                    FROM task
                                                    JOIN staff ON task.staff_id = staff.staff_id
                                                    JOIN project ON task.project_id = project.project_id
                                                ");
                                                $stmt->execute();

                                                if ($stmt->rowCount() > 0) {
                                                    while ($obj = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                                        $personName = $obj['staff_id'] . ' - ' . $obj['firstname'] . ' ' . $obj['lastname'];
                                                        $projectName = $obj['project_id'] . ' - ' . $obj['project_name'];

                                                        echo "<tr>";
                                                        echo "<td>" . htmlspecialchars($obj["task_id"]) . "</td>";
                                                        echo "<td>" . htmlspecialchars($obj["task_name"]) . "</td>";
                                                        echo "<td>" . htmlspecialchars($personName) . "</td>";
                                                        echo "<td>" . htmlspecialchars($projectName) . "</td>";
                                                        echo "<td>" . htmlspecialchars($obj["task_created"]) . "</td>";
                                                        echo "<td>" . htmlspecialchars($obj["due_date"]) . "</td>";
                                                        echo "<td>" . htmlspecialchars($obj["status"]) . "</td>";
                                                        echo "<td>
                                               <button class='btn btn-danger btn-sm' onclick='deleteTask(\"" . htmlspecialchars($obj["task_id"]) . "\")'>Delete</button>
                                               <a href='taskListUpdate.php?task_id=" . htmlspecialchars($obj["task_id"]) . "' class='btn btn-primary btn-sm'>Update</a>
                                                              </td>";
                                                        echo "</tr>";
                                                    }
                                                } else {
                                                    echo "<tr><td colspan='8'>No records found</td></tr>";
                                                }
                                            } catch (PDOException $e) {
                                                echo "<tr><td colspan='8'>Connection failed: " . htmlspecialchars($e->getMessage()) . "</td></tr>";
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                                <!-- /.card-body -->
                            </div>
                        </div>
                    </div>
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
    <!--../ ./wrapper -->

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
    <!-- bs-custom-file-input -->
    <script src="../plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>

    <!-- PAGE ../PLUGINS -->
    <!-- jQuery Mapael -->
    <script src="../plugins/jquery-mousewheel/jquery.mousewheel.js"></script>
    <script src="../plugins/raphael/raphael.min.js"></script>
    <script src="../plugins/jquery-mapael/jquery.mapael.min.js"></script>
    <script src="../plugins/jquery-mapael/maps/usa_states.min.js"></script>
    <!-- ChartJS -->
    <script src="../plugins/chart.js/Chart.min.js"></script>
    <!-- DataTables  & ../Plugins -->
    <script src="../plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="../plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="../plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
    <script src="../plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
    <script src="../plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
    <script src="../plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
    <script src="../plugins/jszip/jszip.min.js"></script>
    <script src="../plugins/pdfmake/pdfmake.min.js"></script>
    <script src="../plugins/pdfmake/vfs_fonts.js"></script>
    <script src="../plugins/datatables-buttons/js/buttons.html5.min.js"></script>
    <script src="../plugins/datatables-buttons/js/buttons.print.min.js"></script>
    <script src="../plugins/datatables-buttons/js/buttons.colVis.min.js"></script>

    <script>
        function deleteTask(task_id) {
            $.ajax({
                type: "POST",
                url: '../action/taskListDelete_action.php',
                data: { task_id: task_id },
                success: function (data) {
                    console.log("Response from server: ", data); // Log the response to check if data is received
                    try {
                        const obj = JSON.parse(data);
                        if (obj.response === 'success') {
                            toastr.success(obj.message);

                            // Delay the reload by 3 seconds (1000 milliseconds)
                            setTimeout(function () {
                                location.reload(); // Reload the page after the delay
                            }, 1000);
                        } else {
                            toastr.error(obj.message);
                        }
                    } catch (e) {
                        console.error("Error parsing JSON: ", e);
                        toastr.error("An error occurred while processing the response.");
                    }
                },
                error: function (xhr, textStatus, errorThrown) {
                    toastr.error("An error occurred. Please try again.");
                }
            });
        }
    </script>
    <script>
        $(function () {
            $("#example2").DataTable({
                "responsive": true,
                "lengthChange": true,
                "autoWidth": true,
                "paging": true,
                "searching": true,
                "ordering": true,
                "info": true,
                "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
            }).buttons().container().appendTo('#example2_wrapper .col-md-6:eq(0)');
        });
    </script>
</body>

</html>