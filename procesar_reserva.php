<?php
include 'conexion.php';
session_start(); // Inicia la sesión

// Función para verificar si el Id_Usuario es válido
function esUsuarioValido($conn, $usuarioId)
{
    // Escapa el valor del Id_Usuario para evitar inyecciones SQL (dependiendo de la configuración de tu base de datos)
    $usuarioId = $conn->real_escape_string($usuarioId);

    // Realiza una consulta a la base de datos para verificar si el Id_Usuario existe
    $sql = "SELECT * FROM usuario WHERE Id_Usuario = '$usuarioId'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // El Id_Usuario es válido, se encontró en la base de datos
        return true;
    } else {
        // El Id_Usuario no es válido, no se encontró en la base de datos
        return false;
    }
}

// Función para obtener el nombre de un usuario dado su Id_Usuario
function obtenerNombreUsuario($conn, $usuarioId)
{
    // Escapa el valor del Id_Usuario para evitar inyecciones SQL (dependiendo de la configuración de tu base de datos)
    $usuarioId = $conn->real_escape_string($usuarioId);

    // Realiza una consulta a la base de datos para obtener el nombre del usuario
    $sql = "SELECT Nombres FROM usuario WHERE Id_Usuario = '$usuarioId'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        return $row['Nombres'];
    } else {
        return "Nombre de Usuario Desconocido";
    }
}

// Verificar si la sesión está iniciada
if (!isset($_SESSION["id_usuario"])) {
    // No hay sesión iniciada, mostrar mensaje y redirigir al usuario
    echo "No hay sesión iniciada. Por favor, ve a Ingresar o registrar.";
    exit; // Detener la ejecución del resto del código
}

// Obtener los parámetros del formulario usando POST
$tipoCancha = $conn->real_escape_string($_POST['tipoCancha']);
$fechaSeleccionada = $conn->real_escape_string($_POST['fechaSeleccionada']);
$hora = $conn->real_escape_string($_POST['hora']);
$idUsuario = $conn->real_escape_string($_POST['idUsuario']);

// Verifica si el Id_Usuario es válido antes de realizar la inserción
if (esUsuarioValido($conn, $idUsuario)) {
    // Obtén el nombre del usuario
    $nombreUsuario = obtenerNombreUsuario($conn, $idUsuario);

    // Realiza la inserción de la reserva en la base de datos, incluyendo el Id_Usuario
    $sql = "INSERT INTO reserva (Id_Usuario, Id_Detalle_Cancha, Fecha, Hora) 
            VALUES ('$idUsuario', (SELECT Id_Detalle_Cancha FROM detalle_cancha WHERE Tamaño = '$tipoCancha'), '$fechaSeleccionada', '$hora')";

    if ($conn->query($sql) === TRUE) {
        // Éxito en la inserción, muestra la ventana emergente con JavaScript
        echo '<script>
        alert("Reserva realizada con éxito.\n\nNombre del Usuario: ' . $nombreUsuario . '\nFecha Seleccionada: ' . $fechaSeleccionada . '\nHora: ' . $hora . '");
        window.location.href = "reservar.php"; // Redirige inmediatamente
      </script>';
    } else {
        echo "Error al realizar la reserva: " . $conn->error;
    }
} else {
    echo "El usuario no es válido. Por favor, proporcione un Id_Usuario válido.";
}


// Consulta para obtener las reservas del usuario actual
$sqlReservasUsuario = "SELECT * FROM reserva WHERE Id_Usuario = '{$_SESSION["id_usuario"]}' AND Fecha = '$fechaSeleccionada'";
$resultReservasUsuario = $conn->query($sqlReservasUsuario);

// Comprueba si hay resultados
$horasReservadasUsuario = array(); // Inicializa como un arreglo vacío

if ($resultReservasUsuario->num_rows > 0) {
    while ($rowUsuario = $resultReservasUsuario->fetch_assoc()) {
        $horaReservadaUsuario = $rowUsuario["Hora"];
        $horasReservadasUsuario[] = $rowUsuario;
    }
}

// Realiza una consulta en la base de datos para obtener las reservas para la fecha y tipo de cancha seleccionados
$sql = "SELECT * FROM reserva WHERE Id_Detalle_Cancha IN (SELECT Id_Detalle_Cancha FROM detalle_cancha WHERE Tamaño = '$tipoCancha') AND Fecha = '$fechaSeleccionada'";

$result = $conn->query($sql);

// Comprueba si hay resultados
$horasReservadas = array(); // Inicializa como un arreglo vacío

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $horaReservada = $row["Hora"];
        $horasReservadas[] = $row;
    }
}

echo '<table>';
echo '<tr><th>Hora</th><th>Disponibilidad</th><th>Reservar/Cancelar Reserva</th></tr>';

$horasDisponibles = array("15:00:00", "16:00:00", "17:00:00", "18:00:00", "19:00:00", "20:00:00");

function buscarHora($array, $key, $value)
{
    $results = null;
    foreach ($array as $object) {
        if (isset($object[$key]) && $object[$key] === $value) {
            $results = $object;
        }
    }
    return $results;
}

foreach ($horasDisponibles as $hora) {
    $res = buscarHora($horasReservadas, 'Hora', $hora);
    $resUsuario = buscarHora($horasReservadasUsuario, 'Hora', $hora);
    echo '<tr>';
    echo '<td>' . $hora . '</td>';
    if ($res !== null) {
        echo '<td>No disponible</td>';
        echo '<td>';

        // Verificar si el usuario actual es el propietario de la reserva
        if ($res['Id_Usuario'] === $_SESSION["id_usuario"]) {
            echo '<form method="post" action="procesar_eliminar.php">
                    <input type="hidden" name="idRes" value="' . $res['Id_Reserva'] . '">
                    <input type="submit" name="cancelarReserva" value="Cancelar">
                  </form>';
        } else {
            echo 'No permitido';
        }

        echo '</td>';
    } elseif ($resUsuario !== null) {
        // Si hay una reserva del usuario actual, mostrar la opción de cancelar
        echo '<td>No disponible</td>';
        echo '<td>
                <form method="post" action="procesar_eliminar.php">
                    <input type="hidden" name="idRes" value="' . $resUsuario['Id_Reserva'] . '">
                    <input type="submit" name="cancelarReserva" value="Cancelar">
                </form>
              </td>';
    } else {
        echo '<td>Disponible</td>';
        echo '<td>
        <form method="post" action="procesar_reserva.php">
            <input type="hidden" name="tipoCancha" value="' . $tipoCancha . '">
            <input type="hidden" name="fechaSeleccionada" value="' . $fechaSeleccionada . '">
            <input type="hidden" name="hora" value="' . $hora . '">
            <input type="hidden" name="idUsuario" id="idUsuario" value='.$_SESSION["id_usuario"].'>
    
            <input type="submit" name="reservar" value="Reservar">
        </form>
    </td>';
    }
    echo '</tr>';
}

echo '</table>';

$conn->close();
?>