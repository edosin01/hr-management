<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "quanly_nhansu";

    //create connection // ket noi csdl

    $conn = new mysqli($servername, $username, $password, $dbname);

    //check connection

    if($conn->connect_error){
        die("Connection failed".$conn->connect_error);
    }
?>