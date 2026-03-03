<?php include(__DIR__ . '/../view/header.php'); ?>

<main class="orders no-sidebar">
<div class="page-header">
    <h2>Vehicle Manager</h2><br>
    <a href="?action=show_add_form" class="button">Add New Vehicle</a>
</div>
    <table border="1" cellpadding="6" cellspacing="0">
        <tr>
            <th>Name</th>
            <th>Fuel Type</th>
            <th>Image</th>
            <th>Price</th>
            <th>Category</th>
            <th>Action</th>
        </tr>

        <?php foreach ($products as $product) : ?>
            <tr>
                <td><?php echo htmlspecialchars($product['productName']); ?></td>
                <td><?php echo htmlspecialchars($product['productCode']); ?></td>
                <td><img src="/Proekt/images/products/<?php echo htmlspecialchars($product['imageName']); ?>"width="60"onerror="this.src='/Proekt/images/products/placeholder.jpg'"></td>
                <td>$<?php echo number_format($product['listPrice'], 2); ?></td>
                <td><?php echo htmlspecialchars($product['categoryName']); ?></td>
                <td>
                <form action="/Proekt/product_manager/index.php" method="post">
                    <input type="hidden" name="action" value="delete_product">
                    <input type="hidden" name="product_id" value="<?= $product['productID']; ?>">
                    <button type="submit">Delete</button>
                </form>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
</main>

<?php include(__DIR__ . '/../view/footer.php'); ?>
