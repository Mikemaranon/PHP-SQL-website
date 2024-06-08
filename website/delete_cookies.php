<?php
    setcookie('nombre_servidor', 0, time() -100);
    setcookie('nombre_usuario', 0, time() -100);
    setcookie('password', 0, time() -100);
    setcookie('database', 0, time() -100);
?>
<html>
    <head>
        <title>
            COOKIES BORRADAS
        </title>
        <link rel="StyleSheet" href="styles.css" type="text/css">
    </head>
    <body>
        <br>
        <h2 align="center">Las cookies han sido borradas</h2>
        <div id="contEnlaces">
            <ul class="enlaces">
                <a href="mainWeb.php"><li id="link"><b>VOLVER AL MENU</b></li></a>
            </ul>
        </div>
    </body>
</html>