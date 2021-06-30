<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title><?= $title ?></title>
    <!-- Custom fonts for this template-->
    <link href="public/admin/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
    <!-- Custom styles for this template-->
    <link href="public/admin/css/sb-admin-2.min.css" rel="stylesheet">
</head>

<body class="bg-gradient-primary">

    <div class="container">

        <div class="card o-hidden border-0 shadow-lg my-5">
            <div class="card-body p-0">
                <!-- Nested Row within Card Body -->
                <div class="row">
                    <div class="col-lg-1"></div>
                    <div class="col-lg-10">
                        <div class="p-5">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">Tạo tài khoản mới!</h1>
                            </div>
                            <?php $this->load->view('messages') ?>
                            <?php $old = $this->session->flashdata('old'); ?>
                            <form action="register" method="POST">
                                <div class="form-group">
                                    <input value="<?= $old['display_name'] ?? '' ?>" name="display_name" type="text" class="form-control form-control-user" id="display-name"
                                        placeholder="Tên hiển thị cho tài khoản sau khi đăng nhập hệ thống">
                                </div>
                                <div class="form-group">
                                    <input value="<?= $old['email'] ?? '' ?>" name="email" type="text" class="form-control form-control-user" id="email"
                                        placeholder="Email là tài khoản đăng nhập hệ thống">
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input value="<?= $old['password'] ?? '' ?>" name="password" type="password" class="form-control form-control-user"
                                            id="password" placeholder="Mật khẩu đăng nhập hệ thống">
                                    </div>
                                    <div class="col-sm-6">
                                        <input value="<?= $old['password_confirm'] ?? '' ?>" name="password_confirm" type="password" class="form-control form-control-user"
                                            id="password-confirm" placeholder="Xác nhận mật khẩu đăng nhập hệ thống">
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary btn-user btn-block">
                                    Đăng ký tài khoản
                                </button>
                            </form>
                            <hr>
                            <div class="text-center">
                                <a class="small" href="trang-chu.html">Trang chủ</a>
                            </div>
                            <div class="text-center">
                                <a class="small" href="dang-nhap.html">Đăng nhập hệ thống!</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="public/admin/vendor/jquery/jquery.min.js"></script>
    <script src="public/admin/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- Core plugin JavaScript-->
    <script src="public/admin/vendor/jquery-easing/jquery.easing.min.js"></script>
    <!-- Custom scripts for all pages-->
    <script src="public/admin/js/sb-admin-2.min.js"></script>
</body>

</html>