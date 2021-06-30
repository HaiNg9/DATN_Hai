<!-- Page Heading -->
<h1 class="h3 mb-1 text-gray-800">Tài khoản cá nhân</h1>

<!-- Content Row -->
<div class="row justify-content-center">

    <!-- Grow In Utility -->
    <div class="col-lg-6">

        <div class="card position-relative">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Thông tin tài khoản</h6>
            </div>
            <div class="card-body">
                <?php $this->load->view('messages') ?>
                <?php $old = $this->session->flashdata('old'); ?>
                <form action="admin/user/create" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="display-name">Tên hiển thị</label>
                        <input value="<?= $old['display_name'] ?? '' ?>" name="display_name" type="text" class="form-control" id="display-name" placeholder="Nhập tên hiển thị">
                    </div>
                    <div class="form-group">
                        <label for="email">Địa chỉ Email</label>
                        <input value="<?= $old['email'] ?? '' ?>" name="email" type="email" class="form-control" id="email" placeholder="Nhập địa chỉ Email">
                    </div>
                    <div class="form-group">
                        <label for="email">Mật khẩu đăng nhập</label>
                        <input value="<?= $old['password'] ?? '' ?>" type="password" name="password" class="form-control" id="password" placeholder="Nhập mật khẩu">
                    </div>
                    <div class="form-group">
                        <label for="email">Xác nhận mật khẩu</label>
                        <input value="<?= $old['password_confirm'] ?? '' ?>" type="password" name="password_confirm" class="form-control" id="password-confirm" placeholder="Nhập lại mật khẩu">
                    </div>
                    <div class="form-group">
                        <label for="input-choose-image">Hình đại diện</label>
                        <input name="img_user" type="file" accept="image/*" class="form-control-file" id="input-choose-image">
                    </div>
                    <div class="form-group">
                        <img id="img-show" style="width: 150px; height: 150px;" id="img-show" src="public/admin/upload/images/user/default.png" class="img-fluid" alt="Hình đại diện." >
                    </div>
                    <div class="form-group text-center">
                        <button type="submit" class="btn btn-success">Lưu lại</button>
                        <button type="reset" class="btn btn-secondary">Hủy bỏ</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>