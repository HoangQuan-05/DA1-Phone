<?php
if (empty($_SESSION['id_khach_hang']) || empty($_SESSION)) {
    header("location: index.php?act=login");
    exit();
}

?>
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
    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
    <script src="https://cdn.quilljs.com/1.3.6/quill.min.js"></script>
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
    body {
        color: #566787;
        background: #f5f5f5;
        font-family: 'Varela Round', sans-serif;
        font-size: 13px;
    }

    .table-responsive {
        margin: 30px 0;
    }

    .table-wrapper {
        min-width: 1000px;
        background: #fff;
        padding: 20px 25px;
        border-radius: 3px;
        box-shadow: 0 1px 1px rgba(0, 0, 0, .05);
    }

    .table-title {
        padding-bottom: 15px;
        background: #299be4;
        color: #fff;
        padding: 16px 30px;
        margin: -20px -25px 10px;
        border-radius: 3px 3px 0 0;
    }

    .table-title h2 {
        margin: 5px 0 0;
        font-size: 24px;
    }

    .table-title .btn {
        color: #566787;
        float: right;
        font-size: 13px;
        background: #fff;
        border: none;
        min-width: 50px;
        border-radius: 2px;
        border: none;
        outline: none !important;
        margin-left: 10px;
    }

    .table-title .btn:hover,
    .table-title .btn:focus {
        color: #566787;
        background: #f2f2f2;
    }

    .table-title .btn i {
        float: left;
        font-size: 21px;
        margin-right: 5px;
    }

    .table-title .btn span {
        float: left;
        margin-top: 2px;
    }

    table.table tr th,
    table.table tr td {
        border-color: #e9e9e9;
        padding: 12px 15px;
        vertical-align: middle;
    }

    table.table tr th:first-child {
        width: 60px;
    }

    table.table tr th:last-child {
        width: 100px;
    }

    table.table-striped tbody tr:nth-of-type(odd) {
        background-color: #fcfcfc;
    }

    table.table-striped.table-hover tbody tr:hover {
        background: #f5f5f5;
    }

    table.table th i {
        font-size: 13px;
        margin: 0 5px;
        cursor: pointer;
    }

    table.table td:last-child i {
        opacity: 0.9;
        font-size: 22px;
        margin: 0 5px;
    }

    table.table td a {
        font-weight: bold;
        color: #566787;
        display: inline-block;
        text-decoration: none;
    }

    table.table td a:hover {
        color: #2196F3;
    }

    table.table td a.settings {
        color: #2196F3;
    }

    table.table td a.delete {
        color: #F44336;
    }

    table.table td i {
        font-size: 19px;
    }

    table.table .avatar {
        border-radius: 50%;
        vertical-align: middle;
        margin-right: 10px;
    }

    .status {
        font-size: 30px;
        margin: 2px 2px 0 0;
        display: inline-block;
        vertical-align: middle;
        line-height: 10px;
    }

    .text-success {
        color: #10c469;
    }

    .text-info {
        color: #62c9e8;
    }

    .text-warning {
        color: #FFC107;
    }

    .text-danger {
        color: #ff5b5b;
    }

    .pagination {
        float: right;
        margin: 0 0 5px;
    }

    .pagination li a {
        border: none;
        font-size: 13px;
        min-width: 30px;
        min-height: 30px;
        color: #999;
        margin: 0 2px;
        line-height: 30px;
        border-radius: 2px !important;
        text-align: center;
        padding: 0 6px;
    }

    .pagination li a:hover {
        color: #666;
    }

    .pagination li.active a,
    .pagination li.active a.page-link {
        background: #03A9F4;
    }

    .pagination li.active a:hover {
        background: #0397d6;
    }

    .pagination li.disabled i {
        color: #ccc;
    }

    .pagination li i {
        font-size: 16px;
        padding-top: 6px
    }

    .hint-text {
        float: left;
        margin-top: 10px;
        font-size: 13px;
    }

    #editor {
        height: 400px;
    }

    textarea {
        height: 70px;
        width: 100%;
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
                <div class="container-fluid" style="background-color: white;  padding:35px; border-radius:10px; min-height:78vh;">

                    <div class="row">
                        <div class="col">

                            <div class="h-100">
                                <h2>Thêm sản phẩm</h2> <br>
                                <form class="row g-3" method="POST" enctype="multipart/form-data" onsubmit="submitForm(event)" id="myForm">
                                    <div class="col-md-6">
                                        <label for="inputEmail4" class="form-label">Tên sản phẩm</label>
                                        <input type="text" class="form-control" id="inputEmail4" placeholder="Nhập tên sản phẩm..." name="ten_san_pham">
                                    </div>
                                    <div class="col-md-4">
                                        <label for="inputState" class="form-label">Danh mục</label>
                                        <select id="inputState" class="form-select" name="id_danh_muc">
                                            <option hidden value="0">Chọn danh mục</option>
                                            <?php foreach ($danh_muc as $dm) : ?>
                                                <option value="<?= $dm['id_danh_muc'] ?>"><?= $dm['ten_danh_muc'] ?></option>
                                            <?php endforeach ?>
                                        </select>
                                    </div>

                                    <div class="col-12">
                                        <label for="floatingTextarea2">Mô tả ngắn</label>
                                        <textarea class="form-control" placeholder="Nhập mô tả ngắn..." id="floatingTextarea2" name="mo_ta_ngan" style="height: 100px"></textarea>
                                    </div>
                                    <div class="col-12">
                                        <label for="floatingTextarea2">Mô tả dài</label>
                                        <!-- <textarea class="form-control" placeholder="Nhập mô tả dài..." id="floatingTextarea2" name="mo_ta_dai" style="height: 150px"></textarea> -->
                                        <div id="editor"></div>
                                    </div>

                                    <div class="col-md-12"">
                                        <label for=" imageUpload" class="form-label">Chọn nhiều ảnh:</label>
                                        <input type="file" class="form-control" id="imageUpload" name="hinh_anh[]" accept="image/*" multiple>
                                    </div>

                                    <div class="col-6">
                                        <div class="d-flex align-items-flex-start">
                                            <div class="col-7" id="ram_rom">
                                                <label for="inputPassword2" class="me-2">Ram/Rom</label>
                                                <input type="text" class="form-control" id="inputPassword2" placeholder="Ram/Rom" name="phien_ban[]">

                                            </div>
                                            <div class="col-auto ms-2" style="margin-top: 25px;">
                                                <div id="add_ram" type="" class="btn btn-primary">Add</div>

                                            </div>

                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="d-flex align-items-flex-start">
                                            <div class="col-7" id="mau_sac">
                                                <label for="inputPassword2" class="me-2">Màu sắc</label>
                                                <input type="text" class="form-control" id="inputPassword2" placeholder="Màu sắc..." name="mau_sac[]">

                                            </div>
                                            <div class="col-auto ms-2" style="margin-top: 25px;">
                                                <div id="add_mau_sac" type="" class="btn btn-primary">Add</div>
                                            </div>
                                        </div>
                                    </div>



                                    <div class="col-6">
                                        <div class="d-flex align-items-flex-start">
                                            <div class="col-7" id="gia_ban">
                                                <label for="inputPassword2" class="me-2">Giá bán</label>
                                                <input type="text" class="form-control" id="inputPassword2" placeholder="Giá bán..." name="gia_ban[]">

                                            </div>
                                            <div class="col-auto ms-2" style="margin-top: 25px;">
                                                <div id="add_gia_ban" type="" class="btn btn-primary">Add</div>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="col-6">
                                        <div class="d-flex align-items-flex-start">
                                            <div class="col-7" id="so_luong">
                                                <label for="inputPassword2" class="me-2">Số lượng</label>
                                                <input type="text" class="form-control" id="inputPassword2" placeholder="Số lượng..." name="so_luong[]">

                                            </div>
                                            <div class="col-auto ms-2" style="margin-top: 25px;">
                                                <div id="add_so_luong" type="" class="btn btn-primary">Add</div>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="col-12">
                                        <h5 style="color:red;" id="er_san_pham"></h5>
                                    </div>
                                    <div class="col-6">
                                        <button type="submit" class="btn btn-primary">Thêm</button>
                                    </div>

                                </form>


                            </div>

                        </div> <!-- end col -->
                    </div>

                </div>
                <!-- container-fluid -->
            </div>
            <!-- End Page-content -->
            <br>
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
    <script>
        // Khởi tạo Quill
        const quill = new Quill('#editor', {
            theme: 'snow'
        });

        function submitForm(event) {
            event.preventDefault(); // Ngăn chặn form gửi tự động

            // Lấy nội dung từ Quill dưới dạng HTML
            const content = quill.root.innerHTML;

            // Tạo một trường ẩn và thêm vào form
            const input = document.createElement('textarea');
            input.setAttribute('name', 'mo_ta_dai'); // Tên này sẽ gửi đi với dữ liệu POST
            input.style.display = 'none';
            input.value = content;
            input.placeholder = "Nhập mô tả dài..."

            // Thêm trường ẩn vào form và gửi form
            const form = document.getElementById('myForm');
            form.append(input);
            form.submit();
        }

        var er_san_pham = document.getElementById('er_san_pham');


        var btn_ram = document.getElementById("add_ram");
        var btn_mau_sac = document.getElementById("add_mau_sac");
        var btn_gia_ban = document.getElementById("add_gia_ban");
        var btn_so_luong = document.getElementById("add_so_luong");

        var ram_rom = document.getElementById("ram_rom");
        var mau_sac = document.getElementById("mau_sac");
        var gia_ban = document.getElementById("gia_ban");
        var so_luong = document.getElementById("so_luong");

        function addInputField(container, placeholderText, inputName) {
            const lineBreak = document.createElement("br");
            var div_field = document.createElement("div");
            div_field.classList.add("d-flex", "justify-content-between", "align-items-center");

            const btn_xoa = document.createElement("div");
            btn_xoa.classList.add("btn", "btn-primary");
            btn_xoa.innerHTML = "Xóa";

            var input_field = document.createElement("input");
            input_field.type = "text";
            input_field.name = inputName;
            input_field.placeholder = placeholderText;
            input_field.classList.add("form-control", "w-75", "p-3");

            div_field.append(input_field);
            div_field.append(btn_xoa);
            container.append(lineBreak);
            container.append(div_field);

            btn_xoa.addEventListener("click", () => {
                lineBreak.remove();
                div_field.remove();
            });
        }

        function onAnyButtonClick() {
            addInputField(ram_rom, "Ram/Rom", "phien_ban[]");
            addInputField(mau_sac, "Màu sắc...", "mau_sac[]");
            addInputField(gia_ban, "Giá bán...", "gia_ban[]");
            addInputField(so_luong, "Số lượng...", "so_luong[]");
        }

        btn_ram.addEventListener("click", onAnyButtonClick);
        btn_mau_sac.addEventListener("click", onAnyButtonClick);
        btn_gia_ban.addEventListener("click", onAnyButtonClick);
        btn_so_luong.addEventListener("click", onAnyButtonClick);
    </script>

    <?php
    require_once "views/layouts/libs_js.php";
    ?>


</body>

</html>