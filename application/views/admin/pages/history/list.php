<div class="row">
    <div class="col-md-6">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Thông báo mới</h6>
        </div>
        <br>
        <?php foreach ($newHistory as $itemHistory) : ?>
            <?php if ($itemHistory['status'] === 'INSERT') : ?>
                <div class="card bg-success text-white shadow">
                    <a href="admin/history/edit/<?= $itemHistory['id'] ?>" class="card-body text-decoration-none text-white">
                        <h6><?= $itemHistory['message'] ?></h6>
                    </a>
                </div>
            <?php elseif ($itemHistory['status'] === 'UPDATE') : ?>
                <div class="card bg-warning text-white shadow">
                    <a href="admin/history/edit/<?= $itemHistory['id'] ?>" class="card-body text-decoration-none text-white">
                        <h6><?= $itemHistory['message'] ?></h6>
                    </a>
                </div>
            <?php elseif ($itemHistory['status'] === 'DELETE') : ?>
                <div class="card bg-danger text-white shadow">
                    <a href="admin/history/edit/<?= $itemHistory['id'] ?>" class="card-body text-decoration-none text-white">
                        <h6><?= $itemHistory['message'] ?></h6>
                    </a>
                </div>
            <?php endif ?>
            <hr>
        <?php endforeach ?>
    </div>
    <div class="col-md-6">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Thông báo đã đọc</h6>
        </div>
        <br>
        <?php foreach ($oldHistory as $itemHistory) : ?>
            <?php if ($itemHistory['status'] === 'INSERT') : ?>
                <div class="card bg-success text-white shadow">
                    <a href="admin/history/edit/<?= $itemHistory['id'] ?>" class="card-body text-decoration-none text-white">
                        <h6><?= $itemHistory['message'] ?></h6>
                    </a>
                </div>
            <?php elseif ($itemHistory['status'] === 'UPDATE') : ?>
                <div class="card bg-warning text-white shadow">
                    <a href="admin/history/edit/<?= $itemHistory['id'] ?>" class="card-body text-decoration-none text-white">
                        <h6><?= $itemHistory['message'] ?></h6>
                    </a>
                </div>
            <?php elseif ($itemHistory['status'] === 'DELETE') : ?>
                <div class="card bg-danger text-white shadow">
                    <a href="admin/history/edit/<?= $itemHistory['id'] ?>" class="card-body text-decoration-none text-white">
                        <h6><?= $itemHistory['message'] ?></h6>
                    </a>
                </div>
            <?php endif ?>
            <hr>
        <?php endforeach ?>
    </div>
</div>