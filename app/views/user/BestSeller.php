<div class="col-lg-12">
    <hr>
    <h4 class="mb-4">SP BÁN CHẠY</h4>
    <?php while ($row = $bestseller1->fetch(PDO::FETCH_ASSOC)) : ?>
        <a href="/chieu2/product/detailProduct/<?= $row['id']; ?>">
            <div class="d-flex align-items-center justify-content-start">
                <div class="rounded" style="width: 100px; height: 100px;">
                    <?php if (empty($row['image']) || !file_exists($row['image'])) : ?>
                        No Image!
                    <?php else : ?>
                        <img src="/chieu2/<?= $row['image'] ?>" alt="Hình ảnh" class="img-fluid rounded" />
                    <?php endif; ?>
                </div>
                <div>
                    <h6 class="mb-2"><?= $row['name'] ?></h6>
                    <div class="d-flex mb-2">
                        <i class="fa fa-star text-secondary"></i>
                        <i class="fa fa-star text-secondary"></i>
                        <i class="fa fa-star text-secondary"></i>
                        <i class="fa fa-star text-secondary"></i>
                        <i class="fa fa-star"></i>
                    </div>
                    <div class="d-flex mb-2">
                        <h5 class="fw-bold me-2"><?= $row['price'] ?></h5>
                    </div>
                </div>
            </div>
        </a>

    <?php endwhile; ?>
</div>