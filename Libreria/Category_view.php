<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Categorías</title>
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
        .category-name {
            font-weight: bold;
        }
        .button-container {
            text-align: center;
            margin-bottom: 20px;
        }
        .button-container a, .actions a {
            text-decoration: none;
            color: white;
            background-color: #007BFF;
            padding: 10px 20px;
            margin: 5px;
            border-radius: 5px;
            transition: background-color 0.3s;
        }
        .button-container a:hover, .actions a:hover {
            background-color: #0056b3;
        }
        .actions a {
            padding: 5px 10px;
            margin: 0 5px;
            font-size: 0.9em;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Lista de Categorías</h1>
        <div class="button-container">
            <a href="add_category.php">Agregar Categoría</a>
        </div>
        <ul>
            <?php
            // base de datos
            require 'db.php';

            // Consulta para obtener todas las categorías
            $sql = 'SELECT id, nombre FROM categorias';
            $stmt = $pdo->query($sql);

            // Mostrar la lista de categorías
            while ($categoria = $stmt->fetch(PDO::FETCH_ASSOC)) {
                echo "<li>";
                echo "<span class='category-name'>" . htmlspecialchars($categoria['nombre']) . "</span>";
                echo "<div class='actions'>";
                echo "<a href='Edit_category.php?id=" . $categoria['id'] . "'>Editar</a>";
                echo "<a href='delate.category.php?id=" . $categoria['id'] . "' onclick='return confirm(\"¿Estás seguro de que deseas eliminar esta categoría?\");'>Eliminar</a>";
                echo "</div>";
                echo "</li>";
            }
            ?>
        </ul>
    </div>
</body>
</html>
