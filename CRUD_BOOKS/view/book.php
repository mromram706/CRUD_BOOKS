<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title><?php echo $book->isbn; ?></title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" rel="stylesheet">
</head>
<body>

<div class="container my-5">
    <h1 class="text-center mb-4"><?php echo $book->isbn; ?></h1>
    <div class="card mb-4">
        <div class="card-body">
            <h5 class="card-title"><?php echo $book->title; ?></h5>
            <p class="card-text">
                <strong>Autor:</strong> <?php echo $book->author; ?><br>
                <strong>Editorial:</strong> <?php echo $book->publisher; ?><br>
                <strong>Páginas:</strong> <?php echo $book->pages; ?>
            </p>
            <a href="index.php" class="btn btn-primary">Volver</a>
        </div>
    </div>
</div>

<footer class="bg-dark text-white text-center fixed-bottom">
    <div class="p-3">
        Desarrollado por Mar Romero 2ºDAW
    </div>
</footer>

</body>
</html>