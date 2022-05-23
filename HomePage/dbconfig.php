<?php
    $svName = "localhost";
    $username = "root";
    $password = "";
    $db = "quanly_nhansu";
    
    $conn = mysqli_connect($svName, $username, $password, $db);
    if(mysqli_error($conn))
        echo "Kết nối cơ sở dữ liệu thất bại. ".mysqli_error($conn);
?>