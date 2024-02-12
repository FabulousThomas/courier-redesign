<?php
require APPROOT . '/views/access/inc/head.php';
require APPROOT . '/views/access/inc/navbar.php';
require APPROOT . '/views/access/inc/sidebar.php';
?>

<main class="mt-0 py-5">
   <section class="">
      <div class="container">
         <?php flashmsg('message'); ?>
         <h3 class='text-center mb-0 text-capitalize'>Change package routing information</h3>
         <p class='text-center mb-0'>Add and Select where appropriate</p>
         <div class="row mt-3">

            <div class="col-lg-10 col-md-12 mb-4 mx-auto">
               <div class="card py-">
                  <div class="card-body">
                     <form method="POST">
                        <div class="row">
                           <div class="col-md-12 col-lg-6 mb-2">
                              <label for="country">Enter Routing Country</label>
                              <input type="text" class="form-control shadow-none" name="transit" required>
                           </div>
                           <div class="col-md-12 col-lg-6 mb-2">
                              <label for="country">Routing Status</label>
                              <select class="form-select shadow-none" name="r_status">
                                 <option value="Not set yet">Not set yet</option>
                                 <option value="Currently here">Currently here</option>
                                 <option value="Passed here">Passed here</option>
                                 <option value="On Transit">On Transit</option>
                              </select>
                           </div>
                           <div class="col-md-12 col-lg-6 mt-2">
                              <button type="submit" class="btn btn-secondary" name="btn_add_routes">Add Routing</button>
                           </div>
                        </div>
                     </form>
                  </div>
               </div>
               <div class="card mt-3">
                  <div class="card-body">
                     <h3 class="text-center text-capitalize mb-3">Rounting and package details</h3>

                     <?php foreach ($data['getAll'] as $row) : ?>
                        <div class="col-12 mx-auto text-center">
                           <div class="d-flex justify-content-evenly border-bottom">
                              <p class="mb-0 py-1">Package ID: <?= $row->p_id ?></p>
                              <p class="mb-0 py-1">Tracking Number: <?= $row->t_id ?></p>
                              <p class="mb-0 py-1">Package Name: <?= $row->r_name ?></p>
                           </div>
                           <div class="d-flex justify-content-evenly border-bottom">
                              <p class="mb-0 py-1">Origin Location: <?= $row->o_location ?></p>
                              <p class="mb-0 py-1">Destination: <?= $row->d_location ?></p>
                              <p class="mb-0 py-1">Transit Location: <?= $row->transit ?></p>
                           </div>
                           <div class="d-flex justify-content-evenly">
                              <p class="mb-0 py-1">Package Status: <?= $row->p_status ?></p>
                              <p class="mb-0 py-1">Transit Status: <?= $row->r_status ?></p>
                           </div>
                        </div>
                     <?php endforeach; ?>

                  </div>
               </div>
            </div>
         </div>

      </div>
   </section>


</main>


<?php
require APPROOT . '/views/access/inc/footer.php';
?>