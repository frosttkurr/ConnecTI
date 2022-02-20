<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "medsos-ti";
    $db_port = "3306";

    $db_connect = new mysqli($servername, $username, $password, $dbname, $db_port);

    if ($db_connect->connect_error) {
        die("Connection failed: " . $db_connect->connect_error);
    }
?>