<?php
    include '../HomePage/dbconfig.php';
    if(isset($_GET['delete'])) {
        $user_id = addslashes($_GET['delete']);
        // Chuyển hợp đồng lao động về trạng thái 0
        $query = "UPDATE hopdonglaodong SET tinhTrang = 0, ngayKetThuc = CURRENT_DATE WHERE maNV = '$user_id'";
        if($query)
            $result = mysqli_query($conn, $query);
        
        // Cập nhật ngày làm cho hồ sơ gần đây nhất
        $sql = "SELECT hoso.maNV, MAX(ngayLuuChuyen) as ngayNhamChuc FROM hoso WHERE maNV = '$user_id'";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_array($result);
        $ngayNhamChuc = addslashes($row['ngayNhamChuc']);
        $sql_update = "UPDATE hoso SET soNgayDamNhiem = DATEDIFF(CURRENT_DATE, '$ngayNhamChuc'), trangThai = 0 
            WHERE maNV = '$user_id' AND ngayLuuChuyen = '$ngayNhamChuc'";
        $result = mysqli_query($conn, $sql_update);

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
        
        // Cập nhật trạng thái nhân viên thôi việc
        $query = "UPDATE nhanvien SET tinhTrang = 0 WHERE maNV = '$user_id'";
        if(mysqli_query($conn, $query))
        {
            require('../src/PHPExcel.php');
            $mon = date('m');
            $year = date('Y');
            $phpExcel = PHPExcel_IOFactory::load('../assets/SourceFile/chamcong_t' .$mon .'_' .$year .'.xlsx');
            // Get the first sheet
            $sheet = $phpExcel ->getActiveSheet();

            $column = "A";
            $lastRow = $sheet->getHighestRow();
            for ($row = 1; $row <= $lastRow; $row++) {
                $cell = $sheet->getCell($column.$row)->getValue();
                if($cell == $user_id) {
                    $sheet->removeRow($row);
                    break;
                }
            }

            $writer = PHPExcel_IOFactory::createWriter($phpExcel, "Excel2007");
            $writer->setPreCalculateFormulas(true);
            // Save the spreadsheet
            
            $writer->save('../assets/SourceFile/chamcong_t' .$mon .'_' .$year .'.xlsx');
            echo "<script>
                alert('Xóa thành công');
                window.location.href='../HomePage/dsnhanvien.php';
                </script>";
        }
    }
    else {
        echo "Xóa không thành công";
    }
?>