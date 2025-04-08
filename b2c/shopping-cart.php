<?php 
include 'session_config.php';
include 'headerlink.php'; 
?>

<body class="preload-wrapper">
    
    <!-- Scroll Top -->
    <button id="scroll-top">
        <svg width="24" height="25" viewBox="0 0 24 25" fill="none" xmlns="http://www.w3.org/2000/svg">
            <g clip-path="url(#clip0_15741_24194)">
            <path d="M3 11.9175L12 2.91748L21 11.9175H16.5V20.1675C16.5 20.3664 16.421 20.5572 16.2803 20.6978C16.1397 20.8385 15.9489 20.9175 15.75 20.9175H8.25C8.05109 20.9175 7.86032 20.8385 7.71967 20.6978C7.57902 20.5572 7.5 20.3664 7.5 20.1675V11.9175H3Z" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
            </g>
            <defs>
            <clipPath id="clip0_15741_24194">
            <rect width="24" height="24" fill="white" transform="translate(0 0.66748)"/>
            </clipPath>
            </defs>
        </svg> 
    </button>

    <!-- preload -->
    <div class="preload preload-container">
        <div class="preload-logo">
            <div class="spinner"></div>
        </div>
    </div>
    <!-- /preload -->

    <div id="wrapper">

        <?php include 'header.php'; ?>
        
        <!-- page-title -->
        <?php 
        $imageQuery = "SELECT * FROM banner LIMIT 1";
        $bans = $obj->fetch($imageQuery);
        foreach ($bans as $ban){ 
        ?>
        <div class="page-title" style="background-image: url('../Admin/uploads/banner/<?= htmlspecialchars($ban['b2c_image']) ?>');">
            <div class="container">
                <h3 class="heading text-center">My Cart</h3>
                <ul class="breadcrumbs d-flex align-items-center justify-content-center">
                    <li><a class="link" href="index.php">Home</a></li>
                    <li><i class="icon-arrRight"></i></li>
                    <li><a class="link" href="products-all.php">Shop</a></li>
                    <li><i class="icon-arrRight"></i></li>
                    <li>Shopping Cart</li>
                </ul>
            </div>
        </div>
        <?php } ?>
        <!-- /page-title -->

        <!-- Section cart -->
        <section class="flat-spacing">
            <div class="container">
                <div class="row">
                    <div class="col-xl-8">
                        <form>
                            <table class="tf-table-page-cart">
                                <thead>
                                    <tr>
                                        <th>Products</th>
                                        <th>Price</th>
                                        <th>Quantity</th>
                                        <th>Total Price</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                    if (isset($_SESSION["user_id"])) {
                                        $userId = $_SESSION["user_id"];
                                        $cartQuery = "SELECT * FROM cart WHERE b2c_id = '$userId'";
                                        $cartItems = $obj->fetch($cartQuery);
                                        if (!empty($cartItems)) { 
                                            foreach ($cartItems as $cartItem) {
                                                $productId = $cartItem['pro_id'];
                                                $quantity = $cartItem['qty'];
                                                $totalPrice = $cartItem['total_price'];
                                                $productQuery = "SELECT * FROM products WHERE id = '$productId'";
                                                $product = $obj->fetch($productQuery);
                                                if (!empty($product)) {
                                                    $productName = $product[0]['name'];
                                                    $productPrice = $product[0]['b2c_price'];
                                                    $productImage = $product[0]['image_1'];
                                                } ?>
                                                <tr class="tf-cart-item file-delete" data-product-id="<?= $productId ?>">
                                                    <td class="tf-cart-item_product">
                                                        <a href="product-detail.php?product_id=<?= base64_encode($productId) ?>" class="img-box">
                                                            <img src="../Admin/uploads/products/<?= $productImage ?>" alt="product">
                                                        </a>
                                                        <div class="cart-info">
                                                            <a href="product-detail.php?product_id=<?= base64_encode($productId) ?>" class="cart-title link"><?= htmlspecialchars($productName) ?></a>
                                                        </div>
                                                    </td>
                                                    <td data-cart-title="Price" class="tf-cart-item_price text-center">
                                                        <div class="cart-price text-button price-on-sale">₹<?= $totalPrice ?></div>
                                                    </td>
                                                    <td data-cart-title="Quantity">
                                                        <div class="wg-quantity mx-md-auto">
                                                            <span class="btn-quantity btn-decrease" data-product-id="<?= $productId ?>">-</span>
                                                            <input type="text" class="quantity-product" name="number" value="<?= $quantity ?>" readonly>
                                                            <span class="btn-quantity btn-increase" data-product-id="<?= $productId ?>">+</span>
                                                        </div>
                                                    </td>
                                                    <td data-cart-title="Total" class="tf-cart-item_total text-center">
                                                        <div class="cart-total text-button total-price">₹<?= $totalPrice ?></div>
                                                    </td>
                                                    <td data-cart-title="Remove" class="remove-cart">
                                                        <span class="remove icon icon-close" data-product-id="<?= $productId ?>"></span>
                                                    </td>
                                                </tr>
                                    <?php } } else { 
                                            echo '<tr><td colspan="5" class="text-center">Your cart is empty</td></tr>';
                                        } } else { 
                                        echo '<tr><td colspan="5" class="text-center"><a href="login.php" class="fw-bold text-danger">Login -</a> to see cart details</td></tr>';
                                    } ?>
                                </tbody>
                            </table>
                        </form>
                    </div>
                    <!-- order summary -->
                    <div class="col-xl-4">
                        <div class="fl-sidebar-cart">
                            <div class="box-order bg-surface">
                                <h5 class="title">Order Summary</h5>
                                <?php 
                                if (isset($_SESSION["user_id"])) {
                                    $userId = $_SESSION["user_id"];
                                    $cartQuery = "SELECT SUM(total_price) AS subtotal, COUNT(*) AS totalItems, SUM(shipping_price) AS shipAmount FROM cart WHERE b2c_id = '$userId'";
                                    $cartData = $obj->fetch($cartQuery);

                                    $subtotal = !empty($cartData[0]['subtotal']) ? $cartData[0]['subtotal'] : 0;
                                    $totalItems = !empty($cartData[0]['totalItems']) ? $cartData[0]['totalItems'] : 0;
                                    $ship = !empty($cartData[0]['shipAmount']) ? $cartData[0]['shipAmount'] : 0;
                                    $shippingCost = ($subtotal > 0) ? $ship : 0; 
                                    $total = $subtotal + $shippingCost;
                                ?>
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
                                                <label for="check-agree">You are agreeing with our <a href="terms.php">T & C Policy</a></label>
                                            </fieldset>
                                            <a href="checkout.php" class="tf-btn btn-reset">Proceed To Checkout</a>
                                            <p class="text-button text-center"><a href="products-all.php">Or continue shopping</a></p>
                                        </div>  
                                    <?php } else { ?>
                                        <p class="text-center">Your cart is empty, <a href="products-all.php" class="text-primary fw-bold">Shop Now</a></p>
                                    <?php } ?>

                                <?php } else { ?>
                                    <p class="text-center fw-semibold">Login to view order summary</p>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- /Section cart -->

        <!-- Recent product -->
        <?php include 'random_products_section.php'; ?>
        <!-- /Recent product -->
       
        <!-- Footer -->
        <?php include 'footer.php'; ?>
        <!-- /Footer -->
        
    </div>
    
    <!-- search -->
    <?php include 'search.php'; ?>
    <?php include 'general_search.php'; ?>
    <!-- /search -->

    <!-- quickView -->
    <?php include 'quickview_modal.php'; ?>
    <!-- /quickView -->

    <!-- Javascript -->
    <script type="text/javascript" src="js/bootstrap.min.js"></script>
    <script type="text/javascript" src="js/jquery.min.js"></script>
    <script type="text/javascript" src="js/swiper-bundle.min.js"></script>
    <script type="text/javascript" src="js/carousel.js"></script>
    <script type="text/javascript" src="js/bootstrap-select.min.js"></script>
    <script type="text/javascript" src="js/lazysize.min.js"></script>
    <script type="text/javascript" src="js/count-down.js"></script>
    <script type="text/javascript" src="js/wow.min.js"></script>
    <script type="text/javascript" src="js/multiple-modal.js"></script>
    <script type="text/javascript" src="js/main.js"></script>
    <!-- add to cart ajax -->
    <script type="text/javascript" src="js/addToCart.js"></script>
    <!-- add to wishlist ajax -->
    <script type="text/javascript" src="js/addToWishlist.js"></script>

    <!-- All necessary scripts are here -->
    <script>
        // update cart js
        $(document).ready(function () {
            $(".btn-quantity").click(function () {
                let productId = $(this).data("product-id");
                let inputField = $(this).siblings(".quantity-product");
                let currentQty = parseInt(inputField.val());
                let price = parseFloat($(this).closest("tr").find(".price-on-sale").text().replace("₹", "").trim());
                let action = $(this).hasClass("btn-increase") ? "increase" : "decrease";

                if (action === "decrease" && currentQty <= 1) return;

                let newQty = action === "increase" ? currentQty + 1 : currentQty - 1;
                let newTotalPrice = (newQty * price).toFixed(2);

                inputField.val(newQty);
                $(this).closest("tr").find(".total-price").text("₹" + newTotalPrice);

                $.ajax({
                    url: "update_cart.php",
                    type: "POST",
                    data: { productId: productId, newQty: newQty },
                    success: function (response) {
                        if (response.trim() === "success") {
                            console.log("Cart updated successfully!");
                            updateOrderSummary();
                        } else {
                            alert("Error updating cart! Refresh & try again.");
                        }
                    }
                });
            });
        });

        // delete item ajax
        $(document).ready(function () {
            $(".remove").click(function () {
                let productId = $(this).data("product-id");
                let row = $(this).closest("tr");
                $.ajax({
                    url: "delete_cart.php",
                    type: "POST",
                    data: { product_id: productId },
                    success: function (response) {
                        if (response == "success") {
                            row.remove(); 
                            Toastify({
                                text: "Item removed from cart!",
                                duration: 3000,
                                gravity: "top",
                                position: "center",
                                backgroundColor: "red",
                            }).showToast();
                            updateOrderSummary();
                        } else {
                            alert("Failed to remove item. Please try again.");
                        }
                    },
                });
            });
        });

        // fetch order summary
        function updateOrderSummary() {
            $.ajax({
                url: "fetch_order_summary.php",
                type: "GET",
                success: function (response) {
                    $(".fl-sidebar-cart").html(response);
                },
            });
        }
    </script>
</body>
</html>