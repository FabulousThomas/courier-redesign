<?php
// === FORM REQUEST
if ($_SERVER['REQUEST_METHOD'] = 'POST') {

   if (isset($_POST['btn_generate_tracking_no'])) {

      global $conn;
      $generate_tracking = "TR" . random_int(11111111, 99999999);
      $pack_id = mysqli_real_escape_string($conn, $_POST['pack_id']);

      $stmt = $conn->prepare("UPDATE products SET t_id=? WHERE p_id=? LIMIT 1");
      $stmt->bind_param("si", $generate_tracking, $pack_id);

      if ($stmt->execute()) {
         flashMsg("message", "New Tracking number generated successfully");
      } else {
         die("Something went wrong");
      }
   }
}
