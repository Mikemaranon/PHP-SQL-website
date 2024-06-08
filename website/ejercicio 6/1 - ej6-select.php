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
?>

<html>
    <head>
        <title>
            Formulario datos personales            
        </title>
        <link rel="StyleSheet" href="style.css" type="text/css">
        <script>
            function setID(x) {
                document.getElementById("id_profesor").value = x;
            }
            function validar() {
                let val1 = id_check();

                if (val1 == true) {
                    alert("el profesor seleccionado no existe, por favor seleccione de nuevo");
                    document.getElementById("formulario").action = "";
                } else {
                    alert("redirigiendo al formulario de actualizacion")
                    document.getElementById("formulario").action = "2 - ej6-form.php";
                    document.formulario1.submit();
                }
            }
            function id_check() {
                let x = document.formulario1.id_profesor.value;
                if(x == ""){
                    return true;
                } else {
                    return false;
                }
                /*let cont = 0;
                let id = document.formulario1.id_profesor.value;
                let element = parseInt(document.getElementById(cont));
                alert("id introducido: " + id + ", id actual: " + element);
                while(element != null) {
                    if (element==id) {
                        return false;
                    } 
                    cont++;
                    element = document.getElementById(cont)
                }
                return true;*/
            }
        </script>
    </head>
    <body>
        <header>
            <div id="heade">
                <h2>Actualizar profesor en la base de datos</h2>
            </div>
        </header>

        <?php
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
                    echo "<tr height='30' onclick='setID(" . $row["id_profesor"] . ")'>
                    <td>" . $row["id_profesor"] . "</a></td>";
                    echo "<td>" . $row["nombre"] . "</td>";
                    echo "<td>" . $row["telefono"] . "</a></td>";
                    if($row["correo"] == "") {
                        $row["correo"] = "<i>no establecido</i>";
                    }
                    echo "<td>" . $row["correo"] . "</a></td>";
                    echo "<td>" . $row["sexo"] . "</a></td>";
                    echo "<td>" . $row["id_departamento"] . "</a></td></tr>";
                }
                echo "</tbody><tr><td colspan='6' id='b_r_l'>+<td></tr>";
                echo "</table><br><br>";
            } else {
                echo "0 resultados";
            }
        ?>

        <fieldset><legend><strong>Introduzca el id del profesor</strong></legend>
            <form name="formulario1" id="formulario" action="2 - ej6-form.php" 
                method=post enctype="multipart/form-data">
                <fieldset><legend><strong>numero identificador</strong></legend>
                    <p>ID: <input type="text" name="id_profesor" value="" size="27" 
                        placeholder="ej: 1" id="id_profesor"></p>
                </fieldset>
                <br>
                <fieldset><legend><strong>Finalizar</strong></legend>
                    <input type="submit" value="Confirmar" onclick="validar()"> 
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