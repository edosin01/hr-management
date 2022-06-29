<?php
    include '../HomePage/dbconfig.php';
    $sql = "SELECT hoso.maNV, MAX(ngayLuuChuyen) as ngayNhamChuc
    FROM hoso INNER JOIN (SELECT nhanvien.maNV FROM nhanvien WHERE nhanvien.tinhTrang = 1) AS d 
    ON d.maNV = hoso.maNV WHERE trangThai = 1 GROUP BY maNV";
    $result = mysqli_query($conn, $sql);
    if($result->num_rows > 0) {
        while($row = mysqli_fetch_array($result)) {
            $user_id = addslashes($row['maNV']);
            $ngayNhamChuc = addslashes($row['ngayNhamChuc']);
            $sql_update = "UPDATE hoso SET soNgayDamNhiem = DATEDIFF(CURRENT_DATE, '$ngayNhamChuc') WHERE maNV = '$user_id' AND ngayLuuChuyen = '$ngayNhamChuc'";
            if($result_update = mysqli_query($conn, $sql_update)) {
                echo "<script>
                window.location.href='../HomePage/dsnhanvien.php';
                alert('Cập nhật thâm niên thành công');
            </script>";
            }
            else {
                echo "Có lỗi";
            }
        }
    }
?>