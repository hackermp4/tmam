<!-- Database connection -->

<?php

error_reporting(E_ERROR | E_PARSE);

function database() {
    $servername = "localhost";
    $username = "ishq";
    $password = "carbon95";
    $database = "qdb";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $database);

    // Check connection
    if ($conn->connect_error) {
    die("Database connection failed!");
    }
    
    return $conn;
}




?> 