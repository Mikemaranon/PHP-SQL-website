<?php
    //session_start();
    if ($_SERVER["REQUEST_METHOD"] == "POST") { // Si ha recibido un post, asigna los valores
        foreach($_POST as $type => $data){  // coge cada valor del post
            $c = htmlspecialchars($type);   // coge el tipo
            $v = $data;                     // coge el valor
            setcookie($c, $v, time()+10000);    // almacena todo en una cookie
        }
        $servername = $_POST['nombre_servidor'];
        $username = $_POST['nombre_usuario'];
        $password = $_POST['password'];
        $database = $_POST['database'];
    } else {
        $servername = $_COOKIE['nombre_servidor'];
        $username = $_COOKIE['nombre_usuario'];
        $password = $_COOKIE['password'];
        $database = $_COOKIE['database'];
    }
?>

<html>
    <head>
        <title>
            Base de datos del profesorado
        </title>
        <link rel="StyleSheet" href="styles.css" type="text/css">
    </head>
    <body>
        <?php
            if(isset($username)) {
                echo '  <br>
                <div id="heade">
                    <h1>Bienvenido a la base de datos del profesorado</h1>
                </div>
                <fieldset><legend><strong>seleccione lo que quiere hacer</strong></legend>
                    <fieldset><legend class="second"><strong>ver base de datos</strong></legend>
                        <div id="contEnlaces">
                            <ul class="enlaces">
                                <a href="ejercicio 1-3/ej2.php"><li id="link"><b>Departamentos</b></li></a>
                                <li class="NONE">|</li><li class="NONE">|</li><li class="NONE">|</li>
                                <a href="ejercicio 1-3/ej3.php"><li id="link"><b>Profesores</b></li></a>
                                <li class="NONE">|</li><li class="NONE">|</li><li class="NONE">|</li>
                                <a href="ejercicio 4/ej4-1.php"><li id="link"><b>Profesores por deparamtentos</b></li></a>
                            </ul>
                        </div>
                    </fieldset>
                    <br>';
                    if ($username == "mike") {
                        echo '
                        <fieldset><legend class="second"><strong>Manipular base de datos</strong></legend>
                            <div id="contEnlaces">
                                <ul class="enlaces">
                                    <a href="ejercicio 5/1 - ej5-form.php"><li id="link"><b>Insertar</b></li></a>
                                    <li class="NONE">|</li><li class="NONE">|</li><li class="NONE">|</li>
                                    <a href="ejercicio 6/1 - ej6-select.php"><li id="link"><b>Actualizar</b></li></a>
                                    <li class="NONE">|</li><li class="NONE">|</li><li class="NONE">|</li>
                                    <a href="ejercicio 7/1 - ej7-select.php"><li id="link"><b>Borrar</b></li></a>
                                </ul>
                            </div>
                        </fieldset><br>
                        ';
                    }
                    echo '
                    <fieldset><legend class="second"><strong>Salir</strong></legend>
                        <div id="contEnlaces">
                            <ul class="enlaces">
                                <a href="welcome.html"><li id="link"><b>Regresar</b></li></a>
                                <li class="NONE">|</li><li class="NONE">|</li><li class="NONE">|</li>
                                <a href="delete_cookies.php"><li id="link"><b>Borrar Cookies</b></li></a>
                            </ul>
                        </div>
                    </fieldset>
                </fieldset>';
            } else {
                echo ' <br>
                <h2 align="center">La sesión ha caducado, porfavor rellene el formulario de nuevo</h2>
                <div id="contEnlaces">
                    <ul class="enlaces">
                        <a href="welcome.html"><li id="link"><b>VOLVER AL FORMULARIO</b></li></a>
                    </ul>
                </div>
                ';
            }
        ?>
    </body>
</html>