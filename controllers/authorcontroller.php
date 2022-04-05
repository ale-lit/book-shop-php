<?php

require_once("models/author.php");

  class AuthorsController {
    public function actionIndex() {
      $authorModel = new Author();
      $authors = $authorModel->getAll();
      $title = 'Авторы';
      require_once("views/authors/table.html");
    }

    public function actionEdit($id) {
      echo "Вызван метод edit $id";
    }
  }