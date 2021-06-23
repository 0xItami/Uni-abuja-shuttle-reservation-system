<?php session_start();
//Validation login Session
if(strlen($_SESSION['driver'])==0)
 { 
  header("Location:logout.php"); }
 else{
  require "config.php";
  $user_id = $_SESSION['driver'];
  $query = "SELECT * FROM `bookings` WHERE user_id=$user_id ORDER BY id desc LIMIT 6 ";
  $result = mysqli_query($mysqli, $query);
  $booked_rides = mysqli_num_rows($result);
  $cash_spent = $booked_rides * 100;


  if (isset($_POST['submit'])){

    $seat_id = $_REQUEST['seat_no'];
    $destination = $_REQUEST['destination'];
    $bus_id = $_SESSION['bus'];
    $randnum = rand(1111111111, 9999999999);
    $ticked_id = "TC" . $randnum;

    $sql = "INSERT INTO bookings "."(bus_id, user_id, status, ticket_code, seat_no, destination)". "VALUES('$bus_id', '$user_id', 'taken', '$ticked_id', '$seat_id', '$destination')";
    $query2 = "UPDATE buses SET status='taken' WHERE bus_id=$bus_id AND seat_no=$seat_id";

    $work1 = mysqli_query($mysqli, $sql);
    $work2 = mysqli_query($mysqli, $query2);
    if ($work1 && $work2) {
        $_SESSION['success_message'] = "ride booked successfully";
        echo"<script>alert('ride booked successfully');</script>";
    } else {
      $_SESSION['error_message'] = "an error occured";
      echo"<script>
      alert('".mysqli_error($mysqli)."');
      </script>";
    }


}

   if(!empty($_SESSION['success_message'])){
     echo("<script>
     Swal.fire({
      icon: 'success',
      title: 'success',
      text: '".$_SESSION['success_message']."',
    })
     </script>
     ");
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

            <button class="btn btn-light">Destination Reached</button>

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
$_SESSION['success_message'] = "";
} ?>                                                                                                                                                                                                                                                     