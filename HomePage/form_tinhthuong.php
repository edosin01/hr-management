<?php
    include 'dbconfig.php';
    if(isset($_GET['thuong'])) {
        $user_id = addslashes($_GET['thuong']);
        $time = addslashes($_GET['time']);
        $sql = "SELECT nhanvien.maNV, tenNV, chucvu.tenChucVu
            FROM nhanvien INNER JOIN chucvu on chucvu.maChucVu = nhanvien.maChucVu
            WHERE nhanvien.maNV = '$user_id';";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);
    }
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Tính thưởng</title>
    
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"/>
    <link href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" rel="stylesheet"/>
    <link rel="icon" href="../assets/img/metaverse_logo.png" type="image/x-icon">
    <link rel="stylesheet" href="../assets/font/bootstrap.css">
    <link rel="stylesheet" href="../assets/font/bootstrap-icons.css">
    <link rel="stylesheet" href="./style2.css">
    <link rel="stylesheet" href="./responsive.css">
  </head>
  <body>
    <div class="main">
      <div id="menu" class="close-nav">
        <div class="acc">
          <img
            class="avatar"
            src="../assets/img/avatar_account.webp"
            alt="Lỗi hiển thị"
          />
          <div class="info clwhite">
            <span class="name">ADMIN1</span><br />
            <span class="status"
              ><img src="../assets/img/green_dot.png" alt="" width="15px" />
              Đang hoạt động</span
            >
          </div>
          <i class="bi bi-list icon-menu icon-menu-close clwhite"></i>
        </div>

        <ul id="nav">
          <li>
            <a href="./index.php" class="right-arrow">
              <i class="bi bi-book icons"></i> Menu chính
            </a>
          </li>
          <li>
            <a href="./dsnhanvien.php" class="right-arrow">
              <i class="bi bi-person-fill icons"></i> Quản lý nhân viên
            </a>
          </li>
          <li>
            <a href="./quanlychamcong.php" class="right-arrow">
              <i class="bi bi-calendar-check-fill icons"></i> Quản lý lịch làm
              việc
            </a>
          </li>
          <li>
            <a href="./quanlyluong.php" class="right-arrow">
              <i class="bi bi-cash-coin icons"></i> Quản lý lương
            </a>
          </li>
          <li>
            <a href="./khenthuong_kyluat.php" class="right-arrow">
              <i class="bi bi-star-fill icons"></i> Khen thưởng, kỷ luật
            </a>
          </li>
          <li>
            <a href="#" class="right-arrow">
              <i class="bi bi-people icons"></i> Quản lý tài khoản
            </a>
          </li>
        </ul>
      </div>
      <div id="content">
        <!-- Begin: Navbar -->
        <div class="navbar clwhite">
          <div class="nav-left">
            <i class="bi bi-list icon-menu clwhite"></i>
          </div>
          <div class="nav-right">
            <i class="bi bi-chat-left-dots-fill icons mg6"></i>
          <i class="bi bi-bell icons mg6"></i>
          <img
            class="avatar mg6"
            src="../assets/img/avatar_account.webp"
            alt="Lỗi hiển thị"
          />
          <span class="mg6">Admin 1</span>
          <a href="logout.php" class="clwhite log-out-btn">          
            <i class="bi bi-box-arrow-in-right icons mg6 log-out-icon"></i>
          </a>
          </div>
        </div>
        <!-- End: Navbar -->

        <!-- Begin: Thanh tiêu đề -->
        <nav class="navbar tieude">
          <div class="container-fluid">
            <a class="navbar-brand clwhite navbar-title">Chi tiết phòng ban</a>
            <form class="d-flex form-search">
              <input
                class="form-control me-2"
                type="month"
                name="time_luong"
              />
              <button class="btn btn-outline-success" type="submit">Tính lương</button>
            </form>
          </div>
        </nav>
        <!-- End: Thanh tiêu đề -->

        <!-- Begin: Form sửa phòng ban -->
        <div class="row">
            <div class="col-md-12">
                <div class="row filter form-add">
                    <div class="col-sm-12">
                        <h4 class="form-add-title">Lương thưởng nhân viên</h4>
                        <div class="form-add-content">
                            <form class="row" method="POST" action="./form_tinhluong.php?time_luong=<?php echo $time ?>" enctype="multipart/form-data">
                              <div class="form-group col-md-4">
                                <label class="control-label">ID nhân viên</label>
                                <?php echo "<input readonly='true' name='id' class='form-control' type='text' value='" .$row['maNV'] ."'>"; ?>
                              </div>
                              <div class="form-group col-md-4">
                                <label class="control-label">Tên nhân viên</label>
                                <?php echo "<input name='name' readonly class='form-control' type='text' required='' value='" .$row['tenNV'] ."'>"; ?>
                              </div>
                              <div class="form-group col-md-4">
                                <label class="control-label">Chức vụ</label>
                                <?php echo "<input name='job' readonly class='form-control' type='text' required='' value='" .$row['tenChucVu'] ."'>"; ?>
                              </div>
                              <div class="form-group col-md-4">
                                <label class="control-label">Danh sách khen thưởng</label><br>
                                <?php
                                    $sql = "SELECT * FROM khenthuong";
                                    $query = mysqli_query($conn, $sql);
                                    if($query->num_rows > 0) {
                                    while ($thuong = mysqli_fetch_array($query)) {
                                ?>
                                <input type="checkbox" id="thuong<?php echo $thuong['ID_KhenThuong'] ?>"
                                    class="cbox_thuong_phat" name="thuong[]"
                                    value = <?php echo $thuong['tienThuong'] ?> >
                                <label for="thuong<?php echo $thuong['ID_KhenThuong'] ?>">
                                    <?php echo $thuong['noiDung'] ." - " .$thuong['tienThuong'] ?>
                                </label>
                                <br>
                                
                                <?php
                                    }
                                  }
                                ?>
                              </div>

                              <div class="form-add-btn text-center col-md-12">
                                <button name="add_emp" class="btn btn-save" type="submit">Xác nhận</button>
                                <a class="btn btn-cancel" href="./form_tinhluong.php?time_luong=<?php echo $time ?>">Hủy bỏ</a>
                              </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
      </div>
    </div>
    <script src="./main.js"></script>
  </body>
</html>