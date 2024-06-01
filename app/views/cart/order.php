<?php
include_once 'app/views/share/header.php';
?>

<div class="container">
    
    <?php
    echo "<h3 class='mt-4'>Danh sách giỏ hàng</h3>";
    echo "<ul class='list-group'>";
    foreach ($_SESSION['cart'] as $item) {
        echo "<li class='list-group-item'>$item->id - $item->name - 
                <input type='number' name='quality' value='$item->quantity' class='form-control' disabled>
            </li>";
    }
    echo "</ul>";
    ?>

    <form action="/chieu2/cart/process_order" method="post" class="mt-4">
        <div class="form-group">
            <label for="hoTen">Họ và Tên:</label>
            <input type="text" id="hoTen" name="hoTen" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="dienThoai">Điện Thoại:</label>
            <input type="text" id="dienThoai" name="dienThoai" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="diachi">Địa Chỉ Nhận Hàng:</label>
            <textarea id="diachi" name="diachi" class="form-control" required></textarea>
        </div>

        <div class="form-group">
            <label for="ghichu">Ghi Chú:</label>
            <textarea id="ghichu" name="ghichu" class="form-control"></textarea>
        </div>

        <div class="form-group">
            <label>Phương Thức Thanh Toán:</label><br>
            <div class="form-check form-check-inline">
                <input type="radio" id="cod" name="phuongThucThanhToan" value="cod" class="form-check-input" checked>
                <label for="cod" class="form-check-label">COD</label>
            </div>
            <div class="form-check form-check-inline">
                <input type="radio" id="bank_transfer" name="phuongThucThanhToan" value="bank_transfer" class="form-check-input">
                <label for="bank_transfer" class="form-check-label">Chuyển khoản</label>
            </div>
        </div>

        <div class="form-group form-check">
            <input type="checkbox" id="terms" name="terms" class="form-check-input" required>
            <label for="terms" class="form-check-label">Tôi chấp nhận điều khoản và điều kiện</label>
        </div>

        <button type="submit" class="btn btn-primary">Xác Nhận Mua Hàng</button>
    </form>
</div>

<?php
include_once 'app/views/share/footer.php';
?>
