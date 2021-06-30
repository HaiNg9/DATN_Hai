<!-- Page Heading -->
<h1 class="h3 mb-1 text-gray-800">Chỉnh sửa loại tin tức</h1>

<!-- Content Row -->
<div class="row justify-content-center">

    <!-- Grow In Utility -->
    <div class="col-lg-6">

        <div class="card position-relative">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Thông tin loại tin</h6>
            </div>
            <div class="card-body">
                <?php $this->load->view('messages') ?>
                <?php $old = $this->session->flashdata('old'); ?>
                <form action="admin/type/update" method="post">
                    <input type="text" name="id" value="<?= $old['id'] ?? $type->id ?>" hidden>
                    <div class="form-group">
                        <label for="type-news">Thể loại tin tức</label>
                        <select name="id_category" class="form-control" id="type-news">
                            <?php foreach ($categories as $catogory) : ?>
                                <option value="<?= $catogory['id'] ?>" <?= $catogory['id'] === $type->id_category ? 'selected' : '' ?>><?= $catogory['name'] ?></option>
                            <?php endforeach ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Tên hiển thị</label>
                        <input value="<?= $old['name'] ?? $type->name ?>" name="name" type="text" class="form-control" placeholder="Nhập tên thể loại">
                    </div>
                    <button type="submit" class="btn btn-success">Lưu lại</button>
                    <button type="reset" class="btn btn-secondary">Hủy bỏ</button>
                </form>
            </div>
        </div>
    </div>

</div>