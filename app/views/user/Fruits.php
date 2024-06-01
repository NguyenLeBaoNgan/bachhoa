<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script>
    function addcart(id) {
        $.ajax({
            url: "/chieu2/cart/add/" + id,
            success: function (response) {
                alert("thêm sản phẩm thành công");
            }
        });
    }
</script>
<!-- Fruits Shop Start-->
<div class="container-fluid fruite py-5">
    <div class="container py-5">
        <div class="tab-class text-center">
            <div class="row g-4">
                <div class="col-lg-4 text-start">
                    <h1>SẢN PHẨM</h1>
                </div>
                <div class="col-lg-8 text-end">
                    <ul class="nav nav-pills d-inline-flex text-center mb-5">
                        <li class="nav-item">
                            <a class="d-flex m-2 py-2 bg-light rounded-pill " 
                                href="/chieu2/">
                                <span class="text-dark" style="width: 130px;">Tất cả</span>
                            </a>
                        </li>
                        <?php if (!empty($categorys)) {
                            while ($itemc = $categorys->fetch(PDO::FETCH_ASSOC)): ?>
                                <li class="nav-item">
                                    <a class="d-flex py-2 m-2 bg-light rounded-pill category" 
                                        href="/chieu2/product/listProductsByCategory/<?php echo $itemc['id']; ?>">
                                        <span class="text-dark" style="width: 130px;"><?php echo $itemc['name']; ?></span>
                                    </a>
                                </li>
                            <?php endwhile;
                        } ?>
                    </ul>
                </div>

            </div>
            <div class="tab-content">
                <div id="tab-1" class="tab-pane fade show p-0 active">
                    <div class="row g-4">
                        <div class="col-lg-12">
                            <div class="row g-4">
                                <?php 
                                 while ($row = $products->fetch(PDO::FETCH_ASSOC)): ?>
                                    <div class="col-md-6 col-lg-4 col-xl-3">
                              
                                            <div class="rounded position-relative fruite-item">
                                            <a href="/chieu2/product/detailProduct/<?= $row['id'] ?>">
                                                <div class="fruite-img">
                                                    <?php if (empty($row['image']) || !file_exists($row['image'])): ?>
                                                        No Image!
                                                    <?php else: ?>
                                                        <img src="/chieu2/<?= $row['image'] ?>" alt="Hình ảnh"
                                                            class="img-fluid w-100 rounded-top" />
                                                    <?php endif; ?>
                                                </div>
                                            </a>
                                                <div class="text-white bg-secondary px-3 py-1 rounded position-absolute"
                                                    style="top: 10px; left: 10px;"><?= $row['category'] ?></div>
                                                <div class="p-4 border border-secondary border-top-0 rounded-bottom">
                                                    <h4><?= $row['name'] ?></h4>
                                                    <p><?= strlen($row['description']) > 50 ? substr($row['description'], 0, 50) . '...' : $row['description'] ?>
                                                    </p>
                                                    <div class="d-flex justify-content-between flex-lg-wrap">
                                                        <p class="text-dark fs-5 fw-bold mb-0"><?= $row['price'] ?> vnd</p>
                                                        <button onclick="addcart(<?php echo $row['id']; ?>)"
                                                            class="btn border border-secondary rounded-pill px-3 text-primary"><i
                                                                class="fa fa-shopping-bag me-2 text-primary"></i> Add to
                                                            cart</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                    </div>


                                <?php endwhile; ?>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div>
</div>
<!-- Fruits Shop End-->