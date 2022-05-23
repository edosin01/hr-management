<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Danh sách nhân viên</title>
    
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
          <a href="login.php" class="clwhite log-out-btn">          
            <i class="bi bi-box-arrow-in-right icons mg6 log-out-icon"></i>
          </a>
          </div>
        </div>
        <!-- End: Navbar -->

        <!-- Begin: Thanh tiêu đề -->
        <nav class="navbar tieude">
          <div class="container-fluid">
            <a class="navbar-brand clwhite navbar-title">Bảng thống kê lương</a>
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

        <!-- Begin: Danh sách lương -->
        <div class="row">
          <div class="col-md-12">
            <div class="row element-button">
              <div class="col-s-2">
                <a class="btn btn-add btn-sm" href="./form_thembangluong.php" title="Thêm"><i class="fas fa-plus"></i>
                  Tạo bản ghi mới</a>
              </div>
              <div class="col-s-2">
                <a class="btn btn-sm nhap-tu-file" type="button" title="Nhập"><i class="fas fa-file-upload"></i> Tải từ file</a>
              </div>
    
              <div class="col-s-2">
                <a class="btn btn-excel btn-sm" href="" title="In"><i class="fas fa-file-excel"></i> Xuất Excel</a>
              </div>
              <div class="col-s-2">
                <a class="btn btn-sm pdf-file" type="button" title="In"><i class="fas fa-file-pdf"></i> Xuất PDF</a>
              </div>
              <div class="col-s-2">
                <a class="btn btn-sm btn-delete" type="button" title="Xóa"><i class="fas fa-trash-alt"></i> Xóa tất cả </a>
              </div>
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
                                    <th>STT <i class="bi bi-sort-down"></i></th>
                                    <th>Mã nhân viên</th>
                                    <th class="table-address" width="150">Họ và tên</th>
                                    <th>Chức vụ</th>
                                    <th>Tiền lương</th>
                                    <th>Tiền thưởng</th>
                                    <th>Tiền phạt</th>
                                    <th>Thực lĩnh</th>
                                    <th class="table-status-sal">Trạng thái</th>
                                    <th class="table-act">Hành động</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>01</td>
                                    <td>2019600822</td>
                                    <td>Trần Đức Anh</td>
                                    <td>Nhân viên</td>
                                    <td>7.500.000đ</td>
                                    <td>Không</td>
                                    <td>Không</td>
                                    <td>7.500.000đ</td>
                                    <td class="text-center"><span class="table-status-emp status-on">Đã nhận</span></td>
                                    <td class="table-td-center"><button class="btn btn-primary btn-sm trash" type="button" title="Xóa">
                                      <i class="fas fa-trash-alt"></i>
                                      </button>
                                      <button class="btn btn-primary btn-sm edit" type="button" title="Sửa" id="show-emp"
                                        data-toggle="modal" data-target="#ModalUP"><i class="fas fa-edit"></i>
                                      </button>
                                    </td>
                                </tr>

                                <tr>
                                    <td>02</td>
                                    <td>2019600822</td>
                                    <td>Trần Đức Anh</td>
                                    <td>Nhân viên</td>
                                    <td>7.500.000đ</td>
                                    <td>Không</td>
                                    <td>200.000đ</td>
                                    <td>7.300.000đ</td>
                                    <td class="text-center"><span class="table-status-emp status-on">Đã nhận</span></td>
                                    <td class="table-td-center"><button class="btn btn-primary btn-sm trash" type="button" title="Xóa">
                                      <i class="fas fa-trash-alt"></i>
                                      </button>
                                      <button class="btn btn-primary btn-sm edit" type="button" title="Sửa" id="show-emp"
                                        data-toggle="modal" data-target="#ModalUP"><i class="fas fa-edit"></i>
                                      </button>
                                    </td>
                                </tr>

                                <tr>
                                    <td>03</td>
                                    <td>2019600822</td>
                                    <td>Trần Đức Anh</td>
                                    <td>Nhân viên</td>
                                    <td>7.500.000đ</td>
                                    <td>Không</td>
                                    <td>Không</td>
                                    <td>7.500.000đ</td>
                                    <td class="text-center"><span class="table-status-emp status-off">Chưa nhận</span></td>
                                    <td class="table-td-center"><button class="btn btn-primary btn-sm trash" type="button" title="Xóa">
                                      <i class="fas fa-trash-alt"></i>
                                      </button>
                                      <button class="btn btn-primary btn-sm edit" type="button" title="Sửa" id="show-emp"
                                        data-toggle="modal" data-target="#ModalUP"><i class="fas fa-edit"></i>
                                      </button>
                                    </td>
                                </tr>

                                <tr>
                                  <td>04</td>
                                  <td>2019600822</td>
                                  <td>Trần Đức Anh</td>
                                  <td>Nhân viên</td>
                                  <td>7.500.000đ</td>
                                  <td>Không</td>
                                  <td>Không</td>
                                  <td>7.500.000đ</td>
                                  <td class="text-center"><span class="table-status-emp status-off">Chưa nhận</span></td>
                                  <td class="table-td-center"><button class="btn btn-primary btn-sm trash" type="button" title="Xóa">
                                    <i class="fas fa-trash-alt"></i>
                                    </button>
                                    <button class="btn btn-primary btn-sm edit" type="button" title="Sửa" id="show-emp"
                                      data-toggle="modal" data-target="#ModalUP"><i class="fas fa-edit"></i>
                                    </button>
                                  </td>
                              </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- End: Danh sách lương -->
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
    <script src="./main.js"></script>
  </body>
</html>
