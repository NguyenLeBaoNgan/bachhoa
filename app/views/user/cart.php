<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Fruitables - Vegetable Website Template</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&family=Raleway:wght@600;800&display=swap"
        rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="/chieu2/public/lib/lightbox/css/lightbox.min.css" rel="stylesheet">
    <link href="/chieu2/public/lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">


    <!-- Customized Bootstrap Stylesheet -->
    <link href="/chieu2/public/css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="/chieu2/public/css/style.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script>

        $(document).ready(function () {
            // Bắt sự kiện khi nút được nhấn
            $('.btnup').click(function () {
                var itemId = $(this).data('id');
                console.log(itemId);
                upQuality(itemId);
            });

            function upQuality(id) {
                $.ajax({
                    type: "post",
                    url: "/chieu2/cart/upQuality/" + id,
                    success: function (response) {
                        location.reload();
                    }
                });
            }

            $('.btndown').click(function () {
                var itemId = $(this).data('id');
                console.log(itemId);
                downQuantity(itemId);
            });

            function downQuantity(id) {
                $.ajax({
                    type: "post",
                    url: "/chieu2/cart/downQuality/" + id,
                    success: function (response) {
                        location.reload();
                    }
                });
            }

            $('.btndelete').click(function () {
                var itemId = $(this).data('id');
                console.log(itemId);
                deleteP(itemId);
            });
            function deleteP(id) {
                $.ajax({
                    type: "post",
                    url: "/chieu2/cart/delete/" + id,
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


</head>

<body>


    <?php include_once 'app/views/user/Navbar.php'; ?>



    <!-- Modal Search Start -->
    <div class="modal fade" id="searchModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-fullscreen">
            <div class="modal-content rounded-0">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Search by keyword</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body d-flex align-items-center">
                    <div class="input-group w-75 mx-auto d-flex">
                        <input type="search" class="form-control p-3" placeholder="keywords"
                            aria-describedby="search-icon-1">
                        <span id="search-icon-1" class="input-group-text p-3"><i class="fa fa-search"></i></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal Search End -->


    <!-- Single Page Header start -->
    <div class="container-fluid page-header py-5">
        <h1 class="text-center text-white display-6">Cart</h1>
        <ol class="breadcrumb justify-content-center mb-0">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item"><a href="#">Pages</a></li>
            <li class="breadcrumb-item active text-white">Cart</li>
        </ol>
    </div>
    <!-- Single Page Header End -->


    <!-- Cart Page Start -->
    <div class="container-fluid py-5">
        <div class="container py-5">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Sản phẩm</th>
                            <th scope="col">Tên sp</th>
                            <th scope="col">Giá</th>
                            <th scope="col">Số lượng</th>
                            <th scope="col">Tổng</th>
                            <th scope="col">Hành động</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if (!isset($_SESSION['cart']) || empty($_SESSION['cart'])) {
                            echo "<div class='container'>";
                            echo "<h2 class='text-center mt-5'>Giỏ hàng trống!</h2>";
                            echo "</div>";
                        } else {
                            $totalPrice = 0;
                            foreach ($_SESSION['cart'] as $item) {
                                $subtotal = $item->price * $item->quantity;
                                $totalPrice += $subtotal;
                                ?>
                                <tr>
                                    <th scope="row">
                                        <div class="d-flex align-items-center">
                                            <?php if (empty($item->image) || !file_exists($item->image)): ?>
                                                No Image!
                                            <?php else: ?>
                                                <img src="/chieu2/<?= $item->image ?>" class="img-fluid me-5 rounded-circle"
                                                    style="width: 80px; height: 80px;" alt="" />
                                            <?php endif; ?>

                                        </div>
                                    </th>
                                    <td>
                                        <p class="mb-0 mt-4"><?php echo $item->name; ?></p>
                                    </td>
                                    <td>
                                        <p class="mb-0 mt-4"><?php echo $item->price; ?></p>
                                    </td>
                                    <td>
                                        <div class="input-group quantity mt-4" style="width: 100px;">
                                            <div class="input-group-btn">
                                                <button class="btn btn-sm btn-minus rounded-circle bg-light border btndown "
                                                    data-id="<?php echo $item->id ?>">
                                                    <i class="fa fa-minus"></i>
                                                </button>
                                            </div>
                                            <input type="text" class="form-control form-control-sm text-center border-0"
                                                value="<?php echo $item->quantity ?>">
                                            <div class="input-group-btn">
                                                <button class="btn btn-sm btn-plus rounded-circle bg-light border btnup "
                                                    data-id="<?php echo $item->id ?>">
                                                    <i class="fa fa-plus"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <p class="mb-0 mt-4"><?php echo $subtotal ?></p>
                                    </td>
                                    <td>
                                        <button class="btn btn-md rounded-circle bg-light border mt-4 btndelete"
                                            data-id="<?php echo $item->id ?>">
                                            <i class="fa fa-times text-danger"></i>
                                        </button>
                                    </td>

                                </tr>
                            <?php }
                        } ?>
                    </tbody>
                </table>
            </div>

            <div class="row g-4 justify-content-end">
                <div class="col-8"></div>
                <div class="col-sm-8 col-md-7 col-lg-6 col-xl-4">
                    <div class="bg-light rounded">
                        <div class="p-4">
                            <h1 class="display-6 mb-4">Giỏ hàng <span class="fw-normal"></span></h1>
                        </div>
                        <div class="py-4 mb-4 border-top border-bottom d-flex justify-content-between">
                            <h5 class="mb-0 ps-4 me-4">Thành tiền</h5>
                            <p class="mb-0 pe-4"><?php
                            if (!empty($totalPrice)) {
                                echo $totalPrice;
                            } else {
                                echo '0';
                            }
                            ?></p>
                        </div>
                        <button
                            class="btn border-secondary rounded-pill px-4 py-3 text-primary text-uppercase mb-4 ms-4"
                            type="button" id="btnthanhtoan">Checkout</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Cart Page End -->

    <?php include_once 'app/views/user/Footer.php'; ?>


    <!-- Back to Top -->
    <a href="#" class="btn btn-primary border-3 border-primary rounded-circle back-to-top"><i
            class="fa fa-arrow-up"></i></a>


    <!-- JavaScript Libraries -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="/chieu2/public/lib/easing/easing.min.js"></script>
    <script src="/chieu2/public/lib/waypoints/waypoints.min.js"></script>
    <script src="/chieu2/public/lib/lightbox/js/lightbox.min.js"></script>
    <script src="/chieu2/public/lib/owlcarousel/owl.carousel.min.js"></script>

    <!-- Template Javascript -->
    <script src="js/main.js"></script>
</body>

</html>