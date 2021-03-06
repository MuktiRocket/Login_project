<?php
include_once('pdo_connect.php');
$username = '';
$isadmin = '';
if (isset($_POST["adminRegister"])) {

    $username = $_POST["username"];
    $password = $_POST["password"];
    $email = $_POST["email"];
    $country = $_POST["country"];
    if (isset($_POST['admin'])) {
        $isadmin = $_POST['admin'];
    } else {
        $isadmin = 0;
    }

    if ($username != '' && $password != '' && $email != '' && $country != '') {

        $query = $pdo->prepare("INSERT INTO user(username, password ,email,country,is_admin) VALUES ('$username','$password','$email','$country',$isadmin)");
        $query->execute();

        if ($query) {
            echo 'Registered Successfully';
            header("Location: listing.php");
        }
    } else {
        echo "please Enter the Required Fields";
    }
}

?>



<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Register</title>
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

                            <h4>New here?</h4>
                            <h6 class="font-weight-light">Signing up is easy. It only takes a few steps</h6>
                            <form class="pt-3" method="POST" name="register" action="">
                                <div class="form-group">
                                    <input type="text" name="username" class="form-control form-control-lg" id="username" placeholder="Username">
                                </div>
                                <div class="form-group">
                                    <input type="email" name="email" class="form-control form-control-lg" id="email" placeholder="Email">
                                </div>
                                <div class="form-group">
                                    <select name="country" class="form-control form-control-lg" id="country" class="darkwrite">
                                        <option value="">Country</option>
                                        <option value="US">United States of America</option>
                                        <option value="UK">United Kingdom</option>
                                        <option value="IN">India</option>
                                        <option value="GR">Germany</option>
                                        <option value="AR">Argentina</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <input type="password" name="password" class="form-control form-control-lg" id="password" placeholder="Password">
                                </div>
                                <div class="mb-4">
                                    <div class="form-check">
                                        <label class="form-check-label text-muted">
                                            <input type="checkbox" name="admin" value="1" class="form-check-input">
                                            Admin
                                        </label>
                                    </div>
                                </div>
                                <div class="mt-3">
                                    <input type="submit" name="adminRegister" class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn" value="SIGN UP" />

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