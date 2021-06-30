<div class="row d-flex justify-content-center">
    <div class="col-md-12">
        <?php if ($history->status === 'INSERT') :  ?>
            <?php $status = 'success'; ?>
        <?php elseif ($history->status === 'UPDATE' ) : ?>
            <?php $status = 'warning'; ?>
        <?php elseif ($history->status === 'DELETE' ) : ?>
            <?php $status = 'danger'; ?>
        <?php endif ?>
        <div class="card bg-<?= $status ?> text-white shadow">
            <a href="admin/history/edit/<?= $history->id ?>" class="card-body text-decoration-none text-white">
                <h6><?= $history->message ?></h6>
            </a>
        </div>
    </div>
</div>
<br>
<div class="row d-flex justify-content-center">
    <div class="col-md-8">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Tài khoản cập nhật</h6>
            </div>
            <div class="card-body">
                <div class="form-group">
                    <label for="display-name">Tên tài khoản</label>
                    <input value="<?= $users->display_name ?>" type="text" class="form-control" readonly>
                </div>
                <div class="form-group">
                    <label for="display-name">Email</label>
                    <input value="<?= $users->email ?>" type="text" class="form-control" readonly>
                </div>
            </div>
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Dữ liệu tác động</h6>
            </div>
            <div class="card-body">
                <div class="form-group">
                    <label for="display-name">Bảng dữ liệu</label>
                    <input value="<?= $history->table ?>" type="text" class="form-control" readonly>
                </div>
                <div class="form-group">
                    <label for="display-name">Mã bảng dữ liệu</label>
                    <input value="<?= $history->id_table ?>" type="text" class="form-control" readonly>
                </div>
                <div class="form-group">
                    <label for="display-name">Tên bảng dữ liệu</label>
                    <input value="<?= $history->name_table ?>" type="text" class="form-control" readonly>
                </div>
            </div>
        </div>
        <button class="btn btn-google btn-block btn-del-forever" data-url="admin/history/delete/<?= $history->id ?>">Xóa bỏ thông báo</button>
    </div>
</div>