<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>AdminLTE 3 | Log in</title>

  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <!-- Toastr -->
  <link rel="stylesheet" href="plugins/toastr/toastr.min.css">
</head>

<body class="hold-transition login-page">
  <div class="login-box">
    <div class="login-logo">
      <a href="index2.html"><b>Task Management System</b></a>
    </div>
    <!-- /.login-logo -->
    <div class="card">
      <div class="card-body login-card-body">
        <p class="login-box-msg">Log in to start your session   </p>

        <form action="../../index3.html" method="post">
          <div class="input-group mb-3">
            <input type="text" class="form-control" placeholder="Username" id="username" name="username">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-user"></span>
              </div>
            </div>
          </div>
          <div class="input-group mb-3">
            <input type="password" class="form-control" placeholder="Password" id="password" name="password">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-lock"></span>
              </div>
            </div>
          </div>
          <div class="row mb-3">
            <div class="col-12">
              <button type="button" class="btn btn-primary btn-block" onclick="Login() ">
                Sign in
              </button>
            </div>
          </div>
          <!-- /.row -->
          <p class="mb-0">
            <a href="createAccount.php" class="text-center">Register a new Account</a>
          </p>
        </form>

      </div>
      <!-- /.login-card-body -->
    </div>
  </div>
  <!-- /.login-box -->

  <!-- jQuery -->
  <script src="plugins/jquery/jquery.min.js"></script>
  <!-- Bootstrap 4 -->
  <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- AdminLTE App -->
  <script src="dist/js/adminlte.min.js"></script>
  <!-- Toastr -->
  <script src="plugins/toastr/toastr.min.js"></script>
  
  <script>
    function Login() {
      var username = document.getElementById("username").value;
      var password = document.getElementById("password").value;
      $.ajax({
        type: "POST",
        url: 'login_action.php',
        data: {
          username: username,
          password: password
        },
        success: function (data) {
          const obj = JSON.parse(data);
          if (obj.response == 'success') {
            toastr.success(obj.message);
            window.setTimeout(function () {
              window.location.href = "dashboard.php";
            }, 1200);
          } else {
            toastr.error(obj.message);
          }
        },
        error: function (xhr, textStatus, errorThrown) {
          alert("Error");
        }
      });
      return false;
    }
  </script>
</body>

</html>