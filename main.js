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