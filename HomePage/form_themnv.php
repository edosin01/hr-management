<?php
  include_once 'dbconfig.php';
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Thêm nhân viên mới</title>
    
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
            <a class="navbar-brand clwhite navbar-title">Thêm nhân viên mới</a>
            <form class="d-flex form-search" method="get">
              <input
                class="form-control me-2"
                type="search"
                placeholder="Search"
                aria-label="Search"
                name="filter"
                required
                value=""
              />
              <button class="btn btn-outline-success" type="submit">
                Search
              </button>
            </form>
          </div>
        </nav>
        <!-- End: Thanh tiêu đề -->

        <!-- Begin: Form thêm nhân viên -->
        <div class="row">
            <div class="col-md-12">
                <div class="row filter form-add">
                    <div class="col-sm-12">
                        <h4 class="form-add-title">Tạo nhân viên mới</h4>
                        <div class="form-add-content">
                            <form class="row" method="POST" action="../Controller/add_nv.php" enctype="multipart/form-data">
                                <div class="form-group col-md-4">
                                  <label class="control-label">ID nhân viên</label>
                                  <input name="id" class="form-control" type="text">
                                </div>
                                <div class="form-group col-md-4">
                                  <label class="control-label">Họ và tên</label>
                                  <input name="name" class="form-control" type="text" required="">
                                </div>
                                <div class="form-group col-md-4">
                                  <label class="control-label">Địa chỉ thường trú</label>
                                  <input name="address" class="form-control" type="text" required="">
                                </div>
                                <div class="form-group col-md-4">
                                  <label class="control-label">Giới tính</label>
                                  <select name="gender" class="form-control" id="exampleSelect2" required="">
                                    <option value="blank">-- Chọn giới tính --</option>
                                    <option value=1>Nam</option>
                                    <option value=0>Nữ</option>
                                  </select>
                                </div>
                                <div class="form-group col-md-4">
                                  <label class="control-label">Địa chỉ email</label>
                                  <input name="email" class="form-control" type="text" required="">
                                </div>
                                <div class="form-group col-md-4">
                                  <label class="control-label">Số điện thoại</label>
                                  <input name="phone" class="form-control" type="text" required="">
                                </div>
                                <div class="form-group  col-md-4">
                                  <label for="exampleSelect1" class="control-label">Chức vụ</label>
                                  <select name="job" class="form-control" id="exampleSelect1">
                                    <option>-- Chọn chức vụ --</option>
                                    
                                    <?php
                                      $sql = "SELECT * FROM chucvu";
                                      $resultchucvu = mysqli_query($conn, $sql);
                                    ?>
                                    <?php
                                      while ($row = mysqli_fetch_assoc($resultchucvu)) {
                                        echo "<option>". $row['tenChucVu']."</option>";
                                      }
                                    ?>
                                  </select>
                                </div>
                                <div class="form-group col-md-4">
                                  <label class="control-label">Phòng ban</label>
                                  <select name="department" class="form-control" id="exampleSelect3">
                                    <option>-- Chọn phòng ban --</option>
                                    <?php
                                      $sql = "SELECT * FROM phongban";
                                      $resultphongban = mysqli_query($conn, $sql);
                                    ?>
                                    <?php
                                      while ($row = mysqli_fetch_assoc($resultphongban)) {
                                        echo "<option>". $row['tenPhongBan']."</option>";
                                      } 
                                    ?>
                                  </select>
                                </div>
                                <div class="form-group col-md-4">
                                  <label class="control-label">Bậc lương</label>
                                  <select name="salary" class="form-control" id="exampleSelect3">
                                    <option>-- Chọn bậc lương --</option>
                                    <?php
                                      $sql = "SELECT * FROM luong";
                                      $resultluong = mysqli_query($conn, $sql);
                                    ?>
                                    <?php
                                      while ($row = mysqli_fetch_assoc($resultluong)) {
                                        echo "<option>". $row['bacLuong']."</option>";
                                      } 
                                    ?>
                                  </select>
                                </div>
                                <div class="form-group col-md-3">
                                  <label class="control-label">Mã hợp đồng</label>
                                  <input name="contract_id" class="form-control" type="text">
                                </div>
                                <div class="form-group col-md-3">
                                  <label class="control-label">Loại hợp đồng</label>
                                  <select name="contract_type" class="form-control" required="">
                                    <option value="blank">-- Chọn loại hợp đồng --</option>
                                    <option>Chính thức</option>
                                    <option>Thời vụ</option>
                                  </select>
                                </div>
                                <div class="form-group col-md-3">
                                  <label class="control-label">Ngày bắt đầu</label>
                                  <input name="date_start" class="form-control" value="<?php echo date('Y-m-d') ?>" type="date" required="">
                                </div>
                                <div class="form-group col-md-3">
                                  <label class="control-label">Ngày kết thúc</label>
                                  <input name="date_end" class="form-control" type="date" required="">
                                </div>
                  
                                <div class="form-group col-md-12">
                                  <label class="control-label">Ảnh 3x4 nhân viên</label>
                                  <div id="myfileupload">
                                    <input type="file" id="uploadfile" name="ImageUpload" onchange="readURL(this);">
                                  </div>
                                </div>
                                <div class="form-add-btn text-center">
                                  <button name="add_emp" class="btn btn-save" type="submit">Lưu lại</button>
                                  <a class="btn btn-cancel" href="./dsnhanvien.php">Hủy bỏ</a>
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
