<?php
include 'conexion.php';

// Realiza una consulta para recuperar las empresas desde la base de datos
$sql = "SELECT * FROM empresa"; // Asegúrate de que el nombre de la tabla coincida con tu base de datos

$result = $conn->query($sql);


if ($result->num_rows > 0) {
    // Mostrar los datos de las empresas en recuadros
    while ($row = $result->fetch_assoc()) {
        echo '<div class="empresa-box">';
        echo '<h2>Nombre de la empresa: ' . $row["Razon_Social"] . '</h2>';
        echo '<p>Direccion: ' . $row["Direccion"] . '</p>';
        echo '<a href="informacion.php?id=' . $row["id"] . '">Ver detalles</a>';
        // Puedes mostrar otros datos de la empresa según la estructura de tu tabla
        echo '</div>';
    }
} else {
    echo "No se encontraron empresas en la base de datos.";
}

// Cierra la conexión a la base de datos
$conn->close();
?>