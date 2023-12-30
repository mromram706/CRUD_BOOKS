<?php
require_once __DIR__ . '/./Database.php';

class BooksGateway extends Database
{
    public function selectAll($order, $dir, $limit = 10, $offset = 0)
    {
        if (!isset($order)) {
            $order = 'isbn';
        }
        if (!isset($dir)) {
            $dir = 'asc';
        }
        $pdo = Database::connect();
        $sql = $pdo->prepare("SELECT * FROM books ORDER BY $order $dir LIMIT :limit OFFSET :offset");
        $sql->bindParam(':limit', $limit, PDO::PARAM_INT);
        $sql->bindParam(':offset', $offset, PDO::PARAM_INT);
        $sql->execute();

        $books = array();
        while ($obj = $sql->fetch(PDO::FETCH_OBJ)) {
            $books[] = $obj;
        }
        return $books;
    }

    public function selectById($id)
    {
        $pdo = Database::connect();
        $sql = $pdo->prepare("SELECT * FROM books WHERE id = ?");
        $sql->bindValue(1, $id);
        $sql->execute();
        $result = $sql->fetch(PDO::FETCH_OBJ);

        return $result;
    }

    public function insert($isbn, $title, $author, $publisher, $pages)
    {
        $pdo = Database::connect();
        $sql = $pdo->prepare("INSERT INTO books (isbn, title, author, publisher, pages) VALUES (?, ?, ?, ?, ?)");
        $result = $sql->execute(array($isbn, $title, $author, $publisher, $pages));
        return $result;

    }

    public function edit($isbn, $title, $author, $publisher, $pages, $id)
    {
        $pdo = Database::connect();
        $sql = $pdo->prepare("UPDATE books set isbn = ?, title = ?, author = ?, publisher = ?, pages = ? WHERE id = ? LIMIT 1");
        $result = $sql->execute(array($isbn, $title, $author, $publisher, $pages, $id));
        return $result;
    }

    public function delete($id)
    {
        $pdo = Database::connect();
        $sql = $pdo->prepare("DELETE FROM books WHERE id = ?");
        $sql->execute(array($id));
    }

    public function getTotalBooksCount()
    {
        $pdo = Database::connect();
        $sql = $pdo->prepare("SELECT COUNT(*) FROM books");
        $sql->execute();
        $count = $sql->fetchColumn();
        return $count;
    }

}
?>