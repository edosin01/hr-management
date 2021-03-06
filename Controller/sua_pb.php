<?php
    include '../HomePage/dbconfig.php';
    $id = addslashes($_POST['id']);
    $sql = "SELECT * FROM phongban WHERE maPhongBan = '$id'";
    $query = mysqli_query($conn, $sql);
    $old_data = mysqli_fetch_array($query);

    $name = addslashes($_POST['name']);
    $phone = addslashes($_POST['phone']);
    if($_POST['leader'] == "blank") {
        $leader = addslashes(NULL);
        $job = "Rỗng";
    }
    else {
        $leader = addslashes($_POST['leader']);
        // Kiểm tra xem chức vụ của trưởng phòng mới là gì ?
        $sql = "SELECT tenChucVu from nhanvien inner join chucvu on nhanvien.maChucVu = chucvu.maChucVu
        where maNV = '$leader'";
        $query = mysqli_query($conn, $sql);
        $row = mysqli_fetch_array($query);
        $job = $row['tenChucVu'];
    }

    if($job == "Trưởng phòng" && $leader != $old_data['maTruongP']) {
        echo "<script>
            alert('Không thể set trưởng phòng khác làm trưởng phòng này');
            window.location.href='../HomePage/index.php';
            </script>";
    }
    else {
        // Phòng ban không phải phòng trống
        if($old_data['maTruongP'] != NULL) {
            // chuyển trưởng phòng cũ về làm nhân viên
            $sql = "UPDATE nhanvien SET maChucVu = (SELECT maChucVu FROM chucvu where tenChucVu = 'Nhân viên') WHERE maNV = '" .$old_data['maTruongP'] ."'";
            $query = mysqli_query($conn, $sql);

            // Cập nhật hồ sơ cũ
            $sql = "SELECT hoso.maNV, MAX(ngayLuuChuyen) as ngayNhamChuc FROM hoso WHERE maNV = '" .$old_data['maTruongP'] ."'";
            $result = mysqli_query($conn, $sql);
            $row = mysqli_fetch_array($result);
            $ngayNhamChuc = addslashes($row['ngayNhamChuc']);
            $sql_update = "UPDATE hoso SET soNgayDamNhiem = DATEDIFF(CURRENT_DATE, '$ngayNhamChuc')
                WHERE ngayLuuChuyen = '$ngayNhamChuc' AND maNV = '" .$old_data['maTruongP'] ."'";
            $result = mysqli_query($conn, $sql_update);

            //Thêm hồ sơ mới
            $sql = "INSERT INTO hoso VALUES(null, '" .$old_data['maTruongP'] ."', (SELECT maChucVu FROM chucvu where tenChucVu = 'Nhân viên'), CURRENT_DATE, 0, 1)";
            $query = mysqli_query($conn, $sql);

            // Nếu có chọn trưởng phòng mới
            if($leader != NULL) { // chuyển nhân viên mới lên làm trưởng phòng
                $sql = "UPDATE nhanvien SET maChucVu = (SELECT maChucVu FROM chucvu where tenChucVu = 'Trưởng phòng'), maPhongBan ='$id' WHERE maNV = '$leader'";
                $query = mysqli_query($conn, $sql);

                // Cập nhật hồ sơ cũ
                $sql = "SELECT hoso.maNV, MAX(ngayLuuChuyen) as ngayNhamChuc FROM hoso WHERE maNV = '$leader'";
                $result = mysqli_query($conn, $sql);
                $row = mysqli_fetch_array($result);
                $ngayNhamChuc = addslashes($row['ngayNhamChuc']);
                $sql_update = "UPDATE hoso SET soNgayDamNhiem = DATEDIFF(CURRENT_DATE, '$ngayNhamChuc')
                    WHERE ngayLuuChuyen = '$ngayNhamChuc' AND maNV = '$leader'";
                $result = mysqli_query($conn, $sql_update);

                //Thêm hồ sơ mới
                $sql = "INSERT INTO hoso VALUES(null, '$leader', (SELECT maChucVu FROM chucvu where tenChucVu = 'Trưởng phòng'), CURRENT_DATE, 0, 1)";
                $query = mysqli_query($conn, $sql);

                $sql = "UPDATE phongban SET tenPhongBan = '$name', soDienThoai = '$phone', maTruongP = '$leader' WHERE maPhongBan = '$id'";
                if(mysqli_query($conn, $sql)) {
                    echo "<script>
                        alert('Sửa thành công');
                        window.location.href='../HomePage/index.php';
                        </script>";
                }
                else {
                    echo "<script>
                        alert('Sửa thất bại');
                        window.location.href='../HomePage/index.php';
                        </script>";
                }
            }
            // Trưởng phòng mới = NULL
            else {
                $sql = "UPDATE phongban SET tenPhongBan = '$name', soDienThoai = '$phone', maTruongP = NULL WHERE maPhongBan = '$id'";
                if(mysqli_query($conn, $sql)) {
                    echo "<script>
                        alert('Sửa thành công');
                        window.location.href='../HomePage/index.php';
                        </script>";
                }
                else {
                    echo "<script>
                        alert('Sửa thất bại');
                        window.location.href='../HomePage/index.php';
                        </script>";
                }
            }
        }
        // Phòng cũ là phòng trống
        else {
            if($leader == NULL) { // Không chọn trưởng phòng mới -> set thành phòng trống
                $sql = "UPDATE phongban SET tenPhongBan = '$name', soDienThoai = '$phone', maTruongP = NULL WHERE maPhongBan = '$id'";
                if(mysqli_query($conn, $sql)) {
                    echo "<script>
                        alert('Sửa thành công');
                        window.location.href='../HomePage/index.php';
                        </script>";
                }
                else {
                    echo "<script>
                        alert('Sửa thất bại');
                        window.location.href='../HomePage/index.php';
                        </script>";
                }
            }
            else { // chuyển nhân viên mới lên làm trưởng phòng
                $sql = "UPDATE nhanvien SET maChucVu = (SELECT maChucVu FROM chucvu where tenChucVu = 'Trưởng phòng'), maPhongBan ='$id' WHERE maNV = '$leader'";
                $query = mysqli_query($conn, $sql);

                $sql = "UPDATE phongban SET tenPhongBan = '$name', soDienThoai = '$phone', maTruongP = '$leader' WHERE maPhongBan = '$id'";
                if(mysqli_query($conn, $sql)) {
                    echo "<script>
                        alert('Sửa thành công');
                        window.location.href='../HomePage/index.php';
                        </script>";
                }
                else {
                    echo "<script>
                        alert('Sửa thất bại');
                        window.location.href='../HomePage/index.php';
                        </script>";
                }
            }
        }
    }
?>