//HÓA ĐƠN


<?php
                                        $processed_ids = []; // Array to keep track of processed ids
                                        foreach ($data_hoa_don as $value) :
                                            if (in_array($value['id_hd'], $processed_ids)) {
                                                continue;
                                            }
                                            $processed_ids[] = $value['id_hd'];
                                        ?>
                                            <tr>
                                                <td><?= $value['id_hd'] ?></td>
                                                <td><?= $value['ngay_dat'] ?></td>
                                                <td><?= number_format($value['tong_tien'], 0, '', '.') ?>
                                                    VND</td>
                                                <td><?= $value['phuong_thuc_thanh_toan'] ?></td>
                                                <td><?= $value['trang_thai_thanh_toan'] ?></td>

                                                <td style="color:red"><?= $value['trang_thai'] ?></td>
                                                <td><a href="index.php?act=don_hang_chi_tiet&id=<?= $value['id_hd'] ?>">Xem chi tiết</a> |
                                                    <button style="border:none;" disabled>Xoa</button>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>


// CHI TIẾT HÓA ĐƠN

<option hidden value=" <?php echo ($data_tt['id']); ?>"> <?php echo ($data_tt['trang_thai']); ?></option>