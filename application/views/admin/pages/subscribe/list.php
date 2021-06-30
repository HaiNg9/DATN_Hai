<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">Danh sách email đăng ký nhận thông báo</h1>
<?php $this->load->view('messages') ?>
<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Mã</th>
                        <th>Tên</th>
                        <th>Email</th>
                        <th>Ngày tạo</th>
                        <th>Chức năng</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>Mã</th>
                        <th>Tên</th>
                        <th>Email</th>
                        <th>Ngày tạo</th>
                        <th>Chức năng</th>
                    </tr>
                </tfoot>
                <tbody>
                    <?php foreach ($subscribe as $itemSub) : ?>
                        <tr>
                            <td><?= $itemSub['id'] ?></td>
                            <td><?= $itemSub['name'] ?></td>
                            <td><?= $itemSub['email'] ?></td>
                            <td><?= $itemSub['created_date'] ?></td>
                            <td class="text-center">
                                <a class="btn btn-danger btn-circle btn-sm btn-delete-confirm" data-url="admin/subscribe/delete/<?= $itemSub['id'] ?>">
                                    <i class="fas fa-trash"></i>
                                </a>
                            </td>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>
    </div>
</div>