<?php
require APPROOT . '/views/access/inc/head.php';
require APPROOT . '/views/access/inc/navbar.php';
require APPROOT . '/views/access/inc/sidebar.php';
?>

<main class="py-5">

   <div class="container">
      <?php foreach ($data['package'] as $row) : ?>
         <?php if ($row->p_status == 'On Process') : ?>
            <h3 class='text-center mb-0'>Your Package Has Been Dispatched and It's On Transit</h3>
         <?php elseif ($row->p_status == 'On Hold') : ?>
            <h3 class='text-center mb-0'>Your Package Has Been Placed On Hold</h3>
         <?php elseif ($row->p_status == 'Delivered') : ?>
            <h3 class='text-center mb-0'>Your Package Has Been Delivered Successfully</h3>
         <?php elseif ($row->p_status == 'Stopped') : ?>
            <h3 class='text-center mb-0'>Your Package Has Been Stopped</h3>
         <?php elseif ($row->p_status == 'Terminated') : ?>
            <h3 class='text-center mb-0'>Your Package Has Been Terminated</h3>
         <?php endif; ?>

         <h2 class="text-center mb-0">See Package Information Below.</h2>
         <div class="row mt-3">

            <div class="col-lg-10 col-md-12 mb-4 mx-auto">
               <div class="card py-">
                  <div class="card-body">
                     <div class="d-lg-flex flex-lg-row row  justify-content-between">
                        <div class="col-md-6 border-bottom pb-2">
                           <small class="d-block">Package ID: <span class="fw-bold">
                                 <?= $row->p_id ?>
                              </span></small>
                           <small class="d-block">Tracking Number: <span class="fw-bold">
                                 <?= $row->t_id ?>
                              </span></small>
                           <small class="d-block">Handled by: <span class="fw-bold">
                                 <?= SITENAME ?>
                              </span></small>
                        </div>

                        <div class="col-md-6 border-bottom pb-2">
                           <small class="d-block">Package Status: <span class="fw-bold">
                                 <?= $row->p_status ?>
                              </span></small>
                           <small class="d-block">Order Date: <span class="fw-bold">
                                 <?= $row->order_date ?>
                              </span></small>
                           <small class="d-block">Arival Date: <span class="fw-bold">
                                 <?= $row->arival_date ?>
                              </span>
                              <?php if (isset($row->p_status)) : ?>
                                 <?php if ($row->p_status != 'Delivered') : ?>
                                    <sup class="text-danger">(subject to change)</sup>
                                 <?php endif; ?>
                              <?php endif; ?>
                           </small>
                        </div>
                     </div>

                     <div class="d-lg-flex flex-lg-row row  justify-content-between">
                        <div class="col-md-6 border-bottom py-2">
                           <small class="d-block">Receiver Name: <span class="fw-bold">
                                 <?= $row->r_name ?>
                              </span></small>
                           <small class="d-block">Receiver Phone: <span class="fw-bold">
                                 <?= $row->r_phone ?>
                              </span></small>
                           <small class="d-block">Receiver Address: <span class="fw-bold">
                                 <?= $row->r_address ?>
                              </span></small>
                        </div>

                        <div class="col-md-6 border-bottom py-2">
                           <small class="d-block">Sender Name: <span class="fw-bold">
                                 <?= $row->s_name ?>
                              </span></small>
                           <small class="d-block">Sender Phone: <span class="fw-bold">
                                 <?= $row->s_phone ?>
                              </span></small>
                           <small class="d-block">Sender Address: <span class="fw-bold">
                                 <?= $row->s_address ?>
                              </span></small>
                        </div>
                     </div>

                     <div class="d-lg-flex flex-lg-row row  justify-content-between">
                        <div class="col-md-6 pt-2">
                           <small class="d-block">Package: <span class="fw-bold">
                                 <?= $row->p_name ?>
                              </span></small>
                           <small class="d-block">Package Weight(KG): <span class="fw-bold">
                                 <?= $row->p_weight ?>
                              </span></small>
                           <small class="d-block">Shipment Cost: <span class="fw-bold">$
                                 <?= number_format($row->ship_cost, 2) ?>
                              </span></small>
                        </div>

                        <div class="col-md-6 pt-2">
                           <small class="d-block">Handling Charges: <span class="fw-bold">$
                                 <?= number_format($row->h_charges, 2) ?>
                              </span></small>
                           <small class="d-block">Location(Origin): <span class="fw-bold">
                                 <?= $row->o_location ?>
                              </span></small>
                           <small class="d-block">Location(Destination): <span class="fw-bold">
                                 <?= $row->d_location ?>
                              </span></small>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>

         <div class="row">
            <h3 class="text-center">Transportation Routes</h3>
            <div class="col-lg-10 col-md-12 mx-auto">
               <div class="card">
                  <div class="card-body">
                     <?php if (isset($row->transit)) : ?>
                        <?php if ($row->transit == 'Not set yet' || $row->r_status == 'Not set yet') : ?>
                           <p class="text-capitalize text-center mb-0">Not available</p>
                        <?php elseif ($row->transit != 'Not set yet' && $row->r_status == 'Currently here') : ?>
                           <p class="text-center mb-0">Your Package:
                              <?= $row->transit ?><span class="fst-italic">(
                                 <?= $row->r_status ?>)
                              </span> <span class="blink bg-success ms-1"></span>
                           </p>
                        <?php elseif ($row->transit != 'Not set yet' && $row->r_status == 'Passed here') : ?>
                           <p class="text-center mb-0">Your Package:
                              <?= $row->transit ?><span class="fst-italic">(
                                 <?= $row->r_status ?>)
                              </span> <span class="blink bg-warning ms-1"></span>
                           </p>
                        <?php elseif ($row->transit != 'Not set yet' && $row->r_status == 'On Transit') : ?>
                           <p class="text-center mb-0">Your Package:
                              <?= $row->transit ?> <span class="fst-italic">(
                                 <?= $row->r_status ?>)
                              </span> <span class="blink bg-danger ms-1"></span>
                           </p>
                        <?php endif; ?>
                     <?php endif; ?>
                  </div>
               </div>
            </div>
         </div>
   </div>
<?php endforeach; ?>

<div class='container d-none'>
   <div class='row justify-content-center mx-auto'>
      <div class='col-md-10 card border-0'>
         <div class='card-body shadow'>
            <h4 class='text-uppercase text-center py-4'>Congratulations your shipment is booked</h4>
            <p class='mb-0'>Tracking Number: TR123456789</p>
            <p class='mb-0'>Current Status: On Process</p>
            <p class='mb-0'>Location: Germany</p>
            <p class='mb-0'>Shipment Cost: $1,500</p>
            <p class="mb-4">Date: 2024-02-10</p>
            <small>
               -------------------------------------------------------------------------------------
               <br>
               Terms and Conditions
               <br>
               I/We agree that the JETKLIN LOGISTICS Company standard terms apply to this shipment and limit JETKLIN LOGISTICS Company liability.
               The Warsaw convention may also apply.
               <br>
               Privacy Policy
               <br>
               We will not divulge your personal details to any other parties and will treat all your personal information as full confidential.
               <br><br>
               Management.<br> <img src='<?= URLROOT ?>/admin-assets/img/logo/signature.png' alt='' width='200px'>
            </small>
         </div>
      </div>
   </div>
</div>

</main>

<?php require APPROOT . '/views/access/inc/footer.php'; ?>