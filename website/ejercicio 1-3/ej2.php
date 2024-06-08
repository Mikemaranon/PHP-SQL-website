<?php
    
    $servername = $_COOKIE['nombre_servidor'];
    $username = $_COOKIE['nombre_usuario'];
    $password = $_COOKIE['password'];
    $database = $_COOKIE['database'];

    // Create connection
    $conn = mysqli_connect($servername, $username, $password, $database);

    // Check connection
    if (!$conn) {
        die("Conexion fallida: " . mysqli_connect_error());
    }
    echo "<br><h2 align='center'>Tabla de departamentos actualmente</h2><br>";

    $sql = "SELECT id_departamento, nombre FROM departamentos";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        echo "<table cellpadding='0' width='250px'>
        <thead><tr height='30'>";
        echo "<th id='t_left'>id_departamento</th><th id='t_right'>Nombre</th>";
        echo "</tr></thead><tbody>";
        while($row = mysqli_fetch_assoc($result)) {
            echo "<tr height='30'><td id='left'>" . $row["id_departamento"]. "</td>";
            echo "<td id='right'>" . $row["nombre"]. "</td></tr>";
        }
        echo "</tbody><tr><td colspan='6' id='b_r_l'>+<td></tr>";
        echo "</table>";
    } else {
        echo "0 resultados";
    }
?>
<html>
    <head>
        <title>
            DEPARTAMENTOS
        </title>
        <link rel="StyleSheet" href="style.css" type="text/css">
    </head>
    <body>
        <br>
        <div id="contEnlaces">
            <ul class="enlaces">
                <a href="http://localhost/PHP/FICHA3/mainWeb.php"><li id="link"><b>VOLVER AL MENU</b></li></a>
            </ul>
        </div>
    </body>
</html>