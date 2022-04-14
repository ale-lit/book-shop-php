<?php

class BooksController
{
    private $bookModel;
    public $isAuthorized;

    public function __construct()
    {
        $this->bookModel = new Book();
        $userModel = new User();
        $this->isAuthorized = $userModel->checkIfUserAuthorized();
    }

    public function actionIndex()
    {
        $books = $this->bookModel->getAll();
        $title = 'Книги';
        require_once("views/books/table.html");
    }
}
