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
    require_once "views/layouts/libs_css.php";
    ?>
    <script>
        $(document).ready(function() {
            $('[data-toggle="tooltip"]').tooltip();
        });
    </script>
</head>
<style>
    table td,
    table th {
        text-align: center;
        /* Căn giữa theo chiều ngang */
        vertical-align: middle;
        /* Căn giữa theo chiều dọc */
        padding: 8px;
        /* Khoảng cách nội dung với viền ô */
        border: 1px solid #ddd;
        /* Viền cho các ô */
    }
</style>

<body>

    <!-- Begin page -->
    <div id="layout-wrapper">

        <!-- HEADER -->
        <?php
        require_once "views/layouts/header.php";

        require_once "views/layouts/siderbar.php";
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

                            <div class="table-responsive">
                                <table style="background-color: white;" class="table table-hover table-nowrap">
                                    <thead class="table-light">
                                        <tr>
                                            <th scope="col">Id</th>
                                            <th scope="col">Tên sản phẩm</th>
                                            <th scope="col">Hình ảnh</th>
                                            <th scope="col">Danh mục</th>
                                            <th scope="col">Giá sản phẩm</th>
                                            <th scope="col">Mô tả </th>
                                            <th scope="col">Lượt xem </th>
                                            <th scope="col">Hành động</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $id = []; // Initialize once before the loop
                                        foreach ($data as $value) :
                                            if (!in_array($value['id_san_pham'], $id)) :
                                        ?>
                                                <tr>

                                                    <td><?= $value['id_san_pham'] ?></td>
                                                    <td><?= $value['ten_san_pham'] ?></td>
                                                    <?php
                                                    $stt = false;
                                                    foreach ($anh as $img) :
                                                        if ($value['id_san_pham'] == $img['id_san_pham']) :
                                                    ?>
                                                            <td>
                                                                <img style="width:60px; height:60px" src="image/<?= $img['hinh_anh'] ?>" alt="<?= $value['ten_san_pham'] ?>" class="img-fluid">
                                                            </td>
                                                        <?php
                                                            $stt = true;
                                                            break;
                                                        endif;
                                                    endforeach;
                                                    if (!$stt) :
                                                        ?>
                                                        <td><img style="width:60px; height:60px" src="" alt="<?= $value['ten_san_pham'] ?>" class="img-fluid"></td>
                                                    <?php endif; ?>
                                                    <td><?= $value['ten_danh_muc'] ?></td>
                                                    <td><?= number_format($value['gia_ban'],) ?> VND</td>
                                                    <td>
                                                        <p id="mo_ta"><?= $value['mo_ta_ngan'] ?></p>
                                                    </td>
                                                    <td><?= $value['luot_xem'] ?></td>

                                                    <td>
                                                        <a href="index.php?act=update_san_pham&id=<?= $value['id_san_pham'] ?>" class="settings" title="Update" data-toggle="tooltip"><i class="material-icons">&#xE8B8;</i></a>
                                                        <a onclick="return confirm('Chắc chắn xóa?')" href="index.php?act=delete_san_pham&id=<?= $value['id_san_pham'] ?>" class="delete" title="Delete" data-toggle="tooltip"><i class="material-icons">&#xE5C9;</i></a>
                                                    </td>
                                                </tr>
                                        <?php
                                                $id[] = $value['id_san_pham']; // Append current ID to avoid duplicates
                                            endif;
                                        endforeach;
                                        ?>

                                    </tbody>
                                </table>
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
    require_once "views/layouts/libs_js.php";
    ?>


</body>

</html>