<?php
/*
 * Admin model
 * Creates Database instance
 * Handles Admin details
 */
class  Admin
{
   private $db;
   public function __construct()
   {
      $this->db = new Database;
   }

   // USER LOGIN
   public function login($email, $password)
   {
      $this->db->query('SELECT * FROM `users` WHERE `user_email` = :email AND `user_pass` = :password');
      $this->db->bind(':email', $email);
      $this->db->bind(':password', $password);

      $this->db->singleSet();

      if ($this->db->rowCount() > 0) {
         return true;
      } else {
         return false;
      }
   }

   // UPDATE PASSWORD
   public function updatePassword($password, $email)
   {
      $this->db->query("UPDATE `users` SET `user_pass` = :password WHERE `user_email` = :email");
      $this->db->bind(':password', $password);
      $this->db->bind(':email', $email);

      if ($this->db->execute()) {
         return true;
      } else {
         return false;
      }
   }

   // CHECK FOR EMAIL
   public function checkEmail($email)
   {
      $this->db->query('SELECT * FROM `users` WHERE `user_email` = :email');
      $this->db->bind(':email', $email);

      $this->db->singleSet();

      if ($this->db->rowCount() > 0) {
         return true;
      } else {
         return false;
      }
   }

   // CHECK FOR PASSWORD
   public function checkPassword($password)
   {
      $this->db->query('SELECT * FROM `users` WHERE `user_pass` = :password');
      $this->db->bind(':password', $password);
      $this->db->singleSet();

      if ($this->db->rowCount() > 0) {
         return true;
      } else {
         return false;
      }
   }

   // CHECK FOR USERNAME
   public function checkUsername($username)
   {
      $this->db->query('SELECT * FROM users WHERE username = :username');
      $this->db->bind(':username', $username);
      $this->db->singleSet();

      if ($this->db->rowCount() > 0) {
         return true;
      } else {
         return false;
      }
   }

   // GET ID
   public function getId($col, $id)
   {
      $this->db->query("SELECT * FROM `products` WHERE `$col` = :id");
      $this->db->bind(':id', $id);

      return $this->db->singleSet();
   }

   // DELETE PACKAGES
   public function delete($col, $id)
   {
      $this->db->query("DELETE FROM `products` WHERE `$col` = :id");
      $this->db->bind(':id', $id);

      if ($this->db->execute()) {
         return true;
      } else {
         return false;
      }
   }
}
