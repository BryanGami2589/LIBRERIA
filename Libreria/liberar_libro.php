<?php
// Verificar si se han enviado datos del formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verificar si se recibió el ID del libro
    if (isset($_POST['libro_id'])) {
        // base de datos
        require 'db.php';

        // Obtener el ID del libro a liberar
        $libro_id = $_POST['libro_id'];

        // Actualizar la tabla de libros para marcar el libro como no prestado
        $sql_update_libro = "UPDATE libros SET prestado = 0 WHERE id = ?";
        $stmt_update_libro = $pdo->prepare($sql_update_libro);
        $stmt_update_libro->execute([$libro_id]);

        // Eliminar la entrada correspondiente en la tabla de préstamos
        $sql_delete_prestamo = "DELETE FROM prestamos WHERE id_libro = ?";
        $stmt_delete_prestamo = $pdo->prepare($sql_delete_prestamo);
        $stmt_delete_prestamo->execute([$libro_id]);

        // Redireccionar de vuelta a la página de lista de libros
        header("Location: home.php");
        exit();
    } else {
        // Si no se recibió el ID del libro, redireccionar con un mensaje de error
        header("Location: home.php?error=missing_data");
        exit();
    }
} else {
    // Si el método de solicitud no es POST, redireccionar con un mensaje de error
    header("Location: home.php?error=invalid_method");
    exit();
}
?>
