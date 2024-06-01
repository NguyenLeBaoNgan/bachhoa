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
        <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&family=Raleway:wght@600;800&display=swap" rel="stylesheet"> 

        <!-- Icon Font Stylesheet -->
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css"/>
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
            function searchProduct(){
            var id = $("#nameproduct").val(); // Sửa tên của biến inputid

            window.location.href = "/chieu2/user/SearchProductShop/" + id;
        }
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


        <!-- Single Page Header start -->
        <div class="container-fluid page-header py-5">
            <h1 class="text-center text-white display-6">Shop Bách Hóa</h1>
            <ol class="breadcrumb justify-content-center mb-0">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item"><a href="#">Pages</a></li>
                <li class="breadcrumb-item active text-white">Shop</li>
            </ol>
        </div>
        <!-- Single Page Header End -->


        <!-- Fruits Shop Start-->
        <div class="container-fluid fruite py-5">
            <div class="container py-5">
                <h3 class="mb-4">Tìm kiếm</h3>
                <div class="row g-4">
                    <div class="col-lg-12">
                        <div class="row g-4">
                        <div class="col-xl-3">
                                <div class="input-group w-100 mx-auto d-flex">
                                    <input type="search" id="nameproduct" class="form-control p-3" placeholder="keywords" aria-describedby="search-icon-1">
                                    <span id="search-icon-1" onclick="searchProduct()" class="input-group-text p-3"><i class="fa fa-search"></i></span>
                                </div>
                            </div>
                            <!-- <div class="col-6"></div> -->
                            <!-- <div class="col-xl-3">
                                <div class="bg-light ps-3 py-3 rounded d-flex justify-content-between mb-4">
                                    <label for="fruits">Default Sorting:</label>
                                    <select id="fruits" name="fruitlist" class="border-0 form-select-sm bg-light me-3" form="fruitform">
                                        <option value="volvo">Nothing</option>
                                        <option value="saab">Popularity</option>
                                        <option value="opel">Organic</option>
                                        <option value="audi">Fantastic</option>
                                    </select>
                                </div>
                            </div> -->
                        </div>
                        <div class="row g-4">
                            <div class="col-lg-3">
                                <div class="row g-4">
                                    <div class="col-lg-12">
                                        <hr>
                                    <?php include_once 'app/views/user/Categories.php'?>
                                    </div>
                                    
                                    <?php include_once 'app/views/user/BestSeller.php'?>
                                  
                                </div>
                            </div>
                            <div class="col-lg-9">
                                <div class="row g-4 justify-content-center">
                                <?php while ($row = $products->fetch(PDO::FETCH_ASSOC)): ?>
                                    
                                    <div class="col-md-6 col-lg-6 col-xl-4">
                                    
                                        <div class="rounded position-relative fruite-item">
                                        <a href="/chieu2/product/detailProduct/<?= $row['id']; ?>">
                                            <div class="fruite-img">
                                                <?php if (empty($row['image']) || !file_exists($row['image'])): ?>
                                                        No Image!
                                                    <?php else: ?>
                                                        <img src="/chieu2/<?= $row['image'] ?>" alt="Hình ảnh"
                                                            class="img-fluid w-100 rounded-top" />
                                                    <?php endif; ?>
                                            </div>
                                            </a>
                                            <div class="text-white bg-secondary px-3 py-1 rounded position-absolute" style="top: 10px; left: 10px;"><?= $row['category'] ?></div>
                                            <div class="p-4 border border-secondary border-top-0 rounded-bottom">
                                                <h4><?= $row['name'] ?></h4>
                                                <p><?= strlen($row['description']) > 50 ? substr($row['description'], 0, 50) . '...' : $row['description'] ?>
                                                    </p>
                                                <div class="d-flex justify-content-between flex-lg-wrap">
                                                    <p class="text-dark fs-5 fw-bold mb-0"><?= $row['price'] ?></p>
                                                    <button onclick="addcart(<?php echo $row['id']; ?>)"
                                                            class="btn border border-secondary rounded-pill px-3 text-primary"><i
                                                                class="fa fa-shopping-bag me-2 text-primary"></i> Add to
                                                            cart</button>
                                                </div>
                                               
                                            </div>
                                         
                                        </div>
                                        
                                    </div>
                                    
                                    <?php endwhile; ?>
                                        <div class="pagination d-flex justify-content-center mt-5">
                                            <a href="#" class="rounded">&laquo;</a>
                                            <a href="#" class="active rounded">1</a>
                                            <a href="#" class="rounded">2</a>
                                            <a href="#" class="rounded">3</a>
                                            <a href="#" class="rounded">4</a>
                                            <a href="#" class="rounded">5</a>
                                            <a href="#" class="rounded">6</a>
                                            <a href="#" class="rounded">&raquo;</a>
                                        </div>
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Fruits Shop End-->


        <?php include_once 'app/views/user/Footer.php'?>


        <!-- Back to Top -->
        <a href="#" class="btn btn-primary border-3 border-primary rounded-circle back-to-top"><i class="fa fa-arrow-up"></i></a>   

        
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