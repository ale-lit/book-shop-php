<?php

  class GendersController {
    private $genderModel;

    public function __construct() {
      $this->genderModel = new Gender();
    }

    public function actionIndex() {
      $genders = $this->genderModel->getAll();
      $title = 'Пол';
      require_once("views/genders/table.html");
    }
  }