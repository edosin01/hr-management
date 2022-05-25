<?php
    include '../HomePage/dbconfig.php';
    if(isset($_GET['delete'])) {
        $user_id = addslashes($_GET['delete']);
        // Xóa hợp đồng lao động
        $query = "DELETE FROM hopdonglaodong where maNV = '$user_id'";
        if($query)
            $result = mysqli_query($conn, $query);

        //Truy vấn nếu là trưởng phòng thì sửa lại thông tin trưởng phòng ở bảng phòng ban
        $query = "SELECT nhanvien.maPhongBan, tenChucVu
        from nhanvien INNER JOIN chucvu ON nhanvien.maChucVu = chucvu.maChucVu
        INNER JOIN phongban ON nhanvien.maPhongBan = phongban.maPhongBan
        WHERE maNV = '$user_id';";
        $result = mysqli_query($conn, $query);
        if($result->num_rows > 0) {
            $row = mysqli_fetch_assoc($result);
            $department_id = addslashes($row['maPhongBan']);

            if($row['tenChucVu'] == "Trưởng phòng") {
                $query = "UPDATE phongban SET maTruongP = NULL WHERE maPhongBan = '$department_id'";
                $result = mysqli_query($conn, $query);
            }
        }
        
        // Xóa nhân viên
        $query = "delete from nhanvien where maNV = '$user_id'";
        $result = mysqli_query($conn, $query);
        header("location: ../HomePage/dsnhanvien.php");
        
    }
    else {
        echo "Xóa không thành công";
    }
?>