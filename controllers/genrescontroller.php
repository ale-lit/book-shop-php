<?php

  class GenresController {
    private $genreModel;
    public $isAuthorized;

    public function __construct() {
      $this->genreModel = new Genre();
      $userModel = new User();
      $this->isAuthorized = $userModel->checkIfUserAuthorized();
    }

    public function actionIndex() {
      $genres = $this->genreModel->getAll();
      $title = 'Жанры';
      require_once("views/genres/table.html");
    }
  }