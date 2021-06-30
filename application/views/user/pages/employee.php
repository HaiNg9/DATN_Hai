 <!-- ##### About Area Start ##### -->
 <section class="about-area">
        <div class="container">

            <div class="row align-items-center mt-80">
                <?php foreach($positions as $position) : ?>
                <!-- Single Cool Fact -->
                <div class="col-12 col-sm-6 col-lg-3">
                    <div class="single-cool-fact d-flex align-items-center">
                        <h3><span class="counter"><?= $position['count_employees'] ?></span></h3>
                        <div class="cf-text">
                            <h6><?= $position['name'] ?></h6>
                            <span>Nhân viên chính thức</span>
                        </div>
                    </div>
                </div>
                <?php endforeach ?>
            </div>
        </div>
    </section>
    <!-- ##### About Area End ##### -->

    <!-- ##### Team Area Start ##### -->
    <section class="newspaper-team mb-30">
        <div class="container">
            <div class="row">
                <?php foreach ($employees as $employee) : ?>
                <!-- Single Team Member -->
                <div class="col-12 col-sm-6 col-lg-3">
                    <div class="single-team-member">
                        <img src="http://localhost/NewsWebsite/public/admin/upload/images/employee/<?= $employee['img'] ?>" alt="">
                        <div class="team-info">
                            <h5><?= $employee['name'] ?></h5>
                            <h6><?= $employee['name_position'] ?></h6>
                        </div>
                    </div>
                </div>
                <?php endforeach ?>
            </div>
        </div>
    </section>
    <!-- ##### Team Area End ##### -->