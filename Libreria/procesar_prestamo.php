<?php
// Verificar si se han enviado datos del formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verificar si se han recibido los datos necesarios
    if (isset($_POST['id_libro']) && isset($_POST['id_usuario'])) {
        // base de datos
        require 'db.php';

        // Obtener los datos del formulario
        $id_libro = $_POST['id_libro'];
        $id_usuario = $_POST['id_usuario'];

        // Actualizar la tabla de libros para marcar el libro como prestado
        $sql_update_libro = "UPDATE libros SET prestado = 1 WHERE id = ?";
        $stmt_update_libro = $pdo->prepare($sql_update_libro);
        $stmt_update_libro->execute([$id_libro]);

        // Registrar el préstamo en la tabla de préstamos
        $fecha_prestamo = date("Y-m-d"); // Fecha actual
        $sql_insert_prestamo = "INSERT INTO prestamos (id_libro, id_usuario, fecha_prestamo) VALUES (?, ?, ?)";
        $stmt_insert_prestamo = $pdo->prepare($sql_insert_prestamo);
        $stmt_insert_prestamo->execute([$id_libro, $id_usuario, $fecha_prestamo]);

        // Redireccionar de vuelta a la página 
        header("Location: home.php");
        exit();
    } else {
        // Si faltan datos, redireccionar con un mensaje de error
        header("Location: loan_book.php?error=missing_data");
        exit();
    }
} else {
    // Si el método de solicitud no es POST, redireccionar con un mensaje de error
    header("Location: loan_book.php?error=invalid_method");
    exit();
}
?>
