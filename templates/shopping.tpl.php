<?php
declare(strict_types=1);

require_once(__DIR__ . '/../database/connection.db.php');
require_once(__DIR__ . '/../database/item.class.php');
require_once(__DIR__ . '/../database/shopping_cart.class.php');

function drawShoppingCart(): void {
    global $db, $session;

    // Get the shopping cart
    $shoppingCart = new ShoppingCart($db, $session);

    // Get the products in the cart
    $products = $shoppingCart->getProducts();

    // Display the cart contents
    if (!empty($products)) {
        ?>
        <h2>Shopping Cart</h2>
        <table>
            <thead>
                <tr>
                    <th>Product</th>
                    <th>Quantity</th>
                    <th>Price</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
        <?php
        foreach ($products as $product) {
            ?>
            <tr>
                <td><?= $product->getName() ?></td>
                <td><?= $product->getQuantity() ?></td>
                <td><?= $product->getPrice() ?></td>
                <td><?= $product->getTotal() ?></td>
            </tr>
        <?php
        }
        ?>
            </tbody>
        </table>

        <h2>Subtotal: <?= $shoppingCart->getSubtotal() ?></h2>
        <h2>Total: <?= $shoppingCart->getTotal() ?></h2>

        <form action="../actions/action_checkout.php" method="post">
            <input type="submit" value="Checkout">
        </form>
    <?php
    } else {
        ?>
        <p>Your cart is empty.</p>
    <?php
    }
}

function drawCheckoutForm(): void {
    global $session;

    // Get the shopping cart
    $shoppingCart = new ShoppingCart($db, $session);

    // Get the products in the cart
    $products = $shoppingCart->getProducts();

    // Display the checkout form
    if (!empty($products)) {
        ?>
        <h2>Checkout</h2>
        <form action="../actions/action_checkout.php" method="post">
            <label for="shipping_address">Shipping Address:</label>
            <input type="text" name="shipping_address" id="shipping_address" required>
            <br>
            <label for="payment_method">Payment Method:</label>
            <select name="payment_method" id="payment_method">
                <option value="credit_card">Credit Card</option>
                <option value="paypal">PayPal</option>
            </select>
            <br>
            <input type="submit" value="Place Order">
        </form>
    <?php
    } else {
        ?>
        <p>You must have products in your cart to checkout.</p>
    <?php
    }
}
