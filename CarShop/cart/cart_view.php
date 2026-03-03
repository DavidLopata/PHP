<?php include('../view/header.php'); ?>

<main class="orders no-sidebar">
    <h2 class="page-title">Your Cart</h2>

    <?php if (empty($cart_items)) : ?>
        <p>Your cart is empty.</p>
    <?php else : ?>
        <table class="cart-table">
            <thead>
                <tr>
                    <th>Product</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Total</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
            <?php foreach ($cart_items as $item) : ?>
                <tr data-price="<?= $item['price'] ?>">
                    <td><?= htmlspecialchars($item['name']) ?></td>

                    <td>$<?= number_format($item['price'], 2) ?></td>

                    <td>
                        <input
                            type="number"
                            min="1"
                            value="<?= $item['quantity'] ?>"
                            class="qty-input"
                            data-id="<?= $item['id'] ?>"
                        >
                    </td>

                    <td class="row-total">
                        $<?= number_format($item['price'] * $item['quantity'], 2) ?>
                    </td>

                    <td>
                        <form action="index.php" method="post">
                            <input type="hidden" name="action" value="remove">
                            <input type="hidden" name="product_id" value="<?= $item['id'] ?>">
                            <button class="remove-btn">✖</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>

        <div class="cart-summary">
            <div class="cart-total">
                Grand Total:
                <strong id="grand-total">$<?= number_format($grand_total, 2) ?></strong>
            </div>

            <div class="cart-checkout">
                <form action="index.php" method="post">
                    <input type="hidden" name="action" value="checkout">
                    <input type="submit" value="Checkout">
                </form>
            </div>
        </div>

    <?php endif; ?>
</main>

<script>
const currencyFormatter = new Intl.NumberFormat('en-US', {
    style: 'currency',
    currency: 'USD'
});

document.querySelectorAll('.qty-input').forEach(input => {
    input.addEventListener('change', function () {
        let qty = parseInt(this.value);

        if (isNaN(qty) || qty < 1) {
            qty = 1;
            this.value = 1;
        }

        const row = this.closest('tr');
        const price = parseFloat(row.dataset.price);
        const id = this.dataset.id;

        const rowTotal = price * qty;


        row.querySelector('.row-total').textContent =
            currencyFormatter.format(rowTotal);

        updateGrandTotal();

        fetch('update_ajax.php', {
            method: 'POST',
            headers: {'Content-Type': 'application/x-www-form-urlencoded'},
            body: `id=${id}&qty=${qty}`
        });
    });
});

function updateGrandTotal() {
    let total = 0;

    document.querySelectorAll('tr[data-price]').forEach(row => {
        const price = parseFloat(row.dataset.price);
        const qty = parseInt(row.querySelector('.qty-input').value);

        total += price * qty;
    });

    document.getElementById('grand-total').textContent =
        currencyFormatter.format(total);
}
</script>


<?php include('../view/footer.php'); ?>
