<?php

require_once __DIR__ . '/ValidationException.php';
require_once __DIR__ . '/Database.php';
require_once __DIR__ . '/BooksGateway.php';

class BooksService extends BooksGateway
{

    private $booksGateway = null;

    public function __construct()
    {
        $this->booksGateway = new BooksGateway();
    }

    public function getAllBooks($order, $dir, $limit = 10, $offset = 0)
    {
        try {
            self::connect();
            $res = $this->booksGateway->selectAll($order, $dir, $limit, $offset);
            self::disconnect();
            return $res;
        } catch (Exception $e) {
            self::disconnect();
            throw $e;
        }
    }
    public function getBook($id)
    {
        try {
            self::connect();
            $result = $this->booksGateway->selectById($id);
            self::disconnect();
            return $result;
        } catch (Exception $e) {
            self::disconnect();
            throw $e;
        }
        return $this->booksGateway->selectById($id);
    }

    private function validateBookParams($isbn, $title, $author, $publisher, $pages)
    {
        $errors = array();
        if (!isset($isbn) || empty($isbn)) {
            $errors[] = 'El campo isbn es obligatorio';
        }
        if (!isset($title) || empty($title)) {
            $errors[] = 'El campo título es obligatorio';
        }
        if (!isset($author) || empty($author)) {
            $errors[] = 'El campo autor es obligatorio';
        }
        if (!isset($publisher) || empty($publisher)) {
            $errors[] = 'El campo editorial es obligatorio';
        }
        if (!isset($pages) || empty($pages)) {
            $errors[] = 'El campo páginas es obligatorio';
        }
        if (empty($errors)) {
            return;
        }
        throw new ValidationException($errors);
    }

    public function createNewBook($isbn, $title, $author, $publisher, $pages)
    {
        try {
            self::connect();
            $this->validateBookParams($isbn, $title, $author, $publisher, $pages);
            $result = $this->booksGateway->insert($isbn, $title, $author, $publisher, $pages);
            self::disconnect();
            return $result;
        } catch (Exception $e) {
            self::disconnect();
            throw $e;

        }
    }

    public function editBook($isbn, $title, $author, $publisher, $pages, $id)
    {
        try {
            self::connect();
            $result = $this->booksGateway->edit($isbn, $title, $author, $publisher, $pages, $id);
            self::disconnect();
            return $result;
        } catch (Exception $e) {
            self::disconnect();
            throw $e;
        }
    }

    public function deleteBook($id)
    {
        try {
            self::connect();
            $result = $this->booksGateway->delete($id);
            self::disconnect();
        } catch (Exception $e) {
            self::disconnect();
            throw $e;
        }
    }

    public function getTotalBooksCount()
    {
        try {
            self::connect();
            $count = $this->booksGateway->getTotalBooksCount();
            self::disconnect();
            return $count;
        } catch (Exception $e) {
            self::disconnect();
            throw $e;
        }
    }

}

?>
