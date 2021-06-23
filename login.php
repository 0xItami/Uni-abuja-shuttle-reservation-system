<?php session_start();
include_once('config.php');

if (!empty($_SESSION['uid'])) {
  header('location:index.php');
}
if (!empty($_SESSION['driver'])) {
  header('location:driver_dashboard.php');
}
if (!empty($_SESSION['admin'])) {
  header('location:admin_dashboard.php');
}

//Coding For Signup
if(isset($_POST['login']))
{
//Getting Psot Values
$status = 'true';
$email=$_POST['email'];	
$pass=$_POST['password'];	
$stmt = $mysqli->prepare( "SELECT FullName,id,Password,Role,bus_id FROM tblusers WHERE (EmailId=?)");
$stmt->bind_param('s',$email);
$stmt->execute();
$stmt->bind_result($FullName,$id,$Password,$Role,$bus_id);
$rs= $stmt->fetch();
$stmt->close();

  if($pass == $Password){
    if ($Role == "user") {
      $_SESSION['fname']=$FullName;
      $_SESSION['uid']=$id;
      header('location:index.php');
    }elseif ($Role == "driver") {
      $_SESSION['fname']=$FullName;
      $_SESSION['driver']=$id;
      $_SESSION['bus_id'] = $bus_id;
      header('location:driver_dashboard.php');
    }elseif ($Role == "admin") {
      # code...
    }

  }
  else {
   $status = 'false';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Transit Login</title>

   <!-- Google Font: Source Sans Pro -->
   <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- SweetAlert2 -->
  <link rel="stylesheet" href="plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
  <!-- Toastr -->
  <link rel="stylesheet" href="plugins/toastr/toastr.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <style>
  body {
  background-image: url('dist/img/campus.jpg');
  background-repeat: no-repeat;
  background-attachment: fixed;
  background-size: cover;
}
  </style>
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <!-- /.login-logo -->
  <div class="card card-outline card-primary">
    <div class="card-header text-center">
      <a href="#" class="h6"><b>University of Abuja reservation system</b></a>
    </div>
    <div class="card-body">
      <p class="login-box-msg">Sign in to start your session</p>

      <form method="post">
        <div class="input-group mb-3">
          <input type="email" name="email" class="form-control" placeholder="Email" required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" name="password" class="form-control" placeholder="Password" required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-8">
            <div class="icheck-primary">
              <input type="checkbox" id="remember">
              <label for="remember">
                Remember Me
              </label>
            </div>
          </div>
          <!-- /.col -->
          <div class="col-4">
            <button type="submit" class="btn btn-primary btn-block" name="login">Sign In</button>
          </div>
          <!-- /.col -->
        </div>
      </form>


      <p class="mb-1">
        <a href="forgot-password.html">I forgot my password</a>
      </p>
      <p class="mb-0">
        <a href="register.php" class="text-center">Register a new membership</a>
      </p>
    </div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->
</div>
<!-- /.login-box -->

<script src="plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- SweetAlert2 -->
<script src="plugins/sweetalert2/sweetalert2.min.js"></script>
<!-- Toastr -->
<script src="plugins/toastr/toastr.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>

<script>
$(function() {
    var Toast = Swal.mixin({
      toast: true,
      position: 'top-end',
      showConfirmButton: false,
      timer: 3000
    });

   <?php if($status != "true"){?>
      Swal.fire({
        icon: 'error',
        title: 'Oops...',
        text: 'Invalid username or password!',
      })
  <?php    } ?>


});
</script>
</body>
</html>
