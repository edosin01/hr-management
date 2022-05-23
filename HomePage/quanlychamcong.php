<?php
  include 'dbconfig.php';
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Bảng chấm công</title>
    
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"/>
    <link href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" rel="stylesheet"/>
    <link rel="icon" href="../assets/img/metaverse_logo.png" type="image/x-icon">
    <link rel="stylesheet" href="../assets/font/bootstrap.css" />
    <link rel="stylesheet" href="../assets/font/bootstrap-icons.css" />
    <link rel="stylesheet" href="./style2.css" />
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
        <div class="container-fluid">
          <a class="navbar-brand clwhite navbar-title">Bảng chấm công hàng tháng</a>
        </div>
        <!-- End: Thanh tiêu đề -->

        <!-- Begin: Filter -->
        <div class="container-fluid">
          <div class="row filter">
            <div class="col-4 d-flex flex-column">
              <label for="fil-time">Thời gian</label>
              <div class="input-group mb-3">
                <input
                  id="fil-time"
                  type="text"
                  class="form-control"
                  aria-label="Sizing example input"
                  aria-describedby="inputGroup-sizing-default"
                />
              </div>
            </div>
            <div class="col-6">
              <label for="fil-name">Họ tên nhân viên</label>
              <div class="input-group mb-3">
                <input
                  id="fil-name"
                  type="text"
                  class="form-control"
                  aria-label="Sizing example input"
                  aria-describedby="inputGroup-sizing-default"
                />
              </div>
            </div>
            <div class="col btn-filter">
              <button type="button" class="btn btn-secondary">
                Lọc <i class="bi bi-sort-down"></i>
              </button>
            </div>
          </div>
        </div>
        <!-- End: Filter -->

        <!-- Begin: Chấm công -->
        <div class="row">
          <div class="col-md-12">
            <div class="row filter">
              <div class="col-sm-12">
                <div class="cc-info">
                  Bảng chấm công nhân viên <br>
                  Thời gian: <?php echo date("m/Y") ?>
                  <div class="dataTables_length" id="sampleTable_length">
                    <label>Show
                      <select name="sampleTable_length" aria-controls="sampleTable" class="form-control-sm">
                        <option value="10">10</option>
                        <option value="25">25</option>
                        <option value="50">50</option>
                        <option value="100">100</option>
                      </select>
                      entries</label>
                  </div>
                </div>
                <table class="table bgwhite table-striped table-responsive table-hover table-bordered js-copytextarea" cellpadding="0" cellspacing="0" border="0">
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th class="table-name">Họ và tên nhân viên</th>
                      <?php
                        for($i = 1; $i <= date ("d"); $i++) {
                          if($i < 10)
                            echo "<th>0" .$i ."</th>";
                          else
                            echo "<th>" .$i ."</th>";
                        }
                        echo "<th>Tổng ngày đi làm</th>";
                      ?>
                    </tr>
                  </thead>
                  <tbody>
                  <?php
                      $sql = "select * from nhanvien order by maNV";
                      $result = mysqli_query($conn, $sql);
                      if($result->num_rows > 0) {
                        while ($row = mysqli_fetch_array($result)) {
                          echo "<tr>";
                          echo "<td>" .$row['maNV'] ."</td>";
                          echo "<td class='table-name'>" .$row['tenNV'] ."</td>";
                          $count = 0;
                          for($i = 1; $i <= date ("d"); $i++) {
                              $rand = rand(1, 4);
                              if($rand == 1)
                                echo "<td style='color: #f00;'>v</td>";
                              else {
                                echo "<td>x</td>";
                                $count++;
                              }
                            }
                          echo "<td class='table-sum'>" .$count ."</td>";
                          echo "</tr>";
                        }
                      }
                    ?>
                    <!-- <tr>
                      <td class="table-name">Trần Đức Anh</td>
                      <td>x</td>
                      <td>x</td>
                      <td>x</td>
                      <td>x</td>
                      <td>x</td>
                      <td>x</td>
                      <td>x</td>
                      <td>x</td>
                      <td>v</td>
                      <td>x</td>
                      <td>x</td>
                      <td>x</td>
                      <td>x</td>
                      <td>x</td>
                      <td>x</td>
                      <td>x</td>
                      <td>x</td>
                      <td>v</td>
                      <td>x</td>
                      <td>x</td>
                      <td>x</td>
                      <td>x</td>
                      <td>x</td>
                      <td>x</td>
                      <td>v</td>
                      <td>v</td>
                      <td>x</td>
                      <td>x</td>
                      <td>x</td>
                      <td>x</td>
                      <td>x</td>
                      <td class="table-sum">27</td>
                    </tr>
                    <tr>
                      <td class="table-name">Trần Đức Anh</td>
                      <td>x</td>
                      <td>x</td>
                      <td>x</td>
                      <td>x</td>
                      <td>x</td>
                      <td>x</td>
                      <td>x</td>
                      <td>x</td>
                      <td>v</td>
                      <td>x</td>
                      <td>x</td>
                      <td>x</td>
                      <td>x</td>
                      <td>x</td>
                      <td>x</td>
                      <td>x</td>
                      <td>x</td>
                      <td>v</td>
                      <td>x</td>
                      <td>x</td>
                      <td>x</td>
                      <td>x</td>
                      <td>x</td>
                      <td>x</td>
                      <td>v</td>
                      <td>v</td>
                      <td>x</td>
                      <td>x</td>
                      <td>x</td>
                      <td>x</td>
                      <td>x</td>
                      <td class="table-sum">27</td>
                    </tr> -->
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
