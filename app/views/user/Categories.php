<div class="mb-4">
    <h4>DANH MỤC</h4>
    <ul class="list-unstyled fruite-categorie">
        <?php while ($row = $categories->fetch(PDO::FETCH_ASSOC)) : ?>

            <li>
                <div class="d-flex justify-content-between fruite-name">
                    <a href="/chieu2/product/listProductsByCategory/<?= $row['id']; ?>"><i class="fas fa-apple-alt me-2"></i><?= $row['name']; ?></a>
                    <span>(<?= $row['count']; ?>)</span>
                </div>
            </li>

        <?php endwhile; ?>
    </ul>
</div>