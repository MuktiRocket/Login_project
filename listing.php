<?php
session_start();
$username =  $_SESSION['user'];
include_once("pdo_connect.php");
$query = $pdo->prepare("SELECT * FROM userblog  WHERE username = '$username' AND deleted_at IS NULL ORDER BY  created_at DESC");
$query->execute();
$result = $query->fetchAll();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="//netdna.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    <title>Document</title>
    <!-- <h1>All Blogs</h1> -->
    <?php require_once('inc_headcss.php'); ?>
    <style>
        .image {
            width: 350px;
        }
    </style>
</head>

<link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.1.0/css/font-awesome.min.css" />


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
                                    <a href="dashboard.php"> <button class='btn btn-danger pull-right'>
                                            Back To Dashboard</button></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body dashboard-tabs p-0">
                                    <ul class="nav nav-tabs px-4" role="tablist">
                                        <li class="nav-item">
                                            <a class="nav-link active" id="overview-tab" data-toggle="tab" href="#overview" role="tab" aria-controls="overview" aria-selected="true">Overview</a>
                                        </li>
                                    </ul>
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
                                            <p class="text-right"><?php echo $_SESSION['user'] ?></p>
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
                                            <form action="edit.php" style="display: inline-block;" method="POST">
                                                <input type="hidden" name="id" value="<?php echo $row['id'] ?>">
                                                <button type="submit" class="btn btn-success">Edit</button>
                                            </form>
                                            <form action="delete.php" style="display: inline-block;" method="POST">
                                                <input type="hidden" name="id" value="<?php echo $row['id'] ?>">
                                                <button type="submit" class="btn btn-danger">Delete</button>
                                            </form>
                                            <br><br>
                                        </div>

                                    <?php }
                                    ?>
                                </div>
                            </div>

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