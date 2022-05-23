<?php
  ob_start();
  session_start();
  if(!isset($_SESSION['login'])) {
    header("location: login.php");
  }
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
    <link rel="stylesheet" href="./responsive.css">
    <link rel="stylesheet" href="./style2.css"/>
    
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
            <form class="d-flex form-search">
              <input
                class="form-control me-2"
                type="search"
                placeholder="Search"
                aria-label="Search"
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
                    $sql = "select * FROM phongban inner join nhanvien WHERE nhanvien.maPhongBan = phongban.maPhongBan and nhanvien.maNV = phongban.maTruongP;";
                    $result = mysqli_query($conn, $sql);
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
                <span class="num">03</span>
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
                      <span class="table-title">Danh sách phòng ban</span>
                        <table class="table table-hover table-responsive table-bordered js-copytextarea" cellpadding="0" cellspacing="0" border="0">
                            <thead>
                                <tr>
                                    <th>Mã phòng</th>
                                    <th>Tên phòng ban</th>
                                    <th>Mã trưởng phòng</th>
                                    <th class="table-hoten">Họ và tên</th>
                                    <th>Ảnh đại diện</th>
                                    <th>Liên hệ</th>
                                    <th class="table-status">Trạng thái</th>
                                    <th class="table-act">Hành động</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                              if($result->num_rows > 0) {
                                while ($row = mysqli_fetch_assoc($result)) {
                                  echo "<tr>";
                                  echo "<td>". $row['maPhongBan']."</td>";
                                  echo "<td>". $row['tenPhongBan']."</td>";
                                  echo "<td>". $row['maTruongP']."</td>";
                                  echo "<td>". $row['tenNV']."</td>";
                                  echo '<td><img src="data:image;base64,'.base64_encode($row['avatar']) .'" alt="image" style="width:100px;height:100px;" ></td>';
                                  echo "<td>". $row['soDT']."</td>";
                                  $rand = rand(1, 3);
                                  if($rand == 1)
                                    echo "<td class='text-center'><span class='table-status-emp status-off'>Không đi làm</span></td>";
                                  else
                                    echo "<td class='text-center'><span class='table-status-emp status-on'>Đang đi làm</span></td>";
                                  echo "<td class='table-td-center'><button class='btn btn-primary btn-sm trash' type='button' title='Xóa'>
                                      <i class='fas fa-trash-alt'></i>
                                      </button>
                                      <button class='btn btn-primary btn-sm edit' type='button' title='Sửa' id='show-emp'
                                        data-toggle='modal' data-target='#ModalUP'><i class='fas fa-edit'></i>
                                      </button>
                                    </td>";
                                    echo "</tr>";
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

    <div class="modal js-modal close">
      <div class="modal-container js-modal-container text-center">
          <div class="modal-title m-title">Cảnh báo</div>
          <div class="modal-content m-content">Bạn có chắc chắn muốn xóa bản ghi này?</div>
          <div class="modal-btn">
            <button class="btn btn-save" type="button">Đồng ý</button>
            <button class="btn btn-cancel" type="button">Hủy bỏ</button>
          </div>
      </div>
    </div>
    <script src="main.js"></script>
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
      crossorigin="anonymous"
    ></script>
  </body>
</html>
