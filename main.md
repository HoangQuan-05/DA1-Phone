<?php
$processed_ids = []; // Array to keep track of processed ids
foreach ($data_hoa_don as $value) :
    if (in_array($value['id_hd'], $processed_ids)) {
        continue;
    }
    $processed_ids[] = $value['id_hd']; // Mark id_hd as processed
?>
    <tr>
        <td><?= $value['id_hd'] ?></td>
        <td><?= $value['tens'] ?></td>
        <td><?= $value['ten_nguoi_nhan'] ?></td>
        <td><?= $value['dia_chi_nhan'] ?></td>
        <td><?= $value['so_dien_thoai'] ?></td>
        <td style="color:red">
            <p style="background-color: yellow; border-radius: 20px;">
                <?= $value['trang_thai'] ?>
            </p>
        </td>
        <td><?= $value['ghi_chu'] ?></td>
        <td><?= $value['ngay_dat'] ?></td>
        <td><?= $value['phuong_thuc_thanh_toan'] ?></td>
        <td style="color:red">
            <p style="background-color: yellow; border-radius: 20px;">
                Chưa thanh toán
            </p>
        </td>

        <td><a href="index.php?act=don_hang_chi_tiet&id=<?= $value['id_hd'] ?>">Xem chi tiết</a></td>
    </tr>
<?php endforeach; ?>