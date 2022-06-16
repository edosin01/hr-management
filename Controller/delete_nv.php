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