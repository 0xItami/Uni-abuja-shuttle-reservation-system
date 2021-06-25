<?php session_start();

//Validation login Session
if(strlen($_SESSION['driver'])==0)
 { 
  header("Location:logout.php"); }
 else{

  require "config.php";
  $user_id = $_SESSION['driver'];
  $bus_id = $_SESSION['bus_id'];
  $query = "SELECT * FROM `bookings` WHERE bus_id=$bus_id AND NOT ticket_code='used' ORDER BY id desc LIMIT 6";
  $result = mysqli_query($mysqli, $query);
  $booked_rides = mysqli_num_rows($result);

  if (isset($_POST['arrival'])){

    $query2 = "UPDATE bookings SET ticket_code='used' WHERE bus_id=$bus_id AND NOT ticket_code='used'";
    $query3 = "UPDATE buses SET status='free' WHERE bus_id=$bus_id";
    $work = mysqli_query($mysqli, $query2);
    $work2 = mysqli_query($mysqli, $query3);

    if ($work2 && $work) {
        $_SESSION['success_message'] = "rides reset successfully";
    } else {
      $_SESSION['error_message'] = "an error occured";
    }

  }

?>
<?php include("includes/drivers/header.php") ?>

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

  <!-- Main Sidebar Container -->
  <?php include('includes/drivers/sidebar.php') ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Welcome <?php echo($_SESSION['fname'].' !') ?></h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Dashboard</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
      <div class="row">
          <div class="col-lg-6 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
              
                <h3><?php echo($booked_rides); ?></h3>
              
                <p>Newly Booked Rides</p>
              </div>
              <div class="icon">
                <i class="ion ion-bag"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-6 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h5>Arrival at destination</h5> 
            <sup style="font-size: 20px"></sup></h3>
            <br>

          <form  method="post">
            <button type="submit" name="arrival" class="btn btn-light">Destination Reached</button>
          </form>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->

        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
      <section class="ftco-section ftco-no-pt bg-light">

    </section>
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
    <div class="p-3">
      <h5>Title</h5>
      <p>Sidebar content</p>
    </div>
  </aside>
  <!-- /.control-sidebar -->


<?php 
include('includes/footer.php');
if($_SESSION['success_message'] != ""){
  echo("<script>
  $(window).onload(function(){
  Swal.fire({
   icon: 'success',
   title: 'success',
   text: '".$_SESSION['success_message']."',
 });
});
  </script>
  "
);
unset($_SESSION['success_message']);
}elseif ($_SESSION['error_message'] != ""){
  
 echo("<script>
 $(window).onload(function(){
 Swal.fire({
  icon: 'error',
  title: 'Oops..',
  text: '".$_SESSION['error_message']."',
});
});

 </script>
 ");
 $_SESSION['error_message'] = "";
 unset($_SESSION['success_message']);
}
} ?>