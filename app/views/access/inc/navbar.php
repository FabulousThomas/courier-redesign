<?php
// if (!isset($_SESSION['isLoggedIn'])) {
//   redirect('access/login');
// }
// if (!isAdmin()) {
//   redirect('access/login');
// }
?>

<!-- NAV START -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-0 py-3 fixed-to shadow black-bg">
  <div class="container text-dark">
    <a href="<?= URLROOT ?>/access">
      <img src="<?= URLROOT ?>/admin-assets/img/logo/globallink_logo.png" width="100px" alt="LOGO">
    </a>
    <!-- <button class="navbar-toggler d-lg-none d-inline theme-color" type="button" data-bs-toggle="collapse" data-bs-target="#collapsibleNavId" aria-controls="collapsibleNavId" aria-expanded="false" aria-label="Toggle navigation">
       <span class="navbar-toggler-icon theme-color"></span>
     </button> -->

    <button class="navbar-toggler d-lg-none d-inline theme-color shadow-none" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvas" aria-controls="offcanvas" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon theme-color"></span>
    </button>

    <div class="collapse navbar-collapse d-sm-none" id="collapsibleNavId">
      <!-- <div class="m-auto"></div> -->
      <ul class="navbar-nav ms-">
        <li class="nav-item">
          <a class="nav-link" href="<?= URLROOT ?>/access">Home</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link" type="button" data-bs-toggle="modal" data-bs-target="#add-product">Add Package</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="<?= URLROOT ?>/access/routes">Manage Routes</a>
        </li>
        <!-- <li class="nav-item">
          <a class="nav-link" href="<?= URLROOT ?>/access/print">Print Receipt</a>
        </li> -->
        <!-- <li class="nav-item">
           <a class="nav-link" href="./settings.php">Website Settings</a>
         </li> -->
        <li class="nav-item">
          <a class="nav-link" type="button" data-bs-toggle="modal" data-bs-target="#change-password-modal">Change Password</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="<?= URLROOT ?>/access/logout" style="color: red !important;">Logout</a>
        </li>

      </ul>
    </div>
  </div>
</nav>
<!-- NAV END -->