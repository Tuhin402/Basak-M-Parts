<?php
include 'session_config.php';
include "../Admin/config.php";

if (isset($_SESSION["b2b_user_id"])) {
    $userId = $_SESSION["b2b_user_id"];
    $cartQuery = "SELECT SUM(total_price) AS subtotal, COUNT(*) AS totalItems FROM cart WHERE b2b_id = '$userId'";
    $cartData = $obj->fetch($cartQuery);

    $subtotal = !empty($cartData[0]["subtotal"]) ? $cartData[0]["subtotal"] : 0;
    $totalItems = !empty($cartData[0]["totalItems"]) ? $cartData[0]["totalItems"] : 0;
    $shippingCost = ($subtotal > 0) ? 50.00 : 0;
    $total = $subtotal + $shippingCost;
?>

    <div class="box-order bg-surface">
        <h5 class="title">Order Summary</h5>
        <div class="subtotal text-button d-flex justify-content-between align-items-center">
            <span>Subtotal</span>
            <span class="total">₹<?= number_format($subtotal, 2) ?></span>
        </div>
        <div class="ship d-flex justify-content-between align-items-center">
            <span class="text-button">Shipping</span>
            <span class="price">₹<?= number_format($shippingCost, 2) ?></span>
        </div>
        <h5 class="total-order d-flex justify-content-between align-items-center">
            <span>Total</span>
            <span class="total">₹<?= number_format($total, 2) ?></span>
        </h5>

        <?php if ($totalItems > 0) { ?>
            <div class="box-progress-checkout">
                <fieldset class="check-agree text-center">
                    <label for="check-agree">You are agreeing with our <a href="#">T & C Policy</a></label>
                </fieldset>
                <a href="checkout.php" class="tf-btn btn-reset">Proceed To Checkout</a>
                <p class="text-button text-center"><a href="products-all.php">Or continue shopping</a></p>
            </div>
        <?php } else { ?>
            <p class="text-center">Your cart is empty, <a href="products-all.php" class="text-primary fw-bold">Shop Now</a></p>
        <?php } ?>
    </div>

<?php } else { ?>
    <p class="text-center fw-semibold">Login to view order summary</p>
<?php } ?>