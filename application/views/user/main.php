<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Title -->
    <title><?= $title ?></title>
    <base href="<?= base_url(); ?>">
    <!-- Favicon -->
    <link rel="icon" href="public/user/img/core-img/favicon.ico">
    <!-- Core Stylesheet -->
    <link rel="stylesheet" href="public/user/style.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.17.1/moment-with-locales.min.js"></script>
</head>

<body>
    <!-- ##### Header Start ##### -->
    <?php $this->load->view('user/layouts/header') ?>
    <!-- ##### Header End ##### -->

    <!-- ##### Hero Area Start ##### -->
    <div class="hero-area">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-12 col-lg-8">
                    <!-- Breaking News Widget -->
                    <div class="breaking-news-area d-flex align-items-center">
                        <div class="news-title">
                            <p>Tin mới</p>
                        </div>
                        <div id="breakingNewsTicker" class="ticker">
                            <ul>
                                <?php foreach($newPosts as $newPost) : ?>
                                    <li><a href="bai-viet/<?= $newPost['id'] ?>"><?= $newPost['title'] ?></a></li>
                                <?php endforeach ?>
                            </ul>
                        </div>
                    </div>

                    <!-- Breaking News Widget -->
                    <div class="breaking-news-area d-flex align-items-center mt-15">
                        <div class="news-title title2">
                            <p>Tin nổi bật</p>
                        </div>
                        <div id="internationalTicker" class="ticker">
                            <ul>
                                <?php foreach($topPosts as $topPost) : ?>
                                    <li><a href="bai-viet/<?= $topPost['id'] ?>"><?= $topPost['title'] ?></a></li>
                                <?php endforeach ?>
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- Hero Add -->
                <div class="col-12 col-lg-4">
                    <div class="hero-add">
                        <a href="#"><img src="public/user/img/bg-img/hero-add.gif" alt=""></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ##### Hero Area End ##### -->

    <!-- ##### Content Start ##### -->
    <?php $this->load->view($contentName) ?>
    <!-- ##### Content End ##### -->

    <!-- ##### Footer Start ##### -->
    <?php $this->load->view('user/layouts/footer') ?>
    <!-- ##### Footer End ##### -->

    <!-- ##### All Javascript Files ##### -->
    <!-- jQuery-2.2.4 js -->
    <script src="public/user/js/jquery/jquery-2.2.4.min.js"></script>
    <!-- Popper js -->
    <script src="public/user/js/bootstrap/popper.min.js"></script>
    <!-- Bootstrap js -->
    <script src="public/user/js/bootstrap/bootstrap.min.js"></script>
    <!-- All Plugins js -->
    <script src="public/user/js/plugins/plugins.js"></script>
    <!-- Active js -->
    <script src="public/user/js/active.js"></script>
    <?php if (!empty($script)) : ?>
        <?php foreach ($script as $link) : ?>
            <?= '<script src="'.$link.'"></script>'?>
        <?php endforeach ?>
    <?php endif ?>
</body>

</html>