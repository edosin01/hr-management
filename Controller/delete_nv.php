<?php
    include '../HomePage/dbconfig.php';
    if(isset($_GET['delete'])) {
        $user_id = $_GET['delete'];
        $query = "DELETE FROM hopdonglaodong where maNV = '$user_id'";
        if($query)
            $result = mysqli_query($conn, $query);
        $query = "delete from nhanvien where maNV = '$user_id'";
        $result = mysqli_query($conn, $query);
        header("location: ../HomePage/dsnhanvien.php");
    }
    else {
        echo "Xóa không thành công";
    }
?>