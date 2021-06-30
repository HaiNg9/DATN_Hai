<!-- Popular News Widget -->
<div class="popular-news-widget mb-30">
    <h3><?= count($top4Posts) ?> tin xem nhiều nhất</h3>
    <?php $index = 1; ?>
    <?php foreach ($top4Posts as $itemTop) : ?>
        <!-- Single Popular Blog -->
        <div class="single-popular-post">
            <a href="bai-viet/<?= $itemTop['id'] ?>">
                <h6><span><?= $index; ?>.</span> <?= $itemTop['title'] ?></h6>
            </a>
            <p><span class="date-convert-full" data-time="<?= $itemTop['updated_date'] ?>"></span></p>
        </div>
        <?php $index++; ?>
    <?php endforeach ?>
</div>

<!-- Newsletter Widget -->
<div class="newsletter-widget">
    <h4>Thông báo</h4>
    <p>Để lại thông tin để nhận bài viết mới nhất từ chúng tôi.</p>
    <?php $old = $this->session->flashdata('old'); ?>
    <form action="subscribe" method="post">
        <input value="<?= $old['name'] ?? '' ?>" type="text" name="name" placeholder="Nhập">
        <input value="<?= $old['email'] ?? '' ?>" type="email" name="email" placeholder="Vui lòng nhập Email nhận thông báo">
        <button type="submit" class="btn w-100">Đăng ký</button>
    </form>
</div>