<!DOCTYPE html>
<html lang="en">
<?php
session_start();
include "../authCheck.php";
include '../connect.php'; // Move the connection here for better organization

try {
    // Establish database connection
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $userid = $_GET['userid'] ?? null;

    // Fetch user record based on id
    $stmt = $conn->prepare("SELECT * FROM user WHERE userid = :userid");
    $stmt->bindParam(':userid', $userid, PDO::PARAM_INT);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    // Check if user data exists
    if ($user) {
        // Fetch role description
        $rstmt = $conn->prepare("SELECT description FROM role WHERE role_id = :role_id");
        $rstmt->bindParam(':role_id', $user['role_id'], PDO::PARAM_INT);
        $rstmt->execute();
        $role = $rstmt->fetch(PDO::FETCH_ASSOC);

        // Fetch full name from staff
        $Fstmt = $conn->prepare("SELECT firstname, middlename, lastname FROM staff WHERE user_id = :userid");
        $Fstmt->bindParam(':userid', $userid, PDO::PARAM_INT);
        $Fstmt->execute();
        $fullname = $Fstmt->fetch(PDO::FETCH_ASSOC);

        $full_name = "{$fullname['firstname']} {$fullname['middlename']} {$fullname['lastname']}";
    } else {
        echo "No Person found.";
        exit;
    }
} catch (PDOException $e) {
    echo "Connection failed: " . htmlspecialchars($e->getMessage());
    exit;
}
?>

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
                            <h1 class="m-0">Dashboard v2</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">Dashboard v2</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <!-- left column -->
                        <div class="col-md-6">
                            <!-- general form elements -->
                            <div class="card card-primary">
                                <div class="card-header">
                                    <h3 class="card-title">User Information</h3>
                                </div>

                                <!-- form start -->
                                <div class="container">
                                    <form id="updateForm" onsubmit="return validateForm()">
                                        <div class="form-group">
                                            <label for="userid">User ID</label>
                                            <input type="text" class="form-control" id="userid"
                                                value="<?php echo htmlspecialchars($user['userid']); ?>" readonly>
                                        </div>

                                        <div class="form-group">
                                            <label for="username">Username</label>
                                            <input type="text" class="form-control" id="username"
                                                value="<?php echo htmlspecialchars($user['username']); ?>" required>
                                        </div>

                                        <div class="form-group">
                                            <label for="password">Password</label>
                                            <input type="text" class="form-control" id="password"
                                            value="<?php echo htmlspecialchars($user['password']); ?>" required> 
                                        </div>

                                        <div class="form-group">
                                            <label for="fullname">Full Name</label>
                                            <input type="text" class="form-control" id="fullname"
                                                value="<?php echo htmlspecialchars($full_name); ?>" readonly>
                                        </div>

                                        <!-- Role dropdown -->
                                        <div class="form-group">
                                            <label for="role_id">Role</label>
                                            <select class="form-control" id="role_id" required>
                                                <option value="" disabled hidden>Select Role</option>
                                                <option value="<?php echo htmlspecialchars($user['role_id']); ?>" selected hidden>
                                                    <?php echo htmlspecialchars($role['description']); ?>
                                                </option>
                                                <?php
                                                // Fetch roles dynamically
                                                $rstmt = $conn->prepare("SELECT role_id, description FROM role WHERE role_id != :current_role_id");
                                                $rstmt->bindParam(':current_role_id', $user['role_id'], PDO::PARAM_INT);
                                                $rstmt->execute();
                                                $roles = $rstmt->fetchAll(PDO::FETCH_ASSOC);
                                                foreach ($roles as $role):
                                                ?>
                                                    <option value="<?php echo htmlspecialchars($role['role_id']); ?>">
                                                        <?php echo htmlspecialchars($role['description']); ?>
                                                    </option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>

                                        <!-- Hidden inputs for staff_id and role_id -->
                                        <input type="hidden" id="staff_id"
                                            value="<?php echo htmlspecialchars($user['staff_id']); ?>">
                                        <input type="hidden" id="role_id"
                                            value="<?php echo htmlspecialchars($user['role_id']); ?>">

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
            </section>
        </div>

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark"></aside>
        <!-- Main Footer -->
        <footer class="main-footer"></footer>
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
                    return false;
                }
            }
            // Handle AJAX call for updating the record here
            updateRecord();
            return false; // Prevent form submission
        }

        function updateRecord() {
            // Collect data and send AJAX request to update the user information
            var userid = document.getElementById("userid").value;
            var username = document.getElementById("username").value;
            var password = document.getElementById("password").value;
            var staff_id = document.getElementById("staff_id").value;
            var role_id = document.getElementById("role_id").value;

            $.ajax({
                type: "POST",
                url: '../action/userListUpdate_action.php',
                data: {
                    userid: userid,
                    username: username,
                    password: password,
                    staff_id: staff_id,
                    role_id: role_id
                },
                success: function (data) {
                    const obj = JSON.parse(data);
                    if (obj.response == 'success') {
                        toastr.success(obj.message);
                        setTimeout(function () {
                            window.location.href = "../controller/userList.php";
                        }, 1000);
                    } else {
                        toastr.error(obj.message);
                    }
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    console.error("Error: " + textStatus + " - " + errorThrown);
                    toastr.error("An error occurred: " + errorThrown + ". Please try again.");
                }
            });
        }
    </script>
</body>

</html>