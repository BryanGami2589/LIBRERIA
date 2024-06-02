<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prestar Libro</title>
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
        select, input[type="submit"] {
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
        <h1>Prestar Libro</h1>
        <form action="procesar_prestamo.php" method="post">
            <label for="libro">Libro:</label>
            <select name="id_libro" id="libro" required>
                <?php
                // base de datos
                require 'db.php';

                // Consulta para obtener todos los libros disponibles para préstamo
                $sql = 'SELECT id, titulo FROM libros WHERE prestado = 0';
                $stmt = $pdo->query($sql);

                // Mostrar la lista de libros disponibles para préstamo
                while ($libro = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    echo "<option value='" . $libro['id'] . "'>" . htmlspecialchars($libro['titulo']) . "</option>";
                }
                ?>
            </select>
            <label for="usuario">Usuario:</label>
            <select name="id_usuario" id="usuario" required>
                <?php
                // Consulta para obtener todos los usuarios
                $sql_usuarios = 'SELECT id, nombre FROM usuarios';
                $stmt_usuarios = $pdo->query($sql_usuarios);

                // Mostrar la lista de usuarios
                while ($usuario = $stmt_usuarios->fetch(PDO::FETCH_ASSOC)) {
                    echo "<option value='" . $usuario['id'] . "'>" . htmlspecialchars($usuario['nombre']) . "</option>";
                }
                ?>
            </select>
            <input type="submit" value="Prestar Libro">
        </form>
    </div>
</body>
</html>
