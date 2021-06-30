<!-- ##### Footer Add Area Start ##### -->
<div class="footer-add-area">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="footer-add">
                        <a href="#"><img src="public/user/img/bg-img/footer-add.gif" alt=""></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ##### Footer Add Area End ##### -->

    <!-- ##### Footer Area Start ##### -->
    <footer class="footer-area">

        <!-- Main Footer Area -->
        <div class="main-footer-area">
            <div class="container">
                <div class="row">

                    <!-- Footer Widget Area -->
                    <div class="col-12 col-sm-6 col-lg-4">
                        <div class="footer-widget-area mt-80">
                            <!-- Footer Logo -->
                            <div class="footer-logo">
                                <a href="trang-chu.html"><img src="public/user/img/core-img/logo.png" alt=""></a>
                            </div>
                            <!-- List -->
                            <ul class="list">
                                <li><a href="mailto:contact@youremail.com">contact@youremail.com</a></li>
                                <li><a href="tel:+4352782883884">+43 5278 2883 884</a></li>
                                <li><a href="http://yoursitename.com">www.yoursitename.com</a></li>
                            </ul>
                        </div>
                    </div>
                    <?php foreach ($typesFooter as $categoryFooter) : ?>
                    <!-- Footer Widget Area -->
                    <div class="col-12 col-sm-6 col-lg-2">
                        <div class="footer-widget-area mt-80">
                            <!-- Title -->
                            <h6 class="widget-title"><?= $categoryFooter['name'] ?></h6>
                            <!-- List -->
                            <ul class="list">
                                <?php foreach ($categoryFooter['types'] as $itemTypes) : ?>
                                    <li><a href="loai-tin/<?= $itemTypes['id'] ?>/1"><?= $itemTypes['name'] ?></a></li>
                                <?php endforeach ?>
                            </ul>
                        </div>
                    </div>
                    <?php endforeach ?>
                </div>
            </div>
        </div>

        <!-- Bottom Footer Area -->
        <div class="bottom-footer-area">
            <div class="container h-100">
                <div class="row h-100 align-items-center">
                    <div class="col-12">
                        <!-- Copywrite -->
                        <p><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
Bản quyền &copy;<script>document.write(new Date().getFullYear());</script> thuộc về Bất động sản DCN | Thiết kế bởi <i class="fa fa-heart-o" aria-hidden="true"></i> by <a href="https://www.youtube.com/channel/UCwBHZqLqgZUTWLLaQLfoJ1g?sub_confirmation=1" target="_blank">DCN</a>
<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. --></p>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- ##### Footer Area Start ##### -->