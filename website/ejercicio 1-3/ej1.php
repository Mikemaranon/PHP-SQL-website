<?php
    $servername = "localhost";
    $username = "mike";
    $password = "P@ssw0rd";
    $database = "profesorado";

    // Create connection
    $conn = mysqli_connect($servername, $username, $password, $database);

    // Check connection
    if (!$conn) {
        die("Conexion fallida: " . mysqli_connect_error());
    }
    echo "Conexion establecida";
?>