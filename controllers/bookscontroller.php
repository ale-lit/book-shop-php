<?php

class BooksController
{
    private $bookModel;
    private $authorModel;
    public $isAuthorized;

    public function __construct()
    {
        $this->bookModel = new Book();
        $this->authorModel = new Author();
        $userModel = new User();
        $this->isAuthorized = $userModel->checkIfUserAuthorized();
    }

    public function actionIndex()
    {
        $books = $this->bookModel->getAll();
        $title = 'Книги';
        require_once("views/books/table.html");
    }

    public function actionAdd()
    {
        $title = 'Добавление книги';
        if (isset($_POST['name'])) {
            $name = htmlentities($_POST['name']);
            $year = htmlentities($_POST['year']);
            $price = htmlentities($_POST['price']);
            $authors = $_POST['authors'];            
            // $authors = htmlentities($_POST['authors']);
            // TODO: проверка на регулярки
            $data = array(
                'name' => $name,
                'year' => $year,
                'price' => $price,
                'authors' => $authors
            );
            $this->bookModel->add($data);
            header('Location: ' . FULL_SITE_ROOT . 'books');
        }
        $authors = $this->authorModel->getAll();
        include_once('views/books/form.html');
    }

    public function actionEdit($id)
    {
        $title = 'Редактирование книги';
        $book = $this->bookModel->getById($id);
        $book['authors'] = explode(',', $book['authors']);
        if (isset($_POST['name'])) {
            $name = htmlentities($_POST['name']);
            $year = htmlentities($_POST['year']);
            $price = htmlentities($_POST['price']);
            $authors = $_POST['authors'];
            // $authors = htmlentities($_POST['authors']);
            // TODO: проверка на регулярки
            $data = array(
                'name' => $name,
                'year' => $year,
                'price' => $price,
                'authors' => $authors
            );
            $this->bookModel->edit($data);
            header('Location: ' . FULL_SITE_ROOT . 'books');
        }
        $authors = $this->authorModel->getAll();
        include_once('views/books/form.html');
    }

    public function actionDelete($id)
    {
        $this->bookModel->remove($id);
        header('Location: ' . FULL_SITE_ROOT . 'books');
    }
}
