<?php
require 'db.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $sql = "DELETE FROM libros WHERE id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$id]);

    header("home.php");
    exit();
} else {
    header("Location: Books_view.php");
    exit();
}
