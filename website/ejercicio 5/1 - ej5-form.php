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

    // seleccionamos las ID de los profesores para quedarnos con la mas alta
    $selectId = "SELECT id_profesor FROM profesores";
    $result = mysqli_query($conn, $selectId); 
    while($id_p = mysqli_fetch_array($result)) {
        $id = $id_p["id_profesor"];
    }
?>

<html>
    <head>
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
                    alert("informacion recogida correctamente, muchas gracias!")
                    document.getElementById("formulario").action = "2 - ej5-insert.php"
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
                <h2>Registrar profesor en la base de datos</h2>
            </div>
        </header>
        <fieldset><legend><strong>Formulario</strong></legend>
            <form name="formulario1" id="formulario" action="" 
                method=post enctype="multipart/form-data">
                <input type="text" class="hide" name="id_profesor" value="
                    <?php
                        echo $id;
                    ?>
                ">
                <fieldset><legend><strong>Datos Personales</strong></legend>
                    <p>Nombre: <input type="text" name="nombre" value="" size="27" 
                        placeholder="ej: David"></p>
                    <p>Telefono: <input type="text" name="telefono" value="" size="27"
                        placeholder="ej: 647543891"></p>
                    <p>Correo: <input type="text" name="correo" value="" size="27"
                        placeholder="ej: ejemplo@correo.dom"></p>
                </fieldset>
                <br>
                <fieldset><legend><strong>Sexo</strong></legend>
                    <select name="sexo">
                        <option value="H">Hombre</option>
                        <option value="M">Mujer</option>
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
                                echo "<option value=" . $row["id_departamento"] . 
                                ">" . $row["nombre"]. "</option>";
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