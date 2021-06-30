<!-- Page Heading -->
<h1 class="h3 mb-1 text-gray-800">Tài khoản cá nhân</h1>

<!-- Content Row -->
<div class="row">

    <!-- Grow In Utility -->
    <div class="col-lg-6">

        <div class="card position-relative">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Thông tin tài khoản</h6>
            </div>
            <div class="card-body">
                <?php $this->load->view('messages') ?>
                <?php $old = $this->session->flashdata('old'); ?>
                <form action="admin/user/update" method="post" enctype="multipart/form-data">
                    <input type="text" name="id" value="<?= $old['id'] ?? $user->id ?>" hidden>
                    <div class="form-group">
                        <label for="display-name">Tên hiển thị</label>
                        <input value="<?= $old['display_name'] ?? $user->display_name ?>" name="display_name" type="text" class="form-control" id="display-name" placeholder="Nhập tên hiển thị">
                    </div>
                    <div class="form-group">
                        <label for="email">Địa chỉ Email</label>
                        <input value="<?= $old['email'] ?? $user->email ?>" name="email" type="email" class="form-control" id="email" placeholder="Nhập địa chỉ Email">
                    </div>
                    <div class="form-group form-check">
                        <input name="change_password" type="checkbox" class="form-check-input" id="change-password" <?= isset($old['change_password']) ? 'checked' : '' ?>>
                        <label class="form-check-label" for="change-password">Thay đổi mật khẩu</label>
                    </div>
                    <div class="form-group">
                        <input type="password" name="password" class="form-control" id="password" placeholder="Nhập mật khẩu" <?= isset($old['change_password']) ? '' : 'readonly' ?>>
                    </div>
                    <div class="form-group">
                        <input type="password" name="password_confirm" class="form-control" id="password-confirm" placeholder="Nhập lại mật khẩu" <?= isset($old['change_password']) ? '' : 'readonly' ?>>
                    </div>
                    <div class="form-group">
                        <label for="input-choose-image">Hình đại diện</label>
                        <input name="img_user" type="file" accept="image/*" class="form-control-file" id="input-choose-image">
                    </div>
                    <div class="form-group">
                        <img id="img-show" style="width: 150px; height: 150px;" id="img-show" src="public/admin/upload/images/user/<?= $user->img ?>" class="img-fluid" alt="Hình đại diện.">
                    </div>
                    <button type="submit" class="btn btn-success">Lưu lại</button>
                    <button type="reset" id="btn-reset-edit-user" class="btn btn-secondary">Hủy bỏ</button>
                </form>
            </div>
        </div>
    </div>

    <div class="col-lg-6">
        <div class="card-group">
            <div class="card text-center">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Hiển thị tài khoản</h6>
                </div>
                <div>
                    <img style="width : 200px" class="card-img-top text-center" src="public/admin/upload/images/user/<?= $user->img ?>" alt="Hình đại diện">
                </div>
                <div class="card-body">
                    <h5 class="card-title"><strong><?= $user->display_name ?></strong></h5>
                    <p class="card-text"><i>Chức vụ: </i><strong><?= $user->role ?></strong></p>
                    <p class="card-text"><i>Email: </i><strong><?= $user->email ?></strong></p>
                    <p class="card-text"><small class="text-muted" id="user-edit-update-time" data-time="<?= $user->updated_date ?>"></small></p>
                </div>
            </div>
        </div>
    </div>
</div>