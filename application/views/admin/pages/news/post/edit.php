<!-- Page Heading -->
<h1 class="h3 mb-1 text-gray-800">Chỉnh sửa tin tức</h1>

<!-- Content Row -->
<div class="row justify-content-center">

    <!-- Grow In Utility -->
    <div class="col-lg-12">

        <div class="card position-relative">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Thông tin bài viết</h6>
            </div>
            <div class="card-body">
                <?php $this->load->view('messages') ?>
                <?php $old = $this->session->flashdata('old'); ?>
                <form action="admin/post/update" method="post" enctype="multipart/form-data">
                    <input type="text" name="id" value="<?= $old['id'] ?? $post->id ?>" hidden>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label>Tiêu đề bài viết</label>
                                <input value="<?= $old['title'] ?? $post->title ?>" name="title" type="text" class="form-control" placeholder="Nhập tiêu đề bài viết">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label>Hình ảnh đại diện</label>
                            </div>
                        </div>
                        <div class="col-lg-12 d-flex justify-content-center">
                            <div class="form-group">
                                <img id="img-show" style="max-width: 1000px;" src="public/admin/upload/images/post/<?= $post->img ?>" alt="<?= $post->title ?>">
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group">
                                <input id="input-choose-image" type="file" name="img_post">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label>Mô tả bài viết</label>
                                <input value="<?= $old['description'] ?? $post->description ?>" name="description" type="text" class="form-control" placeholder="Nhập mô tả bài viết">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Thể loại</label>
                                <select name="id_category" class="form-control" id="category-news">
                                    <?php foreach ($categories as $catogory) : ?>
                                        <option value="<?= $catogory['id'] ?>" <?= $catogory['id'] === $post->id_type ? 'selected' : '' ?>><?= $catogory['name'] ?></option>
                                    <?php endforeach ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Loại tin</label>
                                <select name="id_type" class="form-control" id="type-news">
                                    <?php foreach ($types as $type) : ?>
                                        <option value="<?= $type['id'] ?>" <?= $type['id'] === $post->id_type ? 'selected' : '' ?>><?= $type['name'] ?></option>
                                    <?php endforeach ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label>Nội dung</label>
                                <textarea name="content" id="editer-posts"><?= $old['content'] ?? $post->content ?></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Tác giả</label>
                                <input value="<?= $old['name_user_create'] ?? $post->name_user_create ?>" name="name_user_create" type="text" class="form-control" disabled>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Ngày đăng</label>
                                <input value="<?= $old['created_date'] ?? $post->created_date ?>" name="created_date" type="text" class="form-control" disabled>
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

<!-- Page Heading -->

<hr>

<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Danh sách bình luận bài viết</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Mã</th>
                        <th>Nội dung</th>
                        <th>Người bình luận</th>
                        <th>Ngày bình luận</th>
                        <th>Người cập nhật</th>
                        <th>Ngày cập nhật</th>
                        <th>Chức năng</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>Mã</th>
                        <th>Nội dung</th>
                        <th>Người bình luận</th>
                        <th>Ngày bình luận</th>
                        <th>Người cập nhật</th>
                        <th>Ngày cập nhật</th>
                        <th>Chức năng</th>
                    </tr>
                </tfoot>
                <tbody>
                    <?php foreach ($comments as $comment) : ?>
                        <tr <?= $comment['del_flag'] != 0 ? 'style="text-decoration: line-through;"' : ''?>>
                            <td><?= $comment['id'] ?></td>
                            <td><?= $comment['content'] ?></td>
                            <td><?= $comment['display_name'] ?></td>
                            <td><?= $comment['created_date'] ?></td>
                            <?php if ($comment['updated_by'] != 0) :?>
                                <td><a href="admin/user/edit/<?= $comment['updated_by'] ?>"><?= $comment['name_user_update'] ?></a></td>
                                <td><?= $comment['updated_date'] ?></td>
                            <?php else : ?>
                                <td>Chưa chỉnh sửa</td>
                                <td>Chưa chỉnh sửa</td>
                            <?php endif ?>
                            <td align="center">
                                <?php if ($comment['del_flag'] == 0) :?>
                                    <a href="admin/comment/edit/<?= $comment['id'] ?>" class="btn btn-warning btn-circle btn-sm">
                                    <i class="fas fa-lock-open"></i>
                                <?php else : ?>
                                    <a href="admin/comment/edit/<?= $comment['id'] ?>" class="btn btn-warning btn-circle btn-sm">
                                    <i class="fas fa-lock"></i>
                                <?php endif ?>
                            </td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>
    </div>
</div>