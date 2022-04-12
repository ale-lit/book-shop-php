<?php

class GendersController
{
  private $genderModel;
  public $isAuthorized;

  public function __construct()
  {
    $this->genderModel = new Gender();
    $userModel = new User();
    $this->isAuthorized = $userModel->checkIfUserAuthorized();
  }

  public function actionIndex()
  {
    $genders = $this->genderModel->getAll();
    $title = 'Пол';
    require_once("views/genders/table.html");
  }
}
