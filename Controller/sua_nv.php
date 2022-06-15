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

    // Lấy mã phòng ban từ tên phòng ban
    $department = addslashes($_POST['department']);
    $sql = "Select maPhongBan, maTruongP from phongban where tenPhongBan = '$department'";
    $query = mysqli_query($conn, $sql);
    $res = mysqli_fetch_assoc($query);
    $department_id = addslashes($res['maPhongBan']);
    $leader_de = addslashes($res['maTruongP']); // Kiểm tra xem phòng ban này có trưởng phòng chưa
    
    $salary = addslashes($_POST['salary']);
    if(!empty($_FILES['ImageUpload']['tmp_name']) && file_exists($_FILES['ImageUpload']['tmp_name']))
        $avatar = addslashes(file_get_contents($_FILES['ImageUpload']['tmp_name']));
    else
        $avatar = addslashes($old_data['avatar']);

    if($old_data['tenChucVu'] != "Trưởng phòng") {
        if($job == "Trưởng phòng" && $leader_de != NULL) { // chức vụ mới là trưởng phòng mà phòng có tp rồi
            echo "Phòng ban này đã tồn tại trưởng phòng";
        }
        else { // chức vụ mới là trưởng phòng mà phòng chưa có tp
            if($job == "Trưởng phòng" && $leader_de == NULL) {
                $sql = "UPDATE phongban SET maTruongP = '$id' where maPhongBan = '$department_id'";
                $query = mysqli_query($conn, $sql);
            }
            $sql = "UPDATE nhanvien SET tenNV = '$name', gioiTinh = $gender, avatar = '$avatar', thanhPho = '$address',
            soDT = '$phone', email = '$email', maPhongBan = '$department_id', maChucVu = '$job_id', bacLuong = '$salary' WHERE maNV = '$id'";
            if(mysqli_query($conn, $sql))
                header("Location: ../HomePage/dsnhanvien.php");
            else
                echo "Lỗi: " . $sql . "<br>" . mysqli_error($conn);
        }
    }
    else {
        if($job != "Trưởng phòng") { // Nếu chuyển từ chức trưởng phòng về chức vụ khác
            // Chuyển phòng ban cũ về phòng trống
            $sql = "UPDATE phongban SET maTruongP = NULL where maPhongBan = '" .$old_data['maPhongBan'] ."'";
            $query = mysqli_query($conn, $sql);

            // Sửa thông tin nhân viên
            $sql = "UPDATE nhanvien SET tenNV = '$name', gioiTinh = $gender, avatar = '$avatar', thanhPho = '$address',
            soDT = '$phone', email = '$email', maPhongBan = '$department_id', maChucVu = '$job_id', bacLuong = '$salary' WHERE maNV = '$id'";
            
            if(mysqli_query($conn, $sql))
                header("Location: ../HomePage/dsnhanvien.php");
            else
                echo "Lỗi: " . $sql . "<br>" . mysqli_error($conn);
        }
        else { // Nếu vẫn là trưởng phòng nhưng là phòng cũ
            if($old_data['maPhongBan'] == $department_id) {
                $sql = "UPDATE nhanvien SET tenNV = '$name', gioiTinh = $gender, avatar = '$avatar', thanhPho = '$address',
                soDT = '$phone', email = '$email', maPhongBan = '$department_id', maChucVu = '$job_id', bacLuong = '$salary' WHERE maNV = '$id'";
                if(mysqli_query($conn, $sql))
                    header("Location: ../HomePage/dsnhanvien.php");
                else
                    echo "Lỗi: " . $sql . "<br>" . mysqli_error($conn);
            }
            else { // Nếu vẫn là trưởng phòng nhưng là phòng ban khác
                if($leader_de != NULL)
                    echo "Phòng ban này đã tồn tại trưởng phòng";
                else {
                    // Chuyển phòng ban cũ về phòng trống
                    $sql = "UPDATE phongban SET maTruongP = NULL where maPhongBan = '" .$old_data['maPhongBan'] ."'";
                    $query = mysqli_query($conn, $sql);

                    // Thay đổi trưởng phòng trong phòng ban mới
                    $sql = "UPDATE phongban SET maTruongP = '$id' where maPhongBan = '$department_id'";
                    $query = mysqli_query($conn, $sql);

                    // Sửa thông tin nhân viên
                    $sql = "UPDATE nhanvien SET tenNV = '$name', gioiTinh = $gender, avatar = '$avatar', thanhPho = '$address',
                    soDT = '$phone', email = '$email', maPhongBan = '$department_id', maChucVu = '$job_id', bacLuong = '$salary' WHERE maNV = '$id'";
                    if(mysqli_query($conn, $sql))
                        header("Location: ../HomePage/dsnhanvien.php");
                    else
                        echo "Lỗi: " . $sql . "<br>" . mysqli_error($conn);
                }
            }
        }
    }
?>