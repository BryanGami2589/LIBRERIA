<?php
require 'db.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $titulo = $_POST['titulo'];
        $autor = $_POST['autor'];

        $sql = "UPDATE libros SET titulo = ?, autor = ? WHERE id = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$titulo, $autor, $id]);

        header("Location: home.php");
        exit();
    } else {
        $sql = "SELECT titulo, autor FROM libros WHERE id = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$id]);
        $libro = $stmt->fetch(PDO::FETCH_ASSOC);
    }
} else {
    header("Location: Books_view.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Libro</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }
        .container {
            width: 50%;
            margin: 50px auto;
            padding: 20px;
            background-color: white;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h1 {
            text-align: center;
            color: #333;
        }
        form {
            display: flex;
            flex-direction: column;
        }
        label {
            margin-bottom: 5px;
            font-weight: bold;
        }
        input[type="text"], input[type="submit"] {
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }
        input[type="submit"] {
            background-color: #007BFF;
            color: white;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Editar Libro</h1>
        <form action="Edit_book.php" method="post">
            <label for="titulo">Título:</label>
            <input type="text" id="titulo" name="titulo" value="<?= htmlspecialchars($libro['titulo']) ?>" required>
            <label for="autor">Autor:</label>
            <input type="text" id="autor" name="autor" value="<?= htmlspecialchars($libro['autor']) ?>" required>
            <input type="submit" value="Guardar Cambios">
        </form>
    </div>
</body>
</html>
