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
       
        function searchProduct(){
            var id = $("#inputid").val(); // Sửa tên của biến inputid

            window.location.href = "/chieu2/product/searchProduct/" + id;
        }

    </script>
</head>

<body>

    <?php include_once 'app/views/user/Navbar.php'; ?>
    <!-- Hero Start -->
    <div class="container-fluid py-5 mb-5 hero-header">
        <div class="container py-5">
            <div class="row g-5 align-items-center">
                <div class="col-md-12 col-lg-7">
                    <h4 class="mb-3 text-secondary">Bách hóa </h4>
                    <h1 class="mb-5 display-3 text-primary">Mọi thứ trên đời chúng tôi đều có</h1>
                    <div class="position-relative mx-auto">
                        <input id="inputid" class="form-control border-2 border-secondary w-75 py-3 px-4 rounded-pill"
                            type="text" placeholder="Search">
                        <button onclick="searchProduct()"
                            class="btn btn-primary border-2 border-secondary py-3 px-4 position-absolute rounded-pill text-white h-100"
                            style="top: 0; right: 25%;">Submit Now</button>
                    </div>
                </div>
                <div class="col-md-12 col-lg-5">
                    <div id="carouselId" class="carousel slide position-relative" data-bs-ride="carousel">
                        <div class="carousel-inner" role="listbox">
                            <div class="carousel-item active rounded">
                                <img src="/chieu2/public/img/hero-img-1.png"
                                    class="img-fluid w-100 h-100 bg-secondary rounded" alt="First slide">
                                <!-- <a href="#" class="btn px-4 py-2 text-white rounded">Fruites</a> -->
                            </div>
                            <div class="carousel-item rounded">
                                <img src="/chieu2/public/img/hero-img-2.jpg" class="img-fluid w-100 h-100 rounded"
                                    alt="Second slide">
                                <!-- <a href="#" class="btn px-4 py-2 text-white rounded">Vesitables</a> -->
                            </div>
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#carouselId"
                            data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#carouselId"
                            data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Hero End -->

    <?php include_once 'app/views/user/Fruits.php'; ?>
    <!-- Featurs Section Start -->




    <!-- Featurs Start -->
    
    <!-- Featurs End -->


    <!-- Vesitable Shop Start-->
    <div class="container-fluid vesitable py-5">
        <div class="container py-5">
            <div class="text-center mx-auto mb-5" style="max-width: 700px;">
                <h1 class="display-4">BÁN CHẠY</h1>

            </div>
            <?php include_once 'app/views/user/product2.php' ?>
        </div>
    </div>

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