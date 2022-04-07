<?php
  class DB {
    private $connection;

    public function __construct() {
      require_once('configs/db.php');
      $connect = mysqli_connect($db['HOST'], $db['USER'], $db['PASSWORD'], $db['DB_NAME']);
      mysqli_set_charset($connect, $db['CHARSET']);
      $this->connection = $connect;
    }

    public function getConnection() {
      return $this->connection;
    }
  }