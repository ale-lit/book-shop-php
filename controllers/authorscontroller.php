<?php

  require_once("models/author.php");

  class AuthorsController {

    private $authorModel;

    public function __construct() {
      $this->authorModel = new Author();
    }

    public function actionIndex() {
      $authors = $this->authorModel->getAll();
      $title = 'Авторы';
      require_once("views/authors/table.html");
    }

    public function actionAdd() {
      $title = 'Добавление автора';
      $errors = [];
      if(isset($_POST['fio'])) {
        $fio = htmlentities($_POST['fio']);
        // TODO: сделать проверку на регулярки -> если проверку не проходит, то пушим в errors
        // TODO: проверка на то, что значение есть в таблице
        if(empty($errors)) {
          $this->authorModel->insert($fio);
          header('Location: ' . FULL_SITE_ROOT . 'authors');
        }
      }
      require_once("views/authors/form.html");
    }

    public function actionEdit($id) {
      echo "Вызван метод edit $id";
    }
  }