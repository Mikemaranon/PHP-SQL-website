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
    echo "<br><h2 align='center'>Tabla de profesores actualmente</h2><br>";

    $sql = "SELECT profesores.id_profesor, profesores.nombre as 'profesor', 
    profesores.telefono, profesores.correo, profesores.sexo, 
    departamentos.nombre as 'departamento' FROM profesores, departamentos
    WHERE profesores.id_departamento = departamentos.id_departamento
    GROUP BY profesores.id_profesor";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        echo "<table cellpadding='0' 
        width='700px'><thead><tr height='30'>";
        echo "<th id='t_left'>id_profesor</th><th>Nombre</th>";
        echo "<th>telefono</th><th>correo</th>";
        echo "<th>sexo</th><th id='t_right'>departamento</th>";
        echo "</tr></thead><tbody>";
        while($row = mysqli_fetch_assoc($result)) {
            echo "<tr height='30'><td>" . $row["id_profesor"] . "</td>";
            echo "<td>" . $row["profesor"] . "</td>";
            echo "<td>" . $row["telefono"] . "</td>";
            if($row["correo"] == "") {
                $row["correo"] = "<i>no establecido</i>";
            }
            echo "<td>" . $row["correo"] . "</td>";
            echo "<td>" . $row["sexo"] . "</td>";
            echo "<td>" . $row["departamento"] . "</td></tr>";
        }
        echo "</tbody><tr><td colspan='6' id='b_r_l'>+<td></tr>";
        echo "</table><br>";
    } else {
        echo "0 resultados";
    }
?>
<html>
    <head>
        <title>
            PROFESORES
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