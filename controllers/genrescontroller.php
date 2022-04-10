<?php

  class GenresController {
    private $genreModel;

    public function __construct() {
      $this->genreModel = new Genre();
    }

    public function actionIndex() {
      $genres = $this->genreModel->getAll();
      $title = 'Жанры';
      require_once("views/genres/table.html");
    }
  }