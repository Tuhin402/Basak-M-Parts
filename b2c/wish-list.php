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
                <h3 class="heading text-center">My Wishlist</h3>
                <ul class="breadcrumbs d-flex align-items-center justify-content-center">
                    <li><a class="link" href="index.php">Home</a></li>
                    <li><i class="icon-arrRight"></i></li>
                    <li><a class="link" href="products-all.php">Shop</a></li>
                    <li><i class="icon-arrRight"></i></li>
                    <li>Wishlist</li>
                </ul>
            </div>
        </div>
        <?php } ?>
        <!-- /page-title -->

        <!-- Section product -->
        <section class="flat-spacing">
            <div class="container">
                <div class="tf-grid-layout tf-col-2 md-col-4 xl-col-6">
                <?php 
                if (isset($_SESSION["user_id"])) {
                    $userId = $_SESSION["user_id"];
                    $wishlistQuery = "SELECT * FROM wishlist WHERE b2c_id = '$userId'";
                    $wishlistItems = $obj->fetch($wishlistQuery);
                    if (!empty($wishlistItems)) { 
                        foreach ($wishlistItems as $wishlistItem) {
                            $productId = $wishlistItem['pro_id'];
                            $productQuery = "SELECT * FROM products WHERE id = '$productId'";
                            $product = $obj->fetch($productQuery);
                            if (!empty($product)) {
                                $product_id = $product[0]['id'];
                                $productName = $product[0]['name'];
                                $productPrice = $product[0]['b2c_price'];
                                $productImageOne = $product[0]['image_1'];
                                $productImageTwo = $product[0]['image_2'];
                            } ?>
                            <div class="card-product wow fadeInUp" data-wow-delay="0s" data-availability="Out of stock" data-brand="adidas">
                                <div class="card-product-wrapper">
                                    <a href="product-detail.php?product_id=<?= base64_encode($product_id) ?>" class="product-img">
                                        <img class="lazyload img-product" data-src="../Admin/uploads/products/<?= $productImageOne ?>" src="../Admin/uploads/products/<?= $productImageOne ?>" alt="image-product" style="width: 100%; height: 100%; object-fit: contain;">
                                        <img class="lazyload img-hover" data-src="../Admin/uploads/products/<?= $productImageTwo ?>" src="../Admin/uploads/products/<?= $productImageTwo ?>" alt="image-product" style="width: 100%; height: 100%; object-fit: contain;">
                                    </a>
                                    <div class="list-product-btn">
                                        <button type="button" class="box-icon wishlist btn-icon-action border-0 p-3" data-product-id="<?= $product_id ?>" data-price="<?= $productPrice ?>">
                                            <span class="icon icon-heart"></span>
                                            <span class="tooltip">Wishlist</span>
                                        </button>
                                        <a href="compare.php?product_id=<?= $product_id ?>" class="box-icon compare btn-icon-action">
                                            <span class="icon icon-gitDiff"></span>
                                            <span class="tooltip">Compare</span>
                                        </a>
                                    </div>
                                    <div class="list-btn-main">
                                        <button type="button" class="btn-main-product add-to-cart" data-product-id="<?= $product_id ?>" data-price="<?= $productPrice ?>">
                                            Add To Cart
                                        </button>
                                    </div> 
                                </div>
                                <div class="card-product-info">
                                    <a href="product-detail.php?product_id=<?= base64_encode($product_id) ?>" class="title link"><?= htmlspecialchars($productName) ?></a>
                                    <span class="price current-price">₹ <?= htmlspecialchars($productPrice) ?></span>
                                </div>
                            </div>
                            <?php } } else { 
                            echo '<h5 class="w-100 text-center">Your Wishlist is empty</h5>';
                        } } else { 
                        echo '<h5 class="text-center"><a href="login_B_to_B.php" class="fw-bold text-danger">Login -</a> to see cart details</h5>';
                    } ?>
                </div>
            </div>
        </section>
        <!-- /Section product -->
        
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

</body>
</html>