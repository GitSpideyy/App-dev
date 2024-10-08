
  <!-- Navbar (kept in the dashboard) -->
  <nav class="main-header navbar navbar-expand navbar-dark">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="index.php" class="nav-link">Home</a>
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

<!-- sidebar.php -->
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
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">
                <li class="nav-item menu-open">
                    <a href="dashboard.php" class="nav-link active   ">
                           <!-- person Menu -->
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Dashboard
                           
                        </p>
                    </a>
                 
                </li>
                <li class="nav-item menu-open">
                    <a href="#" class="nav-link active">
                           <!-- person Menu -->
                        <i class="nav-icon fas fa-user-tie"></i>
                        <p>
                            Person
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="../controller/personList.php" class="nav-link">
                                <p>Person List</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="../controller/addPerson.php" class="nav-link">
                                <p> Add Person</p>
                            </a>
                        </li>
                    </ul>
                </li>
                   <!-- project Menu -->
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
                            <a href="../controller/addProject.php" class="nav-link">
                                <p> Add Project</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="../controller/projectList.php" class="nav-link">
                                <p> Project List</p>
                            </a>
                        </li>
                    </ul>
                </li>
                   <!-- task Menu -->
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
                            <a href="../controller/addTask.php" class="nav-link">
                                <p> Add Task</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="../controller/taskList.php" class="nav-link">
                                <p> Task List</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item menu-open">
                    <a href="#" class="nav-link active">
                        <i class="nav-icon fas fa-tasks"></i>
                        <p>
                            User
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="../controller/addUser.php" class="nav-link">
                                <p> Add User</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="../controller/userList.php" class="nav-link">
                                <p> User List</p>
                            </a>
                        </li>
                    </ul>
                </li>
                   <!-- logout Menu -->
                <li class="nav-item">
                    <a href="../controller/login.php" class="nav-link">
                        <i class="fas fa-sign-out-alt"></i>
                        <p> Logout </p>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</aside>
