<?php

  class UsersController {
    private $userModel;
    private $helper;

    public function __construct() {
      $this->userModel = new User();
      $this->helper = new Helper();
    }

    public function actionReg() {
      $title = 'Регистрация';

      $errors = [];

      if(isset($_POST['email'])) {
        $email = htmlentities($_POST['email']);
        $password = htmlentities($_POST['password']);
        $repeatPassword = htmlentities($_POST['repeat_password']);
        // TODO: проверить на регулярки
        if($password !== $repeatPassword) {
          $errors[] = "Пароли не совпадают";
        } else {
          $count = $this->userModel->checkIfUserExists($email);
          if($count === '1') {
            $errors[] = "Такой email уже зарегистрирован";
          }
          if(empty($errors)) {
            $hashedPassword = md5($password);
            $this->userModel->register($email, $hashedPassword);
            header("Location: " . FULL_SITE_ROOT . "authors");
          }
        }
      }

      include_once "views/users/reg.html";
    }

    public function actionAuth() {
      $title = 'Авторизация';

      $errors = [];

      if(isset($_POST['email'])) {
        $email = htmlentities($_POST['email']);
        $password = htmlentities($_POST['password']);
        // TODO: проверить на регулярки
        $hashedPassword = md5($password);
        $userInfo = $this->userModel->getUserInfo($email, $hashedPassword);
        if($userInfo['count'] === '0') {
          $errors[] = "Такой связки email / пароль не существует";
        }        
        if(empty($errors)) {
          $token = $this->helper->genereateToken();
          $tokenTime = time() + 30 * 60;
          $userId = $userInfo['user_id'];
          $this->userModel->auth($userId, $token, $tokenTime);
          setcookie("uid", $userId, time() + 2 * 24 * 3600, '/');
          setcookie("t", $token, time() + 2 * 24 * 3600, '/');
          setcookie("tt", $tokenTime, time() + 2 * 24 * 3600, '/');
          header("Location: " . FULL_SITE_ROOT . "authors");
        }
      }

      include_once "views/users/auth.html";
    }
  }