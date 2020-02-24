<?php
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "lbiz";
    $conn = new mysqli($servername, $username, $password, $dbname);
?>
