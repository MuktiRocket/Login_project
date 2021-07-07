<div class="navbar-brand-wrapper d-flex justify-content-center">
  <div class="navbar-brand-inner-wrapper d-flex justify-content-between align-items-center w-100">
    <!-- <a class="navbar-brand brand-logo" href="index.html"><img src="images/square logo.png" alt="logo" /></a>
    <a class="navbar-brand brand-logo-mini" href="index.html"><img src="images/square logo.png" alt="logo" /></a> -->
    <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
      <span class="mdi mdi-sort-variant"></span>
    </button>
  </div>
</div>
<div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
  <ul class="navbar-nav mr-lg-4 w-100">
    <li class="nav-item nav-search d-none d-lg-block w-100">
    <li class="nav-item nav-profile dropdown">
      <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" id="profileDropdown">
        <img src="images/faces/face5.jpg" alt="profile" />
        <span class="nav-profile-name"><?php echo $_SESSION['user'] ?></span>
      </a>
      <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="profileDropdown">
        <a class="dropdown-item">
          <i class="mdi mdi-settings text-primary"></i>
          Settings
        </a>
        <a class="dropdown-item" href="logout.php">
          <i class="mdi mdi-logout text-secondary">Logout</i>
        </a>
      </div>
    </li>
  </ul>
  <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
    <span class="mdi mdi-menu"></span>
  </button>
</div>