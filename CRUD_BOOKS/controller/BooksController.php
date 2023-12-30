<?php
require_once __DIR__ . '/../model/Autoloader.php';
require_once __DIR__ . '/../model/BooksService.php';

class BooksController
{
    private $booksService = null;

    public function __construct()
    {
        $this->booksService = new BooksService();
    }

    public function redirect($location)
    {
        header('Location: ' . $location);
    }

    public function handleRequest()
    {
        $op = isset($_GET['op']) ? $_GET['op'] : null;

        try {
            if (!$op || $op == 'list') {
                $this->listBooks();
            } elseif ($op == 'new') {
                $this->saveBook();
            } elseif ($op == 'edit') {
                $this->editBook();
            } elseif ($op == 'delete') {
                $this->deleteBook();
            } elseif ($op == 'show') {
                $this->showBook();
            } else {
                $this->showError("Page not found", "Page for operation " . $op . " was not found!");
            }
        } catch (Exception $e) {
            $this->showError("Application error", $e->getMessage());
        }
    }

    public function listBooks()
    {
        $order = isset($_GET['order']) ? $_GET['order'] : 'isbn';
        $dir = isset($_GET['dir']) && in_array($_GET['dir'], ['asc', 'desc']) ? $_GET['dir'] : 'asc';
        $currentPage = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $limit = 10;
        $offset = ($currentPage - 1) * $limit;

        $totalBooks = $this->booksService->getTotalBooksCount();
        $books = $this->booksService->getAllBooks($order, $dir, $limit, $offset);
        $totalPages = ceil($totalBooks / $limit);

        include ROOT_PATH . '/view/books.php';
    }


    public function saveBook()
    {
        $title = 'Añadir nuevo libro';

        $isbn = '';
        $title = '';
        $author = '';
        $publisher = '';
        $pages = '';

        $errors = array();

        if (isset($_POST['form-submitted'])) {
            list($isbn, $title, $author, $publisher, $pages) = $this->isSetBook();

            try {
                $this->booksService->createNewBook($isbn, $title, $author, $publisher, $pages);
                $_SESSION['message'] = "Libro '" . htmlentities($title) . "' añadido con éxito";
                $this->redirect('index.php');
                return;
            } catch (ValidationException $e) {
                $errors = $e->getErrors();
            }
        }

        include ROOT_PATH . '/view/books-form.php';
    }

    public function editBook()
    {
        $title = "Editar libro";

        $isbn = '';
        $title = '';
        $author = '';
        $publisher = '';
        $pages = '';
        $id = $_GET['id'];

        $errors = array();

        $book = $this->booksService->getBook($id);

        if (isset($_POST['form-submitted'])) {
            list($isbn, $title, $author, $publisher, $pages) = $this->isSetBook();

            try {
                $this->booksService->editBook($isbn, $title, $author, $publisher, $pages, $id);
                $_SESSION['message'] = "Libro '" . htmlentities($title) . "' actualizado con éxito";
                $this->redirect('index.php');
                return;
            } catch (ValidationException $e) {
                $errors = $e->getErrors();
            }
        }

        include ROOT_PATH . 'view/books-form-edit.php';
    }

    public function deleteBook()
    {
        $id = isset($_GET['id']) ? $_GET['id'] : null;

        if (!$id) {
            throw new Exception('Internal error');
        }

        $this->booksService->deleteBook($id);
        $_SESSION['message'] = "Libro eliminado con éxito";
        $this->redirect('index.php');
    }

    public function showBook()
    {
        $id = isset($_GET['id']) ? $_GET['id'] : null;

        if (!$id) {
            throw new Exception('Internal error');
        }

        $book = $this->booksService->getBook($id);

        include ROOT_PATH . 'view/book.php';
    }

    public function showError($title, $message)
    {
        include ROOT_PATH . 'view/error.php';
    }

    public function isSetBook()
    {
        $isbn = isset($_POST['isbn']) ? trim($_POST['isbn']) : null;
        $title = isset($_POST['title']) ? trim($_POST['title']) : null;
        $author = isset($_POST['author']) ? trim($_POST['author']) : null;
        $publisher = isset($_POST['publisher']) ? trim($_POST['publisher']) : null;
        $pages = isset($_POST['pages']) ? trim($_POST['pages']) : null;

        return array($isbn, $title, $author, $publisher, $pages);
    }
}
?>