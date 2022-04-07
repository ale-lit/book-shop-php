<?php

  class Author {   

    private $connect;

    public function __construct() {
      $db = new DB();
      $this->connect = $db->getConnection();
    }

    public function getAll() {      
      $query = "SELECT * FROM `authors`";
      $result = mysqli_query($this->connect, $query);
      return mysqli_fetch_all($result, MYSQLI_ASSOC);
    }

    public function insert($fio) {
      require_once('configs/db.php');
      $connect = mysqli_connect($db['HOST'], $db['USER'], $db['PASSWORD'], $db['DB_NAME']);
      mysqli_set_charset($connect, $db['CHARSET']);
      $query = "INSERT INTO `authors` SET `author_fio` = '$fio'";
      return mysqli_query($this->connect, $query);
    }
  }