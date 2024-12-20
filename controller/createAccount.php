<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>AdminLTE 3 | Log in (v2)</title>

    <!-- Font Awesome -->
    <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="../plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="../dist/css/adminlte.min.css">
    <!-- Toastr -->
    <link rel="stylesheet" href="../plugins/toastr/toastr.min.css">
</head>

<body class="hold-transition login-page">
    <div class="login-box">
        <!-- /.login-logo -->
        <div class="card card-outline card-primary">
            <div class="card-header text-center">
                <a href="index2.html" class="h1">Account Registration</a>
            </div>
            <div class="card-body">
                <p class="login-box-msg">Register to start your session</p>

                <form id="login">
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="Enter Staff ID" id="staff_id" name="staff_id">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-user-tie"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="Username" id="username" name="username">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-user"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" class="form-control" placeholder="Password" id="password"
                            name="password">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                   
                    <div class="row">
                        <div class="col-4">
                            <button type="button" class="btn btn-primary btn-block"
                                onclick="SaveRecord()">Submit</button>
                        </div>
                        <div class="col-4">
                            <a href="login.php" class="btn btn-secondary btn-block">Return</a>
                        </div>
                    </div>

                </form>
                <!-- /.social-auth-links -->

            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
    <!-- /.login-box -->

    <!-- jQuery -->
    <script src="../plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="../dist/js/adminlte.min.js"></script>
    <!-- Toastr -->
    <script src="../plugins/toastr/toastr.min.js"></script>


    <script>
        function SaveRecord() {
            var staff_id = document.getElementById("staff_id").value;
            var UserName = document.getElementById("username").value;
            var Password = document.getElementById("password").value;
            var role_id = 1;
            
           

            $.ajax({
                type: "POST",
                url: '../action/createAccount_action.php',
                data: {
                    staff_id: staff_id,
                    UserName: UserName,
                    Password: Password,
                    role_id: role_id
                 
                },
                success: function (data) {
                    const obj = JSON.parse(data);
                    if (obj.response == 'success') {
                        toastr.success(obj.message);
                    } else {
                        toastr.error(obj.message);
                    }
                },
                error: function (xhr, textStatus, errorThrown) {
                    alert("An error occurred. Please try again.");
                }
            });
        }

        function goBack() {
            window.history.back();
        }
    </script>
</body>

</html>