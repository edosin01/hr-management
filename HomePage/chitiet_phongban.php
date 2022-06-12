<?php
    include 'dbconfig.php';
    if(isset($_GET['update'])) {
        $de_id = addslashes($_GET['update']);
        $sql = "SELECT * FROM phongban where maPhongBan = '$de_id'";
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
    <title>Chi tiết phòng ban</title>
    
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

        <!-- Begin: Form sửa phòng ban -->
        <div class="row">
            <div class="col-md-12">
                <div class="row filter form-add">
                    <div class="col-sm-12">
                        <h4 class="form-add-title">Thông tin chi tiết phòng ban</h4>
                        <div class="form-add-content">
                            <form class="row" method="POST" action="../Controller/sua_pb.php" enctype="multipart/form-data">
                                <div class="form-group col-md-4">
                                  <label class="control-label">ID phòng ban</label>
                                  <?php echo "<input readonly='true' name='id' class='form-control' type='text' value='" .$row['maPhongBan'] ."'>"; ?>
                                </div>
                                <div class="form-group col-md-4">
                                  <label class="control-label">Tên phòng ban</label>
                                  <?php echo "<input name='name' class='form-control' type='text' required='' value='" .$row['tenPhongBan'] ."'>"; ?>
                                </div>
                                <div class="form-group col-md-4">
                                  <label class="control-label">Số lượng nhân sự</label>
                                  <?php
                                    $sql_slnv = "select COUNT(maNV) as SL FROM nhanvien WHERE maPhongBan = '" . $row['maPhongBan'] ."'";
                                    $query_slnv = mysqli_query($conn, $sql_slnv);
                                    $slnv = mysqli_fetch_assoc($query_slnv);
                                    echo "<input readonly name='sl' class='form-control' type='text' value='" .$slnv['SL'] ."'>";
                                  ?>
                                </div>
                                <div class="form-group col-md-4">
                                  <label for="exampleSelect1" class="control-label">Trưởng phòng</label>
                                  <select name="leader" class="form-control" id="exampleSelect1">
                                    <option value="blank">-- Chọn trưởng phòng --</option>
                                    <?php
                                        $sql_nv = "SELECT maNV, tenNV FROM nhanvien";
                                        $result_nv = mysqli_query($conn, $sql_nv);
                                    ?>
                                    <?php
                                      while ($row_nv = mysqli_fetch_assoc($result_nv)) {
                                        if($row['maTruongP'] == $row_nv['maNV'])
                                            echo "<option selected='selected' value = '".$row_nv['maNV']."'>". $row_nv['maNV'] . " - " .$row_nv['tenNV']."</option>";
                                        else
                                            echo "<option value='".$row_nv['maNV'] ."'>". $row_nv['maNV'] . " - " .$row_nv['tenNV']."</option>";
                                      }
                                    ?>
                                  </select>
                                </div>
                                <div class="form-group col-md-4">
                                  <label class="control-label">Số điện thoại</label>
                                  <?php echo "<input name='phone' class='form-control' type='text' required='' value='" .$row['soDienThoai'] ."'>"; ?>
                                </div>

                                <div class="form-add-btn text-center col-md-12">
                                  <button name="add_emp" class="btn btn-save" type="submit">Chỉnh sửa</button>
                                  <a class="btn btn-cancel" href="./index.php">Hủy bỏ</a>
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