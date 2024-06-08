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
    /* seleccionamos las ID de los profesores para quedarnos con la mas alta
    $selectId = "SELECT id_profesor FROM profesores";
    $result = mysqli_query($conn, $selectId); 
    while($id_p = mysqli_fetch_array($result)) {
        $id = $id_p["id_profesor"] . "<br>";
    }
    $cont = 0;*/

    if ($_SERVER["REQUEST_METHOD"] == "POST") { // Si ha recibido un post, asigna los valores
        foreach($_POST as $type => $data){  // coge cada valor del post
            $_SESSION[$type] = $data;       // almacena en la sesión cada variable
        }
        $id = $_SESSION["id_profesor"] + 1; // sumamos 1 a la id mas alta para que no se repita
        $nombre = $_SESSION["nombre"];
        $tlf = $_SESSION["telefono"];
        $correo = $_SESSION["correo"];
        $sexo = $_SESSION["sexo"];
        $dep = $_SESSION["departamento"];

        $sql = "INSERT INTO profesores (id_profesor,nombre,telefono,correo,sexo,id_departamento)
        VALUES ($id, '$nombre', '$tlf', '$correo',
                '$sexo', $dep)";
    
        if(mysqli_query($conn, $sql)) {
            echo "<br><h2 align='center'>Profesor insertado con exito!</h2><br>";
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
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);

            echo "para evitar inserciones repetidas se ha bloqueado la ejecucion de esta pagina por rrecargas<br>";
            echo "si estas aqui, seguramente sea porque el campo ya se ha insertado y ha refrescado la pagina<br>";
            echo "consulte la <a href='C:\xampp\htdocs\PHP\FICHA 3\ej3.php'>tabla de profesores</a> para comprobar" .
            "que se ha insertado su registro de forma satisfactoria<br>";
        }
    } else {
        session_unset();
        session_destroy();
        echo "<h3>La sesión ha caducado, volver al <a href='1 - ej5-form.php'>formulario</a></h3>";
    }
?>
<html>
    <head>
        <title>
            INSERT
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