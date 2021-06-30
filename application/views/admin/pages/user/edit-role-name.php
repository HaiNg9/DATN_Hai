<!-- Page Heading -->
<h1 class="h3 mb-1 text-gray-800">Chỉnh sửa tên quyền</h1>

<!-- Content Row -->
<div class="row justify-content-center">

    <!-- Grow In Utility -->
    <div class="col-lg-6">

        <div class="card position-relative">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Thông tin quyền</h6>
            </div>
            <div class="card-body">
                <?php $this->load->view('messages') ?>
                <?php $old = $this->session->flashdata('old'); ?>
                <form action="admin/user/updateRoleName" method="post">
                    <input type="text" name="id" value="<?= $old['id'] ?? $role->id ?>" hidden>
                    <div class="form-group">
                        <label>Tên hiển thị</label>
                        <input value="<?= $old['display_name'] ?? $role->display_name ?>" name="display_name" type="text" class="form-control" placeholder="Nhập tên quyền">
                    </div>
                    <button type="submit" class="btn btn-success">Lưu lại</button>
                    <button type="reset" class="btn btn-secondary">Hủy bỏ</button>
                </form>
            </div>
        </div>
    </div>

</div>