<div class="owl-carousel vegetable-carousel justify-content-center">
                <?php while ($row = $bestseller->fetch(PDO::FETCH_ASSOC)): ?>
                    
                    <div class="border border-primary rounded position-relative vesitable-item">
                    <a href="/chieu2/product/detailProduct/<?= $row['id'] ?>">
                        <div class="vesitable-img">
                            <?php if (empty($row['image']) || !file_exists($row['image'])): ?>
                                No Image!
                            <?php else: ?>
                                <img src="/chieu2/<?= $row['image'] ?>" alt="Hình ảnh" class="img-fluid w-100 rounded-top" />
                            <?php endif; ?>
                        </div>
                    </a>
                        <div class="text-white bg-primary px-3 py-1 rounded position-absolute"
                            style="top: 10px; right: 10px;"><?= $row['category'] ?></div>
                        <div class="p-4 rounded-bottom">
                            <h4><?= $row['name'] ?></h4>
                            <p><?= strlen($row['description']) > 50 ? substr($row['description'], 0, 50) . '...' : $row['description'] ?>
                            </p>
                          
                            <div class="d-flex justify-content-between flex-lg-wrap">
                                <p class="text-dark fs-5 fw-bold mb-0"><?= $row['price'] ?> vnd</p>
                                <button onclick="addcart(<?php echo $row['id']; ?>)"
                                    class="btn border border-secondary rounded-pill px-3 text-primary"><i
                                        class="fa fa-shopping-bag me-2 text-primary"></i> Add to cart</button>
                            </div>
                        </div>
                    </div>
                   
                   
                <?php endwhile; ?>
                </div>