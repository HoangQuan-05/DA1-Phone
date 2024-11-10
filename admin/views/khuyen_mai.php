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
    .custom-table-header {
        background-color: #e3f2fd;
        /* Light blue for header */
        color: #0d6efd;
        /* Darker blue text */
    }

    .custom-table-row:nth-child(odd) {
        background-color: #f9f9f9;
        /* Very light gray for odd rows */
    }

    .custom-table-row:nth-child(even) {
        background-color: #ffffff;
        /* White for even rows */
    }

    .custom-button-delete {
        background-color: #ffccd5;
        /* Light red for delete button */
        color: #e63946;
        /* Darker red text */
    }

    .custom-button-edit {
        background-color: #d1e7dd;
        /* Light green for edit button */
        color: #1b4332;
        /* Darker green text */
    }

    .custom-button-delete:hover {
        background-color: #f8b4b4;
        /* Darker shade on hover */
    }

    .custom-button-edit:hover {
        background-color: #b7d9c8;
        /* Darker shade on hover */
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

                            <div class="container h-100">
                                <div class="row mb-3 pb-1">
                                    <div class="col-12">
                                        <div class="text-center mb-4">
                                            <h1>Danh Sách Voucher</h1>
                                        </div>
                                        <div class="table-responsive">
                                            <table class="table table-bordered table-hover">
                                                <thead class="custom-table-header">
                                                    <tr>
                                                        <th>ID Voucher</th>
                                                        <th>Tên Voucher</th>
                                                        <th>Hình Ảnh</th>
                                                        <th>Voucher (%)</th>
                                                        <th>Thời Gian</th>
                                                        <th>Mô Tả</th>
                                                        <th>Danh Mục</th>
                                                        <th><i class='fa fa-cog'></i> Hành Động</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php foreach ($khuyenmai as $khuyenmais): ?>
                                                        <tr class="custom-table-row">
                                                            <td><?= $khuyenmais['id_voucher'] ?></td>
                                                            <td><?= $khuyenmais['ten_voucher'] ?></td>
                                                            <td><img src="<?= $khuyenmais['hinh_anh'] ?>" width="100" alt="Ảnh sản phẩm"></td>
                                                            <td><?= $khuyenmais['voucher'] ?> %</td>
                                                            <td><?= $khuyenmais['thoi_gian'] ?> Giờ</td>
                                                            <td><?= $khuyenmais['mo_ta'] ?></td>
                                                            <td><?= $khuyenmais['ten_danh_muc'] ?></td>
                                                            <td>
                                                                <a onclick="return confirm('Bạn có muốn xóa?')" href="index.php?act=deletel&id=<?= $khuyenmais['id_voucher'] ?>" class="btn custom-button-delete btn-sm"><i class="fas fa-trash"></i></a>
                                                                <a href="index.php?act=updatekm&id=<?= $khuyenmais['id_voucher'] ?>" class="btn custom-button-edit btn-sm"><i class="fas fa-pencil-alt"></i></a>
                                                            </td>
                                                        </tr>
                                                    <?php endforeach ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <!-- container-fluid -->
                </div>
                <button style="border: none;"><a href="index.php?act=add_khuyenmai"><i class="fas fa-plus"></i>them moi</a></button>
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