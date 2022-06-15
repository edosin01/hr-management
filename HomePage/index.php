<?php
  ob_start();
  session_start();
  if(!isset($_SESSION['login'])) {
    header("location: login.php");
  }
  include 'dbconfig.php';
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Metaverse</title>

    <link rel="icon" href="../assets/img/metaverse_logo.png" type="image/x-icon">
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"/>
    <link href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" rel="stylesheet"/>
    <!-- CSS only -->
    <link rel="stylesheet" href="../assets/font/bootstrap.css" />
    <link rel="stylesheet" href="../assets/font/bootstrap-icons.css" />
    <link rel="stylesheet" href="./style2.css"/>
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
            <a class="navbar-brand clwhite navbar-title">Tổng quan</a>
            <form class="d-flex form-search" method="get" action='search.php'>
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

        <div class="container">
          <div class="row text-center items">
            <a href="./dsnhanvien.php" class="col-sm mg6 d-flex item" style="background-color: #CF2B2B;">
              <div class="col-7 d-flex flex-column item-info">
                <span class="num"><?php
                  $sql = "SELECT * FROM `nhanvien` INNER JOIN chucvu WHERE nhanvien.maChucVu = chucvu.maChucVu;";
                  $result = mysqli_query($conn, $sql);
                  if($result->num_rows < 10)
                    echo "0" .$result->num_rows;
                  else
                    echo $result->num_rows;
                ?></span>
                <span class="te">Nhân viên</span>
              </div>
              <div class="col-5 flex-column item-logo">
                <i class="bi bi-person-lines-fill icon-item"></i>
              </div>
            </a>
            <a href="#ds-table" class="col-sm mg6 d-flex item" style="background-color: #42A8C8;">
              <div class="col-7 d-flex flex-column item-info">
                <span class="num">
                  <?php
                    $sql_pb = "SELECT * FROM phongban";
                    $result = mysqli_query($conn, $sql_pb);
                    if($result->num_rows < 10)
                      echo "0" .$result->num_rows;
                    else
                      echo $result->num_rows;
                  ?>
                </span>
                <span class="te">Phòng ban</span>
              </div>
              <div class="col-5 flex-column item-logo">
                <i class="bi bi-bank icon-item"></i>
              </div>
            </a>
            <a href="#" class="col-sm mg6 d-flex item" style="background-color: #45D84B;">
              <div class="col-7 d-flex flex-column item-info">
                <span class="num">
                <?php
                    $sql_tk = "select * FROM taikhoan";
                    $result_tk = mysqli_query($conn, $sql_tk);
                    if($result_tk->num_rows < 10)
                      echo "0" .$result_tk->num_rows;
                    else
                      echo $result_tk->num_rows;
                  ?>
                </span>
                <span class="te">Tài khoản</span>
              </div>
              <div class="col-5 flex-column item-logo">
                <i class="bi bi-person-plus-fill icon-item"></i>
              </div>
            </a>
          </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="row" id="ds-table">
                  <div class="col-sm-12">
                      <div class="element-button d-flex">
                        <span class="table-title">Danh sách phòng ban</span>
                        <div class="col-s-2">
                          <a class="btn btn-add btn-sm" href="./form_thempb.php" title="Thêm"><i class="fas fa-plus"></i>
                            Tạo mới phòng ban</a>
                        </div>
                      </div>
                        <table class="table table-hover table-responsive table-wrapper table-bordered js-copytextarea" cellpadding="0" cellspacing="0" border="0">
                            <thead class="table-sticky">
                                <tr>
                                    <th>Mã phòng</th>
                                    <th>Tên phòng ban</th>
                                    <th>Mã trưởng phòng</th>
                                    <th class="table-hoten">Họ và tên</th>
                                    <th>Ảnh đại diện</th>
                                    <th>Liên hệ</th>
                                    <th>Số lượng nhân viên</th>
                                    <th class="table-act">Hành động</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                              $sql = "SELECT phongban.maPhongBan, tenPhongBan, maTruongP, tenNV, avatar, soDT
                                FROM phongban, nhanvien
                                WHERE nhanvien.maNV = phongban.maTruongP OR phongban.maTruongP IS NULL
                                GROUP BY phongban.maPhongBan HAVING COUNT(phongban.maPhongBan) >= 1
                                ORDER by phongban.maPhongBan;";
                              $result = mysqli_query($conn, $sql);
                              if($result->num_rows > 0) {
                                while ($row = mysqli_fetch_assoc($result)) {
                                  $sql_slnv = "select COUNT(maNV) as SL FROM nhanvien WHERE maPhongBan = '" . $row['maPhongBan'] ."'";
                                  $query = mysqli_query($conn, $sql_slnv);
                                  $slnv = mysqli_fetch_assoc($query);
                                  if($row['maTruongP'] != NULL) {
                                    echo "<tr>";
                                    echo "<td>". $row['maPhongBan']."</td>";
                                    echo "<td>". $row['tenPhongBan']."</td>";
                                    echo "<td>". $row['maTruongP']."</td>";
                                    echo "<td>". $row['tenNV']."</td>";
                                    echo '<td><img src="data:image;base64,'.base64_encode($row['avatar']) .'" alt="image" style="width:100px;height:100px;" ></td>';
                                    echo "<td>". $row['soDT']."</td>";
                                    echo "<td>". $slnv['SL'] ."</td>";
                                    echo"<td class='table-td-center'>
                                      <a class='btn-form' href='./chitiet_phongban.php?update=" .$row['maPhongBan'] ."'>
                                        <button class='btn btn-primary btn-sm edit' type='button' title='Sửa'>
                                          <i class='fas fa-edit'></i>
                                        </button>
                                      </a>
                                      <a class='btn-form' onclick='return confirm('Bạn có chắc muốn xóa bản ghi này?')' href='../Controller/delete_pb.php?delete=" .$row['maPhongBan'] ."'>
                                        <button class='btn btn-primary btn-sm trash' type='button' title='Xóa'>
                                          <i class='fas fa-trash-alt'></i>
                                        </button>
                                      </a></td>";
                                    echo "</tr>";
                                  }
                                  else {
                                    echo "<tr>";
                                    echo "<td>". $row['maPhongBan']."</td>";
                                    echo "<td>". $row['tenPhongBan']."</td>";
                                    echo "<td>Trống</td>";
                                    echo "<td>Trống</td>";
                                    echo "<td>Trống</td>";
                                    echo "<td>Trống</td>";
                                    echo "<td>". $slnv['SL'] ."</td>";
                                    echo"<td class='table-td-center'>
                                      <a class='btn-form' href='./chitiet_phongban.php?update=" .$row['maPhongBan'] ."'>
                                        <button class='btn btn-primary btn-sm edit' type='button' title='Sửa'>
                                          <i class='fas fa-edit'></i>
                                        </button>
                                      </a>
                                      <a class='btn-form' href='../Controller/delete_pb.php?delete=" .$row['maPhongBan'] ."' onclick='return confirm('Bạn có chắc muốn xóa bản ghi này?')'>
                                        <button class='btn btn-primary btn-sm trash' type='button' title='Xóa'>
                                          <i class='fas fa-trash-alt'></i>
                                        </button>
                                      </a></td>";
                                    echo "</tr>";
                                  }
                                }
                              }
                              ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
      </div>
    </div>
    <script src="./main.js"></script>
  </body>
</html>
