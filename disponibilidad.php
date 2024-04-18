
<!-- ESTO ES CODIGO NUEVOOOOO DE AQUI HACIA ATRAS FUNCIONA SOLO A USUARIO -->
<?php
include 'conexion.php';
session_start(); // Inicia la sesión

// Verificar si la sesión está iniciada como usuario o empresa
if (!isset($_SESSION["id_usuario"]) && !isset($_SESSION["id_empresa"])) {
    // No hay sesión iniciada, mostrar mensaje y redirigir al usuario
    echo "No hay sesión iniciada. Por favor, ve a Ingresar o registrar.";
    // Puedes redirigir al usuario a la página de inicio de sesión, si es necesario
    // header("Location: ingresar.php");
    exit; // Detener la ejecución del resto del código
}

// Obtener los parámetros de la URL (tipoCancha y fechaSeleccionada)
$tipoCancha = $_GET['tipoCancha'];
$fechaSeleccionada = $_GET['fechaSeleccionada'];

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
    echo '<tr>';
    echo '<td>' . $hora . '</td>';
    if ($res !== null) {
        echo '<td>No disponible</td>';
        echo '<td>
        <form method="post" action="procesar_eliminar.php">
            <input type="hidden" name="idRes" value="' . $res['Id_Reserva'] . '">
            <input type="submit" name="cancelarReserva" value="Cancelar">
        </form>
    </td>';
    } else {
        echo '<td>Disponible</td>';
        echo '<td>
        <form method="post" action="procesar_reserva.php">
            <input type="hidden" name="tipoCancha" value="' . $tipoCancha . '">
            <input type="hidden" name="fechaSeleccionada" value="' . $fechaSeleccionada . '">
            <input type="hidden" name="hora" value="' . $hora . '">';
            
        // Verifica si la sesión es de usuario o empresa y establece el campo idUsuario correspondiente
        if (isset($_SESSION["id_usuario"])) {
            echo '<input type="hidden" name="idUsuario" value="' . $_SESSION["id_usuario"] . '">';
        } elseif (isset($_SESSION["id_empresa"])) {
            echo '<input type="hidden" name="idUsuario" value="' . $_SESSION["id_empresa"] . '">';
        }
    
        echo '<input type="submit" name="reservar" value="Reservar">
        </form>
        </td>';
    }
    echo '</tr>';
}

echo '</table>';

$conn->close();
?>
