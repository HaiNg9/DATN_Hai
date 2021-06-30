<!-- ##### Featured Post Area Start ##### -->
<div class="featured-post-area">
    <div class="container">
        <div class="row">
            <div class="col-12 col-md-6 col-lg-8">

                <div class="row">
                    <!-- Single Featured Post -->
                    <div class="col-12 col-lg-7">
                        <?php if ($top1Posts) : ?>
                            <div class="single-blog-post featured-post">
                                <div class="post-thumb">
                                    <a href="bai-viet/<?= $top1Posts['id'] ?>"><img src="public/admin/upload/images/post/<?= $top1Posts['img'] ?>" alt="<?= $top1Posts['title'] ?>"></a>
                                </div>
                                <div class="post-data">
                                    <a href="bai-viet/<?= $top1Posts['id'] ?>" class="post-catagory"><?= $top1Posts['type_name'] ?></a>
                                    <a href="bai-viet/<?= $top1Posts['id'] ?>" class="post-title">
                                        <h6><?= $top1Posts['title'] ?></h6>
                                    </a>
                                    <div class="post-meta">
                                        <p class="post-author">Đăng bởi: <a href="javascript::void(0)"><?= $top1Posts['user_post_name'] ?></a></p>
                                        <p class="post-excerp">
                                            <?= strlen($top1Posts['content']) > 600 ? '...' : '' ?>
                                        </p>
                                        <!-- Post Like & Post Comment -->
                                        <div class="d-flex align-items-center">
                                            <a href="bai-viet/<?= $top1Posts['id'] ?>" class="post-like"><img src="public/user/img/core-img/like.png" alt="<?= $top1Posts['title'] ?>"> <span><?= $top1Posts['like'] ?></span></a>
                                            <a href="bai-viet/<?= $top1Posts['id'] ?>" class="post-comment"><img src="public/user/img/core-img/chat.png" alt="<?= $top1Posts['title'] ?>"> <span><?= $top1Posts['count_comments'] ?></span></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endif ?>
                    </div>

                    <div class="col-12 col-lg-5">
                        <?php if ($top2Posts) : ?>
                            <!-- Single Featured Post -->
                            <div class="single-blog-post featured-post-2">
                                <div class="post-thumb">
                                    <a href="bai-viet/<?= $top2Posts['id'] ?>"><img src="public/admin/upload/images/post/<?= $top2Posts['img'] ?>" alt="<?= $top2Posts['title'] ?>"></a>
                                </div>
                                <div class="post-data">
                                    <a href="bai-viet/<?= $top2Posts['id'] ?>" class="post-catagory"><?= $top2Posts['type_name'] ?></a>
                                    <div class="post-meta">
                                        <a href="bai-viet/<?= $top2Posts['id'] ?>" class="post-title">
                                            <h6><?= $top2Posts['title'] ?></h6>
                                        </a>
                                        <!-- Post Like & Post Comment -->
                                        <div class="d-flex align-items-center">
                                            <a href="bai-viet/<?= $top2Posts['id'] ?>" class="post-like"><img src="public/user/img/core-img/like.png" alt=""> <span><?= $top2Posts['like'] ?></span></a>
                                            <a href="bai-viet/<?= $top2Posts['id'] ?>" class="post-comment"><img src="public/user/img/core-img/chat.png" alt=""> <span><?= $top2Posts['count_comments'] ?></span></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endif ?>

                        <!-- Single Featured Post -->
                        <?php if ($top3Posts) : ?>
                            <!-- Single Featured Post -->
                            <div class="single-blog-post featured-post-2">
                                <div class="post-thumb">
                                    <a href="bai-viet/<?= $top3Posts['id'] ?>"><img src="public/admin/upload/images/post/<?= $top3Posts['img'] ?>" alt="<?= $top3Posts['title'] ?>"></a>
                                </div>
                                <div class="post-data">
                                    <a href="bai-viet/<?= $top3Posts['id'] ?>" class="post-catagory"><?= $top3Posts['type_name'] ?></a>
                                    <div class="post-meta">
                                        <a href="bai-viet/<?= $top3Posts['id'] ?>" class="post-title">
                                            <h6><?= $top3Posts['title'] ?></h6>
                                        </a>
                                        <!-- Post Like & Post Comment -->
                                        <div class="d-flex align-items-center">
                                            <a href="bai-viet/<?= $top3Posts['id'] ?>" class="post-like"><img src="public/user/img/core-img/like.png" alt=""> <span><?= $top3Posts['like'] ?></span></a>
                                            <a href="bai-viet/<?= $top3Posts['id'] ?>" class="post-comment"><img src="public/user/img/core-img/chat.png" alt=""> <span><?= $top3Posts['count_comments'] ?></span></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endif ?>
                    </div>
                </div>
            </div>

            <div class="col-12 col-md-6 col-lg-4">
                <?php foreach ($newsRightMenu as $itemNews) : ?>
                    <!-- Single Featured Post -->
                    <div class="single-blog-post small-featured-post d-flex">
                        <div class="post-thumb">
                            <a href="bai-viet/<?= $itemNews['id'] ?>"><img src="public/admin/upload/images/post/<?= $itemNews['img'] ?>" alt="<?= $itemNews['title'] ?>"></a>
                        </div>
                        <div class="post-data">
                            <a href="bai-viet/<?= $itemNews['id'] ?>" class="post-catagory"><?= $itemNews['type_name'] ?></a>
                            <div class="post-meta">
                                <a href="bai-viet/<?= $itemNews['id'] ?>" class="post-title">
                                    <h6><?= $itemNews['title'] ?></h6>
                                </a>
                                <p class="post-date"><span class="date-convert-full" data-time="<?= $itemNews['updated_date'] ?>"></span></p>
                            </div>
                        </div>
                    </div>
                <?php endforeach ?>
            </div>
        </div>
    </div>
</div>
<!-- ##### Featured Post Area End ##### -->

<!-- ##### Popular News Area Start ##### -->
<div class="popular-news-area section-padding-80-50">
    <div class="container">
        <div class="row">
            <div class="col-12 col-lg-8">
                <div class="section-heading">
                    <h6>Tin tức nổi bật</h6>
                </div>

                <div class="row">

                    <!-- Single Post -->
                    <?php foreach ($top4Posts as $itemTop) : ?>
                        <div class="col-12 col-md-6">
                            <div class="single-blog-post style-3">
                                <div class="post-thumb">
                                    <a href="bai-viet/<?= $itemTop['id'] ?>"><img src="public/admin/upload/images/post/<?= $itemTop['img'] ?>" alt=""></a>
                                </div>
                                <div class="post-data">
                                    <a href="bai-viet/<?= $itemTop['id'] ?>" class="post-catagory"><?= $itemTop['type_name'] ?></a>
                                    <a href="bai-viet/<?= $itemTop['id'] ?>" class="post-title">
                                        <h6><?= $itemTop['title'] ?></h6>
                                    </a>
                                    <div class="post-meta d-flex align-items-center">
                                        <a href="bai-viet/<?= $itemTop['id'] ?>" class="post-like"><img src="public/user/img/core-img/like.png" alt=""> <span><?= $itemTop['like'] ?></span></a>
                                        <a href="bai-viet/<?= $itemTop['id'] ?>" class="post-comment"><img src="public/user/img/core-img/chat.png" alt=""><span><?= $itemTop['count_comments'] ?></span></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach ?>

                </div>
            </div>

            <div class="col-12 col-lg-4">
                <div class="section-heading">
                    <h6>Thông tin</h6>
                </div>
                <?php $this->load->view('user/layouts/right-menu') ?>
            </div>
        </div>
    </div>
</div>
<!-- ##### Popular News Area End ##### -->

<!-- ##### Video Post Area Start ##### -->
/
<!-- ##### Video Post Area End ##### -->

<!-- ##### Editorial Post Area Start ##### -->
<div class="editors-pick-post-area section-padding-80-50">
    <div class="container">
        <div class="row">
            <!-- Editors Pick -->
            <div class="col-12 col-md-7 col-lg-9">
                <div class="section-heading">
                    <h6>Bài viết chọn lọc</h6>
                </div>

                <div class="row">
                
                    <?php foreach ($topPosts as $itemPost) : ?>
                        <!-- Single Post -->
                        <div class="col-12 col-lg-4">
                            <div class="single-blog-post">
                                <div class="post-thumb">
                                    <a href="bai-viet/<?= $itemPost['id'] ?>"><img src="public/admin/upload/images/post/<?= $itemPost['img'] ?>" alt=""></a>
                                </div>
                                <div class="post-data">
                                    <a href="bai-viet/<?= $itemPost['id'] ?>" class="post-title">
                                        <h6><?= $itemPost['title'] ?></h6>
                                    </a>
                                    <div class="post-meta">
                                        <div class="post-date"><a><span class="date-convert-full" data-time="<?= $itemNews['updated_date'] ?>"></span></a></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach ?>

                </div>
            </div>

            <!-- World News -->
            <div class="col-12 col-md-5 col-lg-3">
                <div class="section-heading">
                    <h6>Tin mới</h6>
                </div>
                <?php foreach ($newPosts as $itemPost) : ?>
                <!-- Single Post -->
                <div class="single-blog-post style-2">
                    <div class="post-thumb">
                        <a href="bai-viet/<?= $itemPost['id'] ?>"><img src="public/admin/upload/images/post/<?= $itemPost['img'] ?>" alt=""></a>
                    </div>
                    <div class="post-data">
                        <a href="bai-viet/<?= $itemPost['id'] ?>" class="post-title">
                            <h6><?= $itemPost['title'] ?></h6>
                        </a>
                        <div class="post-meta">
                            <div class="post-date"><a href="bai-viet/<?= $itemPost['id'] ?>"><span class="date-convert-full" data-time="<?= $itemPost['updated_date'] ?>"></span></a></div>
                        </div>
                    </div>
                </div>
                <?php endforeach ?>
            </div>
        </div>
    </div>
</div>
<!-- ##### Editorial Post Area End ##### -->