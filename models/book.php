<?php

class Book
{
    private $connect;

    public function __construct()
    {
        $this->connect = DB::getConnection();
    }

    public function getAll()
    {
        $query = "
            SELECT `book_id`, `book_name`, `book_price`, `book_year`,
            `genre_name`, GROUP_CONCAT(`author_fio`) AS `authors`
            FROM `books`
            LEFT JOIN `genres` ON `book_genre_id` = `genre_id`
            LEFT JOIN `books_authors` ON `book_author_book_id` = `book_id`
            LEFT JOIN `authors` ON `book_author_author_id` = `author_id`
            WHERE `book_is_deleted` = 0
            GROUP BY `book_id`;
        ";
        $result = mysqli_query($this->connect, $query);
        return mysqli_fetch_all($result, MYSQLI_ASSOC);
    }
}