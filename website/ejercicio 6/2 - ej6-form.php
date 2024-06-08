<?php
    
    $servername = $_COOKIE['nombre_servidor'];
    $username = $_COOKIE['nombre_usuario'];
    $password = $_COOKIE['password'];
    $database = $_COOKIE['database'];
    session_start();

    if ($_SERVER["REQUEST_METHOD"] == "POST") { // Si ha recibido un post, asigna los valores
        foreach($_POST as $type => $data){  // coge cada valor del post
            $_SESSION[$type] = $data;       // almacena en la sesión cada variable
        }
        $id = $_SESSION["id_profesor"];
    } else {
        session_unset();
        session_destroy();
    }
    // Create connection
    $conn = mysqli_connect($servername, $username, $password, $database);

    // Check connection
    if (!$conn) {
        die("Conexion fallida: " . mysqli_connect_error());
    }
?>

<html>
    <head>
        <meta charset="UTF-8">
        <title>
            Formulario datos personales            
        </title>
        <link rel="StyleSheet" href="style.css" type="text/css">
        <script>
            function validacion() {
                let val1 = f_nombre() 
                let val2 = f_telefono() 
                let val3 = f_correo()

                if (val1 == true || val2 == true || val3 == true) {
                    alert("hay información incorrecta, porfavor compruebe los datos de nuevo");
                    document.getElementById("formulario").action = ""
                } else {
                    alert("información recogida correctamente, muchas gracias!")
                    document.getElementById("formulario").action = "3 - ej6-update.php"
                    document.formulario1.submit()
                }
            }
            function f_nombre() {
                if (document.formulario1.nombre.value == "") {
                    return true;
                } else {
                    return false;
                } 
            }
            function f_telefono() { 
                let tlf = document.formulario1.telefono.value;

                if (tlf == "" || tlf.length != 9) {
                    return true;
                } else {
                    return false;
                } 
            }
            function f_correo() {
                let mail = document.formulario1.correo.value;
                let cont_at = 0, cont_dot = 0;

                if(mail.lenth > 50) {
                    return true;
                } else {
                    if (mail.length == 0) {
                        return false;
                    } else {
                        let arrayMail = mail.split("");
                        for(let i = 0; i < mail.length; i++) {
                            if(arrayMail[i] == "@") {
                                cont_at++;
                            }
                            if(arrayMail[i] == ".") {
                                cont_dot++;
                            }
                        }
                    }
                    
                    if(cont_at != 1 || cont_dot != 1) {
                        return true;
                    } else {
                        return false;
                    }
                }
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

                $name = $row["nombre"];
                $tlf = $row["telefono"];
                $mail = $row["correo"];
                $sexo = $row["sexo"];
                $dep = $row["id_departamento"];
            }
            echo "</tbody><tr><td colspan='6' id='b_r_l'>+<td></tr>";
            echo "</table><br><br>";
        ?>
        <fieldset><legend><strong>Introduzca los datos nuevos</strong></legend>
            <form name="formulario1" id="formulario" action="" 
                method=post enctype="multipart/form-data">
                <fieldset><legend><strong>Datos Personales</strong></legend>
                    <p>Nombre: <input type="text" name="nombre" 
                    value="<?php echo rtrim(ltrim($name)); ?>" 
                    size="28" placeholder="ej: David"></p>
                    <p>Telefono: <input type="text" name="telefono" 
                    value="<?php echo trim($tlf, " \t\n\r\0\x0B");?>" 
                    size="27" placeholder="ej: 647543891"></p>
                    <p>Correo: <input type="text" name="correo" 
                    value="<?php echo $mail; ?>" size="29" 
                    placeholder="ej: ejemplo@correo.dom"></p>
                </fieldset>
                <br>
                <fieldset><legend><strong>Sexo</strong></legend>
                    <select name="sexo">
                        <option value="H"
                        <?php
                            if($sexo == 'H') {
                                echo "selected";
                            }
                        ?>>Hombre</option>
                        <option value="M"
                        <?php
                            if($sexo == 'M') {
                                echo "selected";
                            }
                        ?>>Mujer</option>
                    </select>
                </fieldset>
                <br>
                <fieldset><legend><strong>Departamento</strong></legend>
                    <?php
                        $sql = "SELECT id_departamento, nombre FROM departamentos";
                        $result = mysqli_query($conn, $sql);

                        if (mysqli_num_rows($result) > 0) {
                            echo "<select name='departamento'>";
                            while($row = mysqli_fetch_assoc($result)) {
                                if($row["id_departamento"] == $dep) {
                                    echo "<option value=" . $row["id_departamento"] . 
                                    " selected>" . $row["nombre"]. "</option>";
                                } else {
                                    echo "<option value=" . $row["id_departamento"] . 
                                    ">" . $row["nombre"]. "</option>";
                                }
                            }
                            echo "</select><br>";
                        } else {
                            echo "0 resultados";
                        }
                    ?>
                </fieldset>
                <br>
                <fieldset><legend><strong>Finalizar</strong></legend>
                    <input type="submit" value="Registrarse" onclick="validacion()">
                    <!--<input type="reset" value="borrar">-->
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