<?php
    include '../HomePage/dbconfig.php';
    $id = addslashes($_POST['id']);

    // Lấy dữ liệu cũ của nhân viên
    $sql = "SELECT nhanvien.maNV, tenNV, gioiTinh, avatar, thanhPho, soDT, email, bacLuong, phongban.maPhongBan, chucvu.maChucVu, tenChucVu
    FROM nhanvien INNER JOIN phongban ON phongban.maPhongBan = nhanvien.maPhongBan
        INNER JOIN chucvu on chucvu.maChucVu = nhanvien.maChucVu WHERE maNV = '$id'";
    $query = mysqli_query($conn, $sql);
    $old_data = mysqli_fetch_array($query);

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

    if($old_data['maChucVu'] != $job_id) {
        // Cập nhật hồ sơ cũ
        $sql = "SELECT hoso.maNV, MAX(ngayLuuChuyen) as ngayNhamChuc FROM hoso WHERE maNV = '$id'";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_array($result);
        $ngayNhamChuc = addslashes($row['ngayNhamChuc']);
        $sql_update = "UPDATE hoso SET soNgayDamNhiem = DATEDIFF(CURRENT_DATE, '$ngayNhamChuc')
            WHERE maNV = '$id' AND ngayLuuChuyen = '$ngayNhamChuc'";
        $result = mysqli_query($conn, $sql_update);

        //Thêm hồ sơ mới
        $sql = "INSERT INTO hoso VALUES(null, '$id', '$job_id', CURRENT_DATE, 0, 1)";
        $query = mysqli_query($conn, $sql);
    }

    // Lấy mã phòng ban từ tên phòng ban
    $department = addslashes($_POST['department']);
    $sql = "Select maPhongBan, maTruongP from phongban where tenPhongBan = '$department'";
    $query = mysqli_query($conn, $sql);
    $res = mysqli_fetch_assoc($query);
    $department_id = addslashes($res['maPhongBan']);
    $leader_de = addslashes($res['maTruongP']); // Kiểm tra xem phòng ban này có trưởng phòng chưa
    
    $salary = addslashes($_POST['salary']);

    $contract_id = $_POST['contract_id'];
    $contract_type = $_POST['contract_type'];
    $date_start = $_POST['date_start'];
    $date_end = $_POST['date_end'];



    if(!empty($_FILES['ImageUpload']['tmp_name']) && file_exists($_FILES['ImageUpload']['tmp_name']))
        $avatar = addslashes(file_get_contents($_FILES['ImageUpload']['tmp_name']));
    else
        $avatar = addslashes($old_data['avatar']);

    $check = true;
    if($old_data['tenChucVu'] != "Trưởng phòng") {
        if($job == "Trưởng phòng" && $leader_de != NULL) { // chức vụ mới là trưởng phòng mà phòng có tp rồi
            echo "Phòng ban này đã tồn tại trưởng phòng";
            $check = false;
        }
        else if($job == "Trưởng phòng" && $leader_de == NULL) { // phòng trống
            $sql = "UPDATE phongban SET maTruongP = '$id' where maPhongBan = '$department_id'";
            $query = mysqli_query($conn, $sql);
        }
    }
    else {
        if($job != "Trưởng phòng") { // Nếu chuyển từ chức trưởng phòng về chức vụ khác
            // Chuyển phòng ban cũ về phòng trống
            $sql = "UPDATE phongban SET maTruongP = NULL where maPhongBan = '" .$old_data['maPhongBan'] ."'";
            $query = mysqli_query($conn, $sql);
        }
        else {
            if($old_data['maPhongBan'] != $department_id) { // Nếu vẫn là trưởng phòng nhưng là phòng ban khác
                if($leader_de != NULL) {
                    echo "Phòng ban này đã tồn tại trưởng phòng";
                    $check = false;
                }
                else {
                    // Chuyển phòng ban cũ về phòng trống
                    $sql = "UPDATE phongban SET maTruongP = NULL where maPhongBan = '" .$old_data['maPhongBan'] ."'";
                    $query = mysqli_query($conn, $sql);

                    // Thay đổi trưởng phòng trong phòng ban mới
                    $sql = "UPDATE phongban SET maTruongP = '$id' where maPhongBan = '$department_id'";
                    $query = mysqli_query($conn, $sql);
                }
            }
        }
    }
    
    if($check == true) {
        // Sửa thông tin nhân viên
        $sql = "UPDATE nhanvien SET tenNV = '$name', gioiTinh = $gender, avatar = '$avatar', thanhPho = '$address',
        soDT = '$phone', email = '$email', maPhongBan = '$department_id', maChucVu = '$job_id', bacLuong = '$salary' WHERE maNV = '$id'";

        if(mysqli_query($conn, $sql)) {
            if($old_data['tenNV'] != $name) {
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
                    if($cell == $id) {
                        $sheet->setCellValue("B".$row, $name);
                        break;
                    }
                }
    
                $writer = PHPExcel_IOFactory::createWriter($phpExcel, "Excel2007");
                $writer->setPreCalculateFormulas(true);
                // Save the spreadsheet
                
                $writer->save('../assets/SourceFile/chamcong_t' .$mon .'_' .$year .'.xlsx');
            }
            // Sửa thông tin hợp đồng
            $sql = "UPDATE hopdonglaodong SET loaiHopDong = '$contract_type', ngayBatDau = '$date_start', ngayKetThuc = '$date_end' WHERE maHopDong = '$contract_id'";
            $query = mysqli_query($conn, $sql);
            echo "<script>
                window.location.href='../HomePage/dsnhanvien.php';
                alert('Sửa thông tin nhân sự thành công');
            </script>";
        }
        else
            echo "Lỗi: " . $sql . "<br>" . mysqli_error($conn);
    }
?>