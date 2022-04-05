<?php

require_once("models/genre.php");

  class GenresController {
    public function actionIndex() {
      $genreModel = new Genre();
      $genres = $genreModel->getAll();
      $title = 'Жанры';
      require_once("views/genres/table.html");
    }
  }