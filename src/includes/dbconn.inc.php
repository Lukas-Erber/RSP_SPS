<?php
    $dbServer = "localhost";
    $dbUsername = "root";
    $dbPassword = "";
    $dbName = "sps-db";

   $conn = mysqli_connect($dbServer, $dbUsername, $dbPassword, $dbName);

   // Kontrola
    if(!$conn){
        die("ERROR: Nepodařilo se připojit k databázi. " . mysqli_connect_error());
    }
    