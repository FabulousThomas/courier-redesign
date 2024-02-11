<?php

// FLASH MESSAGE
function flashmsg($name = '', $message = '', $class = 'alert alert-success')
{
   if (!empty($name)) {
      if (!empty($message) && empty($_SESSION[$name])) {
         if (!empty($_SESSION[$name])) {
            unset($_SESSION[$name]);
         }

         if (!empty($_SESSION[$name . '_class'])) {
            unset($_SESSION[$name . '_class']);
         }

         $_SESSION[$name] = $message;
         $_SESSION[$name . '_class'] = $class;
      } elseif (empty($message) && !empty($_SESSION[$name])) {
         $class = !empty($_SESSION[$name . '_class']) ? $_SESSION[$name . '_class'] : '';
         // echo '<div class="' . $class . '" id="msg-flash">' . $_SESSION[$name] . '</div>';
         echo <<<alert
            <div class="alert $class fade show py-1 rounded-0" role="alert" id="flash-msg">
               <div class="d-flex align-items-center justify-content-between me-">
                  <div class="me-3"><small>$_SESSION[$name]</small></div>
                  <a type="button" class="btn-close shadow-none" data-bs-dismiss="alert" aria-label="Close"></a>
               </div>
            </div>
         alert;
         unset($_SESSION[$name]);
         unset($_SESSION[$name . '_class']);
      }
   }
}

function isAdmin()
{
   if (isset($_SESSION['isLoggedIn'])) {
      return true;
   } else {
      return false;
   }
}

// RANDOM NUMBER
function random_num($length)
{
   $text = "";
   $len = rand($length, $length);

   for ($i = 0; $i < $len; $i++) {
      $text .= rand(2, 9);
   }
   return $text;
}

// PAGE REDIRECT
function redirect($page)
{
   // header('Location: ' . URLROOT . '/' . $page);
   echo "
      <script>
         window.location.href='" . URLROOT . "/" . $page . "';
      </script>
   ";
}

function filteration($type)
{
   foreach ($type as $key => $value) {
      $value = trim($value);
      $value = stripslashes($value);
      $value = strip_tags($value);
      $value = htmlspecialchars($value);
      $type[$key] = $value;
   }
   return $type;
}

function imageUpload($img_name, $path)
{
   $ext = pathinfo($_FILES[$img_name]['name'], PATHINFO_EXTENSION);
   $image = random_int(1111111, 9999999) . '.' . $ext;

   if (move_uploaded_file($_FILES[$img_name]['tmp_name'], $path . $image)) {
      return $image;
   } else {
      flashmsg('success', 'Image Upload Error', 'alert-danger');
   }
}

// function setTimeOut()
// {
//    $_SESSION['lastActive'] = time();
//    $logoutTime = 1;
//    $lastActiveTime = $_SESSION['lastActive'] * 1;

//    if($_SESSION['lastActive'] - $lastActiveTime >= $logoutTime) {
//       session_destroy();
//       redirect('access/login');
//       echo "<script>alert('15 Minutes over!');</script>";
//       exit;
//    } else {
//       $_SESSION['lastActive'];
//    }

   // if (time() - $_SESSION['timestamp'] > 900) { //subtract new timestamp from the old one
   //    echo "<script>alert('15 Minutes over!');</script>";
   //    session_destroy();
   //    redirect("access/login"); //redirect to login
   //    exit;
   // } else {
   //    $_SESSION['timestamp'] = time(); //set new timestamp
   // }
// }
