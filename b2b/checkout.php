<?php 
include 'session_config.php';
if (!isset($_SESSION["b2b_user_id"])) {
    header("Location: login.php");
    exit();
}
// $userId = $_SESSION["b2b_user_id"];
$user_name = $_SESSION["b2b_user_name"];
$user_email = $_SESSION["b2b_user_email"];
$user_mobile = $_SESSION["b2b_user_mobile"];
$user_address = $_SESSION["b2b_user_address"];
$user_state = $_SESSION["b2b_user_state"];
$user_district = $_SESSION["b2b_user_district"];
$user_landmark = $_SESSION["b2b_user_landmark"];
$user_pin = $_SESSION["b2b_user_pin"];
$user_gst = $_SESSION["b2b_user_gst"];

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

        <!-- /Header -->
        <?php include 'header.php'; ?>
        <!-- /Header -->
        
        <!-- page-title -->
        <?php 
        $imageQuery = "SELECT * FROM banner_two LIMIT 1";
        $bans = $obj->fetch($imageQuery);
        foreach ($bans as $ban){ 
        ?>
        <div class="page-title" style="background-image: url('../Admin/uploads/banner/<?= htmlspecialchars($ban['b2b_image']) ?>');">
            <div class="container">
                <h3 class="heading text-center">Check Out</h3>
                <ul class="breadcrumbs d-flex align-items-center justify-content-center">
                    <li><a class="link" href="index.php">Home</a></li>
                    <li><i class="icon-arrRight"></i></li>
                    <li><a class="link" href="shopping-cart.php">Cart</a></li>
                    <li><i class="icon-arrRight"></i></li>
                    <li>View Cart</li>
                </ul>
            </div>
        </div>
        <?php } ?>
        <!-- /page-title -->

        <!-- Section checkout -->
        <section class="flat-spacing">
            <div class="container">
                <div class="row">
                    <?php 
                    $productQuery = "SELECT c.pro_id, c.qty, c.total_price, c.shipping_price, p.name, p.image_1, p.sku, p.part, p.b2b_price, p.b2b_discount, p.mrp FROM cart c INNER JOIN products p ON c.pro_id = p.id WHERE c.b2b_id = '$userId'";
                    $cartItems = $obj->fetch($productQuery);

                    $total_amount = 0;
                    $shipping_amount = 0;
                    foreach ($cartItems as $item) {
                        $total_amount += $item['total_price'];
                        $shipping_amount += $item['shipping_price'];
                        $total_price = $total_amount + $shipping_amount;
                        $round_total_price = round($total_price);
                    } ?>
                    <div class="col-xl-5">
                        <div class="flat-spacing flat-sidebar-checkout">
                            <div class="sidebar-checkout-content">
                                <h5 class="title">Shopping Cart</h5>
                                <div class="list-product">
                                    <?php if (!empty($cartItems)) { 
                                        foreach ($cartItems as $item) { ?>
                                            <div class="item-product">
                                                <a href="product-detail.php?product_id=<?= base64_encode($item['pro_id']) ?>" class="img-product">
                                                    <img src="../Admin/uploads/products/<?= htmlspecialchars($item['image_1']) ?>" alt="<?= htmlspecialchars($item['name']) ?>">
                                                </a>
                                                <div class="content-box d-flex flex-column align-items-start">
                                                    <div class="info">
                                                        <a href="product-detail.php?product_id=<?= base64_encode($item['pro_id']) ?>" class="name-product link text-title"><?= htmlspecialchars($item['name']) ?></a>
                                                    </div>
                                                    <div class="tf-product-info-price">
                                                        <p class="text-button price-on-sale font-2"><span><?= $item['qty'] ?></span> X <span class="price">₹ <?= number_format($item['b2b_price'], 2) ?></span></span></p>
                                                        <div class="compare-at-price font-2"><?= htmlspecialchars($item['mrp']) ?></div>
                                                        <?php if($item['b2b_discount'] != 0) { ?>
                                                        <div class="badges-on-sale text-btn-uppercase">-<?= htmlspecialchars($item['b2b_discount']) ?>%</div>
                                                        <?php } ?>
                                                    </div>
                                                    <p class="badge bg-info text-dark"><i class="bi bi-percent me-1"></i>All taxes included</p>
                                                </div>
                                            </div>
                                    <?php } } else { ?>
                                        <p class="text-center">Your cart is empty. <a href="products-all.php" class="text-primary fw-bold">Shop Now</a></p>
                                    <?php } ?>
                                </div>
                                <div class="sec-total-price">
                                    <div class="bottom">
                                        <h5 class="d-flex justify-content-between mb-5">
                                            <span>Shipping Cost</span>
                                            <span class="total-price-checkout">₹<?= number_format($shipping_amount, 2) ?></span>
                                        </h5>
                                        <h5 class="d-flex justify-content-between">
                                            <span>Total</span>
                                            <span class="total-price-checkout">₹<?= number_format($round_total_price, 2) ?></span>
                                        </h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- divider -->
                    <div class="col-xl-1"><div class="line-separation"></div></div>
                    <!-- /divider -->
                    
                    <div class="col-xl-6">
                        <div class="flat-spacing tf-page-checkout">
                            <div class="wrap d-none d-md-block">
                                <h5 class="title">General Information</h5>
                                <form class="info_box">
                                    <div class="row g-4 mt-3">
                                        <div class="col-lg-6">
                                            <label for="name">Full Name <span style="color:red;">*</span></label>
                                            <input type="text" id="name" name="name" placeholder="Full Name*" value="<?= htmlspecialchars($user_name) ?>" readonly>
                                        </div>
                                        <div class="col-lg-6">
                                            <label for="mobile">Mobile No. <span style="color:red;">*</span></label>
                                            <input type="tel" id="mobile" name="mobile" placeholder="Mobile No.*" value="<?= htmlspecialchars($user_mobile) ?>" readonly>
                                        </div>
                                        <div class="col-lg-6">
                                            <label for="email">Email ID <span style="color:red;">*</span></label>
                                            <input type="email" id="email" name="email" placeholder="Email ID*" value="<?= htmlspecialchars($user_email) ?>" readonly>
                                        </div>
                                        <div class="col-lg-6">
                                            <label for="gst">GST No. <span style="color:red;">*</span></label>
                                            <input type="text" id="gst" name="gst" placeholder="GST No.*" value="<?= htmlspecialchars($user_gst) ?>" readonly>
                                        </div>
                                        <div class="col-lg-12">
                                            <label for="address">Address <span style="color:red;">*</span></label>
                                            <input type="text" id="address" name="address" placeholder="Address*" value="<?= htmlspecialchars($user_address) ?>" readonly>
                                        </div>
                                        <div class="col-lg-6">
                                            <label for="state">State <span style="color:red;">*</span></label>
                                            <input type="text" id="state" name="state" placeholder="State*" value="<?= htmlspecialchars($user_state) ?>" readonly>
                                        </div>
                                        <div class="col-lg-6">
                                            <label for="district">District <span style="color:red;">*</span></label>
                                            <input type="text" id="district" name="district" placeholder="District*" value="<?= htmlspecialchars($user_district) ?>" readonly>
                                        </div>
                                        <div class="col-lg-6">
                                            <label for="landmark">Landmark <span style="color:red;">*</span></label>
                                            <input type="text" id="landmark" name="landmark" placeholder="Landmark*" value="<?= htmlspecialchars($user_landmark) ?>" readonly>
                                        </div>
                                        <div class="col-lg-6">
                                            <label for="pin">Area PIN Code <span style="color:red;">*</span></label>
                                            <input type="number" id="pin" name="pin" placeholder="Area PIN Code*" value="<?= htmlspecialchars($user_pin) ?>" readonly>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="wrap">
                                <h5 class="title">Choose payment Option:</h5>
                                <form class="form-payment">
                                    <div class="row g-3 mt-3">
                                        <div class="col-lg-12">
                                            <button class="btn-style-2 border-0" id="razorpay_payment" style="color:white; width: 100%;">Online payment</button>
                                        </div>
                                        <!--<div class="col-lg-12">-->
                                        <!--    <button class="btn-style-3 border-0" id="cod_order" style="color:white; width: 100%;">Cash on delivery</button>-->
                                        <!--</div>-->
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- /Section checkout -->

       
        <!-- Footer -->
        <?php include 'footer.php'; ?>
        <!-- /Footer -->
        
    </div>
    
    <!-- search -->
    <?php include 'search.php'; ?>
    <?php include 'general_search.php'; ?>
    <!-- /search -->

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
    <script src="js/sibforms.js" defer></script>
    <!-- razorpay script cdn -->
    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>

    <script>
        var totalPrice = <?php echo $total_price; ?>;

        function checkMinimumPurchase() {
            if (totalPrice < 5000) {
                Toastify({
                    text: "Please add products worth at least Rs. 5000 to proceed.",
                    duration: 3000,
                    gravity: "top",       
                    position: "center",   
                    backgroundColor: "#FF0000", 
                }).showToast();
                return false;
            }
            return true;
        }
        
        // razorpay and shiprocket api integration for online payment
        document.getElementById("razorpay_payment").addEventListener("click", function (e) {
            e.preventDefault();
            if (!checkMinimumPurchase()) {
                return;
            }
            const formData = {
                name: "<?= htmlspecialchars($user_name) ?>",
                email: "<?= htmlspecialchars($user_email) ?>",
                mobile: "<?= htmlspecialchars($user_mobile) ?>",
                state: "<?= htmlspecialchars($user_state) ?>",
                city: "<?= htmlspecialchars($user_district) ?>",
                address: "<?= htmlspecialchars($user_address) ?>",
                landmark: "<?= htmlspecialchars($user_landmark) ?>",
                pin: "<?= htmlspecialchars($user_pin) ?>",
                total_amount: "<?= $round_total_price ?>",
                products: [
                    <?php foreach ($cartItems as $item) { ?>
                    {
                        product_id: "<?= $item['pro_id'] ?>",
                        product_name: "<?= htmlspecialchars($item['name']) ?>",
                        quantity: "<?= $item['qty'] ?>",
                        price: "<?= $item['b2b_price'] ?>",
                        total_price: "<?= $item['total_price'] ?>",
                        hsn: "<?= htmlspecialchars($item['sku']) ?>",
                        sku: "<?= htmlspecialchars($item['part']) ?>"
                    },
                    <?php } ?>
                ]
            };
            fetch("razorpay_cart_order.php", {
                method: "POST",
                headers: { "Content-Type": "application/json" },
                body: JSON.stringify(formData)
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    let options = {
                        key: "rzp_live_35SLNsYr1wP5RY",
                        amount: formData.total_amount * 100,
                        currency: "INR",
                        name: "Basak M Parts",
                        description: "Order Payment",
                        image: "images/logo-white.png",
                        order_id: data.orderData.razorpay_order_id,
                        handler: function (response) {
                            const paymentDetails = {
                                razorpay_order_id: data.orderData.razorpay_order_id,
                                razorpay_payment_id: response.razorpay_payment_id,
                                razorpay_signature: response.razorpay_signature,
                                order_id: data.orderData.order_id,
                                name: data.orderData.name,
                                email: data.orderData.email,
                                mobile: data.orderData.mobile,
                                state: data.orderData.state,
                                city: data.orderData.city,
                                address: data.orderData.address,
                                landmark: data.orderData.landmark,
                                pin: data.orderData.pin,
                                total_amount: data.orderData.total_amount,
                                products: data.orderData.products
                            };
                            fetch("confirm_cart_payment.php", {
                                method: "POST",
                                headers: { "Content-Type": "application/json" },
                                body: JSON.stringify(paymentDetails)
                            })
                            .then(res => res.json())
                            .then(confirmData => {
                                if (confirmData.success) {
                                    Toastify({
                                        text: "Payment Successful! Order Confirmed.",
                                        duration: 2000,
                                        gravity: "top",
                                        position: "center",
                                        backgroundColor: "#28a745"
                                    }).showToast();
                                    setTimeout(() => {
                                        let encodedProducts = encodeURIComponent(JSON.stringify(confirmData.orderData.products));
                                        let checkoutURL = `receipt.php?order_id=${encodeURIComponent(confirmData.orderData.order_id)}&razorpay_order_id=${encodeURIComponent(confirmData.orderData.razorpay_order_id)}&total_amount=${encodeURIComponent(confirmData.orderData.total_amount)}&userName=${encodeURIComponent(confirmData.orderData.name)}&userEmail=${encodeURIComponent(confirmData.orderData.email)}&userMobile=${encodeURIComponent(confirmData.orderData.mobile)}&userAdd=${encodeURIComponent(confirmData.orderData.address)}&userLandmark=${encodeURIComponent(confirmData.orderData.landmark)}&userPin=${encodeURIComponent(confirmData.orderData.pin)}&products=${encodedProducts}`;
                                        window.location.href = checkoutURL;
                                    }, 1500);
                                } else {
                                    Toastify({
                                        text: "Payment verification failed. Please try again.",
                                        duration: 3000,
                                        gravity: "top",
                                        position: "center",
                                        backgroundColor: "#dc3545"
                                    }).showToast();
                                }
                            })
                            .catch(err => console.error("Error confirming payment:", err));
                        },
                        prefill: {
                            name: data.orderData.name,
                            email: data.orderData.email,
                            contact: data.orderData.mobile
                        },
                        theme: { color: "#0C74D6" }
                    };
                    let rzp = new Razorpay(options);
                    rzp.open();
                } else {
                    Toastify({
                        text: "Order creation failed!",
                        duration: 3000,
                        gravity: "top",
                        position: "center",
                        backgroundColor: "#dc3545"
                    }).showToast();
                }
            })
            .catch(error => console.error("Error:", error));
        });

        // Cod ajax for shiprocket
        document.getElementById("cod_order").addEventListener("click", function(e) {
            e.preventDefault();
            if (!checkMinimumPurchase()) {
                return;
            }
            const formData = {
                name: "<?= htmlspecialchars($user_name) ?>",
                email: "<?= htmlspecialchars($user_email) ?>",
                mobile: "<?= htmlspecialchars($user_mobile) ?>",
                state: "<?= htmlspecialchars($user_state) ?>",
                city: "<?= htmlspecialchars($user_district) ?>",
                address: "<?= htmlspecialchars($user_address) ?>",
                landmark: "<?= htmlspecialchars($user_landmark) ?>",
                pin: "<?= htmlspecialchars($user_pin) ?>",
                total_amount: "<?= $round_total_price ?>",
                products: [
                    <?php foreach ($cartItems as $item) { ?>
                    {
                        product_id: "<?= $item['pro_id'] ?>",
                        product_name: "<?= htmlspecialchars($item['name']) ?>",
                        quantity: "<?= $item['qty'] ?>",
                        price: "<?= $item['b2b_price'] ?>",
                        total_price: "<?= $item['total_price'] ?>",
                        hsn: "<?= htmlspecialchars($item['sku']) ?>",
                        sku: "<?= htmlspecialchars($item['part']) ?>"
                    },
                    <?php } ?>
                ]
            };

            // debug
            // console.log("Sending Order Data:", JSON.stringify(formData));

            fetch("process_cod_cartOrder.php", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json"
                },
                body: JSON.stringify(formData)
            })
            .then(response => response.json())
            .then(data => {
                if(data.success) {
                    Toastify({
                        text: "Order placed successfully!",
                        duration: 3000,
                        gravity: "top",
                        position: "center",
                        backgroundColor: "green"
                    }).showToast();
                    setTimeout(function(){
                        let encodedProducts = encodeURIComponent(JSON.stringify(data.orderData.products));
                        window.location.href = `receipt.php?order_id=${encodeURIComponent(data.orderData.order_id)}&total_amount=${encodeURIComponent(data.orderData.total_amount)}&userName=${encodeURIComponent(data.orderData.name)}&userEmail=${encodeURIComponent(data.orderData.email)}&userMobile=${encodeURIComponent(data.orderData.mobile)}&userAdd=${encodeURIComponent(data.orderData.address)}&userLandmark=${encodeURIComponent(data.orderData.landmark)}&userPin=${encodeURIComponent(data.orderData.pin)}&products=${encodedProducts}`;
                    }, 1500);
                } else {
                    Toastify({
                        text: "Error: " + data.message,
                        duration: 3000,
                        gravity: "top",
                        position: "center",
                        backgroundColor: "red"
                    }).showToast();
                    console.error("Error:", data.message);
                }
            })
            .catch(error => {
                Toastify({
                    text: "Error placing order",
                    duration: 3000,
                    gravity: "top",
                    position: "center",
                    backgroundColor: "red"
                }).showToast();
                console.error("Error placing order:", error);
            });
        });
    </script>
</body>
</html>