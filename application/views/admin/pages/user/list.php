<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">Danh sách tài khoản</h1>
<?php $this->load->view('messages') ?>
<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary"><a href="admin/user/add" type="button" class="btn btn-success">Thêm mới</a></h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Mã</th>
                        <th>Tên hiển thị</th>
                        <th>Email</th>
                        <th>Quyền</th>
                        <th>Hình ảnh</th>
                        <th>Ngày tạo</th>
                        <th>Ngày cập nhật</th>
                        <th>Chức năng</th>
                        <th>Quyền truy cập hệ thống</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>Mã</th>
                        <th>Tên hiển thị</th>
                        <th>Email</th>
                        <th>Quyền</th>
                        <th>Hình ảnh</th>
                        <th>Ngày tạo</th>
                        <th>Ngày cập nhật</th>
                        <th>Chức năng</th>
                        <th>Quyền truy cập hệ thống</th>
                    </tr>
                </tfoot>
                <tbody>
                    <?php foreach ($users as $user) : ?>
                        <?php if ($this->session->userdata('loginInfo')->id != 1 && $user['id'] == 1) : ?>
                            <?php continue; ?>
                        <?php endif ?>
                        <tr style="color: <?= $user['id'] === $this->session->userdata('loginInfo')->id ? '#5614d8' : 'none' ?>;">
                            <td><?= $user['id'] ?></td>
                            <td><?= $user['display_name'] ?></td>
                            <td><?= $user['email'] ?></td>
                            <td>
                                <div class="form-group">
                                    <select id="text-role-user-<?= $user['id'] ?>" class="form-control" id="exampleFormControlSelect1">
                                        <option><?= $user['role'] ?></option>
                                        <option><?= $user['role'] === 'USER' ? 'ADMIN' : 'USER' ?></option>
                                    </select>
                                </div>
                            </td>
                            <td class="text-center"><img style="width: 150px; height: 150px;" src="public/admin/upload/images/user/<?= $user['img'] ?>" alt="<?= $user['display_name'] ?>"></td>
                            <td><?= $user['created_date'] ?></td>
                            <td><?= $user['updated_date'] ?></td>
                            <td class="text-center">
                                <a class="btn btn-success btn-circle btn-sm btn-save-role-user" data-id="<?= $user['id'] ?>">
                                    <i class="far fa-save"></i>
                                </a>
                                <a href="admin/user/edit/<?= $user['id'] ?>" class="btn btn-secondary btn-circle btn-sm">
                                    <i class="fas fa-user-edit"></i>
                                </a>
                                <?php if ($user['id'] !== '1') : ?>
                                <a class="btn btn-danger btn-circle btn-sm btn-delete-confirm" data-url="admin/user/delete/<?= $user['id'] ?>">
                                    <i class="fas fa-trash"></i>
                                </a>
                                <?php endif ?>
                            </td>
                            <td class="text-center">
                                <a <?= $user['id'] !== '1' ? 'href=admin/user/editRoleNumber/'.$user['id'] : '' ?> class="btn btn-info btn-icon-split">
                                    <span class="icon text-white-50">
                                        <i class="fas fa-user-lock"></i>
                                    </span>
                                    <span class="text">Thay đổi</span>
                                </a>
                            </td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>
    </div>
</div>