<?php session_start();
//Validation login Session
if (strlen($_SESSION['uid']) == 0) {
    header("Location:logout.php");} else {
    require 'config.php';

    $bus_id = $_GET['id'];
    $_SESSION['bus'] = $_GET['id'];
    $query = "SELECT `seat_no` FROM `buses` WHERE status='free' AND bus_id=$bus_id ";
// for method 1
    $result = mysqli_query($mysqli, $query);

    ?>
<?php include "includes/header.php";?>

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
  <?php include('includes/sidebar.php') ?>

  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Invoice</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Payment</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="callout callout-info">
              <h5><i class="fas fa-info"></i> Note:</h5>
              Bus <?php echo ($bus_id) ?> Selected

              <div class="row ">
            <img src="dist/img/<?php echo ($bus_id) ?>.jpg" alt="" style="width: auto;height: 200px;" class="rounded">
      <?php if ($bus_id == 3) {?>
        <img src="dist/img/<?php echo ($bus_id) ?>.jfif" alt="" style="width: auto;height: 200px;" class="rounded">

      <?php }?>
          </div>
            </div>


            <!-- Main content -->
            <div class="invoice p-3 mb-3">
              <!-- title row -->
              <div class="row">
                <div class="col-12">
                  <h4>
                    <i class="fas fa-globe"></i> University of Abuja reservation system.
                  </h4>
                </div>
                <!-- /.col -->
              </div>
          <br>

            <div class="card card-default">
          <div class="card-header">
            <h3 class="card-title">Select a seat and destinaton </h3>

            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse">
                <i class="fas fa-minus"></i>
              </button>
              <button type="button" class="btn btn-tool" data-card-widget="remove">
                <i class="fas fa-times"></i>
              </button>
            </div>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
          <form action="index.php" method="post">
            <div class="row">
              <div class="col-md-6" data-select2-id="29">
                <div class="form-group">
                  <label>Available seats</label>
                  <?php if ($result !== "") {?>
                    <select name="seat_no" class="form-control select2 select2-hidden-accessible" style="width: 100%;" data-select2-id="1" tabindex="-1" aria-hidden="true">

                  <?php while ($row1 = mysqli_fetch_array($result)): ;?>

                      <option value="<?php echo $row1['seat_no']; ?>">Seat <?php echo $row1['seat_no']; ?></option>
                    <?php endwhile;?>
                    </select>

                  <?php } else {?>
                    <p class="text-danger">Bus is Occupied and in transit please check other buses</p>
                  <?php }?>
                </div>
                <!-- /.form-group -->
                <!-- /.form-group -->
              </div>
              <!-- /.col -->
              <div class="col-md-6">
                <div class="form-group">
                  <label>Destination</label>
                  <select name="destination" class="form-control select2 select2-hidden-accessible" style="width: 100%;" data-select2-id="1" tabindex="-1" aria-hidden="true">
                    <option value="main campus">Main campus</option>
                    <option value="mini campus">Mini campus</option>

                  </select>

              </div>
              <!-- /.col -->
            </div>
            <!-- /.row -->

          </div>
          <!-- /.card-body -->
          <div class="card-footer">
          <button type="submit" name="submit" class="btn btn-success float-right submit"><i class="far fa-credit-card"></i>  Pay
          </button>
          </div>
          </form>
        </div>


            </div>
            <!-- /.invoice -->
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
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
include 'includes/footer.php';
}?>