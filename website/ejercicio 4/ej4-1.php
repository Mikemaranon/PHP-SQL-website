<?php
    
    $servername = $_COOKIE['nombre_servidor'];
    $username = $_COOKIE['nombre_usuario'];
    $password = $_COOKIE['password'];
    $database = $_COOKIE['database'];
    session_start();

    // Create connection
    $conn = mysqli_connect($servername, $username, $password, $database);

    // Check connection
    if (!$conn) {
        die("Conexion fallida: " . mysqli_connect_error());
    }

    echo "<h2 align='center'>Selección de departamento</h2>";

    $sql = "SELECT id_departamento, nombre FROM departamentos";
    $result = mysqli_query($conn, $sql);

    
    if (mysqli_num_rows($result) > 0) {
        echo "<form name='formulario1' id='formulario' action='ej4-2.php' 
        method=post enctype='multipart/form-data'>";
        echo "<fieldset>";
        echo "<fieldset><legend>Selecciona un departamento</legend>";
        echo "<select name='departamento'>";
        while($row = mysqli_fetch_assoc($result)) {
            echo "<option value=" . $row["id_departamento"] . 
            ">" . $row["nombre"]. "</option>";
        }
        echo "</select></fieldset>";
        echo "<fieldset><legend>Finalizar</legend>";
        echo "<input type='submit'></fieldset>";
        echo "</fieldset>";
        echo "</form>";
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
                <a href="http://localhost/PHP/FICHA3/mainWeb.php"><li id="link"><b>VOLVER AL MENU</b></li></a>
            </ul>
        </div>
    </body>
</html>