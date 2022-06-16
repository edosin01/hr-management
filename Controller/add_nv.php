<?php
    include '../HomePage/dbconfig.php';
    $id = addslashes($_POST['id']);

    // Kiểm tra trùng mã
    $sql = "SELECT maNV from nhanvien";
    $query = mysqli_query($conn, $sql);
    if($query->num_rows > 0) {
        while($ds_id = mysqli_fetch_array($query)) {
            if(strcasecmp($ds_id['maNV'], $id) == 0) {
                echo "<script>
                        alert('Mã nhân viên đã tồn tại');
                        window.location.href='../HomePage/form_themnv.php';
                    </script>";
            }
        }
    }

    $name = addslashes($_POST['name']);
    $address = addslashes($_POST['address']);
    
    $gender = addslashes($_POST['gender']);
    $email = addslashes($_POST['email']);
    $phone = addslashes($_POST['phone']);
    
    // Lấy mã chức vụ từ tên chức vụ
    $job = addslashes($_POST['job']);
    $sql = "Select maChucVu from chucvu where tenChucVu = '$job'";
    $query = mysqli_query($conn, $sql);
    $res = mysqli_fetch_assoc($query);
    $job_id = addslashes($res['maChucVu']);

    // Lấy mã phòng ban từ tên phòng ban
    $department = addslashes($_POST['department']);
    $sql = "Select maPhongBan, maTruongP from phongban where tenPhongBan = '$department'";
    $query = mysqli_query($conn, $sql);
    $res = mysqli_fetch_assoc($query);
    $department_id = addslashes($res['maPhongBan']);
    $leader_de = addslashes($res['maTruongP']); // Kiểm tra xem phòng ban này có trưởng phòng chưa
    
    $salary = addslashes($_POST['salary']);
    $avatar = addslashes(file_get_contents($_FILES['ImageUpload']['tmp_name']));

    if($job == "Trưởng phòng" && $leader_de != NULL) {
        echo "Phòng ban này đã tồn tại trưởng phòng";
    }
    else {
        if($job == "Trưởng phòng" && $leader_de == NULL) {
            $sql = "UPDATE phongban SET maTruongP = '$id' where maPhongBan = '$department_id'";
            $query = mysqli_query($conn, $sql);
        }
        $sql = "insert into nhanvien (maNV, tenNV, gioiTinh, avatar, thanhPho, soDT, email, maPhongBan,
            maChucVu, bacLuong) values ('$id', '$name', $gender, '$avatar', '$address', '$phone',
            '$email', '$department_id', '$job_id', '$salary')";
        if (mysqli_query($conn, $sql)) {
            require('../src/PHPExcel.php');
            $mon = date('m');
            $year = date('Y');
            $phpExcel = PHPExcel_IOFactory::load('../assets/SourceFile/chamcong_t' .$mon .'_' .$year .'.xlsx');
            // Get the first sheet
            $sheet = $phpExcel ->getActiveSheet();
            
            $row = $sheet->getHighestRow();
            $sheet->setCellValueByColumnAndRow(0, $row+1, $id);
            $sheet->setCellValueByColumnAndRow(1, $row+1, $name);
            $formula_cell = "AH".$row+1;
            $formula = "=COUNTIF(C" .$row+1 .":AG" .$row+1 .", \"x\")";
            $sheet->setCellValue($formula_cell, $formula);

            $writer = PHPExcel_IOFactory::createWriter($phpExcel, "Excel2007");
            $writer->setPreCalculateFormulas(true);
            // Save the spreadsheet
            
            $writer->save('../assets/SourceFile/chamcong_t' .$mon .'_' .$year .'.xlsx');
            echo "<script>
                window.location.href='../HomePage/dsnhanvien.php';
                alert('Thêm nhân viên mới thành công');
            </script>";
        }
        else {
            echo "Lỗi: " . $sql . "<br>" . mysqli_error($conn);
        }
    }
?>