<?php
    session_start();

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

    if ($_SERVER["REQUEST_METHOD"] == "POST") { // Si ha recibido un post, asigna los valores
        foreach($_POST as $type => $data){  // coge cada valor del post
            $_SESSION[$type] = $data;       // almacena en la sesión cada variable
        }
        $id = $_SESSION["id_profesor"];
        echo "<h2 align='center'>Has seleccionado al siguiente profesor</2><br><br>";
    } else {
        echo "ERROR: No has seleccionado ningún profesor. ";
        session_unset();
        session_destroy();
    }

    $sql = "SELECT id_profesor, nombre, telefono, correo,
    sexo, id_departamento FROM profesores 
    WHERE id_profesor = ". $id;
    $result = mysqli_query($conn, $sql);

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
            echo "<td><i>no establecido</i></td>";
        } else {
            echo "<td>" . $row["correo"] . "</td>";
        }
        echo "<td>" . $row["sexo"] . "</td>";
        echo "<td>" . $row["id_departamento"] . "</td></tr>";
    }
    echo "</tbody><tr><td colspan='6' id='b_r_l'>+<td></tr>";
    echo "</table><br>";
?>
<html>
    <head>
        <title>
            Borrado de profesor           
        </title>
        <link rel="StyleSheet" href="style.css" type="text/css">
    </head>
    <body>
        <?php
            $sql = "DELETE FROM profesores WHERE id_profesor=$id";
            $result = mysqli_query($conn, $sql);

            echo "<h2 align='center'>El profesor ha sido borrado de la base de datos</h2>";
            echo "<h2 align='center'>Tabla actualizada</h2><br>";

            $sql = "SELECT id_profesor, nombre, telefono, correo,
            sexo, id_departamento FROM profesores";
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
                        echo "<td><i>no establecido</i></td>";
                    } else {
                        echo "<td>" . $row["correo"] . "</td>";
                    }
                    echo "<td>" . $row["sexo"] . "</td>";
                    echo "<td>" . $row["id_departamento"] . "</td></tr>";
                }
                echo "</tbody><tr><td colspan='6' id='b_r_l'>+<td></tr>";
                echo "</table>";
            } else {
                echo "0 resultados";
            }
        ?>
        <br>
        <div id="contEnlaces">
            <ul class="enlaces">
                <a href="http://localhost/PHP/FICHA3/mainWeb.php"><li id="link"><b>VOLVER AL MENU</b></li></a>
            </ul>
        </div>
    </body>
</html>