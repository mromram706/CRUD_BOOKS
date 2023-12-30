<!DOCTYPE HTML>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title><?php echo htmlentities($book->title); ?></title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">
    <h3 class="text-center mb-4">Editar <?php echo htmlentities($book->title) ?></h3>
    <?php
    if ($errors) {
        echo '<div class="alert alert-danger">';
        foreach ($errors as $field => $error) {
            echo '<p>' . htmlentities($error) . '</p>';
        }
        echo '</div>';
    }
    ?>

    <form method="post" action="" class="mb-4">
        <div class="form-group">
            <label for="isbn">ISBN</label>
            <input type="text" name="isbn" class="form-control" value="<?php echo htmlentities($book->isbn); ?>">
        </div>

        <div class="form-group">
            <label for="title">Título</label>
            <input type="text" name="title" class="form-control" value="<?php echo htmlentities($book->title); ?>">
        </div>

        <div class="form-group">
            <label for="author">Autor</label>
            <input type="text" name="author" class="form-control" value="<?php echo htmlentities($book->author); ?>">
        </div>

        <div class="form-group">
            <label for="publisher">Editorial</label>
            <input type="text" name="publisher" class="form-control" value="<?php echo htmlentities($book->publisher); ?>">
        </div>

        <div class="form-group">
            <label for="pages">Páginas</label>
            <input type="text" name="pages" class="form-control" value="<?php echo htmlentities($book->pages); ?>">
        </div>

        <input type="hidden" name="form-submitted" value="1">
        <div class="text-center">
            <button type="submit" class="btn btn-success">Actualizar</button>
            <button type="button" class="btn btn-secondary" onclick="location.href='index.php'">Cancelar</button>
        </div>
    </form>
</div>

</body>
</html>
