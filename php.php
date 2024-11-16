<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Quản lý sản phẩm</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-4">
        <h2 class="text-center">Quản lý sản phẩm</h2>
        <form id="productForm" method="POST" action="/submit-data">
            <button id="add_so_luong" type="button" class="btn btn-success mb-3">Thêm dòng mới</button>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th style="text-align: center;">Ram/Rom</th>
                        <th style="text-align: center;">Màu sắc</th>
                        <th style="text-align: center;">Giá nhập</th>
                        <th style="text-align: center;">Giá bán</th>
                        <th style="text-align: center;">Số lượng</th>
                        <th style="text-align: center;">Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Các dòng sản phẩm sẽ được thêm vào đây -->
                </tbody>
            </table>
            <button type="submit" class="btn btn-primary">Gửi dữ liệu</button>
        </form>
    </div>

    <!-- Template row -->
    <template id="template-row">
        <tr>
            <td><input type="text" class="form-control" placeholder="Ram/Rom" name="phien_ban[]" required></td>
            <td><input type="text" class="form-control" placeholder="Màu sắc" name="mau_sac[]" required></td>
            <td><input type="number" class="form-control" placeholder="Giá nhập" name="gia_nhap[]" min="0" required></td>
            <td><input type="number" class="form-control" placeholder="Giá bán" name="gia_ban[]" min="0" required></td>
            <td><input type="number" class="form-control" placeholder="Số lượng" name="so_luong[]" min="0" required></td>
            <td style="text-align: center;">
                <button type="button" class="btn btn-danger btn-delete-row">Xóa</button>
            </td>
        </tr>
    </template>

    <script>
        // JavaScript
        document.addEventListener("DOMContentLoaded", () => {
            const btnAddRow = document.getElementById("add_so_luong");
            const tableBody = document.querySelector("tbody");
            const template = document.getElementById("template-row");

            // Thêm dòng mới
            btnAddRow.addEventListener("click", () => {
                const newRow = template.content.cloneNode(true); // Sao chép nội dung từ template
                tableBody.appendChild(newRow); // Thêm dòng mới vào tbody
            });

            // Xóa dòng
            tableBody.addEventListener("click", (e) => {
                if (e.target.classList.contains("btn-delete-row")) {
                    const row = e.target.closest("tr");
                    row.remove(); // Xóa dòng chứa nút "Xóa"
                }
            });
        });
    </script>
</body>
</html>
