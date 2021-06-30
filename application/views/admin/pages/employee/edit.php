<!-- Page Heading -->
<h1 class="h3 mb-1 text-gray-800">Chỉnh sửa nhân viên</h1>

<!-- Content Row -->
<div class="row justify-content-center">

    <!-- Grow In Utility -->
    <div class="col-lg-6">

        <div class="card position-relative">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Thông tin nhân viên</h6>
            </div>
            <div class="card-body">
                <?php $this->load->view('messages') ?>
                <?php $old = $this->session->flashdata('old'); ?>
                <form action="admin/employee/update" method="post" enctype="multipart/form-data">
                    <input type="text" name="id" value="<?= $old['id'] ?? $employee->id ?>" hidden>
                    <div class="form-group">
                        <label for="position-employee">Chức vụ</label>
                        <select name="id_position" class="form-control" id="position-employee">
                            <?php foreach ($positions as $position) : ?>
                                <option value="<?= $position['id'] ?>" <?= $position['id'] === $employee->id_position ? 'selected' : '' ?>><?= $position['name'] ?></option>
                            <?php endforeach ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Tên nhân viên</label>
                        <input value="<?= $old['name'] ?? $employee->name ?>" name="name" type="text" class="form-control" placeholder="Nhập tên nhân viên">
                    </div>
                    <div class="form-group">
                        <label for="input-choose-image">Hình ảnh nhân viên</label>
                        <input name="img_employee" type="file" accept="image/*" class="form-control-file" id="input-choose-image">
                    </div>
                    <div class="form-group">
                        <img id="img-show" style="width: 255px; height: 300px;" id="img-show" src="public/admin/upload/images/employee/<?= $employee->img ?>" class="img-fluid" alt="Hình đại diện." >
                    </div>
                    <button type="submit" class="btn btn-success">Lưu lại</button>
                    <button type="reset" class="btn btn-secondary">Hủy bỏ</button>
                </form>
            </div>
        </div>
    </div>

</div>