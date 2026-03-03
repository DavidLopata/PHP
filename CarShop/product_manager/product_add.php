<?php include(__DIR__ . '/../view/header.php'); ?>

<main>
    <h2>Add Vehicle</h2>

    <form action="/Proekt/product_manager/index.php" method="post">
        <input type="hidden" name="action" value="add_product">

        <label>Category:</label><br>
        <select name="category_id" required>
            <?php foreach ($categories as $category) : ?>
                <option value="<?php echo $category['categoryID']; ?>">
                    <?php echo htmlspecialchars($category['categoryName']); ?>
                </option>
            <?php endforeach; ?>
        </select><br><br>
        <label>Name:</label><br>
        <input type="text" name="name" required><br><br>
        <label>Fuel Type:</label><br>
        <input type="text" name="code" required><br><br>
        <label>Price:</label><br>
        <input type="number" step="1000" name="price" required><br><br>
        <label>Image filename:</label><br>
        <input type="text" name="image" value="placeholder.png"><br><br>
        
        <button type="submit">Add Vehicle</button>
    </form>
</main>

<?php include(__DIR__ . '/../view/footer.php'); ?>
