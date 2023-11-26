<?php 

// Database variables
$server = "mysql-db"; // using Docker Compose service name
$user = "root";
$password = "mysql";
$database = "cityParking";

// Connection variable
$connection = mysqli_connect($server, $user, $password, $database);

// Check connection
if (!$connection) {
    echo "Could not connect to database: " . mysqli_connect_error();
    exit;
}

?>
