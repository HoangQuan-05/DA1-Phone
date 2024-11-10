<!doctype html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg" data-sidebar-image="none" data-preloader="disable" data-theme="default" data-theme-colors="default">

<head>
    <meta charset="utf-8" />
    <title>Thêm Mới Khách Hàng | NN Shop</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- CSS -->
    <?php require_once "layouts/libs_css.php"; ?>
</head>

<body>
    <!-- Begin page -->
    <div id="layout-wrapper">
        <!-- HEADER -->
        <?php require_once "layouts/header.php"; ?>
        <?php require_once "layouts/siderbar.php"; ?>
        <div class="vertical-overlay"></div>

        <div class="main-content">
            <div class="page-content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col">
                            <div class="h-100">
                                <div class="row mb-3 pb-1">
                                    <div class="col-12">
                                        <div class="d-flex align-items-lg-center flex-lg-row flex-column">
                                            <div class="container mt-5">
                                                <h2>Thêm Mới Khách Hàng</h2>
                                                <form action="" method="POST" enctype="multipart/form-data">
                                                    <div class="form-group">
                                                        <label for="tens">Tên Khách Hàng:</label>
                                                        <input type="text" class="form-control" id="tens" name="tens" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="email">Email:</label>
                                                        <input type="email" class="form-control" id="email" name="email" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="anh_dai_dien">Ảnh Đại Diện:</label>
                                                        <input type="file" class="form-control" id="anh_dai_dien" name="anh_dai_dien" accept="image/*">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="so_dien_thoai">Số Điện Thoại:</label>
                                                        <input type="text" class="form-control" id="so_dien_thoai" name="so_dien_thoai" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="mat_khau">Mật Khẩu:</label>
                                                        <input type="password" class="form-control" id="mat_khau" name="mat_khau" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="ngay_sinh">Ngày Sinh:</label>
                                                        <input type="date" class="form-control" id="ngay_sinh" name="ngay_sinh" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="dia_chi">Địa Chỉ:</label>
                                                        <input type="text" class="form-control" id="dia_chi" name="dia_chi" required>
                                                    </div>
                                                    <button type="submit" class="btn btn-primary">Thêm Mới</button>
                                                    <a href="index.php?act=khachhang" class="btn btn-secondary">Quay Lại</a>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div> <!-- end col -->
                        </div>
                    </div>
                    <!-- container-fluid -->
                </div>

                <!-- End Page-content -->
                <footer class="footer">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-sm-6">
                                <script>
                                    document.write(new Date().getFullYear())
                                </script> © Velzon.
                            </div>
                            <div class="col-sm-6">
                                <div class="text-sm-end d-none d-sm-block">
                                    Design & Develop by Themesbrand
                                </div>
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
            <!-- end main content -->
        </div>
        <!--END layout-wrapper -->

        <!--start back-to-top-->
        <button onclick="topFunction()" class="btn btn-danger btn-icon" id="back-to-top">
            <i class="ri-arrow-up-line"></i>
        </button>
        <!--end back-to-top-->

        <!--preloader-->
        <div id="preloader">
            <div id="status">
                <div class="spinner-border text-primary avatar-sm" role="status">
                    <span class="visually-hidden">Loading...</span>
                </div>
            </div>
        </div>

        <div class="customizer-setting d-none d-md-block">
            <div class="btn-info rounded-pill shadow-lg btn btn-icon btn-lg p-2" data-bs-toggle="offcanvas" data-bs-target="#theme-settings-offcanvas" aria-controls="theme-settings-offcanvas">
                <i class='mdi mdi-spin mdi-cog-outline fs-22'></i>
            </div>
        </div>

        <!-- JAVASCRIPT -->
        <?php require_once "layouts/libs_js.php"; ?>
    </body>
</html>