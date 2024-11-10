<!doctype html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg" data-sidebar-image="none" data-preloader="disable" data-theme="default" data-theme-colors="default">

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
<!-- Mirrored from themesbrand.com/velzon/html/master/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 29 Oct 2024 07:29:52 GMT -->

<head>

    <meta charset="utf-8" />
    <title>Dashboard | NN Shop</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="Themesbrand" name="author" />

    <!-- CSS -->
    <?php
    require_once "layouts/libs_css.php";
    ?>

</head>
<style>
    table {
        width: 100%;
        border-collapse: collapse;
    }

    th,
    td {
        padding: 10px;
        border: 1px solid #ddd;
        text-align: center;
    }

    th {
        background-color: #f4f4f4;
    }

    img {
        max-width: 100px;
        border-radius: 8px;
    }

    a {
        color: #007bff;
        text-decoration: none;
    }

    button {
        border: none;
    }

    .form-container {
        max-width: 600px;
        padding: 40px;
        background-color: #ffffff;
        border-radius: 12px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    }

    .form-container h1 {
        color: #007bff;
        font-size: 1.8rem;
    }

    .form-group {
        margin-bottom: 0.5rem;
        /* Increased space between fields */
    }

    .form-group label {
        font-weight: 500;
    }

    .form-control,
    .form-control-file,
    .form-control:focus,
    textarea {
        border-radius: 8px;
        transition: box-shadow 0.3s ease;
    }

    .form-control:hover,
    .form-control-file:hover,
    .form-control:focus,
    textarea:focus {
        box-shadow: 0 0 5px rgba(0, 123, 255, 0.4);
        border-color: #007bff;
    }

    .submit-btn {
        padding: 10px 20px;
        border-radius: 8px;
        transition: background-color 0.3s ease;
    }

    .submit-btn:hover {
        background-color: #0056b3;
    }
</style>

<body>

    <!-- Begin page -->
    <div id="layout-wrapper">

        <!-- HEADER -->
        <?php
        require_once "layouts/header.php";

        require_once "layouts/siderbar.php";
        ?>

        <!-- Left Sidebar End -->
        <!-- Vertical Overlay-->
        <div class="vertical-overlay"></div>

        <!-- ============================================================== -->
        <!-- Start right Content here -->
        <!-- ============================================================== -->
        <div class="main-content">

            <div class="page-content">
                <div class="container-fluid">

                    <div class="row">
                        <div class="col">


                            <div class="container h-100 d-flex justify-content-center align-items-center">
                                <div class="form-container">
                                    <div class="text-center mb-4">
                                        <h1><i class="fas fa-plus"></i> Thêm Dữ Liệu</h1>
                                    </div>
                                    <form action="index.php?act=voucher" method="post" enctype="multipart/form-data">
                                        <div class="form-group">
                                            <label for="ten_voucher">Tên:</label>
                                            <input type="text" class="form-control" name="ten_voucher" id="ten_voucher" placeholder="Nhập tên voucher">
                                        </div>
                                        <div class="form-group">
                                            <label for="hinh_anh">Ảnh:</label>
                                            <input type="file" class="form-control-file" name="hinh_anh" id="hinh_anh">
                                        </div>
                                        <div class="form-group">
                                            <label for="thoi_gian">Thời gian:</label>
                                            <input type="number" class="form-control" name="thoi_gian" id="thoi_gian" placeholder="Có hiệu hiệu trong giờ">
                                        </div>
                                        <div class="form-group">
                                            <label for="voucher">Voucher %:</label>
                                            <input type="number" class="form-control" name="voucher" id="voucher" placeholder="Nhập phần trăm giảm giá">
                                        </div>
                                        <div class="form-group">
                                            <label for="mo_ta">Mô tả:</label>
                                            <textarea name="mo_ta" class="form-control" cols="30" rows="4" id="mo_ta" placeholder="Nhập mô tả"></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label for="id_danh_muc">Danh mục:</label>
                                            <select name="id_danh_muc" class="form-control" id="id_danh_muc">
                                                <?php foreach ($danhmuc as $dm) : ?>
                                                    
                                                    <option value="<?= $dm['id_danh_muc'] ?>">
                                                        <?= $dm['ten_danh_muc'] ?>
                                                    </option>
                                                <?php endforeach ?>
                                            </select>
                                        </div>
                                        <div class="text-center">
                                            <button type="submit" class="btn btn-primary submit-btn">Thêm mới</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
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
            <!-- end main content-->

        </div>
        <!-- END layout-wrapper -->



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
        <?php
        require_once "layouts/libs_js.php";
        ?>

</body>

</html>