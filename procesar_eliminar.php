<?php
include 'conexion.php';
session_start(); // Inicia la sesión

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Verificar si se recibió el valor del campo idRes
    if (isset($_POST['idRes'])) {
        $idReserva = $_POST['idRes'];

        // Verificar si la clave 'id_usuario' está definida en la sesión
        if (isset($_SESSION["id_usuario"]) || isset($_SESSION["id_empresa"])) {
            $idUsuario = isset($_SESSION["id_usuario"]) ? $_SESSION["id_usuario"] : $_SESSION["id_empresa"];

            // Resto del código sigue igual...
            // Verificar si el usuario actual es una empresa
            $sql = "SELECT * FROM empresa WHERE Id_Empresa = '$idUsuario'";
            $result = $conn->query($sql);

            if ($result !== false && $result->num_rows > 0) {
                // El usuario es una empresa, proceder con la eliminación
                $sqlEliminar = "DELETE FROM reserva WHERE Id_Reserva = '$idReserva'";

                if ($conn->query($sqlEliminar) === TRUE) {
                    // Éxito en la eliminación
                    echo '<script>
                    alert("Reserva Cancelada con Éxito.");
                    window.location.href = "reservar.php";
                    </script>';
                } else {
                    echo "Error al cancelar la reserva: " . $conn->error;
                }
            } else {
                // El usuario no es una empresa, verificar propietario de la reserva
                $sql = "SELECT * FROM usuario WHERE Id_Usuario = '$idUsuario'";
                $result = $conn->query($sql);

                if ($result !== false && $result->num_rows > 0) {
                    // El usuario es un usuario normal, verificar si es el propietario de la reserva
                    $sql = "SELECT * FROM reserva WHERE Id_Reserva = '$idReserva' AND Id_Usuario = '$idUsuario'";
                    $result = $conn->query($sql);

                    if ($result !== false && $result->num_rows > 0) {
                        // El usuario es el propietario de la reserva, proceder con la eliminación
                        $sqlEliminar = "DELETE FROM reserva WHERE Id_Reserva = '$idReserva'";

                        if ($conn->query($sqlEliminar) === TRUE) {
                            // Éxito en la eliminación
                            echo '<script>
                            alert("Reserva Cancelada con Éxito.");
                            window.location.href = "reservar.php";
                            </script>';
                        } else {
                            echo "Error al cancelar la reserva: " . $conn->error;
                        }
                    } else {
                        // El usuario no es el propietario de la reserva
                        echo '<script>
                        alert("No tienes permiso para cancelar esta reserva.");
                        setTimeout(function() {
                            window.location.href = "reservar.php";
                        }, 100); // 1000 milisegundos = 10 segundos
                        </script>';
                    }
                } else {
                    // No se encontró al usuario
                    echo "Error: No se encontró al usuario.";
                }
            }
        } else {
            // La clave 'id_usuario' no está definida en la sesión
            echo "Error: La sesión de usuario no está iniciada.";
        }
    } else {
        echo "El campo 'idRes' no se encontró en la solicitud POST.";
    }
} else {
    echo "Acceso no permitido.";
}

$conn->close();
?>
