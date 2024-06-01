<?php
include_once 'app/views/share/header.php';
?>

<!-- Thêm thư viện jQuery -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script>
$(document).ready(function(){
    // Bắt sự kiện khi nút được nhấn
    $('.btncong').click(function(){
        var itemId = $(this).data('id');
        console.log(itemId);
        upQuality(itemId); 
    });

    function upQuality(id){ 
        $.ajax({
            type: "post",
            url: "/chieu2/cart/upQuality/"+id,
            success: function (response) {
                location.reload();
            }
        });
    }

    $('.btntru').click(function(){
        var itemId = $(this).data('id');
        console.log(itemId);
        downQuantity(itemId); 
    });

    function downQuantity(id){ 
        $.ajax({
            type: "post",
            url: "/chieu2/cart/downQuality/"+id,
            success: function (response) {
                location.reload();
            }
        });
    }
    $('.btnxoa').click(function(){
        var itemId = $(this).data('id');
        console.log(itemId);
        downQuantity(itemId);
    });
    function downQuantity(id){ 
        $.ajax({
            type: "post",
            url: "/chieu2/cart/delete/"+id,
            success: function (response) {
                location.reload();
            }
        });
    }
    $("#btnthanhtoan").click(function (e) { 
    e.preventDefault();
    window.location.href = "/chieu2/cart/checkout";
});

});
</script>


<?php

if (!isset($_SESSION['cart']) || empty($_SESSION['cart'])) {
    echo "<div class='container'>";
    echo "<h2 class='text-center mt-5'>Giỏ hàng trống!</h2>";
    echo "</div>";
} else {

    echo "<div class='container'>";
    echo "<h2 class='text-center mt-5'>Danh sách giỏ hàng</h2>";
    echo "<ul class='list-group mt-3'>";
    $totalPrice = 0;
    foreach ($_SESSION['cart'] as $item) {
        $subtotal = $item->price * $item->quantity;
        $totalPrice += $subtotal;
        echo "<li class='list-group-item d-flex justify-content-between align-items-center mb-3'>";

     
        echo "$item->id - $item->name";
        echo "<span class='badge badge-primary badge-pill'>$item->quantity</span>";
        echo "<span class='badge badge-success badge-pill'>$subtotal VNĐ</span>";
        echo "<button type='submit' class='btn btn-info btntru' data-id='$item->id'>-</button>";
        echo "<input name='quality' type='number' value=".$item->quantity." class='form-control mr-2' style='width: 80px;' />";
        echo "<button type='submit' class='btn btn-info btncong'  data-id='$item->id'>+</button>";
        
        echo "<button type='submit' class='btn btn-danger ml-2 btnxoa' data-id='$item->id'>Xóa</button>";
        echo "</li>";
    }
    echo "</ul>";

    echo "<div class='text-right mt-3'>";
    echo "<h4>Tổng tiền: $totalPrice VNĐ</h4>";
    echo "</div>";
    echo "<div class='text-center mt-3'>";
    echo "<button type='submit' class='btn btn-primary' id='btnthanhtoan'>Thanh toán</button>";
    echo "</div>";

    echo "</div>";
}

include_once 'app/views/share/footer.php';
?>
