<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">Dữ liệu đã xóa</h1>
<?php $this->load->view('messages') ?>
<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3" style="display: flex; justify-content: flex-end;">
        <form action="admin/bin/list" method="post" id="form-search-bin-data">
            <div class="input-group">
                <select name="table" class="form-control" id="choose-bin-table">
                    <option selected value="0">-- Chọn dữ liệu --</option>
                    <option <?= $tableID === '1' ? 'selected' : '' ?> value="1">Thể loại tin tức</option>
                    <option <?= $tableID === '2' ? 'selected' : '' ?> value="2">Loại tin tức</option>
                    <option <?= $tableID === '7' ? 'selected' : '' ?> value="7">Bình luận bài viết</option>
                    <option <?= $tableID === '3' ? 'selected' : '' ?> value="3">Tin tức</option>
                    <option <?= $tableID === '4' ? 'selected' : '' ?> value="4">Chức vụ nhân viên</option>
                    <option <?= $tableID === '5' ? 'selected' : '' ?> value="5">Nhân viên</option>
                    <option <?= $tableID === '6' ? 'selected' : '' ?> value="6">Tài khoản</option>
                    <option <?= $tableID === '8' ? 'selected' : '' ?> value="8">Email nhận thông báo</option>
                </select>
            </div>
        </form>
    </div>

    <div class="card-body">
        <?php if ($dataTables) : ?>
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <?php $headerTable = '' ?>
                    <?php $bodyTable = '' ?>
                    <?php $footerTable = '' ?>
                    <?php $headerTable .= '<tr>' ?>
                    <?php $footerTable .= '<tr>' ?>
                    <?php $hasHeader = false ?>
                    <?php foreach ($dataTables as $data) : ?>
                        <?php $id = '' ?>
                        <?php $bodyTable .= '<tr>' ?>
                        <?php foreach ($data as $key => $value) : ?>
                            <?php if ($key === 'id') : ?>
                                <?php $id = $value; ?>
                            <?php endif ?>
                                
                            <?php if (!$hasHeader) : ?>
                                <?php $headerTable .= '<th>' . $key . '</th>' ?>
                                <?php $footerTable .= '<th>' . $key . '</th>' ?>
                            <?php endif ?>
                            <?php $bodyTable .= '<td>' . $value . '</td>' ?>
                        
                        <?php endforeach ?>

                        <?php $hasHeader = true ?>
                        <?php $bodyTable .= '<td class="text-center"><button data-url="admin/bin/edit/'.$tableID.'-'.$id.'" class="btn btn-warning btn-icon-split btn-update-bin-data">' ?>
                        <?php $bodyTable .= '<span class="icon text-white-50"><i class="fas fas fa-undo"></i></span><span class="text">Khôi phục</span>' ?>
                        <?php $bodyTable .= '</button></td>' ?>
                        
                        <?php $bodyTable .= '<td class="text-center"><button data-url="admin/bin/delete/'.$tableID.'-'.$id.'" class="btn btn-danger btn-icon-split btn-del-forever">' ?>
                        <?php $bodyTable .= '<span class="icon text-white-50"><i class="fas fa-trash"></i></span><span class="text">Xóa bỏ</span>' ?>
                        <?php $bodyTable .= '</button></td>' ?>
                        
                        <?php $bodyTable .= '</tr>' ?>

                    <?php endforeach ?>
                    <?php $headerTable .= '<th>Phục hồi dữ liệu</th>' ?>
                    <?php $footerTable .= '<th>Phục hồi dữ liệu</th>' ?>
                    <?php $headerTable .= '<th>Gỡ bỏ dữ liệu vĩnh viễn</th>' ?>
                    <?php $footerTable .= '<th>Gỡ bỏ dữ liệu vĩnh viễn</th>' ?>
                    <?php $headerTable .= '</tr>' ?>
                    <?php $footerTable .= '</tr>' ?>
                    <thead>
                        <?= $headerTable ?>
                    </thead>
                    <tbody>
                        <?= $bodyTable ?>
                    </tbody>
                    <tfoot>
                        <?= $footerTable ?>
                    </tfoot>
                </table>
            </div>
        <?php elseif ($tableID === '0') : ?>
            <h5 class="text-center">Vui lòng chọn thông tin dữ liệu</h5>
        <?php else : ?>
            <h5 class="text-center">Không có dữ liệu đã xóa</h5>
        <?php endif ?>
    </div>
</div>