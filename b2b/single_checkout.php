<?php 
include 'session_config.php';
if (!isset($_SESSION['b2b_user_id'])) {
    header("Location: login_B_to_B.php");
    exit();
}
$user_name = $_SESSION["b2b_user_name"];
$user_email = $_SESSION["b2b_user_email"];
$user_mobile = $_SESSION["b2b_user_mobile"];
$user_address = $_SESSION["b2b_user_address"];
$user_state = $_SESSION["b2b_user_state"];
$user_district = $_SESSION["b2b_user_district"];
$user_landmark = $_SESSION["b2b_user_landmark"];
$user_pin = $_SESSION["b2b_user_pin"];

$product_id = isset($_GET['product_id']) ? $_GET['product_id'] : '';
$product_name = isset($_GET['name']) ? urldecode($_GET['name']) : '';
$product_image = isset($_GET['image']) ? urldecode($_GET['image']) : '';
$product_price = isset($_GET['price']) ? $_GET['price'] : 0;
$total_amount = isset($_GET['totalprice']) ? $_GET['totalprice'] : 0;
$product_quantity = isset($_GET['quantity']) ? $_GET['quantity'] : 1;
$hsn = isset($_GET['hsn']) ? $_GET['hsn'] : '26GTV77';
$sku = isset($_GET['sku']) ? $_GET['sku'] : '114433';

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
                    <li><a class="link" href="products-all.php">Shop</a></li>
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
                    $shipQuery = "SELECT shipping_price, mrp, b2b_discount FROM products WHERE id = '$product_id'";
                    $shippingCost = $obj->fetch($shipQuery);
                    $shipping_price = $shippingCost[0]['shipping_price']; 
                    $b2b_discount = $shippingCost[0]['b2b_discount']; 
                    $mrp = $shippingCost[0]['mrp']; 
                    $total_price = $total_amount + $shipping_price;
                    $round_total_price = round($total_price);
                    ?>
                    <div class="col-xl-5">
                        <div class="flat-spacing flat-sidebar-checkout">
                            <div class="sidebar-checkout-content">
                                <h5 class="title">Shopping Cart</h5>
                                <div class="list-product">
                                    <div class="item-product">
                                        <a href="product-detail.php?product_id=<?= base64_encode($product_id) ?>" class="img-product">
                                            <img src="../Admin/uploads/products/<?= htmlspecialchars($product_image) ?>" alt="<?= htmlspecialchars($product_name) ?>">
                                        </a>
                                        <div class="content-box d-flex flex-column align-items-start">
                                            <div class="info">
                                                <a href="product-detail.php?product_id=<?= base64_encode($product_id) ?>" class="name-product link text-title"><?= htmlspecialchars($product_name) ?></a>
                                            </div>
                                            <div class="tf-product-info-price">
                                                <p class="text-button price-on-sale font-2"><span><?= $product_quantity ?></span> X <span class="price">₹ <?= number_format($product_price, 2) ?></span></span></p>
                                                <div class="compare-at-price font-2"><?= htmlspecialchars($mrp) ?></div>
                                                <?php if($b2b_discount != 0) { ?>
                                                <div class="badges-on-sale text-btn-uppercase">-<?= htmlspecialchars($b2b_discount) ?>%</div>
                                                <?php } ?>
                                            </div>
                                            <p class="badge bg-info text-dark"><i class="bi bi-percent me-1"></i>All taxes included</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="sec-total-price">
                                    <div class="bottom">
                                        <h5 class="d-flex justify-content-between mb-5">
                                            <span>Shipping Charges</span>
                                            <span class="total-price-checkout">₹<?= number_format($shipping_price, 2) ?></span>
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
                                        <div class="col-lg-12">
                                            <label for="name">Full Name <span style="color:red;">*</span></label>
                                            <input type="text" id="name" name="name" placeholder="Enter Full Name*" value="<?= htmlspecialchars($user_name) ?>" readonly>
                                        </div>
                                        <div class="col-lg-6">
                                            <label for="mobile">Mobile No. <span style="color:red;">*</span></label>
                                            <input type="tel" id="mobile" name="mobile" placeholder="Enter Mobile No.*" value="<?= htmlspecialchars($user_mobile) ?>" readonly>
                                        </div>
                                        <div class="col-lg-6">
                                            <label for="email">Email ID <span style="color:red;">*</span></label>
                                            <input type="email" id="email" name="email" placeholder="Enter Email ID*" value="<?= htmlspecialchars($user_email) ?>" readonly>
                                        </div>
                                        <div class="col-lg-12">
                                            <label for="address">Address <span style="color:red;">*</span></label>
                                            <input type="text" id="address" name="address" placeholder="Enter Address*" value="<?= htmlspecialchars($user_address) ?>" readonly>
                                        </div>
                                        <div class="col-lg-6">
                                            <label for="state">State <span style="color:red;">*</span></label>
                                            <input type="text" id="state" name="state" placeholder="Enter State*" value="<?= htmlspecialchars($user_state) ?>" readonly>
                                        </div>
                                        <div class="col-lg-6">
                                            <label for="district">District <span style="color:red;">*</span></label>
                                            <input type="text" id="district" name="district" placeholder="Enter District*" value="<?= htmlspecialchars($user_district) ?>" readonly>
                                        </div>
                                        <div class="col-lg-6">
                                            <label for="landmark">Landmark <span style="color:red;">*</span></label>
                                            <input type="text" id="landmark" name="landmark" placeholder="Enter Landmark*" value="<?= htmlspecialchars($user_landmark) ?>" readonly>
                                        </div>
                                        <div class="col-lg-6">
                                            <label for="pin">Area PIN Code <span style="color:red;">*</span></label>
                                            <input type="number" id="pin" name="pin" placeholder="Enter Area PIN Code*" value="<?= htmlspecialchars($user_pin) ?>" readonly>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="wrap">
                                <h5 class="title">Choose payment Option:</h5>
                                <form class="form-payment">
                                    <div class="payment-box" id="payment-box">
                                        <input type="hidden" name="hsn" value="<?= htmlspecialchars($hsn) ?>">
                                        <input type="hidden" name="sku" value="<?= htmlspecialchars($sku) ?>">
                                    </div>
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
                product_id: "<?= $product_id ?>",
                product_name: "<?= htmlspecialchars($product_name) ?>",
                quantity: "<?= $product_quantity ?>",
                price: "<?= $product_price ?>",
                shipping_price: "<?= $shipping_price ?>",
                total_price: "<?= $round_total_price ?>",
                hsn: "<?= htmlspecialchars($hsn) ?>",
                sku: "<?= htmlspecialchars($sku) ?>"
            };
            fetch("razorpay_order.php", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                },
                body: JSON.stringify(formData)
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    let options = {
                        key: "rzp_live_35SLNsYr1wP5RY", 
                        amount: formData.total_price * 100, 
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
                                product_id: data.orderData.product_id,
                                product_name: data.orderData.product_name,
                                quantity: data.orderData.quantity,
                                price: data.orderData.price,
                                shipping_price: data.orderData.shipping_price,
                                total_price: data.orderData.total_price,
                                hsn: data.orderData.hsn,
                                sku: data.orderData.sku,
                            };
                            fetch("confirm_single_payment.php", {
                                method: "POST",
                                headers: {
                                    "Content-Type": "application/json",
                                },
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
                                        let checkoutURL = `single_receipt.php?product_id=${encodeURIComponent(confirmData.orderData.product_id)}&name=${encodeURIComponent(confirmData.orderData.product_name)}&price=${encodeURIComponent(confirmData.orderData.price)}&quantity=${encodeURIComponent(confirmData.orderData.quantity)}&totalprice=${encodeURIComponent(confirmData.orderData.total_price)}&hsn=${encodeURIComponent(confirmData.orderData.hsn)}&sku=${encodeURIComponent(confirmData.orderData.sku)}&userName=${encodeURIComponent(confirmData.orderData.name)}&userAdd=${encodeURIComponent(confirmData.orderData.address)}&userLandmark=${encodeURIComponent(confirmData.orderData.landmark)}&userPin=${encodeURIComponent(confirmData.orderData.pin)}&userMobile=${encodeURIComponent(confirmData.orderData.mobile)}&userEmail=${encodeURIComponent(confirmData.orderData.email)}&order_id=${encodeURIComponent(confirmData.orderData.order_id)}&razorpay_order_id=${encodeURIComponent(confirmData.orderData.razorpay_order_id)}`;
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
                product_id: "<?= $product_id ?>",
                product_name: "<?= htmlspecialchars($product_name) ?>",
                quantity: "<?= $product_quantity ?>",
                price: "<?= $product_price ?>",
                shipping_price: "<?= $shipping_price ?>",
                total_price: "<?= $round_total_price ?>",
                hsn: "<?= htmlspecialchars($hsn) ?>",
                sku: "<?= htmlspecialchars($sku) ?>"
            };

            // debug
            // console.log("Sending Order Data:", JSON.stringify(formData));

            fetch("process_cod_singleOrder.php", {
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
                        window.location.href = `single_receipt.php?product_id=${encodeURIComponent(data.orderData.product_id)}&name=${encodeURIComponent(data.orderData.product_name)}&price=${encodeURIComponent(data.orderData.price)}&quantity=${encodeURIComponent(data.orderData.quantity)}&totalprice=${encodeURIComponent(data.orderData.total_price)}&hsn=${encodeURIComponent(data.orderData.hsn)}&sku=${encodeURIComponent(data.orderData.sku)}&userName=${encodeURIComponent(data.orderData.name)}&userAdd=${encodeURIComponent(data.orderData.address)}&userLandmark=${encodeURIComponent(data.orderData.landmark)}&userPin=${encodeURIComponent(data.orderData.pin)}&userMobile=${encodeURIComponent(data.orderData.mobile)}&userEmail=${encodeURIComponent(data.orderData.email)}&order_id=${encodeURIComponent(data.orderData.order_id)}`;
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