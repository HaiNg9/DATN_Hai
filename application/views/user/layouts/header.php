<!-- ##### Header Area Start ##### -->
<header class="header-area">
<?php $this->load->view('messages') ?>

<!-- Top Header Area -->
<div class="top-header-area">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="top-header-content d-flex align-items-center justify-content-between">
                    <!-- Logo -->
                    <div class="logo">
                        <a href="trang-chu.html"><img src="public/user/img/core-img/logo.png" alt=""></a>
                    </div>

                    <!-- Login Search Area -->
                    <div class="login-search-area d-flex align-items-center">
                        <!-- Login -->
                        <div class="login d-flex">
                            <?php if ($this->session->userdata('loginInfo')) : ?>
                                <a href="tai-khoan.html"><i class="fa fa-dot-circle-o"></i> <?= $this->session->userdata('loginInfo')->display_name ?></a>
                                <a href="dang-xuat.html">Đăng xuất</a>
                            <?php else : ?>
                                <a href="dang-nhap.html">Đăng nhập</a>
                                <a href="dang-ky.html">Đăng ký</a>
                            <?php endif ?>
                        </div>
                        <!-- Search Form -->
                        <div class="search-form">
                            <form action="javascript::void(0)">
                                <input value="<?= $keySearch ?? '' ?>" type="search" name="search" id="input-search-user" class="form-control" placeholder="Nhập thông tin tìm kiếm">
                                <button type="submit" id="btn-search-user"><i class="fa fa-search" aria-hidden="true"></i></button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Navbar Area -->
<div class="newspaper-main-menu" id="stickyMenu">
    <div class="classy-nav-container breakpoint-off">
        <div class="container">
            <!-- Menu -->
            <nav class="classy-navbar justify-content-between" id="newspaperNav">

                <!-- Logo -->
                <div class="logo">
                    <a href="trang-chu.html"><img src="public/user/img/core-img/logo.png" alt=""></a>
                </div>

                <!-- Navbar Toggler -->
                <div class="classy-navbar-toggler">
                    <span class="navbarToggler"><span></span><span></span><span></span></span>
                </div>

                <!-- Menu -->
                <div class="classy-menu">

                    <!-- close btn -->
                    <div class="classycloseIcon">
                        <div class="cross-wrap"><span class="top"></span><span class="bottom"></span></div>
                    </div>

                    <!-- Nav Start -->
                    <div class="classynav">
                        <ul>
                            <li class="active"><a href="trang-chu.html">Trang chủ</a></li>
                            <li><a href="#">Thể loại</a>
                                <ul class="dropdown">
                                    <?php foreach ($categoriesHeader as $category) : ?>
                                        <li><a href="the-loai/<?= $category['id'] ?>/1"><?= $category['name'] ?></a></li>
                                    <?php endforeach ?>
                                </ul>
                            </li>
                            <li><a href="#">Tin tức</a>
                                <div class="megamenu">
                                    <?php foreach ($typesHeader as $categoryHead) : ?>
                                        <ul class="single-mega cn-col-4">
                                            <li class="title"><?= $categoryHead['name'] ?></li>
                                            <?php foreach ($categoryHead['types'] as $typeHead) : ?>
                                                <li><a href="loai-tin/<?= $typeHead['id'] ?>/1"><?= $typeHead['name'] ?></a></li>
                                            <?php endforeach ?>
                                        </ul>
                                    <?php endforeach ?>
                                    <div class="single-mega cn-col-4">

                                        <!-- Single Featured Post -->
                                        <?php foreach ($newsHeader as $newsHead) : ?>
                                            <div class="single-blog-post small-featured-post d-flex">
                                                <div class="post-thumb">
                                                    <a href="bai-viet/<?= $newsHead['id'] ?>"><img src="public/admin/upload/images/post/<?= $newsHead['img'] ?>" alt="<?= $newsHead['title'] ?>"></a>
                                                </div>
                                                <div class="post-data">
                                                    <div class="post-meta">
                                                        <a href="bai-viet/<?= $newsHead['id'] ?>" class="post-title">
                                                            <h6><?= $newsHead['title'] ?></h6>
                                                        </a>
                                                        <p class="post-date"><span class="date-convert-full" data-time="<?= $newsHead['updated_date'] ?>"></span></p>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php endforeach ?>

                                    </div>
                                </div>
                            </li>
                            <li><a href="nhan-su.html">Nhân sự</a></li>
                            <li><a href="lien-he.html">liên hệ</a></li>
                        </ul>
                    </div>
                    <!-- Nav End -->
                </div>
            </nav>
        </div>
    </div>
</div>
</header>
<!-- ##### Header Area End ##### -->