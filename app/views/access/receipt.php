<?php
require APPROOT . '/views/access/inc/head.php';
require APPROOT . '/views/access/inc/navbar.php';
require APPROOT . '/views/access/inc/sidebar.php';
?>

<style>
   small {
      display: block;
   }

   p,
   h5,
   h4,
   h3,
   h2,
   h1,
   h6 {
      margin-bottom: 0 !important;
   }

   table thead tr th,
   table tbody tr th {
      padding: .3rem .5rem;
   }
</style>

<main class="py-5">

   <?php foreach ($data['package'] as $row) : ?>
      <div class="text-center">
         <button type="button" onclick="window.print();" class="btn btn-success" id="print-btn">Print Receipt</button>
      </div>

      <div class="">
         <div class="px-3 position-relative">
            <div>
               <img src="<?=URLROOT?>/assets/img/logo/logo.png" class="img-fluid" alt="LOGO">
            </div>
            <div class="d-flex justify-content-between mt-3">
               <div>
                  <small class="d-block fw-bold">Address: </small>
                  <small class="d-block fw-bold">Email: <?= EMAIL ?></small>
                  <small class="d-block fw-bold">Website: <?= WEBSITE ?></small>
                  <small class="d-block fw-bold">Tel: <?= PHONE ?></small>
               </div>
               <div>
                  <h3 class="text-uppercase text-success">invoice</h3>
               </div>
            </div>
            <table class="table table-bordered table-sm table-responsive-sm">
               <thead>
                  <tr>
                     <th colspan="10">
                        <h5 class="text-center">TRACKING NO. <?= $row->t_id ?></h5>
                     </th>
                  </tr>
               </thead>
               <thead>
                  <tr>
                     <th scope="col">
                        <h6 class="text-center text-uppercase">sender's information</h6>
                     </th>
                     <th scope="col">
                        <h6 class="text-center text-uppercase">Receiver's information</h6>
                     </th>
                  </tr>
               </thead>

               <tbody>
                  <tr>
                     <td><small class="fw-bold d-inline">Sender Name: </small> <span><?= $row->s_name ?></span></td>
                     <td><small class="fw-bold d-inline">Receiver Name: </small> <span><?= $row->r_name ?></span></td>
                  </tr>
                  <tr>
                     <td><small class="fw-bold d-inline">Address: </small> <span><?= $row->s_address ?></span></td>
                     <td><small class="fw-bold d-inline">Address: </small> <span><?= $row->r_address ?></span></td>
                  </tr>
                  <tr>
                     <td><small class="fw-bold d-inline">Location (Origin): </small> <span><?= $row->o_location ?></span>
                     </td>
                     <td><small class="fw-bold d-inline">Location (Destination): </small>
                        <span><?= $row->d_location ?></span>
                     </td>
                  </tr>
                  <tr>
                     <td><small class="fw-bold d-inline">Phone: </small> <span><?= $row->s_phone ?></span></td>
                     <td><small class="fw-bold d-inline">Phone: </small> <span><?= $row->r_phone ?></span></td>
                  </tr>
                  <tr>
                     <td><small class="fw-bold d-inline">Email: </small> <span><?= $row->s_email ?></span></td>
                     <td><small class="fw-bold d-inline">Email: </small> <span><?= $row->r_email ?></span></td>
                  </tr>
               </tbody>
               <thead>
                  <tr class="bg-success fw-bold">
                     <th colspan="10">
                        <h6 class="text-center">PACKAGE INFORMATION</h6>
                     </th>
                  </tr>
               </thead>
               <thead>
                  <tr class="bg-success fw-bold">
                     <th scope="col">
                        <h6 class="text-center text-uppercase">consignment</h6>
                     </th>
                     <th scope="col">
                        <h6 class="text-center text-uppercase">charges</h6>
                     </th>
                  </tr>
               </thead>

               <tbody>
                  <tr>
                     <td><small class="fw-bold d-inline">Quantity: </small> <span><?= $row->p_pieces ?></span></td>
                     <td><small class="fw-bold d-inline">Shipment Fee: </small>
                        <span>$<?= number_format($row->ship_cost) ?></span>
                     </td>
                  </tr>
                  <tr>
                     <td><small class="fw-bold d-inline">Weight: </small> <span><?= $row->p_weight ?>KG</span></td>
                     <td><small class="fw-bold d-inline">Handling Charges: </small>
                        <span>$<?= number_format($row->h_charges) ?></span>
                     </td>
                  </tr>

                  <tr class="">
                     <td colspan="" class="py-2">
                        <h6 class="text-center text-success text-uppercase">registerd box</h6>
                        <h6 class="text-center text-uppercase">sealed and stamped</h6>
                     </td>
                     <td class="bg-success align-items-center py-3 d-flex justify-content-evenly">
                        <h6 class="d-inline pe-3 mb text-">Total Charges:</h6>
                        <p class=" text-">$<?= number_format($row->ship_cost + $row->h_charges) ?></p>
                     </td>
                  </tr>
               </tbody>
               <thead>
                  <tr class="bg-success fw-bold">
                     <th scope="col">
                        <h6 class="text-center text-uppercase">sender's authorization</h6>
                     </th>
                     <th scope="col">
                        <h6 class="text-center text-uppercase">payment information</h6>
                     </th>
                  </tr>
               </thead>

               <tbody>
                  <tr>
                     <td>
                        <small class="text-success">Terms and Conditions</small>
                        <small class="">I/We agree that the <?= SITENAME ?> Company standard terms apply to this shipment and limit <?= SITENAME ?> Company liability.<br>The Warsaw convention may also apply.</small>

                        <small class="text-success">Privacy Policy</small>
                        <small class="">We will not divulge your personal details to any other parties and will treat all your personal information as full confidential.<br><span class="fst-italic">Management</span></small>
                     </td>
                     <td style="width: 45%;">
                        <small class="d-block"><span class="fw-bold">Currency Code: </span> <span>United States Dollar (USD)</span></small>
                        <small class="d-block"><span class="fw-bold">Payment Method:</span> <span>Pay Before Delivery</span></small>
                        <small class="d-block"><span class="fw-bold">Payment Status:</span> <span><?= $row->pay_status ?></span></small>
                        <small class="d-block border-bottom"><span class="fw-bold">Total Balance:</span> <span>$<?= number_format($row->ship_cost + $row->h_charges) ?></span></small>

                        <div class="bg-success py-3 px-2">
                           <small class="fw-bold d-inline">Packaged by: </small> <span><?= SITENAME ?> Company, Worldwide</span>
                        </div>
                     </td>
                  </tr>
               </tbody>
            </table>
            <div>
               <img src="<?=URLROOT?>/admin-assets/img/logo/signature.png" class="img-fluid" width="200px" alt="...">
            </div>
            <div class="position-absolute text-center" style="margin-top: 87%; margin-left: 34%;">
               <img src="<?=URLROOT?>/admin-assets/img/logo/dispatch.png" class="img-fluid" width="200px" alt="...">
            </div>


         <?php endforeach; ?>
         </form>
         </div>
      </div>

</main>

<?php require APPROOT . '/views/access/inc/footer.php'; ?>