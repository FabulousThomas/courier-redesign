<?php
/*
 * Page model
 * Creates Database instance
 * Handles Pages details
 */
class Page
{
   private $db;
   public function __construct()
   {
      $this->db = new Database;
   }

   // ====GET ALL RECORDS====
   public function getAll($table, $orderby)
   {
      $this->db->query("SELECT * FROM $table ORDER BY $orderby DESC");
      return $this->db->resultSet();
   }

   // SELECT ALL WHERE WITH LIMIT RANDOM
   public function select_where_rand_limit($table, $col, $param, $limit)
   {
      $this->db->query("SELECT * FROM $table WHERE $col='$param' ORDER BY RAND() DESC LIMIT $limit");
      return $this->db->resultSet();
   }

   // SELECT ALL WITH LIMIT RANDOM
   public function select_rand_limit($table, $limit)
   {
      $this->db->query("SELECT * FROM $table ORDER BY RAND() DESC LIMIT $limit");
      return $this->db->resultSet();
   }

   // SELECT ALL WHERE
   public function select_Where($table, $col, $param)
   {
      $this->db->query("SELECT * FROM `$table` WHERE `$col`='$param' LIMIT 1");
      return $this->db->resultSet();
   }

   // === SELECT ALL FROM TABLE WHERE
   public function selectAllWhere($table, $col, $param)
   {
      global $conn;
      return $conn->query("SELECT * FROM $table WHERE $col = '$param' LIMIT 1");
   }

   // === DELETE FORM TABLE
   public function deletePackage($table, $col, $param)
   {
      global $conn;
      return $conn->query("DELETE FROM $table WHERE $col = '$param' LIMIT 1");
   }

}
