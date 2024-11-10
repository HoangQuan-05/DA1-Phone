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
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>

    <!-- CSS -->
    <?php
    require_once "layouts/libs_css.php";
    ?>
    <script>
        $(document).ready(function() {
            $('[data-toggle="tooltip"]').tooltip();
        });
    </script>
</head>
<style>
    .table-title {
        background-color: #f8f9fa;
        /* Light background for header */
        color: #495057;
        /* Dark gray text for contrast */
        padding: 16px;
        border-bottom: 2px solid #dee2e6;
    }

    .table-title h2 {
        margin: 0;
    }

    .table-responsive {
        margin-top: 20px;
    }

    .table thead th {
        background-color: #e3f2fd;
        /* Light blue header */
        color: #0d6efd;
        /* Dark blue text */
    }

    .table tbody tr:nth-child(odd) {
        background-color: #f9f9f9;
        /* Light gray for odd rows */
    }

    .table tbody tr:nth-child(even) {
        background-color: #ffffff;
        /* White for even rows */
    }

    .table td,
    .table th {
        vertical-align: middle;
    }

    .pagination .page-item.active .page-link {
        background-color: #0d6efd;
        /* Blue for active page */
        color: #fff;
    }

    .pagination .page-link {
        color: #0d6efd;
        /* Blue text for pagination links */
    }

    .form-control {
        max-width: 250px;
        /* Limit search bar width */
        margin-right: 10px;
    }

    .btn-action {
        color: #0d6efd;
    }

    .btn-action.delete {
        color: #e63946;
        /* Red for delete */
    }

    .btn-action:hover {
        opacity: 0.8;
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
                                <div class="row">
                                    <div class="col-12">
                                        <div class="table-responsive">
                                            <div class="table-wrapper">
                                                <div class="table-title d-flex justify-content-between align-items-center">
                                                    <h2><b>Danh Sách Khách Hàng</b></h2>
                                                    <form action="" method="GET" class="d-flex">
                                                        <input type="text" name="search" class="form-control" placeholder="Tìm kiếm...">
                                                    </form>
                                                </div>

                                                <table class="table table-striped table-hover">
                                                    <thead>
                                                        <tr>
                                                            <th>ID</th>
                                                            <th>Tên</th>
                                                            <th>Ảnh</th>
                                                            <th>Email</th>
                                                            <th>Số Điện Thoại</th>
                                                            <th>Ngày Sinh</th>
                                                            <th>Ngày Đăng Ký</th>
                                                            <th>Địa Chỉ</th>
                                                            <th>Vai Trò</th>
                                                            <th>Chi Tiết</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php foreach ($data as $value) : ?>
                                                            <tr>
                                                                <td><?= $value['id_khach_hang'] ?></td>
                                                                <td><?= $value['tens'] ?></td>
                                                                <td><img src="<?= $value['anh_dai_dien'] ?>" width="100" alt=""></td>
                                                                <td><?= $value['email'] ?></td>
                                                                <td><?= $value['so_dien_thoai'] ?></td>
                                                                <td><?= $value['ngay_sinh'] ?></td>
                                                                <td><?= $value['ngay_dang_ky'] ?></td>
                                                                <td><?= $value['dia_chi'] ?></td>
                                                                <td><?= $value['vai_tro'] ?></td>
                                                                <td>
                                                                    <a href="index.php?act=update_khachhang&id=<?= $value['id_khach_hang'] ?>" class="btn-action" title="Settings" data-toggle="tooltip"><i class="material-icons">&#xE8B8;</i></a>
                                                                    <a onclick="return confirm('Bạn có chắc chắn muốn xóa?')" href="index.php?act=dl_khachhang&id=<?= $value['id_khach_hang'] ?>" class="btn-action delete" title="Delete" data-toggle="tooltip"><i class="material-icons">&#xE5C9;</i></a>
                                                                </td>
                                                            </tr>
                                                        <?php endforeach ?>
                                                    </tbody>
                                                </table>

                                                <div class="clearfix">
                                                    <ul class="pagination">
                                                        <li class="page-item active"><a href="#" class="page-link">1</a></li>
                                                        <li class="page-item"><a href="#" class="page-link">2</a></li>
                                                    </ul>
                                                </div>
                                            </div>
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