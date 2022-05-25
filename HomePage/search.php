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
    <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous"> -->
    
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
            <a href="#" class="right-arrow">
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
        <!-- List nhân viên --> 
        <?php
          if(isset($_GET['filter'])) 
            $_filter = $_GET['filter'];
        ?>
        <div class="row">
            <div class="col-md-12">
                <div class="row" id="ds-table">
                    <div class="col-sm-12">
                    <span class="table-title">Kết quả trả về cho từ khoá "<?php echo $_filter; ?>"</span>
                        <table class="table table-hover table-responsive table-bordered js-copytextarea" cellpadding="0" cellspacing="0" border="0">
                            <thead>
                              <tr>
                                <th>STT <i class="bi bi-sort-down"></i></th>
                                <th>Mã nhân viên</th>
                                <th>Ảnh thẻ</th>
                                <th class="table-hoten">Họ và tên</th>
                                <th class="table-address">Địa chỉ</th>
                                <th>Liên hệ</th>
                                <th>Vai trò</th>
                                <th class="table-status">Trạng thái</th>
                                <th class="table-act">Hành động</th>
                              </tr>
                            </thead>

                            <tbody>
                            <?php
                              $sql = "select * from (SELECT nhanvien.maNV, avatar, tenNV, thanhPho, soDT, chucvu.tenChucVu FROM nhanvien INNER JOIN chucvu WHERE nhanvien.maChucVu = chucvu.maChucVu order by maNV) as a where a.tenNV like '%" .$_filter ."%'";
                              $result = $conn->query($sql);
                              $i = 0;
                              if($result->num_rows > 0) {
                                while($row = $result->fetch_assoc()){
                                  ?>
                                  <tr>
                                    <td><?php echo ++$i; ?></td>
                                    <td><?php echo $row['maNV'] ?></td>
                                    <td><?php echo '<img src="data:image;base64,'.base64_encode($row['avatar']) .'" alt="image" style="width:100px;height:100px;" >'; ?></td>
                                    <td><?php echo $row['tenNV'] ?></td>
                                    <td><?php echo $row['thanhPho'] ?></td>
                                    <td><?php echo $row['soDT'] ?></td>
                                    <td><?php echo $row['tenChucVu'] ?></td>
                                    <?php
                                      $rand = rand(1, 4);
                                      if($rand == 1)
                                        echo "<td class='text-center'><span class='table-status-emp status-off'>Không đi làm</span></td>";
                                      else
                                        echo "<td class='text-center'><span class='table-status-emp status-on'>Đang đi làm</span></td>";
                                    ?>
                                    <td class='table-td-center'><a class="btn-form" href="update.php?id=<?php echo $row['maNV'] ?>">
                                      <button class='btn btn-primary btn-sm edit' type='button' title='Sửa'>
                                        <i class='fas fa-edit'></i>
                                      </button>
                                    </a>
                                    <a class="btn-form" href="../Controller/delete_nv.php?delete=<?php echo $row['maNV'] ?>">
                                      <button class='btn btn-primary btn-sm trash' type='button' title='Xóa'>
                                        <i class='fas fa-trash-alt'></i>
                                      </button>
                                    </a></td>
                                  </tr>
                                  <?php
                                }
                              } 
                              else 
                                {
                            ?>
                            <tr>
                              <td colspan="9">Không có kết quả tìm kiếm nào trùng từ khoá "<?php echo $_filter; ?>" </td>
                            </tr>
                              <?php }?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
              <!-- <div class="list-nv">
                <div class="container-nv">
                  <h1 style="text-align: center ;">Kết quả trả về cho từ khoá "<?php echo $_filter; ?>"</h1>
                  <table class="table table-hover table-responsive">
                    <thead class="thead-dark">
                        <tr>
                            <th>ID</th>
                            <th>Ảnh</th>
                            <th>Tên NV</th>
                            <th>Địa Chỉ</th>
                            <th>Số ĐT</th>
                            <th>Chức vụ</th>
                            <th>Trạng thái</th>
                            <th>Hành động</th>
                        </tr>
                    </thead>
                    <tbody>
                      <?php
                        $sql = "select * from (SELECT nhanvien.maNV, avatar, tenNV, thanhPho, soDT, chucvu.tenChucVu FROM nhanvien INNER JOIN chucvu WHERE nhanvien.maChucVu = chucvu.maChucVu order by maNV) as a where a.tenNV like '%" .$_filter ."%'";
                        $result = $conn->query($sql);
                        if($result->num_rows > 0) {
                          while($row = $result->fetch_assoc()){
                            ?>
                            <tr>
                              <td><?php echo $row['maNV'] ?></td>
                              <td><?php echo '<img src="data:image;base64,'.base64_encode($row['avatar']) .'" alt="image" style="width:100px;height:100px;" >'; ?></td>
                              <td><?php echo $row['tenNV'] ?></td>
                              <td><?php echo $row['thanhPho'] ?></td>
                              <td><?php echo $row['soDT'] ?></td>
                              <td><?php echo $row['tenChucVu'] ?></td>
                              <td class='text-center'><span class='table-status-emp status-on'>Đang đi làm</span></td>
                              <td><a class="btn btn-info" href="update.php?id= <?php echo $row['maNV'] ?>">Edit</a>
                              &nbsp;
                              <a class="btn btn-danger"href="delete.php?id=<?php echo $row['maNV'] ?>">Delete</a></td>
                            </tr>
                            <?php
                          }
                        } 
                        else 
                          {
                      ?>
                      <tr>
                        <td colspan="8">Không có kết quả tìm kiếm nào trùng từ khoá "<?php echo $_filter; ?>" </td>
                      </tr>
                      <?php }?>
                    </tbody>
                  </table>
                </div>
              </div> -->
      </div>
    </div>
    
        
  </body>
</html>