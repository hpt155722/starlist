<?php
    $server_name = "localhost";
    $username = "root";
    $password = "";
    $database_name = "starlistdatabase";
    $port = 3307;

    $conn = new mysqli($server_name, $username, $password, $database_name, $port);

    if ($conn -> connect_error) {
        die("Connection error: " . $conn -> connect_error);
    }

?>