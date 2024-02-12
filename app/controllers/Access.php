<?php
class Access extends Controller
{
   private $accessModel, $pageModel, $data = [], $formData, $imagePath = './uploads/';
   public function __construct()
   {
      $this->pageModel = $this->model("Page");
      $this->accessModel = $this->model("Admin");
      $this->delete();
      $this->addPackage();
      $this->updateImage();
      $this->updatePackage();
      $this->changePassword();
   }

   public function index()
   {
      if (!isAdmin()) {
         redirect('access/login');
      }

      $this->formData = filteration($_POST);

      if (isset($this->formData['btn_view_package'])) {
         redirect('access/views/' . $this->formData['t_id']);
      }

      if (isset($this->formData['btn_print_receipt'])) {
         redirect('access/receipt/' . $this->formData['t_id']);
      }

      $this->data = [
         'getAll' => $this->pageModel->getAll('products', 'id'),
      ];

      $this->view('access/index', $this->data);
   }

   public function routes()
   {
      if (!isAdmin()) {
         redirect('access/login');
      }

      if ($_SERVER['REQUEST_METHOD'] === 'POST') {
         $this->formData = filteration($_POST);

         if (isset($this->formData['btn_routes'])) {
            $this->data = [
               'p_id' => $this->formData['p_id'],
               'getAll' => $this->pageModel->getAll('products', 'id'),
            ];

            redirect("access/addRoutes/" . $this->data['p_id']);
         }
      }

      $this->data = [
         'getAll' => $this->pageModel->getAll('products', 'id'),
      ];

      $this->view('access/routes', $this->data);
   }

   // ADD ROUTES
   public function addRoutes($id)
   {
      if (!isAdmin()) {
         redirect('access/login');
      }

      global $conn;
      $frData = filteration($_POST);
      if (isset($frData['btn_add_routes'])) {

         $update = $conn->query("UPDATE `products` SET `transit`='$frData[transit]', `r_status`='$frData[r_status]' 
                      WHERE `p_id`='$id'");

         if ($update) {
            flashmsg('message', 'Package updated');
         } else {
            flashmsg('message', 'Package could not be updated', 'alert alert-danger');
         }
      }

      if ($id && !$this->accessModel->getId('p_id', $id) == $id) {
         redirect('access/routes');
      }

      $this->data = [
         'id' => $id,
         'getAll' => $this->pageModel->select_Where('products', 'p_id', $id),
      ];

      $this->view('access/addRoutes', $this->data);
   }

   // $this->view PACKAGE
   public function views($id)
   {
      if (!isAdmin()) {
         redirect('access/login');
      }

      if ($id && !$this->accessModel->getId('t_id', $id) == $id) {
         redirect('access');
      }

      $this->data = [
         'id' => $id,
         'package' => $this->pageModel->select_Where('products', 't_id', $id),
      ];

      $this->view('access/views', $this->data);
   }

   // $this->view PACKAGE
   public function receipt($id)
   {
      if (!isAdmin()) {
         redirect('access/login');
      }

      if ($id && !$this->accessModel->getId('t_id', $id) == $id) {
         redirect('access');
      }

      $this->data = [
         'id' => $id,
         'package' => $this->pageModel->select_Where('products', 't_id', $id),
      ];

      $this->view('access/receipt', $this->data);
   }

   // USER LOGIN
   public function login()
   {
      if ($_SERVER['REQUEST_METHOD'] === 'POST') {
         $this->formData = filteration($_POST);

         if (isset($this->formData['btn-login'])) {

            $this->data = [
               'email' => $this->formData['email'],
               'password' => md5($this->formData['password']),
            ];

            if ($this->accessModel->checkEmail($this->data['email']) && $this->accessModel->checkPassword($this->data['password'])) {
               $grantUser = $this->accessModel->login($this->data['email'], $this->data['password']);
               // if ($grantUser) {
               $this->createLoggedinSession($grantUser);
               // }
            } else {
               flashmsg('error', 'Could not verify your account. Check your details', 'alert alert-danger');
            }
         }
      }

      $this->data = [
         'email' => '',
         'password' => '',
      ];

      $this->view('access/login', $this->data);
   }

   // CHANGE PASSWORD
   private function changePassword()
   {
      if ($_SERVER['REQUEST_METHOD'] === 'POST') {
         $this->formData = filteration($_POST);

         if (isset($this->formData['btn_change_password'])) {

            $password = md5($this->formData['password']);
            $user_email = $_SESSION['email'];

            if (strlen($this->formData['password']) >= 6) {
               $this->accessModel->updatePassword($password, $user_email);
               flashmsg('message', 'Password updated successfully');
            } else {
               flashmsg('message', 'Passwords must be at least 6 characters', 'alert alert-danger');
            }
         }
      }
   }

   // DELETE PACKAGES
   private function delete()
   {
      $this->formData = filteration($_POST);
      if (isset($this->formData['btn_delete_package'])) {

         $image = $this->pageModel->selectAllWhere('products', 'p_id', $this->formData['p_id']);
         $row = $image->fetch_assoc();

         $delete = $this->accessModel->delete('p_id', $this->formData['p_id']);

         if ($delete) {
            if (file_exists($this->imagePath . $row['image'])) {
               unlink($this->imagePath . $row['image']);
            }
            flashmsg('message', 'Package deleted');
         } else {
            flashmsg('message', 'Something went wrong');
         }
      }
   }

   // ADD PACKAGE
   private function addPackage()
   {
      global $conn;
      $this->formData = filteration($_POST);
      if (isset($this->formData['btn_add_package'])) {
         $rand_pid = "ID" . random_int(111111, 999999);
         $rand_tid = "TR" . random_int(11111111, 99999999);
         $transit = 'Not set yet';
         $r_status = 'Not set yet';
         $auto_track = 'No';

         // IMAGE UPLOAD FUNCTION -> TAKES THE IMAGE NAME FROM THE FORM AND SAVE IT TO UPLOADS FOLDER
         $image = imageUpload('image', $this->imagePath);

         $stmt = $conn->prepare("INSERT INTO `products` (`p_id`, `t_id`, `r_name`, `r_email`, `r_phone`, `r_postcode`, `r_address`, `s_name`, `s_email`, `s_phone`, `s_postcode`, `s_address`, `p_name`, `p_weight`, `p_status`, `ship_cost`, `h_charges`, `pay_status`, `p_type`, `p_pieces`, `image`, `transit`, `r_status`, `auto_track`, `o_location`, `d_location`, `order_date`, `arival_date`) 
         VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");

         $stmt->bind_param("sssssissssissisiisssssssssss", $rand_pid, $rand_tid, $this->formData['r_name'], $this->formData['r_email'], $this->formData['r_phone'], $this->formData['r_postcode'], $this->formData['r_address'], $this->formData['s_name'], $this->formData['s_email'], $this->formData['s_phone'], $this->formData['s_postcode'], $this->formData['s_address'], $this->formData['p_name'], $this->formData['p_weight'], $this->formData['p_status'], $this->formData['ship_cost'], $this->formData['h_charges'], $this->formData['pay_status'], $this->formData['p_type'], $this->formData['p_pieces'], $image, $transit, $r_status, $auto_track, $this->formData['o_location'], $this->formData['d_location'], $this->formData['order_date'], $this->formData['arival_date']);

         if ($stmt->execute()) {
            flashmsg('message', 'Package added successfully!');
            $this->sendMail($rand_tid, $this->formData['p_status'], $this->formData['d_location'], $this->formData['ship_cost'] + $this->formData['h_charges'], $this->formData['order_date']);
         } else {
            flashmsg('message', "Something went wrong");
         }
      }
   }

   // ADD PACKAGE
   private function updatePackage()
   {
      global $conn;
      $this->formData = filteration($_POST);
      if (isset($this->formData['btn_update_package'])) {

         $stmt = $conn->prepare("UPDATE products SET r_name=?, r_email=?, r_phone=?, r_postcode=?, r_address=?, s_name=?, s_email=?, s_phone=?, s_postcode=?, s_address=?, p_name=?, p_weight=?, p_status=?, ship_cost=?, h_charges=?, pay_status=?, p_type=?, p_pieces=?, o_location=?, d_location=?, order_date=?, arival_date=? WHERE p_id=?");

         $stmt->bind_param("sssssssssssssssssssssss", $this->formData['r_name'], $this->formData['r_email'], $this->formData['r_phone'], $this->formData['r_postcode'], $this->formData['r_address'], $this->formData['s_name'], $this->formData['s_email'], $this->formData['s_phone'], $this->formData['s_postcode'], $this->formData['s_address'], $this->formData['p_name'], $this->formData['p_weight'], $this->formData['p_status'], $this->formData['ship_cost'], $this->formData['h_charges'], $this->formData['pay_status'], $this->formData['p_type'], $this->formData['p_pieces'], $this->formData['o_location'], $this->formData['d_location'], $this->formData['order_date'], $this->formData['arival_date'], $this->formData['p_id']);

         if ($stmt->execute()) {
            flashmsg('message', 'Package updated successfully!');
            $this->sendMail($this->formData['t_id'], $this->formData['p_status'], $this->formData['d_location'], $this->formData['ship_cost'] + $this->formData['h_charges'], $this->formData['order_date']);
         } else {
            flashmsg('message', "Something went wrong");
         }
      }
   }

   private function updateImage()
   {
      global $conn;
      $this->formData = filteration($_POST);
      if (isset($this->formData['btn_update_image'])) {

         $sql = $this->pageModel->selectAllWhere('products', 'p_id', $this->formData['image_id']);
         $row = $sql->fetch_assoc();

         // IMAGE UPLOAD FUNCTION -> TAKES THE IMAGE NAME FROM THE FORM AND SAVE IT TO UPLOADS FOLDER
         $image = imageUpload('image', $this->imagePath);

         $stmt = $conn->prepare("UPDATE products SET image=? WHERE p_id=?");
         $stmt->bind_param("ss", $image, $this->formData['image_id']);

         if ($stmt->execute()) {
            flashmsg("message", "Image updated");

            if (file_exists($this->imagePath . $row['image'])) {
               unlink($this->imagePath . $row['image']);
            }
         } else {
            flashmsg('message', 'Something went wrong', 'alert alert-danger');
         }
      }
   }

   // SEND MESSAGE TO E-MAIL
   public function sendMail($t_id, $status, $location, $cost, $date)
   {
      $_email = htmlentities($_REQUEST['s_email']);

      $subject = SITENAME . ', CONGRATS';
      $body = "<div class='container'>
      <div class='row justify-content-center mx-auto'>
         <div class='col-md-10 card border-0'>
            <div class='card-body shadow'>
               <h4 class='text-uppercase text-center py-4'>Congratulations your shipment is booked</h4>
               <p class='mb-0'>Tracking Number: $t_id</p>
               <p class='mb-0'>Current Status: $status</p>
               <p class='mb-0'>Location: $location</p>
               <p class='mb-0'>Shipment Cost: $$cost</p>
               <p class='mb-4'>Date: $date</p>
               <small>
                  -------------------------------------------------------------------------------------
                  <br>
                  Terms and Conditions
                  <br>
                  I/We agree that the " . SITENAME . " Company standard terms apply to this shipment and limit " . SITENAME . " Company liability.
                  The Warsaw convention may also apply.
                  <br>
                  Privacy Policy
                  <br>
                  We will not divulge your personal details to any other parties and will treat all your personal information as full confidential.
                  <br><br>
                  Management.<br> <img src='" . URLROOT . "/admin-assets/img/logo/signature.png' alt='' width='200px'>
               </small>
            </div>
         </div>
      </div>
   </div>";
   
      $headers = "MIME-Version: 1.0" . "\r\n";
      $headers .= "Content-Type:text/html;charset=UTF-8" . "\r\n";

      mail($_email, $subject, $body, $headers);
   }

   private function updateData($table, $set_columns, $set_values, $where_column, $where_value)
   {
      global $conn;
      // Check if set_columns and set_values arrays have the same length
      if (count($set_columns) != count($set_values)) {
         echo "Error: The number of set columns and set values must be the same.";
         return false;
      }

      // Build the SET clause
      $set_clause = "";
      for ($i = 0; $i < count($set_columns); $i++) {
         $set_clause .= "$set_columns[$i] = ?,";
      }
      $set_clause = rtrim($set_clause, ",");

      // Prepare the SQL statement
      $sql = "UPDATE $table SET $set_clause WHERE $where_column = ?";
      $stmt = $conn->prepare($sql);

      // Bind the parameters
      // $stmt->bind_param(str_repeat('s', count($set_values[$i])));

      $bindValues = array_merge(array_values($set_values));
      $stmt->bind_param(str_repeat('s', count($bindValues)), ...$bindValues);

      $stmt->bind_param("i", $where_value);

      // Execute the SQL statement
      if ($stmt->execute()) {
         echo "Record updated successfully.";
         return true;
      } else {
         echo "Error: " . $conn->error;
         return false;
      }
   }

   // private function updateData($table, $columnValues, $conditions)
   // {
   //    global $conn;

   //    $columns = implode('=?, ', array_keys($columnValues)) . '=?';
   //    $conditions = implode(' AND ', array_keys($conditions)) . '=?';

   //    $query = "UPDATE `$table` SET $columns WHERE $conditions";

   //    $stmt = $conn->prepare($query);

   //    $bindValues = array_merge(array_values($columnValues), array_values($conditions));
   //    $stmt->bind_param(str_repeat('s', count($bindValues)), ...$bindValues);

   //    return $stmt->execute();
   // }

   // $update = $this->updateData('products', ['transit' => $transit, 'r_status' => $r_status], ['p_id' => $id]);

   // CHECK LOGGED IN USER AND CREATE SESSIONS

   public function createLoggedinSession($users)
   {
      $_SESSION['email'] = $this->data['email'];
      $_SESSION['isLoggedIn'] = true;

      redirect('access/');
   }

   // LOGOUT USER AND DESTROY SESSIONS
   public function logout()
   {
      unset($_SESSION['isLoggedIn']);
      unset($_SESSION['user_email']);
      session_destroy();

      redirect('access/login');
   }
}
