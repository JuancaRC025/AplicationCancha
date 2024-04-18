<?php
session_start();
include 'conexion.php';
?>
<?php
$consulta = "SELECT * FROM usuario";
$resultado = $conn->query($consulta);

if (!$resultado) {
    die('Error en la consulta: ' . $conexion->error);
}
?>

<html>
<head>
    <title>Usuarios</title>
    <link rel="stylesheet" href="css/mod-e.css">
    <link rel='stylesheet' type='text/css' media='screen' href='css/main.css'>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
</head>
<body>

<ul class="navbar">
    <li class="nav-item"><a href="bienvenido_e.php"> < Volver </a></li>
 
</ul>
<br>
    <h1>Lista De Usuarios Registrados</h1>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Acciones</th>
        </tr>

        <?php
        while ($fila = $resultado->fetch_assoc()) {
            echo '<tr id="fila_' . $fila['Id_Usuario'] . '">';
            echo '<td>' . $fila['Id_Usuario'] . '</td>';
            echo '<td>' . $fila['Nombres'] . ' '. $fila['Apellidos'].'</td>';
            echo '<td>';
            echo '<button onclick="eliminarUsuario(' . $fila['Id_Usuario'] . ')" class="button_onclick">Eliminar</button>';
            echo '<button onclick="actualizarUsuario(' . $fila['Id_Usuario'] . ')" class="button">Actualizar</button>';
            echo '</td>';
            echo '</tr>';
        }
        ?>
    </table>
    <script>
        function eliminarUsuario(id) {
            // Aquí puedes agregar lógica para confirmar la eliminación y luego enviar una solicitud al servidor usando AJAX.
            if (confirm('¿Seguro que deseas eliminar este usuario?')) {
                $.ajax({
                    type: 'POST',
                    url: 'acciones_usuarios.php', // Nombre de tu script PHP que maneja las acciones
                    data: { eliminar_usuario: id },
                    success: function(response) {
                        // Puedes actualizar la interfaz o realizar otras acciones según la respuesta del servidor
                        $('#fila_' + id).remove();
                    }
                });
            }
        }

    function actualizarUsuario(id) {
        // Redirigir a la página de actualización de usuario
        window.location.href = 'actualizar_usuario.php?id=' + id;
    }


    </script>
</body>
</html>