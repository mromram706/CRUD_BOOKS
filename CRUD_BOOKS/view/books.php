<!DOCTYPE HTML>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>Books</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" rel="stylesheet">
</head>
</head>
<body>

<div class="container text-center" style="margin-bottom: 100px;">

    <?php

    if (isset($_SESSION['message'])) {
        echo "<div id='success-message' class='alert alert-success'>" . $_SESSION['message'] . "</div>";
        unset($_SESSION['message']);
    }
    ?>

    <h1 class="p-4">Lista de libros</h1>

    <div class="d-flex justify-content-between mb-4">
        <a href="index.php?op=new" class="btn btn-primary"><i class="fas fa-plus"></i> Añadir libro</a>

        <form action="librosPDF.php" method="get" class="d-inline">
            <label for="numRegistros" class="mr-2">Número de libros:</label>
            <input type="number" id="numRegistros" name="limit" class="form-control d-inline w-25" placeholder="0">
            <button type="submit" class="btn btn-info ml-3"><i class="fas fa-file-pdf"></i>Exportar como PDF</button>
        </form>
    </div>
    <br>
    <table class="table table-striped table-bordered table-hover">
        <thead class="thead-dark">
        <tr>
            <th>
                <a href="?order=isbn&dir=<?php echo ($order == 'isbn' && $dir == 'asc') ? 'desc' : 'asc'; ?>"
                   class="text-white">
                    ISBN
                    <i class="fas <?php echo ($order == 'isbn' && $dir == 'asc') ? 'fa-caret-up' : 'fa-caret-down'; ?>"></i>
                </a>
            </th>
            <th>
                <a href="?order=title&dir=<?php echo ($order == 'title' && $dir == 'asc') ? 'desc' : 'asc'; ?>"
                   class="text-white">
                    Título
                    <i class="fas <?php echo ($order == 'title' && $dir == 'asc') ? 'fa-caret-up' : 'fa-caret-down'; ?>"></i>
                </a>
            </th>
            <th>
                <a href="?order=author&dir=<?php echo ($order == 'author' && $dir == 'asc') ? 'desc' : 'asc'; ?>"
                   class="text-white">
                    Autor
                    <i class="fas <?php echo ($order == 'author' && $dir == 'asc') ? 'fa-caret-up' : 'fa-caret-down'; ?>"></i>
                </a>
            </th>
            <th>
                <a href="?order=publisher&dir=<?php echo ($order == 'publisher' && $dir == 'asc') ? 'desc' : 'asc'; ?>"
                   class="text-white">
                    Editorial
                    <i class="fas <?php echo ($order == 'publisher' && $dir == 'asc') ? 'fa-caret-up' : 'fa-caret-down'; ?>"></i>
                </a>
            </th>
            <th class="text-nowrap">
                <a href="?order=pages&dir=<?php echo ($order == 'pages' && $dir == 'asc') ? 'desc' : 'asc'; ?>"
                   class="text-white">
                    Páginas
                    <i class="fas <?php echo ($order == 'pages' && $dir == 'asc') ? 'fa-caret-up' : 'fa-caret-down'; ?>"></i>
                </a>
            </th>

            <th>Acciones</th>
        </tr>
        </thead>

        <tbody>
        <?php foreach ($books as $book) : ?>
            <tr>
                <td>
                    <a href="index.php?op=show&id=<?php echo $book->id; ?>">
                        <?php echo htmlentities($book->isbn); ?></a>
                </td>
                <td><?php echo htmlentities($book->title); ?></td>
                <td><?php echo htmlentities($book->author); ?></td>
                <td><?php echo htmlentities($book->publisher); ?></td>
                <td><?php echo htmlentities($book->pages); ?></td>
                <td>
                    <a href="index.php?op=edit&id=<?php echo $book->id; ?>" class="btn btn-sm btn-warning">
                        <i class="fas fa-edit"></i>
                    </a>
                    <a href="index.php?op=delete&id=<?php echo $book->id; ?>"
                       onclick="return confirm('¿Seguro que quiere borrar este libro?');" class="btn btn-sm btn-danger">
                        <i class="fas fa-trash"></i>
                    </a>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>

    <?php
    $prevPage = max(1, $currentPage - 1);
    $nextPage = min($totalPages, $currentPage + 1);
    ?>

    <div class="pagination-wrapper">
        <?php if ($currentPage > 1): ?>
            <a href="?page=1">Primera página</a>
        <?php endif; ?>

        <?php if ($currentPage > 1): ?>
        <a href="?page=<?php echo $prevPage; ?>"><i class="fas fa-arrow-left"></i></a>
        <?php endif; ?>

        <span> | Página <?php echo $currentPage; ?> de <?php echo $totalPages; ?> | </span>

        <?php if ($currentPage < $totalPages): ?>
        <a href="?page=<?php echo $nextPage; ?>"><i class="fas fa-arrow-right"></i></a>
        <?php endif; ?>

        <?php if ($currentPage < $totalPages): ?>
            <a href="?page=<?php echo $totalPages; ?>">Última página</a>
        <?php endif; ?>
    </div>
    <footer class="bg-dark text-center text-white fixed-bottom">
        <div class="p-3">
            Desarrollado por Mar Romero 2ºDAW
        </div>
    </footer>
</div>

</body>
</html>
