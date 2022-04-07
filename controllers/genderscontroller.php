<?php

  require_once("models/gender.php");

  class GendersController {
    public function actionIndex() {
      $genderModel = new Gender();
      $genders = $genderModel->getAll();
      $title = 'Пол';
      require_once("views/genders/table.html");
    }
  }