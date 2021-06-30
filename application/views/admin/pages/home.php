<?php $this->load->view('messages') ?>
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Thông số</h1>
    <a href="admin/dashboard/edit/all" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> tải xuống</a>
</div>

<!-- Content Row -->
<div class="row">

    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                            Số lượng bài viết</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $countDashboard['posts'] ?? 0 ?></div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-newspaper fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-success shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                            Đánh giá từ người dùng</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $countDashboard['comments'] ?? 0 ?></div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-comments fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-info shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                            Tài khoản hệ thống</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $countDashboard['users'] ?? 0 ?></div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-users fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Pending Requests Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-warning shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                            Liên hệ </div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $countDashboard['contacts'] ?? 0 ?></div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-id-card-alt fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<hr>
<!-- Content Row -->
<div class="row mt-5">

    <div class="col-lg-12 mb-4">

        <div class="row">
            <div class="col-lg-6 mb-4">
                <a href="admin/dashboard/edit/users" class="card bg-primary text-white shadow">
                    <div class="card-body">
                        <h3>Dữ liệu tài khoản</h3>
                        <div class="text-white-50 small"><i class="fas fa-download float-right"></i></div>
                    </div>
                </a>
            </div>
            <div class="col-lg-6 mb-4">
                <a href="admin/dashboard/edit/posts" class="card bg-success text-white shadow">
                    <div class="card-body">
                        <h3>Dữ liệu bài viết</h3>
                        <div class="text-white-50 small"><i class="fas fa-download float-right"></i></div>
                    </div>
                </a>
            </div>
            <div class="col-lg-6 mb-4">
                <a href="admin/dashboard/edit/positions" class="card bg-info text-white shadow">
                    <div class="card-body">
                        <h3>Dữ liệu chức vụ</h3>
                        <div class="text-white-50 small"><i class="fas fa-download float-right"></i></div>
                    </div>
                </a>
            </div>
            <div class="col-lg-6 mb-4">
                <a href="admin/dashboard/edit/employees" class="card bg-warning text-white shadow">
                    <div class="card-body">
                        <h3>Dữ liệu nhân viên</h3>
                        <div class="text-white-50 small"><i class="fas fa-download float-right"></i></div>
                    </div>
                </a>
            </div>
            <div class="col-lg-12 mb-4">
                <a href="admin/dashboard/edit/comments" class="card bg-light text-black shadow">
                    <div class="card-body">
                        <h3 class="text_center">Dữ liệu đánh giá phản hồi bài viết từ phía khách hàng</h3>
                        <div class="text-black-50 small"><i class="fas fa-download float-right"></i></div>
                    </div>
                </a>
            </div>
        </div>

    </div>
</div>