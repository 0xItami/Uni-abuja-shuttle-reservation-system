<?php session_start();
//Validation login Session
if (strlen($_SESSION['admin']) == 0) {
    header("Location:logout.php");} else {
    $id = $_SESSION['admin'];
    require 'config.php';
    $query = "SELECT * FROM `tblusers` WHERE `Role`='driver'";
    $result = mysqli_query($mysqli, $query);

    if (isset($_POST['add_driver'])) {

        $name = $_POST['fname'];
        $email = $_POST['email'];
        $number = $_POST['pnumber'];
        $password = $_POST['password'];
        $bus_id = $_POST['bus'];
        $role = "driver";

        $value = "SELECT count(*) FROM tblusers WHERE EmailId=?";
        $stmt = $mysqli->prepare($value);
        $stmt->bind_param('s', $email);
        $stmt->execute();
        $stmt->bind_result($count);
        $stmt->fetch();
        $stmt->close();
        //if email already exist
        if ($count > 0) {
          $_SESSION['error_message'] = "user with this email exists";
        } else {
            $sql = "INSERT INTO tblusers " . "(FullName, EmailId, MobileNumber, Password, Role, bus_id)" . "VALUES('$name', '$email', '$number', '$password', '$role', '$bus_id')";
            $exec = mysqli_query($mysqli, $sql);
            if ($exec) {
                $_SESSION['success_message'] = "Driver added successfully";
            } else {
                $_SESSION['error_message'] = "an error occured";

            }
        }

    }
    ?>
<?php include "includes/admin/header.php";?>


<div class="wrapper">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
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
     <a href="logout.php"><button class="btn btn-primary">Logout</button></a>
    </ul>
  </nav>
  <!-- /.navbar -->

  <?php include 'includes/admin/sidebar.php'?>
  <!-- Main Sidebar Container -->

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Add Driver</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Add Driver</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-md-12">
          <div class="card card-secondary">
            <div class="card-header">
              <h3 class="card-title">New Driver</h3>

              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                  <i class="fas fa-minus"></i>
                </button>
              </div>
            </div>
            <form method="post">
            <div class="card-body">
              <div class="form-group">
                <label for="inputEstimatedBudget">Driver's Full Name</label>
                <input type="text" id="inputEstimatedBudget" name="fname" class="form-control" required>
              </div>
              <div class="form-group">
                <label for="inputSpentBudget">Driver's Email</label>
                <input type="email" name="email" id="inputSpentBudget" class="form-control" required>
              </div>
              <div class="form-group">
                <label for="inputEstimatedDuration">Driver's Phone Number</label>
                <input type="number" name="pnumber" id="inputEstimatedDuration" class="form-control" required>
              </div>
              <div class="form-group">
                <label for="inputSpentBudge">Driver's Password</label>
                <input type="password" name="password" id="inputSpentBudge" class="form-control" required>
              </div>
              <div class="form-group">
                <label for="inputSpentBudg">Driver's Bus</label>
                <select name="bus" id="inputSpentBudg" class="form-control" required>
                <option value="1">Bus 1</option>
                <option value="2">Bus 2</option>
                <option value="3">Bus 3</option>
                </select>
              </div>
            </div>
            <!-- /.card-body -->
            <div class="card-footer">
            <div class="row">
              <div class="col-12">
                <a href="admin_dashboard.php" class="btn btn-secondary">Cancel</a>
                <input type="submit" name="add_driver" value="Create new Driver" class="btn btn-success float-right">
              </div>
            </div>
            </div>
            </form>
          </div>
          <!-- /.card -->
        </div>
      </div>

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
</div>
<?php
include 'includes/footer.php';
    if ($_SESSION['success_message'] != "") {
        echo ("<script>
  Swal.fire({
   icon: 'success',
   title: 'success',
   text: '" . $_SESSION['success_message'] . "',
 });

  </script>
  "
        );
        unset($_SESSION['success_message']);
    } elseif ($_SESSION['error_message'] != "") {

        echo ("<script>
 Swal.fire({
  icon: 'error',
  title: 'Oops..',
  text: '" . $_SESSION['error_message'] . "',
});

 </script>
 ");
        $_SESSION['error_message'] = "";
        unset($_SESSION['success_message']);
    }
}?>