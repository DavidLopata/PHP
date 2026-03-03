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
        <h2>Products</h2>

        <?php if (empty($products)) : ?>
            <p>No products found in this category.</p>
        <?php else : ?>

            <div class="product-grid">
                <?php foreach ($products as $product) : ?>
                    <div class="product-card">
                        <img src="images/products/<?php echo htmlspecialchars($product['imageName']); ?>"
                             alt="<?php echo htmlspecialchars($product['productName']); ?>"
                             onerror="this.src='images/products/placeholder.jpg'">

                        <h3><?php echo htmlspecialchars($product['productName']); ?></h3>
                        <p class="code"><?php echo htmlspecialchars($product['productCode']); ?></p>
                        <p class="price">$<?php echo number_format($product['listPrice'], 2); ?></p>
                            <form action="/Proekt/cart/index.php" method="post">
                        <input type="hidden" name="action" value="add">
                        <input type="hidden" name="product_id" value="<?php echo $product['productID']; ?>">
                        <input type="submit" value="Add to Cart">
                            </form>
                    </div>

                <?php endforeach; ?>
            </div>

        <?php endif; ?>
    </section>
</main>

<?php include(__DIR__ . '/../view/footer.php'); ?>
