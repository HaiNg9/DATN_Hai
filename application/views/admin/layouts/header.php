<!-- Topbar -->
<nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

    <!-- Sidebar Toggle (Topbar) -->
    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
        <i class="fa fa-bars"></i>
    </button>

    <!-- Topbar Navbar -->
    <ul class="navbar-nav ml-auto">

        <!-- Nav Item - Search Dropdown (Visible Only XS) -->
        <li class="nav-item dropdown no-arrow d-sm-none">
            <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-search fa-fw"></i>
            </a>
            <!-- Dropdown - Messages -->
            <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in" aria-labelledby="searchDropdown">
                <form class="form-inline mr-auto w-100 navbar-search">
                    <div class="input-group">
                        <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
                        <div class="input-group-append">
                            <button class="btn btn-primary" type="button">
                                <i class="fas fa-search fa-sm"></i>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </li>

        <!-- Nav Item - Alerts -->
        <li class="nav-item dropdown no-arrow mx-1">
            <a class="nav-link dropdown-toggle" href="javascript::void(0)" id="alertsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-bell fa-fw"></i>
                <!-- Counter - Alerts -->
                <span class="badge badge-danger badge-counter"><?= count($notify)?></span>
            </a>
            <?php if (count($notify) != 0) : ?>
            <!-- Dropdown - Alerts -->
            <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="alertsDropdown" id="notify-list">
                <h6 class="dropdown-header text-center">
                    Thông báo hệ thống
                </h6>
                <?php foreach ($notify as $itemNotify) : ?>
                    <?php if ($itemNotify['status'] === 'INSERT') : ?>
                        <a class="dropdown-item d-flex align-items-center" href="admin/history/edit/<?= $itemNotify['id'] ?>">
                            <div class="mr-3">
                                <div class="icon-circle bg-success btn-circle btn-sm">
                                    <i class="fas fa-plus-circle text-white"></i>
                                </div>
                            </div>
                            <div>
                                <div class="small text-gray-500 time-notify" data-time="<?= $itemNotify['created_date'] ?>"></div>
                                <?= $itemNotify['message'] ?>
                            </div>
                        </a>
                    <?php elseif ($itemNotify['status'] === 'UPDATE') : ?>
                        <a class="dropdown-item d-flex align-items-center" href="admin/history/edit/<?= $itemNotify['id'] ?>">
                            <div class="mr-3">
                                <div class="icon-circle bg-warning btn-circle btn-sm">
                                    <i class="far fa-edit text-white"></i>
                                </div>
                            </div>
                            <div>
                                <div class="small text-gray-500 time-notify" data-time="<?= $itemNotify['created_date'] ?>"></div>
                                <?= $itemNotify['message'] ?>
                            </div>
                        </a>
                    <?php elseif ($itemNotify['status'] === 'DELETE') : ?>
                        <a class="dropdown-item d-flex align-items-center" href="admin/history/edit/<?= $itemNotify['id'] ?>">
                            <div class="mr-3">
                                <div class="icon-circle bg-danger btn-circle btn-sm">
                                    <i class="fas fa-trash text-white"></i>
                                </div>
                            </div>
                            <div>
                                <div class="small text-gray-500 time-notify" data-time="<?= $itemNotify['created_date'] ?>"></div>
                                <?= $itemNotify['message'] ?>
                            </div>
                        </a>
                    <?php endif ?>
                <?php endforeach ?>
                <form action="admin/history/update" method="post">
                    <input type="text" name="url_back" value="<?= uri_string() ?>" hidden>
                    <button type="submit" class="dropdown-item text-center small text-gray-500">Đánh dấu đã xem toàn bộ</button>
                </form>
            </div>
            <?php endif ?>
        </li>

        <!-- Nav Item - Messages -->
        <li class="nav-item dropdown no-arrow mx-1">
            <a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-envelope fa-fw"></i>
                <!-- Counter - Messages -->
                <span class="badge badge-danger badge-counter"><?= count($subNotify) ?></span>
            </a>
            <!-- Dropdown - Messages -->
            <?php if (count($subNotify) != 0) : ?>
                <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="messagesDropdown">
                    <h6 class="dropdown-header text-center">
                        Tin nhắn
                    </h6>
                    <?php foreach ($subNotify as $itemSubNotify) : ?>
                        <a class="dropdown-item d-flex align-items-center" href="admin/subscribe/edit/<?= $itemSubNotify['id'] ?>">
                            <div class="font-weight-bold">
                                <div><?= $itemSubNotify['name'] ?>. Đã đăng ký nhận thông báo hệ thống.</div>
                            </div>
                        </a>
                    <?php endforeach ?>
                    <form action="admin/subscribe/update" method="post">
                        <input type="text" name="url_back" value="<?= uri_string() ?>" hidden>
                        <button type="submit" class="dropdown-item text-center small text-gray-500">Đánh dấu đã xem toàn bộ</button>
                    </form>
                </div>
            <?php endif ?>
        </li>

        <div class="topbar-divider d-none d-sm-block"></div>

        <!-- Nav Item - User Information -->
        <li class="nav-item dropdown no-arrow">
            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?= $this->session->userdata('loginInfo')->display_name ?></span>
                <img class="img-profile rounded-circle" src="public/admin/upload/images/user/<?= $this->session->userdata('loginInfo')->img ?>">
            </a>
            <!-- Dropdown - User Information -->
            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                <a class="dropdown-item" href="admin/user/edit/<?= $this->session->userdata('loginInfo')->id ?>">
                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                    Hồ sơ
                </a>
                <a class="dropdown-item" href="admin/user/editRoleNumber/<?= $this->session->userdata('loginInfo')->id ?>">
                    <i class="fas fa-key fa-sm fa-fw mr-2 text-gray-400"></i>
                    Phân quyền
                </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                    Đăng xuất
                </a>
            </div>
        </li>

    </ul>

</nav>
<!-- End of Topbar -->