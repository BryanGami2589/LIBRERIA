<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Librería JOCOTEPEC</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }
        .container {
            width: 80%;
            margin: 0 auto;
            padding: 20px;
            background-color: white;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h1 {
            text-align: center;
            color: #333;
        }
        ul {
            list-style-type: none;
            padding: 0;
        }
        li {
            padding: 10px;
            border-bottom: 1px solid #ddd;
        }
        .book-title {
            font-weight: bold;
        }
        .book-author {
            color: #555;
        }
        .user-name {
            font-style: italic;
        }
        .book-category {
            color: #777;
        }
        .button-container {
            text-align: center;
            margin-bottom: 20px;
        }
        .button-container a {
            text-decoration: none;
            color: white;
            background-color: #007BFF;
            padding: 10px 20px;
            margin: 5px;
            border-radius: 5px;
            transition: background-color 0.3s;
        }
        .button-container a:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Librería JOCOTEPEC</h1>
        <div class="button-container">
            <a href="Category_view.php">Categorías</a>
            <a href="User_view.php">Usuarios</a>
            <a href="Books_view.php">Libros</a>
        </div>
        <?php
        // Incluir la conexión a la base de datos
        require 'db.php';

        // Consulta para obtener los libros prestados, su categoría y a quién se les prestó
        $sql = 'SELECT libros.id, libros.titulo, libros.autor, usuarios.nombre AS nombre_usuario, categorias.nombre AS nombre_categoria
                FROM prestamos 
                INNER JOIN libros ON prestamos.id_libro = libros.id
                INNER JOIN usuarios ON prestamos.id_usuario = usuarios.id
                INNER JOIN libros_categorias ON libros.id = libros_categorias.libro_id
                INNER JOIN categorias ON libros_categorias.categoria_id = categorias.id';
        $stmt = $pdo->query($sql);

        // Contar el número de libros prestados
        $num_prestamos = $stmt->rowCount();

        if ($num_prestamos > 0) {
            // Mostrar la lista de libros prestados
            echo "<ul>";
            echo "<h2>Libros Prestados</h2>";
            while ($libro = $stmt->fetch(PDO::FETCH_ASSOC)) {
                echo "<li>";
                echo "<span class='book-title'>" . htmlspecialchars($libro['titulo']) . "</span> - ";
                echo "<span class='book-author'>" . htmlspecialchars($libro['autor']) . "</span> (Categoría: ";
                echo "<span class='book-category'>" . htmlspecialchars($libro['nombre_categoria']) . "</span>, ";
                echo "Prestado a <span class='user-name'>" . htmlspecialchars($libro['nombre_usuario']) . "</span>) ";
                // Agregar un botón para liberar el libro
                echo "<form action='liberar_libro.php' method='post'>";
                echo "<input type='hidden' name='libro_id' value='" . $libro['id'] . "'>";
                echo "<input type='submit' value='Liberar Libro'>";
                echo "</form>";
                echo "</li>";
            }
            echo "</ul>";
        } else {
            // Mostrar mensaje si no hay libros prestados
            echo "<p>No hay libros prestados en este momento.</p>";
        }
        ?>
    </div>
</body>
</html>

