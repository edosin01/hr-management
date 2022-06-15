<?php
    include '../HomePage/dbconfig.php';
    $id = addslashes($_POST['id']);
    // Kiểm tra trùng mã
    $sql = "SELECT maPhongBan from phongban";
    $query = mysqli_query($conn, $sql);
    if($query->num_rows > 0) {
        while($ds_id = mysqli_fetch_array($query)) {
            if(strcasecmp($ds_id['maPhongBan'], $id) == 0) {
                echo "<script>
                        alert('Mã phòng ban đã tồn tại');
                        window.location.href='../HomePage/form_thempb.php';
                    </script>";
            }
        }
    }
    $name = addslashes($_POST['name']);
    $phone = addslashes($_POST['phone']);
    $leader = addslashes($_POST['leader']);

    $sql = "SELECT maChucVu from chucvu where tenChucVu = 'Trưởng phòng'";
    $query = mysqli_query($conn, $sql);
    $result = mysqli_fetch_array($query);
    $maChucVu = $result['maChucVu'];
    
    if($leader == "blank") {
        $sql = "INSERT INTO phongban (maPhongBan, tenPhongBan, maTruongP, soDienThoai) VALUES ('$id', '$name', NULL, '$phone')";
        if (mysqli_query($conn, $sql)) {
            header("Location: ../HomePage/index.php");
        }
        else {
            echo "Lỗi: " . $sql . "<br>" . mysqli_error($conn);
        }
    }
    else {
        $sql = "INSERT INTO phongban (maPhongBan, tenPhongBan, maTruongP, soDienThoai) VALUES ('$id', '$name', $leader, '$phone')";
        $query = mysqli_query($conn, $sql);
        $sql = "UPDATE nhanvien SET maChucVu = '$maChucVu' WHERE maNV = '$id'";
        if (mysqli_query($conn, $sql)) {
            header("Location: ../HomePage/index.php");
        }
        else {
            echo "Lỗi: " . $sql . "<br>" . mysqli_error($conn);
        }
    }
?>