<!-- Page Heading -->
<h1 class="h3 mb-1 text-gray-800">Thêm thể loại tin tức</h1>

<!-- Content Row -->
<div class="row justify-content-center">

    <!-- Grow In Utility -->
    <div class="col-lg-6">

        <div class="card position-relative">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Thông tin thể loại</h6>
            </div>
            <div class="card-body">
                <?php $this->load->view('messages') ?>
                <?php $old = $this->session->flashdata('old'); ?>
                <form action="admin/category/create" method="post">
                    <div class="form-group">
                        <label>Tên hiển thị</label>
                        <input value="<?= $old['name'] ?? '' ?>" name="name" type="text" class="form-control" placeholder="Nhập tên thể loại">
                    </div>
                    <button type="submit" class="btn btn-success">Lưu lại</button>
                    <button type="reset" class="btn btn-secondary">Hủy bỏ</button>
                </form>
            </div>
        </div>
    </div>

</div>