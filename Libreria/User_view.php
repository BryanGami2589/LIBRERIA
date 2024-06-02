<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Usuarios</title>
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
        .user-name {
            font-weight: bold;
        }
        .user-email {
            color: #555;
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
        <h1>Lista de Usuarios</h1>
        <div class="button-container">
            <a href="add_user.php">Agregar Usuario</a>
        </div>
        <ul>
            <?php
            // Incluir la conexión a la base de datos
            require 'db.php';

            // Consulta para obtener todos los usuarios
            $sql = 'SELECT id, nombre, email FROM usuarios';
            $stmt = $pdo->query($sql);

            // Mostrar la lista de usuarios
            while ($usuario = $stmt->fetch(PDO::FETCH_ASSOC)) {
                echo "<li>";
                echo "<span class='user-name'>" . htmlspecialchars($usuario['nombre']) . "</span> - ";
                echo "<span class='user-email'>" . htmlspecialchars($usuario['email']) . "</span>";
                echo "<div class='actions'>";
                echo "<a href='Edit_user.php?id=" . $usuario['id'] . "'>Editar</a>";
                echo "<a href='delate_user.php?id=" . $usuario['id'] . "' onclick='return confirm(\"¿Estás seguro de que deseas eliminar este usuario?\");'>Eliminar</a>";
                echo "</div>";
                echo "</li>";
            }
            ?>
        </ul>
    </div>
</body>
</html>
