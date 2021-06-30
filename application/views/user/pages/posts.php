<!-- ##### Blog Area Start ##### -->
<div class="blog-area section-padding-0-80">
        <div class="container">
            <div class="row">
                <div class="col-12 col-lg-12">
                    <div class="blog-posts-area">

                        <!-- Single Featured Post -->
                        <div class="single-blog-post featured-post single-post">
                            <div class="post-thumb">
                                <a href="#"><img src="http://localhost/NewsWebsite/public/admin/upload/images/post/<?= $posts->img ?>" alt="<?= $posts->title ?>"></a>
                            </div>
                            <div class="post-data">
                                <a href="#" class="post-catagory"><?= $posts->user_post_name ?></a>
                                <a href="#" class="post-title">
                                    <h6><?= $posts->title ?></h6>
                                </a>
                                <div class="post-meta">
                                    <p class="post-author">Đăng bởi <a href="#"><?= $posts->title ?></a></p>
                                    <?php echo $posts->content; ?>
                                    <div class="newspaper-post-like d-flex align-items-center justify-content-between">
                                        <!-- Tags -->
                                        <div class="newspaper-tags d-flex">
                                            <span>Thể loại :</span>
                                            <ul class="d-flex">
                                                <?php $lastKey = array_key_last($types); ?>
                                                <?php foreach ($types as $key => $itemType) : ?>
                                                    <?php if ($key === $lastKey) : ?>
                                                        <li><a href="the-loai/<?= $itemType['id'] ?>"><?= $itemType['name'] ?></a></li>
                                                    <?php else : ?>
                                                        <li><a href="the-loai/<?= $itemType['id'] ?>"><?= $itemType['name'] ?>, </a></li>
                                                    <?php endif ?>
                                                <?php endforeach ?>
                                            </ul>
                                        </div>

                                        <!-- Post Like & Post Comment -->
                                        <div class="d-flex align-items-center post-like--comments">
                                            <a href="bai-viet/<?= $posts->id ?>" class="post-like"><img src="public/user/img/core-img/like.png" alt=""> <span><?= $posts->like ?></span></a>
                                            <a href="bai-viet/<?= $posts->id ?>" class="post-comment"><img src="public/user/img/core-img/chat.png" alt=""> <span><?= $posts->count_comments ?></span></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- About Author -->
                        <div class="blog-post-author d-flex">
                            <div class="author-thumbnail">
                                <img src="public/admin/upload/images/user/<?= $posts->user_img ?>" alt="<?= $posts->title ?>">
                            </div>
                            <div class="author-info">
                                <a href="#" class="author-name"><?= $posts->user_post_name ?></a>
                                <p><?= $posts->description ?></p>
                            </div>
                        </div>

                        <div class="section-heading">
                            <h6>Bài viết tương tự</h6>
                        </div>

                        <div class="row">
                            <?php foreach ($postsInvolve as $post) : ?>
                                <!-- Single Post -->
                                <div class="col-12 col-md-6">
                                    <div class="single-blog-post style-3 mb-80">
                                        <div class="post-thumb">
                                            <a href="bai-viet/<?= $post['id'] ?>"><img src="public/admin/upload/images/post/<?= $post['img'] ?>" alt=""></a>
                                        </div>
                                        <div class="post-data">
                                            <a href="bai-viet/<?= $post['id'] ?>" class="post-catagory"><?= $post['type_name'] ?></a>
                                            <a href="bai-viet/<?= $post['id'] ?>" class="post-title">
                                                <h6><?= $post['title'] ?></h6>
                                            </a>
                                            <div class="post-meta d-flex align-items-center">
                                                <a href="bai-viet/<?= $post['id'] ?>" class="post-like"><img src="public/user/img/core-img/like.png" alt=""> <span><?= $post['like'] ?></span></a>
                                                <a href="bai-viet/<?= $post['id'] ?>" class="post-comment"><img src="public/user/img/core-img/chat.png" alt=""> <span><?= $post['count_comments'] ?></span></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach ?>
                        </div>

                        <!-- Comment Area Start -->
                        <div class="comment_area clearfix">
                            <h5 class="title"><?= $posts->count_comments ?> bình luận</h5>
                            <?php foreach ($comments as $comment) : ?>
                            <ol>
                                <!-- Single Comment Area -->
                                <li class="single_comment_area">
                                    <!-- Comment Content -->
                                    <div class="comment-content d-flex">
                                        <!-- Comment Author -->
                                        <div class="comment-author">
                                            <img src="public/admin/upload/images/user/<?= $comment['user_img'] ?>" alt="author">
                                        </div>
                                        <!-- Comment Meta -->
                                        <div class="comment-meta">
                                            <a href="#" class="post-author"><?= $comment['user_post_name'] ?></a>
                                            <a href="#" class="post-date"><span class="date-convert-full" data-time="<?= $comment['created_date'] ?>"></span></a>
                                            <p><?= $comment['content'] ?></p>
                                        </div>
                                    </div>
                                </li>
                            </ol>
                            <?php endforeach ?>
                        </div>

                        <div class="post-a-comment-area section-padding-80-0">
                            <h4>Đánh giá cho bài viết</h4>
                            <!-- Reply Form -->
                            <div class="contact-form-area">
                                <?php if($this->session->has_userdata('loginInfo')) : ?>
                                <form action="send-comment-post" method="post">
                                    <div class="row">
                                        <input type="text" value="<?= $posts->id ?>" name="idPost" hidden>
                                        <div class="col-12">
                                            <textarea name="message" class="form-control" cols="30" rows="10" placeholder="Nhập nội dung bình luận" required maxlength="255"></textarea>
                                        </div>
                                        <div class="col-12 text-center">
                                            <button class="btn newspaper-btn mt-30 w-100" type="submit">Gửi bình luận bài viết</button>
                                        </div>
                                    </div>
                                </form>
                                <?php else : ?>
                                    <button class="btn newspaper-btn mt-30 w-100" type="button">Đăng nhập để bình luận</button>
                                <?php endif ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ##### Blog Area End ##### -->