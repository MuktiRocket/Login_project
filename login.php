<?php
$remember = '';
session_start();
//connecting database
include_once('db_connect.php');

if (isset($_POST["login"])) {
  //getting the forms data
  $username = $_POST["username"];
  $password = $_POST["password"];
  if (isset($_POST["remember"])) {
    $remember = $_POST["remember"];
  }
  //setting cookies
  if ($remember == 1) {
    setcookie('uname', $username, time() + 60 * 60 * 24 + 10, "/");
    setcookie('pname', $password, time() + 60 * 60 * 24 + 10, "/");
  }

  $sql = "SELECT * FROM user WHERE username = '$username' && password = '$password'";
  $qry = mysqli_query($conn, $sql);
  $count = mysqli_num_rows($qry);
  if ($count == 1) {
    $_SESSION['user'] = $username;
    header("Location: dashboard.php ");
  } else {
    echo "Wrong login Credentials";
  }
}

?>




<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Login</title>
  <!-- plugins:css -->
  <link rel="stylesheet" href="vendors/mdi/css/materialdesignicons.min.css">
  <link rel="stylesheet" href="vendors/base/vendor.bundle.base.css">
  <!-- endinject -->
  <!-- plugin css for this page -->
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href="css/style.css">
  <!-- endinject -->
  <link rel="shortcut icon" href="images/favicon.png" />
</head>

<body>
  <div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper">
      <div class="content-wrapper d-flex align-items-center auth px-0">
        <div class="row w-100 mx-0">
          <div class="col-lg-4 mx-auto">
            <div class="auth-form-light text-left py-5 px-4 px-sm-5">

              <h4>Hello! let's get started</h4>
              <h6 class="font-weight-light">Sign in to continue.</h6>
              <form class="pt-3" method="post" name="login">
                <div class="form-group">
                  <input type="text" name="username" class="form-control form-control-lg" id="username" placeholder="Username" value="<?php if (isset($_COOKIE['uname'])) {
                                                                                                                                        echo $_COOKIE['uname'];
                                                                                                                                      } ?>">
                </div>
                <div class="form-group">
                  <input type="password" name="password" class="form-control form-control-lg" id="password" placeholder="Password" value="<?php if (isset($_COOKIE['pname'])) {
                                                                                                                                            echo $_COOKIE['pname'];
                                                                                                                                          } ?>">
                </div>
                <div class="mt-3">
                  <input type="submit" class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn" name="login" value="SIGN IN" />
                </div>
                <div class="my-2 d-flex justify-content-between align-items-center">
                  <div class="form-check">
                    <label class="form-check-label text-muted">
                      <input type="checkbox" class="form-check-input" name="remember" value="1">
                      Keep me signed in
                    </label>
                  </div>
                </div>
                <div class="text-center mt-4 font-weight-light">
                  Don't have an account? <a href="register.php" class="text-primary">Create</a>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
      <!-- content-wrapper ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->
  <!-- plugins:js -->
  <script src="vendors/base/vendor.bundle.base.js"></script>
  <!-- endinject -->
  <!-- inject:js -->
  <script src="js/off-canvas.js"></script>
  <script src="js/hoverable-collapse.js"></script>
  <script src="js/template.js"></script>
  <!-- endinject -->
</body>

</html>