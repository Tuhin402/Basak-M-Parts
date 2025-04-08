<?php
include 'session_config.php';
$order_id = $_GET['order_id'] ?? '';
$razorpay_order_id = $_GET['razorpay_order_id'] ?? 'N/A';
$total_amount = $_GET['total_amount'] ?? '';
$userName = $_GET['userName'] ?? '';
$userEmail = $_GET['userEmail'] ?? '';
$userMobile = $_GET['userMobile'] ?? '';
$userAdd = $_GET['userAdd'] ?? '';
$userLandmark = $_GET['userLandmark'] ?? '';
$userPin = $_GET['userPin'] ?? '';

$products = isset($_GET['products']) ? json_decode(urldecode($_GET['products']), true) : [];

include 'headerlink.php'; 
?>

<body class="preload-wrapper">
    
    <!-- Scroll Top -->
    <button id="scroll-top">
        <svg width="24" height="25" viewBox="0 0 24 25" fill="none" xmlns="http://www.w3.org/2000/svg">
            <g clip-path="url(#clip0_15741_24194)">
            <path d="M3 11.9175L12 2.91748L21 11.9175H16.5V20.1675C16.5 20.3664 16.421 20.5572 16.2803 20.6978C16.1397 20.8385 15.9489 20.9175 15.75 20.9175H8.25C8.05109 20.9175 7.86032 20.8385 7.71967 20.6978C7.57902 20.5572 7.5 20.3664 7.5 20.1675V11.9175H3Z" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
            </g>
            <defs>
            <clipPath id="clip0_15741_24194">
            <rect width="24" height="24" fill="white" transform="translate(0 0.66748)"></rect>
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

    <!-- #wrapper -->
    <div id="wrapper">

        <!-- Header -->
        <?php include 'header.php'; 
        
        $statusSql = "SELECT status FROM orders WHERE order_id = '$order_id'";
        $statusData = $obj->fetch($statusSql); 
        $status = $statusData[0]['status']; ?>
        <!-- /Header -->

        <!-- Section Invoice -->
        <section class="flat-spacing">
            <div class="container">
                <div id="invoiceSection" class="row justify-content-center">
                    <div class="col-12 col-lg-12 col-xl-9 col-xxl-8">
                        <div class="row gy-3 mb-3">
                            <div class="col-12">
                                <div class="d-flex align-items-center justify-content-between gap-3">
                                    <h4 class="text-uppercase text-endx m-0">Order Confirmation Receipt</h4>
                                    <a class="d-block text-end" href="index.php">
                                        <img src="images/logo-white.png" class="img-fluid" alt="Logo" width="155">
                                    </a>
                                </div>
                            </div>
                            <div class="col-12">
                                <h4>From:</h4>
                                <address> 
                                    <strong class="text-danger fw-bold">Basak M Parts</strong><br>
                                    <?php 
                                    $infoQuery = "SELECT * FROM contact LIMIT 1";
                                    $infos = $obj->fetch($infoQuery); 
                                    foreach ($infos as $info) {
                                    ?>
                                    <p>Email: <a href="mailto:<?= htmlspecialchars($info['email']) ?>" class="text-dark fw-semibold"><?= htmlspecialchars($info['email']) ?></a></p>
                                    <p>Phone: <a href="tel:<?= htmlspecialchars($info['phone']) ?>" class="text-dark fw-semibold"><?= htmlspecialchars($info['phone']) ?></a></p>
                                    <?php } ?>
                                </address>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-12 col-sm-6 col-md-8">
                                <h4>Bill To:</h4>
                                <address>
                                    <strong class="text-danger fw-bold"><?= htmlspecialchars($userName) ?></strong><br>
                                    Address : <?= htmlspecialchars($userAdd) ?><br>
                                    Landmark : <?= htmlspecialchars($userLandmark) ?><br>
                                    Pin : <?= htmlspecialchars($userPin) ?><br>
                                    Phone: <?= htmlspecialchars($userMobile) ?><br>
                                    Email: <?= htmlspecialchars($userEmail) ?>
                                </address>
                            </div>
                            <div class="col-12 col-sm-6 col-md-4">
                                <h4>Invoice #</h4>
                                <div class="row">
                                    <span class="col-12">Order ID: <?= htmlspecialchars($order_id) ?></span>
                                    <span class="col-12">Txn ID: <?= htmlspecialchars($razorpay_order_id) ?></span>
                                    <span class="col-12">Status: <?= htmlspecialchars($status) ?></span>
                                </div>
                            </div>
                        </div>
                        <div class="row my-5">
                            <div class="col-12">
                                <div class="table-responsive">
                                    <table class="table table-hover align-middle table-bordered">
                                        <thead class="table-dark text-uppercase text-center">
                                            <tr>
                                                <th>Product</th>
                                                <th>SKU</th>
                                                <th>Part</th>
                                                <th>Price</th>
                                                <th>Quantity</th>
                                                <th>Total Price</th>
                                            </tr>
                                        </thead>
                                        <tbody class="table-group-divider">
                                            <?php
                                            $totalAmount = 0; 
                                            foreach ($products as $product) {
                                                $product_id = $product['product_id'] ?? '';
                                                $product_name = $product['product_name'] ?? 'N/A';
                                                $price = $product['price'] ?? 0;
                                                $quantity = $product['quantity'] ?? 1;
                                                $total_price = $product['total_price'] ?? 0;
                                                $hsn = $product['hsn'] ?? 'N/A';
                                                $sku = $product['sku'] ?? 'N/A';

                                                // $totalAmount += $total_price;
                                            ?>
                                            <tr>
                                                <td class="text-center fw-semibold"><?= htmlspecialchars($product_name) ?></td>
                                                <td class="text-center"><?= htmlspecialchars($hsn) ?></td>
                                                <td class="text-center"><?= htmlspecialchars($sku) ?></td>
                                                <td class="text-center">&#8377;<?= number_format(htmlspecialchars($price), 2) ?></td>
                                                <td class="text-center">x <?= htmlspecialchars($quantity) ?></td>
                                                <td class="text-center">&#8377;<?= number_format(htmlspecialchars($total_price), 2) ?></td>
                                            </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="row my-5">
                            <div class="col-12 text-center">
                                <h5>Total Amount : <span class="text-success fw-semibold">₹ <?= $total_amount ?></span></h5>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 text-center">
                        <button id="downloadInvoice" class="btn btn-outline-primary fw-bold px-3 py-2 mb-3 rounded-pill">Download Receipt</button>
                    </div>
                </div>
            </div>
        </section>
        <!-- /Section Invoice -->
       
        <!-- footer -->
        <?php include 'footer.php'; ?>
        <!-- /footer -->
        
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
    <script type="text/javascript" src="js/nouislider.min.js"></script>
    <script type="text/javascript" src="js/shop.js"></script>
    <script type="text/javascript" src="js/main.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>

    <!-- pdf download script -->
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            document.getElementById('downloadInvoice').addEventListener('click', function () {
                var invoiceElement = document.getElementById('invoiceSection');
                var clonedElement = invoiceElement.cloneNode(true);
                var wrapper = document.createElement('div');
                wrapper.style.width = "800px";          
                wrapper.style.padding = "20px";          
                wrapper.style.boxSizing = "border-box";
                wrapper.style.margin = "0 auto";          
                wrapper.appendChild(clonedElement);
                
                var hiddenContainer = document.createElement('div');
                hiddenContainer.style.position = 'fixed';
                hiddenContainer.style.left = '-10000px';
                hiddenContainer.appendChild(wrapper);
                document.body.appendChild(hiddenContainer);
                
                var orderId = "<?= htmlspecialchars($order_id) ?>";
                var opt = {
                  margin:       10, 
                  filename:     'Invoice_' + orderId + '.pdf',
                  image:        { type: 'jpeg', quality: 1 },
                  html2canvas:  { scale: 2, scrollY: 0 },
                  jsPDF:        { unit: 'pt', format: 'a4', orientation: 'portrait' },
                  pagebreak:    { mode: ['avoid-all'] }
                };
                
                html2pdf().set(opt).from(wrapper).save().then(function() {
                  document.body.removeChild(hiddenContainer);
                });
            });
        });
    </script>
</body>
</html>