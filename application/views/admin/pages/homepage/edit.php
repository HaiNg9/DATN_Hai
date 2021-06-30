<!-- Page Heading -->
<h1 class="h3 mb-1 text-gray-800">Cài đặt trang chủ người dùng</h1>

<!-- Content Row -->
<div class="row justify-content-center">

    <!-- Grow In Utility -->
    <div class="col-lg-12">
        <div class="card position-relative">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Thông tin cài đặt</h6>
            </div>
            <div class="card-body">
                <?php $this->load->view('messages') ?>
                <?php $old = $this->session->flashdata('old'); ?>
                <form action="admin/homepage/update" method="post" enctype="multipart/form-data">
                    <input type="text" name="id" value="<?= $homeData->id ?>" hidden>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label>Hình ảnh logo</label>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group d-flex justify-content-center" style="background-color: #ee002d;">
                                <img id="img-show" id="img-show" src="public/admin/upload/images/logo/<?= $homeData->logo ?>" class="img-fluid" alt="logo">
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <input name="img_logo" type="file" accept="image/*" class="form-control-file" id="input-choose-image">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Email</label>
                                <input value="<?= $old['email'] ?? $homeData->email ?>" name="email" type="email" class="form-control" placeholder="Nhập email">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Số điện thoại</label>
                                <input value="<?= $old['phone'] ?? $homeData->phone ?>" name="phone" type="text" class="form-control" placeholder="Nhập số điện thoại">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Đường dẫn trang web</label>
                                <input value="<?= $old['web_link'] ?? $homeData->web_link ?>" name="web_link" type="text" class="form-control" placeholder="Nhập đừng dẫn trang web">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Người cập nhật</label>
                                <input value="<?= $old['name_user_update'] ?? $homeData->name_user_update ?>" type="text" class="form-control" placeholder="Chưa được cập nhật" readonly>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Ngày cập nhật</label>
                                <input value="<?= $old['updated_date'] ?? $homeData->updated_date ?>" type="text" class="form-control" placeholder="Chưa được cập nhật" readonly>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-success">Lưu lại</button>
                    <button type="reset" class="btn btn-secondary">Hủy bỏ</button>
                </form>
            </div>
        </div>
    </div>

</div>