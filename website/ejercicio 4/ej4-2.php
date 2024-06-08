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

    session_start();
    if ($_SERVER["REQUEST_METHOD"] == "POST") { // Si ha recibido un post, asigna los valores
        foreach($_POST as $type => $data){  // coge cada valor del post
            $_SESSION[$type] = $data;       // almacena en la sesión cada variable (name y color)
        }
        $dep = $_SESSION["departamento"]; // id del departamento
    }
    echo "<h2 align='center'>Profesores del departamento</h2>";

    $sql = "SELECT id_profesor, nombre, telefono, correo,
    sexo, id_departamento FROM profesores 
    WHERE id_departamento = ". $dep;
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        echo "<table cellpadding='0' 
        width='700px'><thead><tr height='30'>";
        echo "<th id='t_left'>id_profesor</th><th>Nombre</th>";
        echo "<th>telefono</th><th>correo</th>";
        echo "<th>sexo</th><th id='t_right'>id_departamento</th></tr>";
        echo "</thead><tbody>";
        while($row = mysqli_fetch_assoc($result)) {
            echo "<tr height='30'><td>" . $row["id_profesor"] . "</td>";
            echo "<td>" . $row["nombre"] . "</td>";
            echo "<td>" . $row["telefono"] . "</td>";
            if($row["correo"] == "") {
                $row["correo"] = "<i>no establecido</i>";
            }
            echo "<td>" . $row["correo"] . "</td>";
            echo "<td>" . $row["sexo"] . "</td>";
            echo "<td>" . $row["id_departamento"] . "</td></tr>";
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
            PROFESORES POR DEPARTAMENTOS
        </title>
        <link rel="StyleSheet" href="styles.css" type="text/css">
    </head>
    <body>
        <br>
        <div id="contEnlaces">
            <ul class="enlaces">
                <a href="ej4-1.php"><li id="link"><b>VOLVER A LA SELECCION</b></li></a>
            </ul>
        </div>
    </body>
</html>