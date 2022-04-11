<?php

  class User {
    private $connect;

    public function __construct() {
      $this->connect = DB::getConnection();
    }

    public function checkIfUserExists($email) {
      $query = "
        SELECT COUNT(*) AS `count`
        FROM `users`
        WHERE `user_email` = '$email';
      ";
      $result = mysqli_query($this->connect, $query);
      return mysqli_fetch_assoc($result)['count'];
    }

    public function register($email, $hashedPassword) {
      $query = "
        INSERT INTO `users`
        SET `user_email` = '$email',
        `user_password` = '$hashedPassword';
      ";
      return mysqli_query($this->connect, $query);
    }

    public function getUserInfo($email, $hashedPassword) {
      $query = "
        SELECT COUNT(*) AS `count`, `user_id`
        FROM `users`
        WHERE `user_email` = '$email' AND `user_password` = '$hashedPassword';
      ";
      $result = mysqli_query($this->connect, $query);
      return mysqli_fetch_assoc($result);
    }

    public function auth($userId, $token, $tokenTime) {
      $query = "
        INSERT INTO `connects`
        SET `connect_user_id` = $userId,
            `connect_token` = '$token',
            `connect_token_time` = FROM_UNIXTIME($tokenTime);
      ";
      return mysqli_query($this->connect, $query);
    }
  }