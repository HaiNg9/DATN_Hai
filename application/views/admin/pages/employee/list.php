<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">Danh sách nhân viên</h1>
<?php $this->load->view('messages') ?>
<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary"><a href="admin/employee/add" type="button" class="btn btn-success">Thêm mới</a></h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Mã</th>
                        <th>Tên</th>
                        <th>Hình ảnh</th>
                        <th>Tạo bởi</th>
                        <th>Ngày tạo</th>
                        <th>Cập nhật bởi</th>
                        <th>Ngày cập nhật</th>
                        <th>Chức năng</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>Mã</th>
                        <th>Tên</th>
                        <th>Hình ảnh</th>
                        <th>Tạo bởi</th>
                        <th>Ngày tạo</th>
                        <th>Cập nhật bởi</th>
                        <th>Ngày cập nhật</th>
                        <th>Chức năng</th>
                    </tr>
                </tfoot>
                <tbody>
                    <?php foreach ($employees as $employee) : ?>
                        <tr>
                            <td><?= $employee['id'] ?></td>
                            <td><?= $employee['name'] ?></td>
                            <td class="text-center"><img style="width: 155px; height: 200px;" src="public/admin/upload/images/employee/<?= $employee['img'] ?>" alt="<?= $employee['name'] ?>"></td>
                            <td><a href="admin/employee/edit/<?= $employee['created_by'] ?>"><?= $employee['name_user_create'] ?></a></td>
                            <td><?= $employee['created_date'] ?></td>
                            <?php if ($employee['updated_by'] != 0) :?>
                                <td><a href="admin/employee/edit/<?= $employee['updated_by'] ?>"><?= $employee['name_user_update'] ?></a></td>
                                <td><?= $employee['updated_date'] ?></td>
                            <?php else : ?>
                                <td>Chưa chỉnh sửa</td>
                                <td>Chưa chỉnh sửa</td>
                            <?php endif ?>
                            <td class="text-center">
                                <a href="admin/employee/edit/<?= $employee['id'] ?>" class="btn btn-secondary btn-circle btn-sm">
                                    <i class="fas fa-user-edit"></i>
                                </a>
                                <a class="btn btn-danger btn-circle btn-sm btn-delete-confirm" data-url="admin/employee/delete/<?= $employee['id'] ?>">
                                    <i class="fas fa-trash"></i>
                                </a>
                            </td>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>
    </div>
</div>