<div class="blog-area section-padding-0-80">
    <div class="container">
        <div class="row">
            <div class="col-12 col-lg-12">
                <div class="blog-posts-area">
                    <div class="row d-flex justify-content-center">
                        <div class="col-6 col-lg-6">
                            <?php $old = $this->session->flashdata('old'); ?>
                            <?php $user = $this->session->userdata('loginInfo'); ?>
                            <form action="user/update/account" method="post" enctype="multipart/form-data">
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
            </div>
        </div>
    </div>
</div>