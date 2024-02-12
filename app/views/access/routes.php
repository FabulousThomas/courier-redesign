<?php
require APPROOT . '/views/access/inc/head.php';
require APPROOT . '/views/access/inc/navbar.php';
require APPROOT . '/views/access/inc/sidebar.php';
$i = 1;
?>

<main class="py-5">

   <div class="container">
      <?php flashmsg('message'); ?>
      <h2 class="text-center mb-0">Manage Routes</h2>
      <p class="text-center">Route gives you the privilege to manage locations of transit of this package.</p>
      <div class="col-lg-8 col-md-12 mx-auto">
         <p>Choose package to manage routes</p>
         <form method="POST">
            <div class="form-group mb-3">
               <select class="form-select form-control shadow-none" name="p_id">
                  <!-- <option selected disabled>Select Route To Manage</option> -->
                  <?php if ($data['getAll'] > 0) : ?>
                     <?php foreach ($data['getAll'] as $row) : ?>
                        <option value="<?= $row->p_id ?>"><?= $i++ . '. ' . $row->r_name ?></option>
                     <?php endforeach; ?>
                  <?php else : ?>
                     <option selected disabled>No data found</option>
                  <?php endif; ?>
               </select>
            </div>
            <div class="form-group mb-3">
               <button type="submit" name="btn_routes" class="btn btn-secondary">Proceed to edit</button>
            </div>
         </form>
      </div>
   </div>

</main>

<?php require APPROOT . '/views/access/inc/footer.php'; ?>