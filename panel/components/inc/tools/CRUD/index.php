<?php 

    require_once("C:/xampp/htdocs/lander_rey/panel/components/inc/config/db/index.php");

    $connection = mysqli_connect($server, $username, $password, $database);

    if (!$connection) {
        die("Connection failed: " . mysqli_connect_error());
    }

?>