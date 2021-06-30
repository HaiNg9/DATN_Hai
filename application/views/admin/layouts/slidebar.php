<?php
if (empty($focusMenu)) {
    $focusMenu = '';
}
if (empty($focusSubMenu)) {
    $focusSubMenu = '';
}
?>
<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="trang-chu.html" target="blank">
        <div class="sidebar-brand-text mx-3">DCN <sup>Master</sup></div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item<?= $focusMenu === 'DASHBOARD' ? ' active' : '' ?>">
        <a class="nav-link" href="admin/home">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Thống kê</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Tài khoản
    </div>

    <li class="nav-item<?= $focusMenu === 'PROFILE' ? ' active' : '' ?>">
        <a class="nav-link" href="admin/user/edit/<?= $this->session->userdata('loginInfo')->id ?>">
            <i class="fas fa-user-edit"></i>
            <span>Cá nhân</span></a>
    </li>

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item<?= $focusMenu === 'USER' ? ' active' : '' ?>">
        <a class="<?= $focusMenu === 'USER' ? 'nav-link' : 'nav-link collapsed' ?>" href="#" data-toggle="collapse" data-target="#user-system-menu" aria-expanded="<?= $focusMenu === 'USER' ? 'true' : 'false' ?>" aria-controls="user-system-menu">
            <i class="fas fa-users-cog"></i>
            <span>Hệ thống</span>
        </a>
        <div id="user-system-menu" class="collapse<?= $focusMenu === 'USER' ? ' show' : '' ?>" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item<?= $focusSubMenu === 'USER_ADD' ? ' active' : '' ?>" href="admin/user/add">Thêm mới</a>
                <a class="collapse-item<?= $focusSubMenu === 'USER_LIST' ? ' active' : '' ?>" href="admin/user/list">Danh sách</a>
            </div>
        </div>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Tin tức
    </div>

    <!-- Nav Item - Pages Category -->
    <li class="nav-item<?= $focusMenu === 'CATEGORY' ? ' active' : '' ?>">
        <a class="<?= $focusMenu === 'CATEGORY' ? 'nav-link' : 'nav-link collapsed' ?>" href="#" data-toggle="collapse" data-target="#category-new" aria-expanded="<?= $focusMenu === 'CATEGORY' ? 'true' : 'false' ?>" aria-controls="category-new">
            <i class="fas fa-book"></i>
            <span>Thể loại</span>
        </a>
        <div id="category-new" class="collapse<?= $focusMenu === 'CATEGORY' ? ' show' : '' ?>" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item<?= $focusSubMenu === 'CATEGORY_ADD' ? ' active' : '' ?>" href="admin/category/add">Thêm mới</a>
                <a class="collapse-item<?= $focusSubMenu === 'CATEGORY_LIST' ? ' active' : '' ?>" href="admin/category/list">Danh sách</a>
            </div>
        </div>
    </li>

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item<?= $focusMenu === 'TYPE' ? ' active' : '' ?>">
        <a class="<?= $focusMenu === 'TYPE' ? 'nav-link' : 'nav-link collapsed' ?>" href="#" data-toggle="collapse" data-target="#type-new" aria-expanded="<?= $focusMenu === 'TYPE' ? 'true' : 'false' ?>" aria-controls="type-new">
            <i class="fas fa-book-open"></i>
            <span>Loại tin</span>
        </a>
        <div id="type-new" class="collapse<?= $focusMenu === 'TYPE' ? ' show' : '' ?>" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item<?= $focusSubMenu === 'TYPE_ADD' ? ' active' : '' ?>" href="admin/type/add">Thêm mới</a>
                <a class="collapse-item<?= $focusSubMenu === 'TYPE_LIST' ? ' active' : '' ?>" href="admin/type/list">Danh sách</a>
            </div>
        </div>
    </li>

    <!-- Nav Item - Utilities Collapse Menu -->
    <li class="nav-item<?= $focusMenu === 'NEWS' ? ' active' : '' ?>">
        <a class="<?= $focusMenu === 'NEWS' ? 'nav-link' : 'nav-link collapsed' ?>" href="#" data-toggle="collapse" data-target="#posts-new" aria-expanded="<?= $focusMenu === 'NEWS' ? 'true' : 'false' ?>" aria-controls="collapseUtilities">
            <i class="far fa-newspaper"></i>
            <span>Tin tức</span>
        </a>
        <div id="posts-new" class="collapse<?= $focusMenu === 'NEWS' ? ' show' : '' ?>" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item<?= $focusSubMenu === 'NEWS_ADD' ? ' active' : '' ?>" href="admin/post/add">Đăng bài</a>
                <a class="collapse-item<?= $focusSubMenu === 'NEWS_LIST' ? ' active' : '' ?>" href="admin/post/list">Danh sách</a>
            </div>
        </div>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Heading -->
    <div class="sidebar-heading">
        Nhân sự
    </div>

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item<?= $focusMenu === 'POSTION' ? ' active' : '' ?>">
        <a class="<?= $focusMenu === 'POSTION' ? 'nav-link' : 'nav-link collapsed' ?>" href="#" data-toggle="collapse" data-target="#position" aria-expanded="<?= $focusMenu === 'POSTION' ? 'true' : 'false' ?>" aria-controls="collapsePages">
            <i class="far fa-address-card"></i>
            <span>Chức vụ</span>
        </a>
        <div id="position" class="collapse<?= $focusMenu === 'POSTION' ? ' show' : '' ?>" aria-labelledby="headingPages" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item<?= $focusSubMenu === 'POSTION_LIST' ? ' active' : '' ?>" href="admin/position/list">Tên chức vụ</a>
            </div>
        </div>
    </li>

    <li class="nav-item<?= $focusMenu === 'EMPLOYEES' ? ' active' : '' ?>">
        <a class="<?= $focusMenu === 'EMPLOYEES' ? 'nav-link' : 'nav-link collapsed' ?>" href="#" data-toggle="collapse" data-target="#employees" aria-expanded="<?= $focusMenu === 'EMPLOYEES' ? 'true' : 'false' ?>" aria-controls="collapsePages">
            <i class="far fa-address-book"></i>
            <span>Nhân viên</span>
        </a>
        <div id="employees" class="collapse<?= $focusMenu === 'EMPLOYEES' ? ' show' : '' ?>" aria-labelledby="headingPages" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item<?= $focusSubMenu === 'EMPLOYEES_ADD' ? ' active' : '' ?>" href="admin/employee/add">Thêm mới</a>
                <a class="collapse-item<?= $focusSubMenu === 'EMPLOYEES_LIST' ? ' active' : '' ?>" href="admin/employee/list">Danh sách</a>
            </div>
        </div>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Liên hệ
    </div>

    <li class="nav-item<?= $focusMenu === 'CONTACTS' ? ' active' : '' ?>">
        <a class="nav-link" href="admin/subscribe/list">
            <i class="fas fa-comment-alt"></i>
            <span>Nhận thông báo</span></a>
    </li>

    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Thông tin chung
    </div>

    <!-- Nav Item - Charts -->
    <li class="nav-item<?= $focusMenu === 'HOME' ? ' active' : '' ?>">
        <a class="nav-link" href="admin/homepage/list">
            <i class="fas fa-fw fas fa-house-user"></i>
            <span>Trang chủ</span></a>
    </li>

    <li class="nav-item<?= $focusMenu === 'HISTORY' ? ' active' : '' ?>">
        <a class="nav-link" href="admin/history/list">
            <i class="fas fa-fw fas fa-clipboard-list"></i>
            <span>Lịch sử thông báo</span></a>
    </li>

    <li class="nav-item<?= $focusMenu === 'BIN' ? ' active' : '' ?>">
        <a class="nav-link" href="admin/bin/list">
            <i class="fas fa-fw fas fa-trash"></i>
            <span>Thùng rác</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

    <!-- Sidebar Message -->
    <div class="sidebar-card">
        <p class="text-center mb-2"><strong>DCN</strong> kênh youtube.</p>
        <a class="btn btn-success btn-sm fab fa-youtube" href="https://www.youtube.com/" target="_blank"> DCN</a>
    </div>

</ul>
<!-- End of Sidebar -->