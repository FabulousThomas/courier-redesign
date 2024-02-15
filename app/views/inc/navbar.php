 <!-- NAV START -->
 <nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-0 py-3 fixed-top shadow-sm black-bg">
   <div class="container text-dark">
     <a href="<?= URLROOT ?>">
       <img src="<?= URLROOT ?>/assets/img/logo/logo.png" width="100px" height="40px" alt="LOGO">
     </a>
     <button class="navbar-toggler d-lg-none d-inline theme-color shadow-none border-0" type="button" data-bs-toggle="collapse" data-bs-target="#collapsibleNavId" aria-controls="collapsibleNavId" aria-expanded="false" aria-label="Toggle navigation">
       <span class="navbar-toggler-icon theme-color"></span>
     </button>
     <div class="collapse navbar-collapse" id="collapsibleNavId">
       <div class="m-auto"></div>
       <ul class="navbar-nav ms-auto">
         <li class="nav-item">
           <a class="nav-link" href="<?= URLROOT ?>">Home</a>
         </li>
         <li class="nav-item dropdown">
           <a class="nav-link" href="<?= URLROOT ?>/index#services">Services</a>
         </li>
         <li class="nav-item dropdown">
           <a class="nav-link" href="<?= URLROOT ?>/index#about">About</a>
         </li>

         <li class="nav-item">
           <a class="nav-link" href="<?= URLROOT ?>/index#contact">Contact</a>
         </li>

         <li class="nav-item">
           <a class="nav-link" href="<?= URLROOT ?>/track">Track</a>
         </li>

         <li class="nav-item">
           <small class="text-white shadow-none" id="google_translate_element"></small>
         </li>

       </ul>
     </div>
   </div>
 </nav>
 <!-- NAV END -->