<?php
    include '../HomePage/dbconfig.php';
    $id = addslashes($_POST['id']);

    // Kiểm tra trùng mã
    $sql = "SELECT ID_KyLuat from kyluat";
    $query = mysqli_query($conn, $sql);
    if($query->num_rows > 0) {
        while($ds_id = mysqli_fetch_array($query)) {
            if(strcasecmp($ds_id['ID_KyLuat'], $id) == 0) {
                echo "<script>
                        alert('Mã kỷ luật đã tồn tại');
                        window.location.href='../HomePage/form_themphat.php';
                    </script>";
            }
        }
    }

    $name = addslashes($_POST['name']);
    $money = addslashes($_POST['money']);

    $sql = "INSERT INTO kyluat VALUES ('$id', '$name', '$money')";
    if($query = mysqli_query($conn, $sql)) {
        echo "<script>
                window.location.href='../HomePage/khenthuong_kyluat.php';
                alert('Thêm kỷ luật mới thành công');
            </script>";
    }
    else {
        echo "<script>
                window.location.href='../HomePage/form_themphat.php';
                alert('Đã xảy ra lỗi');
            </script>";
    }
?>