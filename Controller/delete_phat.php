<?php
    include '../HomePage/dbconfig.php';
    if(isset($_GET['delete'])) {
        $id = addslashes($_GET['delete']);
        $sql = "DELETE FROM kyluat WHERE ID_KyLuat = '$id'";
        if($query = mysqli_query($conn, $sql)) {
            echo "<script>
                    window.location.href='../HomePage/khenthuong_kyluat.php';
                    alert('Xóa kỷ luật thành công');
                </script>";
        }
        else {
            echo "<script>
                    window.location.href='../HomePage/khenthuong_kyluat.php';
                    alert('Đã xảy ra lỗi');
                </script>";
        }
    }
?>