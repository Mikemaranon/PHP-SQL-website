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
?>
<link rel="StyleSheet" href="styles.css" type="text/css">
<?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") { // Si ha recibido un post, asigna los valores
        foreach($_POST as $type => $data){  // coge cada valor del post
            $_SESSION[$type] = $data;       // almacena en la sesión cada variable
        }
        $id = $_SESSION["id_profesor"];
        $nombre = $_SESSION["nombre"];
        $tlf = $_SESSION["telefono"];
        $correo = $_SESSION["correo"];
        $sexo = $_SESSION["sexo"];
        $dep = $_SESSION["departamento"];
    } else {
        session_unset();
        session_destroy();
    }

    $sql = "UPDATE profesores SET nombre = '$nombre', telefono = '$tlf', 
    correo = '$correo', sexo = '$sexo', id_departamento = $dep
    WHERE id_profesor = $id";

    if (mysqli_query($conn, $sql)) {
        echo "<h2 align='center'>Profesor actualizado con exito!</h2><br>";
        $sql = "SELECT * FROM profesores WHERE id_profesor = " . $id;
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
            echo "<td>" . $row["correo"] . "</td>";
            echo "<td>" . $row["sexo"] . "</td>";
            echo "<td>" . $row["id_departamento"] . "</td></tr>";
        }
        echo "</tbody><tr><td colspan='6' id='b_r_l'>+<td></tr>";
        echo "</table><br><br>";
    } else {
      echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
?>
<html>
    <head>
        <title>
            UPDATE
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