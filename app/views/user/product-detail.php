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
            $('#addcart').click(function (e) {
                e.preventDefault();
                var productid = $(this).data('id');
                var quantityp = $('#quantity').val();
                console.log(quantityp);
                $.ajax({
                    type: "post",
                    url: "/chieu2/cart/add/" + productid,
                    data: { quantity: quantityp },
                    success: function (response) {
                        alert("Đã thêm vào giỏ hàng");
                    },
                    error: function (xhr, status, error) {
                        alert("Đã xảy ra lỗi: " + error);
                    }
                });
            });
        });
        function addcart(id) {
            $.ajax({
                url: "/chieu2/cart/add/" + id,
                success: function (response) {
                    alert("thêm sản phẩm thành công");
                }
            });
        }

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
        <h1 class="text-center text-white display-6">CHI TIẾT SẢN PHẨM</h1>
        <ol class="breadcrumb justify-content-center mb-0">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item"><a href="#">Pages</a></li>
            <li class="breadcrumb-item active text-white">Shop Detail</li>
        </ol>
    </div>
    <!-- Single Page Header End -->


    <!-- Single Product Start -->
    <div class="container-fluid py-5 mt-5">
        <div class="container py-5">
            <div class="row g-4 mb-5">
                <div class="col-lg-8 col-xl-9">
                    <div class="row g-4">
                        <div class="col-lg-6">
                            <div class="border rounded">
                                <a href="#">
                                    <img src="/chieu2/<?php echo $product->image ?>" class="img-fluid rounded"
                                        alt="Image">
                                </a>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <h4 class="fw-bold mb-3"><?php echo $product->name ?></h4>
                            <!-- <p class="mb-3"><?php echo $product->name ?></p> -->
                            <h5 class="fw-bold mb-3"><?php echo $product->price ?> vnd</h5>
                            <div class="d-flex mb-4">
                                <i class="fa fa-star text-secondary"></i>
                                <i class="fa fa-star text-secondary"></i>
                                <i class="fa fa-star text-secondary"></i>
                                <i class="fa fa-star text-secondary"></i>
                                <i class="fa fa-star"></i>
                            </div>
                            <p class="mb-4"><?php echo substr($product->description, 0, 300); ?> ...</p>
                            <div class="input-group quantity mb-5" style="width: 100px;">
                                <div class="input-group-btn">
                                    <button class="btn btn-sm btn-minus rounded-circle bg-light border">
                                        <i class="fa fa-minus"></i>
                                    </button>
                                </div>
                                <input type="number" class="form-control form-control-sm text-center border-0" value="1"
                                    id='quantity' min="1">
                                <div class="input-group-btn">
                                    <button class="btn btn-sm btn-plus rounded-circle bg-light border">
                                        <i class="fa fa-plus"></i>
                                    </button>
                                </div>
                            </div>
                            <button id="addcart" data-id="<?php echo $product->id ?>"
                                class="btn border border-secondary rounded-pill px-4 py-2 mb-4 text-primary"><i
                                    class="fa fa-shopping-bag me-2 text-primary"></i> Add to cart</button>
                        </div>
                        <div class="col-lg-12">
                            <nav>
                                <div class="nav nav-tabs mb-3">
                                    <button class="nav-link active border-white border-bottom-0" type="button"
                                        role="tab" id="nav-about-tab" data-bs-toggle="tab" data-bs-target="#nav-about"
                                        aria-controls="nav-about" aria-selected="true">Mô tả</button>
                                    <button class="nav-link border-white border-bottom-0" type="button" role="tab"
                                        id="nav-mission-tab" data-bs-toggle="tab" data-bs-target="#nav-mission"
                                        aria-controls="nav-mission" aria-selected="false">Đánh giá</button>
                                </div>
                            </nav>
                            <div class="tab-content mb-5">
                                <div class="tab-pane active" id="nav-about" role="tabpanel"
                                    aria-labelledby="nav-about-tab">
                                    <p><?php echo $product->description ?></p>
                                    <!-- <div class="px-2">
                                        <div class="row g-4">
                                            <div class="col-6">
                                                <div
                                                    class="row bg-light align-items-center text-center justify-content-center py-2">
                                                    <div class="col-6">
                                                        <p class="mb-0">Weight</p>
                                                    </div>
                                                    <div class="col-6">
                                                        <p class="mb-0">1 kg</p>
                                                    </div>
                                                </div>
                                                <div
                                                    class="row text-center align-items-center justify-content-center py-2">
                                                    <div class="col-6">
                                                        <p class="mb-0">Country of Origin</p>
                                                    </div>
                                                    <div class="col-6">
                                                        <p class="mb-0">Agro Farm</p>
                                                    </div>
                                                </div>
                                                <div
                                                    class="row bg-light text-center align-items-center justify-content-center py-2">
                                                    <div class="col-6">
                                                        <p class="mb-0">Quality</p>
                                                    </div>
                                                    <div class="col-6">
                                                        <p class="mb-0">Organic</p>
                                                    </div>
                                                </div>
                                                <div
                                                    class="row text-center align-items-center justify-content-center py-2">
                                                    <div class="col-6">
                                                        <p class="mb-0">Сheck</p>
                                                    </div>
                                                    <div class="col-6">
                                                        <p class="mb-0">Healthy</p>
                                                    </div>
                                                </div>
                                                <div
                                                    class="row bg-light text-center align-items-center justify-content-center py-2">
                                                    <div class="col-6">
                                                        <p class="mb-0">Min Weight</p>
                                                    </div>
                                                    <div class="col-6">
                                                        <p class="mb-0">250 Kg</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div> -->
                                </div>
                                <div class="tab-pane" id="nav-mission" role="tabpanel"
                                    aria-labelledby="nav-mission-tab">
                                    <?php while ($item = $review->fetch(PDO::FETCH_ASSOC)): ?>
                                        <div class="d-flex">
                                            <img src="/chieu2/public/img/avatar.jpg" class="img-fluid rounded-circle p-3"
                                                style="width: 100px; height: 100px;" alt="">
                                            <div class="">

                                                <p class="mb-2" style="font-size: 14px;"><?php echo $item['time'] ?></p>
                                                <div class="d-flex justify-content-between">

                                                    <h5><?php echo $item['name'] ?></h5>
                                                </div>

                                                <p><?php echo $item['content'] ?></p>
                                            </div>
                                        </div>
                                    <?php endwhile; ?>
                                </div>
                                <div class="tab-pane" id="nav-vision" role="tabpanel">
                                    <p class="text-dark">Tempor erat elitr rebum at clita. Diam dolor diam ipsum et
                                        tempor sit. Aliqu diam
                                        amet diam et eos labore. 3</p>
                                    <p class="mb-0">Diam dolor diam ipsum et tempor sit. Aliqu diam amet diam et eos
                                        labore.
                                        Clita erat ipsum et lorem et sit</p>
                                </div>
                            </div>
                        </div>
                        <form action="/chieu2/review/add" method="post">
                            <h4 class="mb-5 fw-bold">Bình luận tại đây</h4>
                            <div class="row g-4">
                                <div class="col-lg-6">
                                    <div class="border-bottom rounded">
                                        <input id="name" name="name" type="text" class="form-control border-0 me-4"
                                            placeholder="Nhập tên của bạn *">
                                    </div>
                                </div>

                                <div class="col-lg-12">
                                    <div class="border-bottom rounded my-4">
                                        <!-- Sửa lỗi: chỉ cần sử dụng thuộc tính name một lần -->
                                        <textarea id="content" name="content" class="form-control border-0" cols="30"
                                            rows="8" placeholder="Nhập đánh giá *" spellcheck="false"></textarea>
                                    </div>
                                </div>
                                <input type="hidden" name="product_id" value="<?php echo $product->id ?>">
                                <div class="col-lg-12">
                                    <div class="d-flex justify-content-between py-3 mb-5">
                                        <div class="d-flex align-items-center">

                                        </div>
                                        <button type="submit"
                                            class="btn border border-secondary text-primary rounded-pill px-4 py-3">
                                            Đăng</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-lg-4 col-xl-3">
                    <div class="row g-4 fruite">
                        <div class="col-lg-12">
                           
                            <?php include_once 'app/views/user/Categories.php' ?>
                        </div>
                        <?php include_once 'app/views/user/BestSeller.php' ?>

                    </div>
                </div>
            </div>
            <h1 class="fw-bold mb-0">Sản Phẩm Cùng Loại</h1>
            <div class="vesitable">
                <?php include_once 'app/views/user/product2.php' ?>
            </div>
        </div>
    </div>
    <!-- Single Product End -->


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
    <script src="/chieu2/public/js/main.js"></script>
</body>

</html>