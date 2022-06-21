<?php
  session_start();
  if(!isset($_SESSION['thuong']))
    $_SESSION['thuong'] = [];
  if(!isset($_SESSION['phat']))
    $_SESSION['phat'] = [];

  $sum_thuong = 0;
  $sum_phat = 0;
  $id_nv = '';

  if(isset($_POST['thuong']) && isset($_POST['id'])) {
    $money = $_POST['thuong'];
    $id_nv = $_POST['id'];
    foreach ($money as $v) { 
      $sum_thuong += $v;
    }
    $_SESSION['thuong'][$id_nv] = $sum_thuong;
  }
  
  if(isset($_POST['phat']) && isset($_POST['id'])) {
    $money = $_POST['phat'];
    $id_nv = $_POST['id'];
    foreach ($money as $v) { 
      $sum_phat += $v;
    }
    $_SESSION['phat'][$id_nv] = $sum_phat;
  }
?>

<?php
  include 'dbconfig.php';
  $month = "01";
  $year = "1980";
  $default_file = "";
  if(isset($_GET['time_luong']) && $_GET['time_luong']) {
    $time = $_GET['time_luong'];
    $year = substr($time, 0, 4);
    $month = substr($time, -2, 2);
  }
  $default_file = '../assets/SourceFile/chamcong_t' .$month .'_' .$year .'.xlsx';
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Tính lương</title>
    
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
            <a class="navbar-brand clwhite navbar-title">Tính lương</a>
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

        <!-- Begin: Form thêm nhân viên -->
        <div class="row">
          <div class="col-md-12">
            <div class="row filter form-add">
              <div class="col-sm-12">
                <div>
                  <h4 class="form-add-title"><?php echo "Bảng lương tháng " .$month ."-" .$year ?>
                    <form method="POST">
                      <button name="xlsx-export-btn" class="btn btn-success xlsx-export-btn">Xuất Excel</button>
                    </form>
                  </h4>
                <div>
                <div class="form-add-content">
                  <table class="table bgwhite table-striped table-responsive table-hover table-bordered table-wrapper js-copytextarea" cellpadding="0" cellspacing="0" border="0">
                    <thead class="table-sticky">
                      <tr>
                        <th>ID</th>
                        <th>Họ tên nhân viên</th>
                        <th>Ngày công</th>
                        <th>Tiền lương</th>
                        <th>Tiền phụ cấp</th>
                        <th>Tiền thưởng</th>
                        <th>Tiền phạt</th>
                        <th>Thực lĩnh</th>
                        <th>Thưởng/Phạt</th>
                      </tr>
                    </thead>
                    <?php
                      use Shuchkin\SimpleXLSX;
                      require_once '../src/SimpleXLSX.php';
                      $data = array(); // Danh sách chấm công
                      $data_db = array(); // Danh sách từ cơ sở dữ liệu
                      $row = 0;
                      if ($xlsx = SimpleXLSX::parse($default_file))
                      {
                        $dim = $xlsx->dimension();
                        $cols = $dim[0];

                        $sql = "SELECT maNV, heSoLuong * luongCoBan AS tienLuong, phuCap 
                          FROM luong inner join nhanvien ON luong.bacLuong = nhanvien.bacLuong
                          ORDER BY nhanvien.maNV ASC";
                        
                        $query = mysqli_query($conn, $sql);

                        if($query->num_rows > 0) {
                          while($result = mysqli_fetch_array($query)) {
                            $data_db[$row] = $result;
                            $row++;
                          }
                        }
                        $row = 0;

                        foreach ($xlsx->readRows() as $k => $r) {
                          if ($k == 0) continue; // skip first row
                          
                          echo '<tr>';
                          if(isset($r[0])) {
                            $data[$row][0] = $r[0];
                          }
                          if(isset($r[1])) {
                            $data[$row][1] = $r[1];
                          }
                          if(isset($r[$cols-1])) {
                            $data[$row][2] = $r[$cols-1];
                          }
                          $sql = "SELECT * FROM khenthuong where noiDung = 'Thưởng chuyên cần'";
                          $query = mysqli_query($conn, $sql);
                          $khenthuong = mysqli_fetch_array($query);

                          for($i = 0; $i < count($data_db); $i++) {
                            if($data[$row][0] == $data_db[$i]['maNV']) {
                              $id = $data[$row][0];
                              $tienLuong = $data_db[$i]['tienLuong'] * $data[$row][2] / 26;
                              $phuCap = $data_db[$i]['phuCap'];
                              if(array_key_exists($id, $_SESSION['thuong'])) {
                                $tienThuong = $_SESSION['thuong'][$id];
                              }
                              else if($data[$row][2] >= 25)
                                $tienThuong = $khenthuong['tienThuong'];
                              else
                                $tienThuong = 0;

                              if(array_key_exists($id, $_SESSION['phat']))
                                $tienPhat = $_SESSION['phat'][$id];
                              else
                                $tienPhat = 0;
                              $thucLinh = $tienLuong + $phuCap + $tienThuong - $tienPhat;
                              echo '<td>' .$id .'</td>';
                              echo '<td>' .$data[$row][1] .'</td>';
                              echo '<td>' .$data[$row][2] .'</td>';
                              echo '<td class="text-right">' .number_format($tienLuong) .'</td>';
                              $data[$row][3] = $tienLuong;
                              echo '<td class="text-right">' .number_format($phuCap) .'</td>';
                              $data[$row][4] = $phuCap;
                              echo '<td class="text-right">' .number_format($tienThuong) .'</td>';
                              $data[$row][5] = $tienThuong;
                              echo '<td class="text-right">' .number_format($tienPhat) .'</td>';
                              $data[$row][6] = $tienPhat;
                              echo '<td class="text-right">' .number_format($thucLinh) .'</td>';
                              $data[$row][7] = $thucLinh;
                              echo"<form method='POST'>
                                <td class='table-td-center'>
                                <a class='btn-form' href='./form_tinhthuong.php?thuong=" .$id ."&time=" .$year .'_' .$month ."'>
                                <button class='btn btn-primary btn-sm add-th btn-th" .$id ."' type='button'
                                title='Thưởng' name='thuong'" .$id ."' value='" .$id ."'>
                                  <i class='fas fa-plus'></i>
                                </button>
                                </a>
                                <a class='btn-form' href='./form_tinhphat.php?phat=" .$id ."&time=" .$year .'_' .$month ."'>
                                <button class='btn btn-primary btn-sm minus-th btn-ph" .$id ."' type='button'
                                title='Phạt' name='phat'" .$id ."' value='" .$id ."'>
                                  <i class='fas fa-minus'></i>
                                </button></a>
                                </td>
                              </form>";
                            }
                          }
                          $row++;
                          echo '</tr>';
                        }
                      }
                      else {
                        echo SimpleXLSX::parseError();
                      }
                    ?>
                  </table>
                </div>
              </div>
            </div>
        </div>
      </div>
    </div>
    <?php
      if(array_key_exists('xlsx-export-btn', $_POST)) {
        require('../src/PHPExcel.php');
        ghi_file($data, $month, $year);
        session_destroy();
      }
      
      function ghi_file($data, $month, $year) {
        $excel = new PHPExcel();
        //Chọn trang cần ghi (là số từ 0->n)
        $excel->setActiveSheetIndex(0);

        $excel->getActiveSheet()->getColumnDimension('A')->setWidth(10);
        $excel->getActiveSheet()->getColumnDimension('B')->setWidth(30);
        $excel->getActiveSheet()->getColumnDimension('C')->setWidth(20);
        $excel->getActiveSheet()->getColumnDimension('D')->setWidth(20);
        $excel->getActiveSheet()->getColumnDimension('E')->setWidth(20);
        $excel->getActiveSheet()->getColumnDimension('F')->setWidth(20);
        $excel->getActiveSheet()->getColumnDimension('G')->setWidth(20);
        $excel->getActiveSheet()->getColumnDimension('H')->setWidth(20);
        
        $excel->getActiveSheet()->getStyle('A1:H1')->getFont()->setBold(true);
        $excel->getActiveSheet()->getStyle('A1:H1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

        $excel->getActiveSheet()->setCellValue('A1', 'ID');
        $excel->getActiveSheet()->setCellValue('B1', 'Họ tên nhân viên');
        $excel->getActiveSheet()->setCellValue('C1', 'Ngày công');
        $excel->getActiveSheet()->setCellValue('D1', 'Tiền lương');
        $excel->getActiveSheet()->setCellValue('E1', 'Tiền phụ cấp');
        $excel->getActiveSheet()->setCellValue('F1', 'Tiền thưởng');
        $excel->getActiveSheet()->setCellValue('G1', 'Tiền phạt');
        $excel->getActiveSheet()->setCellValue('H1', 'Thực lĩnh');
        // thực hiện thêm dữ liệu vào từng ô bằng vòng lặp
        // dòng bắt đầu = 2
        $numRow = 2;
        foreach ($data as $row) {
            $excel->getActiveSheet()->setCellValue('A' . $numRow, $row[0]);
            $excel->getActiveSheet()->setCellValue('B' . $numRow, $row[1]);
            $excel->getActiveSheet()->setCellValue('C' . $numRow, $row[2]);
            $excel->getActiveSheet()->setCellValue('D' . $numRow, $row[3]);
            $excel->getActiveSheet()->setCellValue('E' . $numRow, $row[4]);
            $excel->getActiveSheet()->setCellValue('F' . $numRow, $row[5]);
            $excel->getActiveSheet()->setCellValue('G' . $numRow, $row[6]);
            $excel->getActiveSheet()->setCellValue('H' . $numRow, $row[7]);
            $numRow++;
        }
        // Khởi tạo đối tượng PHPExcel_IOFactory để thực hiện ghi file
        // ở đây mình lưu file dưới dạng excel2007
        
        PHPExcel_IOFactory::createWriter($excel, 'Excel2007')->save('../assets/SourceFile/tinhluong_t' .$month .'_' .$year .'.xlsx');
        echo "<script>
            window.location.href='./quanlyluong.php';
            alert('Tính lương thành công');
        </script>";
      }
    ?>
    <script src="./main.js"></script>
  </body>
</html>
