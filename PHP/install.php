<?php

    // Database variables
    $server = "localhost";
    $user = "root";
    $password = "mysql";
    $database = "CITYPARKING";

    // Dump into string
    $sqlDump = file_get_contents("newDump.sql");

    // Create a new mysqli connection with no database parameter
    $connection = new mysqli($server, $user, $password);

    // Create the database if it doesn't exist
    $createDatabaseQuery = "CREATE DATABASE IF NOT EXISTS $database";

    if ($connection->query($createDatabaseQuery) === TRUE) {
        echo "Database created<br>";

        // Close the current connection (not connected to database)
        $connection->close();

        // Connect to the created database
        $connection = new mysqli($server, $user, $password, $database);

        // Check connection
        if ($connection->connect_error) {

            die("Connection failed: " . $connection->connect_error);
        }

        // Execute the SQL dump into the cityparking database
        $connection->multi_query($sqlDump);

    } else {
        echo "Error creating database: " . $connection->error;
    }

    // Close the connection
    $connection->close();

?>