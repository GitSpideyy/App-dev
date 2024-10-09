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
    <!-- Toastr -->
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
                            <h1 class="m-0">Add Task</h1>
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
                                    <h3 class="card-title">Task Information</h3>
                                </div>
                                <!-- /.card-header -->

                                <!-- form start -->
                                <?php
                                include '../connect.php';
                                try {
                                    // Establish database connection
                                    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
                                    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                                    // Retrieve persons
                                    $personStmt = $conn->prepare("SELECT staff_id, firstname, lastname FROM staff");
                                    $personStmt->execute();
                                    $persons = $personStmt->fetchAll(PDO::FETCH_ASSOC);

                                    // Retrieve projects
                                    $projectStmt = $conn->prepare("SELECT project_id, project_name FROM project");
                                    $projectStmt->execute();
                                    $projects = $projectStmt->fetchAll(PDO::FETCH_ASSOC);

                                } catch (PDOException $e) {
                                    echo "Connection failed: " . $e->getMessage();
                                } finally {
                                    // Optional: Close the connection if needed
                                    $conn = null;
                                }
                                ?>

                                <div class="container">
                                    <form id="updateForm" onsubmit="return validateForm()">
                                        <div class="form-group">
                                            <label for="Task Name">Task Name</label>
                                            <input type="text" class="form-control" id="task_name"
                                                placeholder="Enter Task Name" required autocomplete="off">
                                        </div>
                                        <div class="form-group">
                                            <label for="Project">Project</label>
                                            <select class="form-control" id="project_id" required>
                                                <option value="" disabled selected>Select Project</option>
                                                <?php foreach ($projects as $project): ?>
                                                    <option value="<?php echo $project['project_id']; ?>">
                                                        <?php echo $project['project_id']. " - ". $project['project_name']; ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label for="Person">Person</label>
                                            <select class="form-control" id="staff_id" required>
                                                <option value="" disabled selected>Select Person</option>
                                                <?php foreach ($persons as $person): ?>
                                                    <option value="<?php echo $person['staff_id']; ?>">
                                                        <?php echo $person['staff_id'] . " - " . $person['firstname'] . " " . $person['lastname']; ?>
                                                    </option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                        
                                        <div class="form-group">
                                            <label for="Creation Date">Creation Date</label>
                                            <input type="date" class="form-control" id="task_created" value="<?php echo date('Y-m-d'); ?>" readonly>
                                        </div>

                                        <div class="form-group">
                                            <label for="Project Due Date ">Task Due Date </label>
                                            <input type="date" class="form-control" id="due_date" placeholder="Enter Task Due Date " required autocomplete="off">
                                        </div>
                                        

                                        <div class="card-footer">
                                            <button type="submit" class="btn btn-primary btn-block">Save Task</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
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

    <script>
        function validateForm() {
            // Check if all required fields are filled
            var requiredFields = document.querySelectorAll('input[required], select[required]');
            for (var i = 0; i < requiredFields.length; i++) {
                if (!requiredFields[i].value) {
                    alert('Please fill in all required fields.');
                    return false; // Prevent form submission
                }
            }
            // Handle AJAX call for saving the task
            saveTask();
            return false; // Prevent default form submission
        }

        function saveTask() {
            // Collect data and send AJAX request to save the task
            var task_name = document.getElementById("task_name").value;
            var staff_id = document.getElementById("staff_id").value;
            var project_id = document.getElementById("project_id").value;
            var task_created = document.getElementById("task_created").value;
            var due_date = document.getElementById("due_date").value;

            $.ajax({
                type: "POST",
                url: '../action/addTask_action.php',
                data: {
                    task_name: task_name,
                    staff_id: staff_id,
                    project_id: project_id,
                    task_created: task_created,
                    due_date: due_date
                },
                success: function (data) {
                    try {
                        const obj = JSON.parse(data);
                        if (obj.response === 'success') {
                            toastr.success(obj.message);
                            window.setTimeout(function () {
                                window.location.href = "../controller/taskList.php";
                            }, 1000);
                        } else {
                            toastr.error(obj.message);
                        }
                    } catch (e) {
                        toastr.error("Failed to parse response: " + e.message);
                    }
                },
                error: function (xhr, textStatus, errorThrown) {
                    toastr.error("An error occurred. Please try again.");
                }
            });
        }
    </script>
</body>

</html>