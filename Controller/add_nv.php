<?php
    include '../HomePage/dbconfig.php';
    $id = addslashes($_POST['id']);
    $name = addslashes($_POST['name']);
    $address = addslashes($_POST['address']);
    
    $gender = addslashes($_POST['gender']);
    if($_gender == "Nam")
        $gender = addslashes(0);
    else
        $gender = addslashes(1);
    
    $email = addslashes($_POST['email']);
    $phone = addslashes($_POST['phone']);
    
    $job = addslashes($_POST['job']);
    $sql = "Select maChucVu from chucvu where tenChucVu = '$job'";
    $result = mysqli_query($conn, $sql);
    $res = mysqli_fetch_assoc($result);
    $job = addslashes($res['maChucVu']);
    
    $department = addslashes($_POST['department']);
    $sql = "Select maPhongBan from phongban where tenPhongBan = '$department'";
    $result = mysqli_query($conn, $sql);
    $res = mysqli_fetch_assoc($result);
    $department = addslashes($res['maPhongBan']);
    
    $salary = addslashes($_POST['salary']);
    $avatar = addslashes($_POST['ImageUpload']);
    $sql = "insert into nhanvien (maNV, tenNV, gioiTinh, avatar, thanhPho, soDT, email, maPhongBan,
        maChucVu, bacLuong) values ('$id', '$name', '$gender', '$avatar', '$address', '$phone',
        '$email', '$department', '$job', '$salary')";
    if (mysqli_query($conn, $sql)) {
        header("Location: ../HomePage/dsnhanvien.php");
    }
    else {
        echo "Lỗi: " . $sql . "<br>" . mysqli_error($conn);
    }
?>