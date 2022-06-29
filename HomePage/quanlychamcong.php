<?php
  include 'dbconfig.php';
  $month = date('m');
  $year = date('Y');
  $default_file = '../assets/SourceFile/chamcong_t' .$month .'_' .$year .'.xlsx';
  $d_file = 'chamcong_t' .$month .'_' .$year .'.xlsx';
  $check_file = true;
  if (isset($_FILES['file'])) {
    if($_FILES['file']['name'] != $d_file) {
      $check_file = false;
    }
  }
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
                  type="date"
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
                  <div class="cc-in4">
                    Bảng chấm công nhân viên <br>
                    Today: <?php echo date("d/m/Y") ?>
                  </div>
                  <button class="btn btn-info cc-btn" <?php if ($check_file == false){ ?> disabled <?php   } ?> >Chấm công</button>
                </div>
                <div>
                  <form class="insert-file d-flex" method="post" enctype="multipart/form-data">
                    <input type="file" name="file"/>
                    <input class="btn btn-info cc-btn" type="submit" value="Xuất"/>
                  </form>
                </div>
                <table class="table bgwhite table-striped table-responsive table-hover table-bordered table-wrapper js-copytextarea" cellpadding="0" cellspacing="0" border="0">
                  <thead class="table-sticky">
                    <tr>
                      <th>ID</th>
                      <th class="table-name">Họ và tên nhân viên</th>
                      <?php
                        for($i = 1; $i <= 31; $i++) {
                          if($i < 10)
                            echo "<th>0" .$i ."</th>";
                          else
                            echo "<th>" .$i ."</th>";
                        }
                        echo "<th  class='table-sum'>Tổng ngày đi làm</th>";
                      ?>
                    </tr>
                  </thead>
                  <tbody>
                  <?php
                    use Shuchkin\SimpleXLSX;
                    require_once '../src/SimpleXLSX.php';
                    $data = array(); // Danh sách chấm công
                    $row = 0;
                    if (isset($_FILES['file'])) { // Chọn bảng chấm công bất kì
                      if ($xlsx = SimpleXLSX::parse($_FILES['file']['tmp_name']))
                      {
                        if($_FILES['file']['name'] != $d_file) {
                          $check_file = false;
                        }
                        $dim = $xlsx->dimension();
                        $cols = $dim[0];
                        
                        foreach ($xlsx->readRows() as $k => $r) {
                          if ($k == 0) continue; // skip first row
                          
                          echo '<tr>';
                          for ($i = 0; $i < $cols; $i++) {
                            if(isset($r[$i])) {
                              if($r[$i] == "v" || $r[$i] == "CN")
                                echo '<td style="color: red; font-weight: bold;">' . $r[$i]. '</td>';
                              else
                                echo '<td>' . $r[$i]. '</td>';
                              $data[$row][$i] = $r[$i];
                            }
                            else {
                              echo '<td>&nbsp</td>';
                              $data[$row][$i] = '&nbsp';
                            }
                          }
                          $row++;
                          echo '</tr>';
                        }
                      }
                      else {
                        echo SimpleXLSX::parseError();
                      }
                    }
                    else { // Hiện default, mỗi tháng một bảng chấm công mới
                      if ($xlsx = SimpleXLSX::parse($default_file))
                      {
                        $dim = $xlsx->dimension();
                        $cols = $dim[0];
                        
                        foreach ($xlsx->readRows() as $k => $r) {
                          if ($k == 0) continue; // skip first row
                          
                          echo '<tr>';
                          for ($i = 0; $i < $cols; $i++) {
                            if(isset($r[$i])) {
                              if($r[$i] == "v" || $r[$i] == "CN")
                                echo '<td style="color: red; font-weight: bold;">' . $r[$i]. '</td>';
                              else
                                echo '<td>' . $r[$i]. '</td>';
                              $data[$row][$i] = $r[$i];
                            }
                            else {
                              echo '<td>&nbsp</td>';
                              $data[$row][$i] = '&nbsp';
                            }
                          }
                          $row++;
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
      </div>
    </div>
    <div class="modal js-modal close">
      <form method="POST" enctype="multipart/form-data">
        <div class="modal-container js-modal-container text-center">
            <div class="modal-title m-title">Chấm công ngày <?php echo date("d/m/Y") ?></div>
            <div class="modal-content m-content" data-spy="scroll">
              <table class="table bgwhite table-striped table-responsive table-hover table-bordered table-wrapper js-copytextarea" cellpadding="0" cellspacing="0" border="0">
                <thead class="table-sticky">
                  <tr>
                    <th>ID</th>
                    <th class="table-name">Họ và tên nhân viên</th>
                    <th>Tình trạng đi làm</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                    $sql = "SELECT maNV, tenNV FROM nhanvien";
                    $query = mysqli_query($conn, $sql);
                    $date = date('d');
                    if($query->num_rows > 0) {
                      $r = 0;
                      while($row = mysqli_fetch_array($query)) {
                  ?>
                  <tr>
                    <td><?php echo $row['maNV']?></td>
                    <td><?php echo $row['tenNV']?></td>
                    <td>
                    
                      <?php
                        $today = date('Y-m-d');
                        $newDate = date('l', strtotime($today));
                        
                        if($data[$r][$date+1] == "v") {
                          echo "<input class='mg6' type='radio' name='status" . $r."' value='x'>Đi làm</input>";
                          echo "&nbsp&nbsp&nbsp";
                          echo "<input class='mg6' type='radio' name='status" . $r."' value='v' checked='checked'>Vắng mặt</input>";
                          echo "&nbsp&nbsp&nbsp";
                          echo "<input class='mg6' type='radio' disabled name='status" . $r."' value='CN'>Chủ nhật</input>";
                        }
                        else if($newDate == "Sunday") {
                          echo "<input class='mg6' disabled type='radio' name='status" . $r."' value='x'>Đi làm</input>";
                          echo "&nbsp&nbsp&nbsp";
                          echo "<input class='mg6' disabled type='radio' name='status" . $r."' value='v'>Vắng mặt</input>";
                          echo "&nbsp&nbsp&nbsp";
                          echo "<input class='mg6' type='radio' name='status" . $r."' value='CN' checked='checked'>Chủ nhật</input>";
                        }
                        else {
                          echo "<input class='mg6' type='radio' name='status" . $r."' value='x' checked='checked'>Đi làm</input>";
                          echo "&nbsp&nbsp&nbsp";
                          echo "<input class='mg6' type='radio' name='status" . $r."' value='v'>Vắng mặt</input>";
                          echo "&nbsp&nbsp&nbsp";
                          echo "<input class='mg6' type='radio' disabled name='status" . $r."' value='CN'>Chủ nhật</input>";
                        }
                      ?>
                    </td>
                  </tr>
                  <?php
                        $r++;
                      }
                    }
                  ?>
                </tbody>
              </table>
            </div>
            <div class="modal-btn">
              <input name="save-btn" class="btn btn-save" type="submit" value="Lưu lại">
              <input name="cancel-btn" class="btn btn-cancel" type="button" value="Hủy bỏ">
            </div>
        </div>
      </form>
    </div>
    <?php
      if(array_key_exists('save-btn', $_POST)) {
        require('../src/PHPExcel.php');
        ghi_file($data);
      }
      
      function ghi_file($data) {
        $month = date('m');
        $year = date('Y');
        $phpExcel = PHPExcel_IOFactory::load('../assets/SourceFile/chamcong_t' .$month .'_' .$year .'.xlsx');
        // Get the first sheet
        $sheet = $phpExcel ->getActiveSheet();
        
        $row = $sheet->getHighestRow();
        $date = date('d');
        for($vt = 0; $vt < $row-1; $vt++) {
          $vari = 'status'.(string)$vt;
          // row tính từ 1, col tính từ 0
          $sheet->setCellValueByColumnAndRow($date+1, $vt+2, $_POST[$vari]);
          $data[$vt][$date+1] = $_POST[$vari];
        }
        $writer = PHPExcel_IOFactory::createWriter($phpExcel, "Excel2007");
        $writer->setPreCalculateFormulas(true);
        // Save the spreadsheet
        
        $writer->save('../assets/SourceFile/chamcong_t' .$month .'_' .$year .'.xlsx');
        echo "<script>
            window.location.href='./quanlychamcong.php';
            alert('Cập nhật thành công');
        </script>";
      }
    ?>
    <script src="./main.js"></script>
  </body>
</html>
