<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>TaskManagement | System </title>

    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="dist/css/adminlte.min.css">
    <!-- Toastr -->
    <link rel="stylesheet" href="plugins/toastr/toastr.min.css">
</head>

<body class="hold-transition dark-mode sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
    <div class="wrapper">

        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-dark">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="index3.html" class="nav-link">Home</a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="#" class="nav-link">Contact</a>
                </li>
            </ul>

            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
                <!-- Navbar Search -->
                <li class="nav-item">
                    <a class="nav-link" data-widget="navbar-search" href="#" role="button">
                        <i class="fas fa-search"></i>
                    </a>
                    <div class="navbar-search-block">
                        <form class="form-inline">
                            <div class="input-group input-group-sm">
                                <input class="form-control form-control-navbar" type="search" placeholder="Search"
                                    aria-label="Search">
                                <div class="input-group-append">
                                    <button class="btn btn-navbar" type="submit">
                                        <i class="fas fa-search"></i>
                                    </button>
                                    <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </li>

                <li class="nav-item">
                    <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                        <i class="fas fa-expand-arrows-alt"></i>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href="index3.html" class="brand-link">
                <span class="brand-text font-weight-light">Task Management System</span>
            </a>

            <!-- Sidebar -->
            <div class="sidebar">
                <!-- SidebarSearch Form -->
                <div class="form-inline">
                    <div class="input-group" data-widget="sidebar-search">
                        <input class="form-control form-control-sidebar" type="search" placeholder="Search"
                            aria-label="Search">
                        <div class="input-group-append">
                            <button class="btn btn-sidebar">
                                <i class="fas fa-search fa-fw"></i>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                        data-accordion="false">
                        <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                        <li class="nav-item menu-open">
                            <a href="#" class="nav-link active">
                                <i class="nav-icon fas fa-user-tie"></i>
                                <p>
                                    Person
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="personList.php" class="nav-link">                                      
                                        <p>Person List </p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="addPerson.php" class="nav-link">                                      
                                        <p> Add Person</p>
                                    </a>
                                </li>
                               
                            </ul>
                        </li>
                        <li class="nav-item menu-open">
                            <a href="#" class="nav-link active">
                                <i class="nav-icon fas fa-project-diagram"></i>
                                <p>
                                    Project
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="addProject.php" class="nav-link">                                      
                                        <p> Add Project</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="projectList.php" class="nav-link">                                      
                                        <p> Project List</p>
                                    </a>
                                </li>
                               
                            </ul>
                        </li>
                        <li class="nav-item menu-open">
                            <a href="#" class="nav-link active">
                                <i class="nav-icon fas fa-tasks"></i>
                                <p>
                                    Task
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="addTask.php" class="nav-link">                                      
                                        <p> Add Task</p>
                                    </a>
                                </li>
                               
                            </ul>
                        </li>
                    
                        <li class="nav-item">
                            <a href="login.php" class="nav-link">
                            <i class="fas fa-sign-out-alt"></i>
                                <p>
                                  Logout
                                </p>
                            </a>
                        </li>
                        
                    </ul>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>

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
                                    <h3 class="card-title">Task Information</h3>
                                </div>
                                <!-- /.card-header -->

                                <!-- form start -->
                                <?php
                                $servername = "localhost";
                                $dbname = "taskmanagementsystem";
                                $username = "root";
                                $password = "";
                                try {
                                    // Establish database connection
                                    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
                                    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                                    // Retrieve persons
                                    $personStmt = $conn->prepare("SELECT person_id, firstname, lastname FROM person");
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
                                            <select class="form-control" id="person_id" required>
                                                <option value="" disabled selected>Select Person</option>
                                                <?php foreach ($persons as $person): ?>
                                                    <option value="<?php echo $person['person_id']; ?>">
                                                        <?php echo $person['person_id'] . " - " . $person['firstname'] . " " . $person['lastname']; ?>
                                                    </option>
                                                <?php endforeach; ?>
                                            </select>
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
    <script src="plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap -->
    <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- overlayScrollbars -->
    <script src="plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
    <!-- AdminLTE App -->
    <script src="dist/js/adminlte.js"></script>
    <!-- Toastr -->
    <script src="plugins/toastr/toastr.min.js"></script>

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
            var person_id = document.getElementById("person_id").value;
            var project_id = document.getElementById("project_id").value;

            $.ajax({
                type: "POST",
                url: 'addTask_action.php',
                data: {
                    task_name: task_name,
                    person_id: person_id,
                    project_id: project_id
                },
                success: function (data) {
                    const obj = JSON.parse(data);
                    if (obj.response == 'success') {
                        toastr.success(obj.message);
                        window.setTimeout(function () {
                            window.location.href = "taskList.php";
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
