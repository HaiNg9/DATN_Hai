<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <base href="<?= base_url() ?>">
    <title><?= $title ?></title>
    <!-- Custom fonts for this template-->
    <link href="public/admin/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <!-- Custom styles for this template-->
    <link href="public/admin/css/sb-admin-2.min.css" rel="stylesheet">
    <?php if (!empty($css)) : ?>
        <?php foreach ($css as $link) : ?>
            <?= '<link href="'.$link.'" rel="stylesheet">'?>
        <?php endforeach ?>
    <?php endif ?>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.17.1/moment-with-locales.min.js"></script>
</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <?php $this->load->view('admin/layouts/slidebar') ?>

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <?php $this->load->view('admin/layouts/header') ?>

                <!-- Begin Page Content -->
                <div class="container-fluid">

                <?php $this->load->view($contentName) ?>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Bản quyền &copy; <script>document.write(new Date().getFullYear());</script> thuộc về <a href="https://www.youtube.com/channel/UCwBHZqLqgZUTWLLaQLfoJ1g?sub_confirmation=1">DCN</a></span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <?php $this->load->view('admin/layouts/footer'); ?>

    <!-- Bootstrap core JavaScript-->
    <script src="public/admin/vendor/jquery/jquery.min.js"></script>
    <script src="public/admin/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- Core plugin JavaScript-->
    <script src="public/admin/vendor/jquery-easing/jquery.easing.min.js"></script>
    <!-- Custom scripts for all pages-->
    <script src="public/admin/js/sb-admin-2.min.js"></script>
    <script src="public/admin/js/common.js"></script>
    <?php if (!empty($script)) : ?>
        <?php foreach ($script as $link) : ?>
            <?= '<script src="'.$link.'"></script>'?>
        <?php endforeach ?>
    <?php endif ?>
</body>

</html>