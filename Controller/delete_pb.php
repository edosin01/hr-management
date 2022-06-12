<?php
    include '../HomePage/dbconfig.php';
    if(isset($_GET['delete'])) {
        $id_department = $_GET['delete'];
        $sql = "SELECT * FROM nhanvien WHERE maPhongBan = '$id_department'";
        $query = mysqli_query($conn, $sql);
        if($query->num_rows > 0) {
            echo "<script>
                    alert('Có nhân viên tồn tại trong phòng ban đó, vui lòng xem xét lại');
                    window.location.href='../HomePage/index.php';
                    </script>";
        }
        else {
            $sql = "delete from phongban where maPhongBan = '$id_department'";
            if(mysqli_query($conn, $sql))
            {
                echo "<script>
                    alert('Xóa thành công');
                    window.location.href='../HomePage/index.php';
                    </script>";
            }
        }
    }
    else
        echo "Failed to delete";
?>