<?php
$username = '';
$result = '';

include_once("session.php");
include("pdo_connect.php");
session_start();
$username =  $_SESSION['user'];
include_once("pdo_connect.php");
$query = $pdo->prepare("SELECT * FROM userblog ORDER BY created_at DESC");
$query->execute();
$result = $query->fetchAll();
$adminCheck = $pdo->prepare("SELECT is_admin FROM user WHERE username = '$username'");
$adminCheck->execute();
$res = $adminCheck->fetch();
$res = $res['is_admin'];

?>
<!DOCTYPE html>
<html lang="en">

<head>

  <title>Dashboard</title>
  <?php require_once('inc_headcss.php'); ?>
  <style>
    .image {
      width: 350px;
    }
  </style>
</head>

<body>
  <div class="container-scroller">
    <!-- partial:partials/_navbar.html -->
    <nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">

      <?php require_once('inc_searchbar.php'); ?>
    </nav>
    <!-- partial -->0
    <div class="container-fluid page-body-wrapper">
      <!-- partial:partials/_sidebar.html -->
      <?php require_once('inc_sidebarnav.php'); ?>
      <!-- partial -->
      <div class="main-panel">
        <div class="content-wrapper">

          <div class="row">
            <div class="col-md-12 grid-margin">
              <div class="d-flex justify-content-between flex-wrap">
                <div class="d-flex align-items-end flex-wrap">

                  <div class="d-flex">
                    <i class="mdi mdi-home text-muted hover-cursor"></i>
                    <p class="text-muted mb-0 hover-cursor">&nbsp;/&nbsp;Dashboard&nbsp;/&nbsp;</p>

                  </div>
                </div>
                <div class="d-flex justify-content-between align-items-end flex-wrap">
                  <button type="button" class="btn btn-light bg-white btn-icon mr-3 d-none d-md-block ">
                    <i class="mdi mdi-download text-muted"></i>
                  </button>
                  <button type="button" class="btn btn-light bg-white btn-icon mr-3 mt-2 mt-xl-0">
                    <i class="mdi mdi-clock-outline text-muted"></i>
                  </button>
                  <button type="button" class="btn btn-light bg-white btn-icon mr-3 mt-2 mt-xl-0">
                    <i class="mdi mdi-plus text-muted"></i>
                  </button>

                </div>
              </div>
            </div>
          </div>
          <?php
          if ($res == 1) { ?> <a href="adminRegister.php"><button type="submit" class="btn btn-secondary">Create New User</button></a>
          <?php } ?>
          <?php
          foreach ($result as $row) { ?>
            <div class="media-body">
              <h4 class="media-heading">
                <h1><?php echo $row['blogsubject'] ?></h1>
              </h4>
              <div>
                <?php if ($row['image']) { ?>
                  <img src="<?php echo $row['image'] ?>" class="image">
                <?php } ?>
              </div>
              <br>
              <p class="text-right"><?php echo $row['username'] ?></p>
              <p><?php echo $row['Blogcontent'] ?></p>
              <ul class="list-inline list-unstyled">
                <li><span><i class="glyphicon glyphicon-calendar"></i><?php $breakdate = explode('-', $row['created_at']);
                                                                      $date = explode(' ', $breakdate[2]);
                                                                      $indays = date('d') - $date[0];
                                                                      if ($indays == 0) {
                                                                        echo 'Today';
                                                                      } else {
                                                                        echo $indays . ' days ago';
                                                                      } ?></span></li>

              </ul>
              <br><br>
            </div>

          <?php }
          ?>
          <!-- content-wrapper ends -->
          <!-- partial:partials/_footer.html -->
          <?php require_once('inc_footer.php'); ?>
          <!-- partial -->
        </div>

        <!-- main-panel ends -->
      </div>

      <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->

    <?php require_once('inc_scripts.php'); ?>
</body>

</html>