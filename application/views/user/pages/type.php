<div class="blog-area section-padding-0-80">
    <div class="container">
        <div class="row">
            <div class="col-12 col-lg-12">
                <div class="blog-posts-area">
                    <div class="row">
                        <?php foreach ($posts as $post) : ?>
                            <div class="col-4 col-lg-4">
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
                                                <?= strlen($post['content']) > 300 ? '...' : '' ?>
                                            </p>
                                            <!-- Post Like & Post Comment -->
                                            <div class="d-flex align-items-center">
                                                <a href="#" class="post-like"><img src="public/user/img/core-img/like.png" alt="<?= $post['title'] ?>"> <span><?= $post['like'] ?></span></a>
                                                <a href="#" class="post-comment"><img src="public/user/img/core-img/chat.png" alt="<?= $post['title'] ?>"> <span><?= $post['count_comments'] ?></span></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach ?>
                    </div>
                </div>
                <nav aria-label="Page navigation example">
                    <?php echo $links; ?>
                </nav>
            </div>
        </div>
    </div>
</div>