<?php 

    // Database variables
    $server = "mysql-db"; // using Docker Compose service name
    $user = "root";
    $password = "mysql";
    $database = "cityParking";

    // Check connection
    try {

        // connection variable
        $connection = mysqli_connect($server, $user, $password, $database);
        
    } catch(mysqli_sql_exception $e) {

        echo "Could not connect to database, please check your credentials.";
    }

?>