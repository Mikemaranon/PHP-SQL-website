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
?>
<html>
    <head>
        <title>
            Borrado de profesor           
        </title>
        <link rel="StyleSheet" href="style.css" type="text/css">
        <script>
            function setID(x) {
                document.getElementById("id_profesor").value = x;
            }
        </script>
    </head>
    <body>
        <header>
            <div id="heade">
                <h2>Borrar profesor en la base de datos</h2>
            </div>
        </header>
        <?php
            $sql = "SELECT id_profesor, nombre, telefono, correo,
            sexo, id_departamento FROM profesores";
            $result = mysqli_query($conn, $sql);

            if (mysqli_num_rows($result) > 0) {
                echo "<table cellspacing='0' 
                width='700px'><thead><tr height='30'>";
                echo "<th id='t_left'>id_profesor</th><th>Nombre</th>";
                echo "<th>telefono</th><th>correo</th>";
                echo "<th>sexo</th><th id='t_right'>id_departamento</th></tr>";
                echo "</thead><tbody>";
                while($row = mysqli_fetch_assoc($result)) {
                    echo "<tr height='30' onclick='setID(" . $row["id_profesor"] . ")'>
                    <td>" . $row["id_profesor"] . "</td>";
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
                echo "</table><br><br>";
            } else {
                echo "0 resultados";
            }
        ?>
        <br><br>
        <fieldset><legend><strong>Introduzca el id del profesor</strong></legend>
            <form name="formulario1" id="formulario" action="2 - ej7-delete.php" 
                method=post enctype="multipart/form-data">
                <fieldset><legend><strong>numero identificador</strong></legend>
                    <p>ID: <input type="text" name="id_profesor" value="" size="27" 
                        placeholder="ej: 1" id="id_profesor"></p>
                </fieldset>
                <br>
                <fieldset><legend><strong>Finalizar</strong></legend>
                    <input type="submit" value="Confirmar">
                    <input type="reset" value="borrar">
                </fieldset>
            </form>
        </fieldset><br>
        <div id="contEnlaces">
            <ul class="enlaces">
                <a href="http://localhost/PHP/FICHA3/mainWeb.php"><li id="link"><b>VOLVER AL MENU</b></li></a>
            </ul>
        </div>
    </body>
</html>