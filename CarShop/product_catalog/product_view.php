<?php include(__DIR__ . '/../view/header.php'); ?>

<main>
    <aside>
        <h2>Categories</h2>
        <ul>
            <?php foreach ($categories as $category) : ?>
                <li>
                    <a href="?action=list_products&category_id=<?php echo $category['categoryID']; ?>">
                        <?php echo htmlspecialchars($category['categoryName']); ?>
                    </a>
                </li>
            <?php endforeach; ?>
        </ul>
    </aside>

    <section>
        <h2><?php echo htmlspecialchars($product['productName']); ?></h2>

        <div class="product-card">
            <img src="images/products/<?php echo htmlspecialchars($product['imageName']); ?>"
                 alt="<?php echo htmlspecialchars($product['productName']); ?>"
                 onerror="this.src='images/products/placeholder.jpg'">

            <p class="code"><?php echo htmlspecialchars($product['productCode']); ?></p>
            <p class="price">$<?php echo number_format($product['listPrice'], 2); ?></p>
        </div>
    </section>
</main>

<?php include(__DIR__ . '/../view/footer.php'); ?>
