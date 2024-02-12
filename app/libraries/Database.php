<?php
/*
 * PDO Database Class
 * Connect to database
 * Bind values
 * Create prepared statements
 * Return rows and result
 */
class Database
{
   private $host = DB_HOST, $user = DB_USER, $pass = DB_PASS, $dbname = DB_NAME;
   private $dbh, $stmt, $error;

   /**
    * Constructor
    */
   public function __construct()
   {
      // Set DSN (DATABASE STRING NAME)
      $dsn = 'mysql:host=' . $this->host . '; dbname=' . $this->dbname;
      $options = array(
         PDO::ATTR_PERSISTENT => true,
         PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
      );

      // Create PDO instance
      try {
         $this->dbh = new PDO($dsn, $this->user, $this->pass, $options);
      } catch (PDOException $e) {
         $this->error = $e->getMessage();
         echo $this->error;
      }
   }

   /**
    * Query the database
    *
    * @param string $sql
    */
   public function query($sql)
   {
      $this->stmt = $this->dbh->prepare($sql);
   }

   /**
    * Bind values to the prepared statement
    *
    * @param string $param
    * @param mixed $value
    * @param int $type
    */
   public function bind($param, $value, $type = null)
   {
      if (is_null($type)) {
         switch (true) {
            case is_int($value):
               $type = PDO::PARAM_INT;
               break;
            case is_bool($value):
               $type = PDO::PARAM_BOOL;
               break;
            case is_null($value):
               $type = PDO::PARAM_NULL;
               break;
            default:
               $type = PDO::PARAM_STR;
         }
      }
      $this->stmt->bindValue($param, $value, $type);
   }

   /**
    * Execute the prepared statement
    *
    * @return bool
    */
   public function execute()
   {
      return $this->stmt->execute();
   }

   /**
    * Get result set as array of object
    *
    * @return array
    */
   public function resultSet()
   {
      $this->execute();
      return $this->stmt->fetchAll(PDO::FETCH_OBJ);
   }

   /**
    * Get single set as object
    *
    * @return object
    */
   public function singleSet()
   {
      $this->execute();
      return $this->stmt->fetch(PDO::FETCH_OBJ);
   }

   /**
    * Get row count
    *
    * @return int
    */
   public function rowCount()
   {
      return $this->stmt->rowCount();
   }
}
