<?php

  class Gender {
    private $connect;

    public function __construct() {
      $this->connect = DB::getConnection();
    }

    public function getAll() {
      $query = "SELECT * FROM `genders`";
      $result = mysqli_query($this->connect, $query);
      return mysqli_fetch_all($result, MYSQLI_ASSOC);
    }
  }