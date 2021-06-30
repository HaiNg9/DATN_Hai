<!-- Page Heading -->
<h1 class="h3 mb-1 text-gray-800">Đăng tin tức</h1>

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
                <form action="admin/post/create" method="post" enctype="multipart/form-data">
                    <input type="text" name="id" value="<?= $old['id'] ?? '' ?>" hidden>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label>Tiêu đề bài viết</label>
                                <input value="<?= $old['title'] ?? '' ?>" name="title" type="text" class="form-control" placeholder="Nhập tiêu đề bài viết">
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
                                <img id="img-show" style="max-width: 1000px;" src="public/admin/upload/images/post/default.png" alt="hình đại diện">
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
                                <input value="<?= $old['description'] ?? '' ?>" name="description" type="text" class="form-control" placeholder="Nhập mô tả bài viết">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Thể loại</label>
                                <select name="id_category" class="form-control" id="category-news">
                                    <?php foreach ($categories as $catogory) : ?>
                                        <option value="<?= $catogory['id'] ?>"><?= $catogory['name'] ?></option>
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
                                        <option value="<?= $type['id'] ?>"><?= $type['name'] ?></option>
                                    <?php endforeach ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label>Nội dung</label>
                                <textarea name="content" id="editer-posts"><?= $old['content'] ?? '' ?></textarea>
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