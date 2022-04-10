<?php

  class Genre {
    private $connect;

    public function __construct() {
      $db = new DB();
      $this->connect = $db->getConnection();
    }

    public function getAll() {
      $query = "SELECT * FROM `genres`";
      $result = mysqli_query($this->connect, $query);
      return mysqli_fetch_all($result, MYSQLI_ASSOC);
    }
  }