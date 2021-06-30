<div class="blog-area section-padding-0-80">
    <div class="container">
        <div class="row">
            <div class="col-12 col-lg-8">
                <div class="blog-posts-area">
                    <?php foreach ($posts as $post) : ?>
                        <!-- Single Featured Post -->
                        <div class="single-blog-post featured-post mb-30">
                            <div class="post-thumb">
                                <a href="bai-viet/<?= $post['id'] ?>"><img src="public/admin/upload/images/post/<?= $post['img'] ?>" alt="<?= $post['title'] ?>"></a>
                            </div>
                            <div class="post-data">
                                <a href="bai-viet/<?= $post['id'] ?>" class="post-catagory"><?= $post['type_name'] ?></a>
                                <a href="bai-viet/<?= $post['id'] ?>" class="post-title">
                                    <h6><?= $post['title'] ?></h6>
                                </a>
                                <div class="post-meta">
                                    <p class="post-author">Đăng bởi: <a href="javascript::void(0)"><?= $post['user_post_name'] ?></a></p>
                                    <p class="post-excerp">
                                        <?= strlen($post['content']) > 400 ? '...' : '' ?>        
                                    </p>
                                    <!-- Post Like & Post Comment -->
                                    <div class="d-flex align-items-center">
                                        <a href="bai-viet/<?= $post['id'] ?>" class="post-like"><img src="public/user/img/core-img/like.png" alt="<?= $post['title'] ?>"> <span><?= $post['like'] ?></span></a>
                                        <a href="bai-viet/<?= $post['id'] ?>" class="post-comment"><img src="public/user/img/core-img/chat.png" alt="<?= $post['title'] ?>"> <span><?= $post['count_comments'] ?></span></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr>
                    <?php endforeach ?>
                </div>
                <nav aria-label="Page navigation example">
                    <?php echo $links; ?>
                </nav>
            </div>

            <div class="col-12 col-lg-4">
                <div class="blog-sidebar-area">

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
                    
                    <?php $this->load->view('user/layouts/right-menu') ?>

                    <hr>

                    <!-- Latest Comments Widget -->
                    <div class="latest-comments-widget">
                        <h3>Bình luận mới nhất</h3>
                        <?php foreach ($newComments as $comment) : ?>
                        <!-- Single Comments -->
                        <div class="single-comments d-flex">
                            <div class="comments-thumbnail mr-15">
                                <img src="public/admin/upload/images/user/<?= $comment['img'] ?>" alt="">
                            </div>
                            <div class="comments-text">
                                <a href="bai-viet/<?= $comment['posts_id']?>"><?= $comment['display_name'] ?> <span>bình luận trên </span> <?= $comment['title'] ?></a>
                                <p><span class="date-convert-full" data-time="<?= $comment['created_date'] ?>"></span></p>
                            </div>
                        </div>
                        <?php endforeach ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>