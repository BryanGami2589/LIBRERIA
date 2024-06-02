<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Libro</title>
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
        input[type="text"], select, input[type="submit"] {
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
        <h1>Agregar Libro</h1>
        <form action="add_book.php" method="post">
            <label for="titulo">Título:</label>
            <input type="text" id="titulo" name="titulo" required>
            <label for="autor">Autor:</label>
            <input type="text" id="autor" name="autor" required>
            <label for="categorias">Categorías:</label>
            <select id="categorias" name="categorias[]" multiple required>
                <?php
                require 'db.php';

                // Consulta para obtener todas las categorías de la base de datos
                $sql_categorias = "SELECT id, nombre FROM categorias";
                $stmt_categorias = $pdo->query($sql_categorias);
                
                // Mostrar opciones para seleccionar categorías
                while ($categoria = $stmt_categorias->fetch(PDO::FETCH_ASSOC)) {
                    echo "<option value='" . $categoria['id'] . "'>" . htmlspecialchars($categoria['nombre']) . "</option>";
                }
                ?>
            </select>
            <input type="submit" value="Agregar Libro">
        </form>
    </div>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $titulo = $_POST['titulo'];
        $autor = $_POST['autor'];
        $categorias = $_POST['categorias'];

        // Insertar el libro en la tabla de libros
        $sql_insert_libro = "INSERT INTO libros (titulo, autor) VALUES (?, ?)";
        $stmt_insert_libro = $pdo->prepare($sql_insert_libro);
        $stmt_insert_libro->execute([$titulo, $autor]);

        // Obtener el ID del libro recién insertado
        $libro_id = $pdo->lastInsertId();

        // Insertar las relaciones libro-categoria en la tabla de libros_categorias
        foreach ($categorias as $categoria_id) {
            $sql_insert_relacion = "INSERT INTO libros_categorias (libro_id, categoria_id) VALUES (?, ?)";
            $stmt_insert_relacion = $pdo->prepare($sql_insert_relacion);
            $stmt_insert_relacion->execute([$libro_id, $categoria_id]);
        }

        // Redireccionar al usuario al menú de inicio
        header("Location: home.php");
        exit();
    }
    ?>
</body>
</html>

