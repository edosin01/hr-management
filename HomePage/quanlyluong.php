<?php
  include 'dbconfig.php';
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Quản lý tính lương</title>
    
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
            <a class="navbar-brand clwhite navbar-title">Bảng thống kế lương</a>
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

        <!-- Begin: Danh sách lương -->
        <div class="row">
          <div class="col-md-12">
            <div class="row element-button tinh-luong">
              <a href="./form_tinhluong.php"><button class="btn btn-success"><i class="fas fa-plus"></i>
                Tính lương</button></a>
              <form class="insert-file" method="post" enctype="multipart/form-data">
                <input type='file' name='file' id="getFile">
                <input class="btn btn-info cc-btn" type="submit" value="Xuất bảng lương"/>
              </form>
            </div>
          </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="row" id="ds-table">
                    <div class="col-sm-12">
                    <span class="table-title">Bảng tính lương</span>
                        <table class="table table-hover table-responsive table-bordered js-copytextarea" cellpadding="0" cellspacing="0" border="0">
                            <thead>
                              <tr>
                                  <th>Mã nhân viên</th>
                                  <th>Họ và tên nhân viên</th>
                                  <th>Ngày công</th>
                                  <th>Tiền lương</th>
                                  <th>Tiền phụ cấp</th>
                                  <th>Tiền thưởng</th>
                                  <th>Tiền phạt</th>
                                  <th>Tiền thực lĩnh</th>
                              </tr>
                            </thead>
                              <?php
                                use Shuchkin\SimpleXLSX;
                                require_once '../src/SimpleXLSX.php';
                                if (isset($_FILES['file'])) {
                                  if ($xlsx = SimpleXLSX::parse($_FILES['file']['tmp_name']))
                                  {
                                    $dim = $xlsx->dimension();
                                    $cols = $dim[0];
                                    foreach ($xlsx->readRows() as $k => $r) {
                                      if ($k == 0) continue; // skip first row
                                      
                                      echo '<tr>';
                                      for ($i = 0; $i < $cols; $i++) {
                                        if(isset($r[$i])) {
                                          if(gettype($r[$i]) == 'string')
                                            echo '<td>' .$r[$i] .'</td>';
                                          else
                                          echo '<td>' .number_format($r[$i]) .'</td>';
                                        }
                                        else {
                                          echo '<td>&nbsp</td>';
                                        }
                                      }
                                      echo '</tr>';
                                    }
                                  }
                                  else {
                                    echo SimpleXLSX::parseError();
                                  }
                                }
                              ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- End: Danh sách lương -->
      </div>
    </div>
    <script src="./main.js"></script>
  </body>
</html>
