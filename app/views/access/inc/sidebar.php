<div class="offcanvas offcanvas-start text-bg-dark" data-bs-scroll="false" data-bs-backdrop="true" tabindex="-1" id="offcanvas" aria-labelledby="offcanvasExampleLabel">
   <div class="offcanvas-header">
      <a href="<?= URLROOT ?>/access">
         <img src="<?= URLROOT ?>/assets/img/logo/logo.png" width="100px" alt="LOGO">
      </a>
      <button type="button" class="text-reset shadow-none text-white bg-transparent border-0" data-bs-dismiss="offcanvas">
         <i class="las la-times"></i>
      </button>
   </div>
   <div class="offcanvas-body">
      <ul class="">
         <li class="py-2">
            <a class="" href="<?= URLROOT ?>/access">Home</a>
         </li>
         <li class="py-2">
            <a class="" type="button" data-bs-toggle="modal" data-bs-target="#add-product">Add Package</a>
         </li>
         <li class="py-2">
            <a class="" href="<?= URLROOT ?>/access/routes">Manage Routes</a>
         </li>
         <!-- <li class="py-2">
            <a class="" href="<?= URLROOT ?>/access/print">Print Receipt</a>
         </li> -->
         <!-- <li class="py-2">
           <a class="" href="./settings">Website Settings</a>
         </li> -->
         <li class="py-2">
            <a class="" type="button" data-bs-toggle="modal" data-bs-target="#change-password-modal">Change Password</a>
         </li>
         <li class="py-2">
            <a class="" href="<?= URLROOT ?>/access/logout" style="color: red !important;">Logout</a>
         </li>

      </ul>
   </div>
</div>