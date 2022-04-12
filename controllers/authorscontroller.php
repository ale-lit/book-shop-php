<?php

class AuthorsController
{
  private $authorModel;
  public $isAuthorized;

  public function __construct()
  {
    $this->authorModel = new Author();
    $userModel = new User();
    $this->isAuthorized = $userModel->checkIfUserAuthorized();
  }

  public function actionIndex()
  {
    $authors = $this->authorModel->getAll();
    $title = 'Авторы';
    require_once("views/authors/table.html");
  }

  public function actionAdd()
  {
    $title = 'Добавление автора';
    $errors = [];
    if (isset($_POST['fio'])) {
      $fio = htmlentities($_POST['fio']);
      // TODO: сделать проверку на регулярки -> если проверку не проходит, то пушим в errors
      // TODO: проверка на то, что значение есть в таблице
      if (empty($errors)) {
        $this->authorModel->insert($fio);
        header('Location: ' . FULL_SITE_ROOT . 'authors');
      }
    }
    require_once("views/authors/form.html");
  }

  public function actionEdit($id)
  {
    $title = 'Редактирование автора';
    $errors = [];
    $author = $this->authorModel->getById($id);
    if (isset($_POST['fio'])) {
      $fio = htmlentities($_POST['fio']);
      // TODO: сделать проверку на регулярки -> если проверку не проходит, то пушим в errors

      if (empty($errors)) {
        if ($author['author_fio'] === $fio) {
          header('Location: ' . FULL_SITE_ROOT . 'authors');
        }
        if ($author['author_fio'] !== $fio) {
          // TODO: проверка на то, что значение есть в таблице  
          $result = $this->authorModel->edit($fio, $id);
          if ($result) {
            header('Location: ' . FULL_SITE_ROOT . 'authors');
          } else {
            $errors[] = "Не удалось добавить данные в таблицу";
          }
        }
      }
    }

    require_once("views/authors/form.html");
  }

  public function actionDelete($id)
  {
    $errors = [];
    // TODO: сделать проверку на то что $id передан правильно (по регулярке + есть в таблице)
    $this->authorModel->remove($id);
    header('Location: ' . FULL_SITE_ROOT . 'authors');
  }
}
