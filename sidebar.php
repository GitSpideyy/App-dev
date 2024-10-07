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
