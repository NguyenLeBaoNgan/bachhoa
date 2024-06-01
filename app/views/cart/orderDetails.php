<?php
include_once 'app/views/share/header.php';
?>

<div class="row">
    <div class="col-12">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Tên Sản Phẩm</th>
                        <th>Số Lượng</th>
                        <th>Đơn Giá</th>
                        <th>Thao Tác</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $products->fetch(PDO::FETCH_ASSOC)) : ?>
                        <tr>
                            <td><?= $row['orderDetailID'] ?></td>
                            <td><?= $row['tenSanPham'] ?></td>
                            <td><?= $row['soLuong'] ?></td>
                            <td><?= $row['donGia'] ?></td>
                            <td>
                                <a href="/chieu2/product/edit/<?= $row['id'] ?>" class="btn btn-primary btn-sm">Sửa</a>
                                <a href="#" class="btn btn-danger btn-sm">Xóa</a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php
include_once 'app/views/share/footer.php';
?>
