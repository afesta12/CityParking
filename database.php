<?php 

    // database variables
    $server = "localhost";
    $user = "root";
    $password = "mysql";
    $database = "parking";

    // Check connection
    try {

        // connection variable
        $connection = mysqli_connect($server, $user, $password, $database);
        
    } catch(mysqli_sql_exception) {

        echo "Could not connect to database, please check your credentials.";
    }

?>