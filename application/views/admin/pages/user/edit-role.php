<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">Danh sách quyền hệ thống</h1>
<?php $this->load->view('messages') ?>
<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">
            <?php if ($this->session->userdata('loginInfo')->id == 1 || $userId != 1) : ?>
                <button type="button" class="btn btn-success" id="btn-changeRole-user">Lưu lại</button>
            <?php endif ?>
        </h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead class="text-center">
                    <tr>
                        <th>Đường dẫn</th>
                        <th>Tên chức năng</th>
                        <th>
                            Trạng thái
                        </th>
                    </tr>
                </thead>
                <tfoot class="text-center">
                    <tr>
                        <th>Đường dẫn</th>
                        <th>Tên chức năng</th>
                        <th>Trạng thái</th>
                    </tr>
                </tfoot>
                <tbody>
                    <tr>
                        <td></td>
                        <td></td>
                        <td class="text-center">
                            <input id="check-all-role-user" type="checkbox" checked>
                        </td>
                    </tr>
                    <?php foreach ($roles as $role) : ?>
                        <tr>
                            <td><?= $role['name'] ?></td>
                            <td><a <?= $role['id'] !== '1' ? 'href="admin/user/editRoleName/'.$role['id'].'"' : '' ?>><?= $role['display_name'] ?></a></td>
                            <td class="text-center">
                                <input value="<?= $role['id'] ?>" type="checkbox" class="checkbox-role-user" <?= in_array($role['id'], $userRole) ? 'checked' : ''?> <?= $role['id'] == 1 ? 'disabled' : ''?>>
                            </td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>
    </div>
    <div>
        <form id="form-change-role-user" action="admin/user/updateRoleNumber" method="post">
            <input name="role_number" id="txt-value-roles" type="text" value="" hidden>
            <input name="id" type="text" value="<?= $userId ?>" hidden>
        </form>
    </div>
</div>