<?php
    include '../HomePage/dbconfig.php';
    $id = addslashes($_POST['id']);
    $name = addslashes($_POST['name']);
    $money = addslashes($_POST['money']);

    $sql = "UPDATE kyluat SET noiDung = '$name', tienPhat = '$money' WHERE ID_KyLuat = '$id'";
    if($query = mysqli_query($conn, $sql)) {
        echo "<script>
                alert('Sửa thành công');
                window.location.href='../HomePage/khenthuong_kyluat.php';
            </script>";
    }
    else {
        echo "<script>
                alert('Sửa thất bại');
                window.location.href='../HomePage/khenthuong_kyluat.php';
            </script>";
    }
?>