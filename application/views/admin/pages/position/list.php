<!-- Page Heading -->
<h1 class="h3 mb-1 text-gray-800">Hệ thống chức vụ</h1>

<!-- Content Row -->
<div class="row justify-content-center">

    <!-- Grow In Utility -->
    <div class="col-lg-12">

        <div class="card position-relative">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Thông tin chức vụ</h6>
            </div>
            <div class="card-body">
                <?php $this->load->view('messages') ?>
                <?php $old = $this->session->flashdata('old'); ?>
                <form action="admin/position/update" method="post" id="form-position">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <div class="form-group">
                                    <label for="list-position">Danh sách chức vụ</label>
                                    <select class="form-control" id="list-position">
                                        <option value="0"></option>
                                        <?php foreach ($positions as $position) : ?>
                                            <option value="<?= $position['id'] ?>"><?= $position['name'] ?></option>
                                        <?php endforeach ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <label>Chức vụ</label>
                            <input name="name" id="position-name" type="text" class="form-control" placeholder="Nhập tên chức vụ">
                            <input name="id" id="position-id" type="text" hidden>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="form-group">
                            <label>Danh sách chi tiết</label>
                            <select style="min-height: 400px;" multiple class="form-control">
                                <?php foreach ($positions as $position) : ?>
                                    <option value="<?= $position['id'] ?>"><?= $position['name'] ?></option>
                                <?php endforeach ?>
                            </select>
                        </div>
                    </div>
                </form>
                <div class="form-group text-center">
                    <button type="button" class="btn btn-success" id="btn-save-position">Lưu lại</button>
                    <button type="button" class="btn btn-danger" id="btn-del-position" style="display: none;">Xóa bỏ</button>
                </div>
            </div>
        </div>

    </div>

</div>