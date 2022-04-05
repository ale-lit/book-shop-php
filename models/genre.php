<?php

  class Genre {
    public function getAll() {
      require_once('configs/db.php');
      $connect = mysqli_connect($db['HOST'], $db['USER'], $db['PASSWORD'], $db['DB_NAME']);
      mysqli_set_charset($connect, $db['CHARSET']);
      $query = "SELECT * FROM `genres`";
      $result = mysqli_query($connect, $query);
      return mysqli_fetch_all($result, MYSQLI_ASSOC);
    }
  }