<?php
include "../connect.php";



// Check if the user is logged in by verifying the existence of the userid
if (isset($_SESSION['userid'])) {
    // Retrieve the userid from the session
    $userid = $_SESSION['userid'];
} else {
    // Redirect to login page if no session found
    header("Location: login.php");
    exit();
}
$stmt = $conn->prepare("SELECT s.firstname, s.middlename, s.lastname 
                        FROM staff s 
                        JOIN user u ON s.staff_id = u.staff_id 
                        WHERE u.userid = :userid");
$stmt->bindParam(':userid', $userid);
$stmt->execute();

$result = $stmt->fetch(PDO::FETCH_ASSOC);
if ($result) {
    $fullname = $result['firstname'] . ' ' . $result['lastname'];
} else {
    $fullname = "Unknown User";
}
?>
<!-- Navbar (kept in the dashboard) -->
<nav class="main-header navbar navbar-expand navbar-dark">


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

<!-- sidebar.php -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
        <img src="../dist/img/mainlogo.jpg" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
            style="opacity: .8">
        <span class="brand-text font-weight-light">Project Management</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="../dist/img/profile.jpg" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block"><?php echo $fullname; ?></a>
            </div>
        </div>
        <a href="index3.html" class="brand-link">
            <span class="brand-text font-weight-light">Task Management System</span>
        </a>
        <!-- SidebarSearch Form -->
        <div class="form-inline">
            <div class="input-group" data-widget="sidebar-search">
                <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
                <div class="input-group-append">
                    <button class="btn btn-sidebar">
                        <i class="fas fa-search fa-fw"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item menu-open">
                    <a href="dashboard.php" class="nav-link active   ">
                        <!-- person Menu -->
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Dashboard

                        </p>
                    </a>
                    <li class="nav-item menu-open">
                    <a href="../controller/staffAccountModify.php" class="nav-link active">
                        <!-- person Menu -->
                        <i class="nav-icon fas fa-user-tie"></i>
                        <p>
                            Edit Account 
                        
                        </p>
                    </a>
                   
                </li>
                </li>
                
                <!-- logout Menu -->    
                <li class="nav-item">
                    <form action="../controller/logout.php" method="post" style="display: inline;">
                        <button type="submit" class="nav-link btn btn-link"
                            style="color: inherit; text-align: left; padding: 0;">
                            <i class="fas fa-sign-out-alt"></i>
                            <p>Logout</p>
                        </button>
                    </form>
                </li>

                </li>
            </ul>
        </nav>
    </div>
</aside>