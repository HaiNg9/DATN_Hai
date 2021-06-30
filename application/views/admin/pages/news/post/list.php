<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">Danh sách bài viết</h1>
<?php $this->load->view('messages') ?>
<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary"><a href="admin/post/add" type="button" class="btn btn-success">Thêm mới</a></h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Mã</th>
                        <th>Tiêu đề</th>
                        <th>Hình đại diện</th>
                        <th>Lượt thích</th>
                        <th>Ghi chú</th>
                        <th>Thể loại</th>
                        <th>Người đăng</th>
                        <th>Ngày đăng</th>
                        <th>Cập nhật bởi</th>
                        <th>Ngày cập nhật</th>
                        <th>Chức năng</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>Mã</th>
                        <th>Tiêu đề</th>
                        <th>Hình đại diện</th>
                        <th>Lượt thích</th>
                        <th>Ghi chú</th>
                        <th>Thể loại</th>
                        <th>Người đăng</th>
                        <th>Ngày đăng</th>
                        <th>Cập nhật bởi</th>
                        <th>Ngày cập nhật</th>
                        <th>Chức năng</th>
                    </tr>
                </tfoot>
                <tbody>
                    <?php foreach ($posts as $post) : ?>
                        <tr>
                            <td><?= $post['id'] ?></td>
                            <td><?= $post['title'] ?></td>
                            <td align="center">
                                <img style="width: 100px;" src="public/admin/upload/images/post/<?= $post['img'] ?>" alt="">
                            </td>
                            <td><?= $post['like'] ?></td>
                            <td><?= $post['description'] ?></td>
                            <td><?= $post['name_type'] ?></td>
                            <td>
                                <a href="admin/user/edit/<?= $post['created_by'] ?>"><?= $post['name_user_create'] ?></a>
                            </td>
                            <td><?= $post['created_date'] ?></td>
                            <?php if ($post['updated_by'] != 0) :?>
                                <td><a href="admin/user/edit/<?= $post['updated_by'] ?>"><?= $post['name_user_update'] ?></a></td>
                                <td><?= $post['updated_date'] ?></td>
                            <?php else : ?>
                                <td>Chưa chỉnh sửa</td>
                                <td>Chưa chỉnh sửa</td>
                            <?php endif ?>
                            <td>
                                <a href="admin/post/edit/<?= $post['id'] ?>" class="btn btn-secondary btn-circle btn-sm">
                                    <i class="far fa-eye"></i>
                                </a>
                                <a class="btn btn-danger btn-circle btn-sm btn-delete-confirm" data-url="admin/post/delete/<?= $post['id'] ?>">
                                    <i class="fas fa-trash"></i>
                                </a>
                            </td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>
    </div>
</div>