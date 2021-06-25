<?php session_start();
//Validation login Session
if (strlen($_SESSION['admin']) == 0) {
    header("Location:logout.php");} else {
    $id= $_SESSION['admin'];
    require('config.php');
    $query = "SELECT * FROM `tblusers` WHERE `Role`='driver'";
    $result = mysqli_query($mysqli, $query);
    
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

  <?php include('includes/admin/sidebar.php') ?>
  <!-- Main Sidebar Container -->


  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>All Drivers</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Drivers</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
          <div class="row mb-2">
            
          <div class="col-sm-6">
          
          </div>
        </div>
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">All Drivers</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>id</th>
                    <th>Full Name</th>
                    <th>Email</th>
                    <th>Phone Number</th>
                    <th>Role</th>            
                    <th>Date</th>
                  </tr>
                  </thead>
                  <tbody>
                  <?php if($result != "") {?>
                  <?php while ($row1 = mysqli_fetch_array($result)): ;?>
                  <tr>
                    <td><?php echo $row1['id']; ?></td>
                    <td><?php echo $row1['FullName']; ?></td>
                    <td><?php echo $row1['EmailId']; ?></td>
                    <td><?php echo $row1['MobileNumber']; ?></td>
                    <td><?php echo $row1['Role']; ?></td>
                    <td><?php echo $row1['RegDate']; ?></td>
                  </tr>
                    <?php endwhile;?>
                 <?php } ?>
                  </tbody>
                  <tfoot>
                  <tr>

                  <th>id</th>
                    <th>Full Name</th>
                    <th>Email</th>
                    <th>Phone Number</th>
                    <th>Role</th>            
                    <th>Date</th>
                  </tr>
                  </tfoot>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <!-- Control Sidebar -->



<?php
include 'includes/footer.php';
}?>