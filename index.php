<?php

require_once './controller/BooksController.php';

session_start();

if (isset($_SESSION['message'])) {
    echo "<div id='success-message' class='alert alert-success'>" . $_SESSION['message'] . "</div>";
    unset($_SESSION['message']);
}

$controller = new BooksController();

$controller->handleRequest();

?>

<script>
        setTimeout(function() {
            var messageElement = document.getElementById('success-message');
            if (messageElement) {
                messageElement.style.display = 'none';
            }
        }, 5000);
</script>