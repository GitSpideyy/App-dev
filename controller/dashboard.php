<!-- index.php -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>TaskManagement | System</title>
    <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="../plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <link rel="stylesheet" href="../dist/css/adminlte.min.css">
    <link rel="stylesheet" href="../plugins/toastr/toastr.min.css">
</head>

<body class="hold-transition dark-mode sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
    <div class="wrapper">
      
        <!-- Main Sidebar Container -->
        <?php include '../sidebar.php'; ?>

        <!-- Content Wrapper -->
        <?php
        // Database connection
        include '../connect.php';

        //for staff
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Query to get the total number of staff
        $sql = "SELECT COUNT(staff_id) AS total_staff FROM staff";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        $total_staff = 0;
        if ($result) {
            $total_staff = $result['total_staff'];
        } else {
            echo "0 results";
        }

        // Query to get the total number of projects
        $sql = "SELECT COUNT(project_id) AS total_projects FROM project";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        $total_projects = 0;
        if ($result) {
            $total_projects = $result['total_projects'];
        } else {
            echo "0 results";
        }

        // Query to get the total number of tasks
        $sql = "SELECT COUNT(task_id) AS total_tasks FROM task";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        $total_tasks = 0;
        if ($result) {
            $total_tasks = $result['total_tasks'];
        } else {
            echo "0 results";
        }

        // Query to get the total number of users
        $sql = "SELECT COUNT(userid) AS total_users FROM user";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        $total_users = 0;
        if ($result) {
            $total_users = $result['total_users'];
        } else {
            echo "0 results";
        }

        


        // Close the connection
        $conn = null;
        ?>

        <div class="content-wrapper">
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0">Dashboard</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">Dashboard</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Main content goes here -->
            <div class="row">
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3><?php echo $total_staff; ?></h3>

                            <p>Staff</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-bag"></i>
                        </div>
                        <a href="../controller/personList.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-success">
                        <div class="inner">
                            <h3><?php echo $total_projects?><sup style="font-size: 20px"></sup></h3>

                            <p>Projects</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-stats-bars"></i>
                        </div>
                        <a href="../controller/projectList.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-warning">
                        <div class="inner">
                            <h3><?php echo $total_tasks;?></h3>

                            <p>Task</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-person-add"></i>
                        </div>
                        <a href="../controller/taskList.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-danger">
                        <div class="inner">
                            <h3><?php echo $total_users?></h3>

                            <p>User</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-pie-graph"></i>
                        </div>
                        <a href="../controller/userList.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
            </div>
        </div>

        <!-- Footer -->
        <footer class="main-footer">
            <!-- Footer content -->
        </footer>
    </div>

    <!-- Scripts -->
    <script src="../plugins/jquery/jquery.min.js"></script>
    <script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
    <script src="../dist/js/adminlte.js"></script>
    <script src="../plugins/toastr/toastr.min.js"></script>
</body>

</html>