<?php 
include 'session_config.php';
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
        <?php include 'header.php'; ?>
        <!-- /Header -->
        
        <!-- page-title -->
        <?php 
        $imageQuery = "SELECT * FROM banner LIMIT 1";
        $bans = $obj->fetch($imageQuery);
        foreach ($bans as $ban){ 
        ?>
        <div class="page-title" style="background-image: url('../Admin/uploads/banner/<?= htmlspecialchars($ban['b2c_image']) ?>');">
            <div class="container">
                <h3 class="heading text-center">All Products</h3>
                <ul class="breadcrumbs d-flex align-items-center justify-content-center">
                    <li><a class="link" href="index.php">Home</a></li>
                    <li><i class="icon-arrRight"></i></li>
                    <li>All Products</li>
                </ul>
            </div>
        </div>
        <?php } ?>
        <!-- /page-title -->

        <!-- Section product -->
        <section class="flat-spacing">
            <div class="container">
                <div class="tf-shop-control d-flex justify-content-between">
                    <div class="tf-control-filter">
                        <a href="#filterShop" data-bs-toggle="offcanvas" aria-controls="filterShop" class="tf-btn-filter"><span class="icon icon-filter"></span><span class="text">Filters</span></a>
                    </div>
                    <ul class="tf-control-layout">
                        <li class="tf-view-layout-switch sw-layout-2" data-value-layout="tf-col-2">
                            <div class="item">
                                <svg class="icon" width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <circle cx="6" cy="6" r="2.5" stroke="#181818"/>
                                    <circle cx="14" cy="6" r="2.5" stroke="#181818"/>
                                    <circle cx="6" cy="14" r="2.5" stroke="#181818"/>
                                    <circle cx="14" cy="14" r="2.5" stroke="#181818"/>
                                </svg>   
                            </div>
                        </li>
                        <li class="tf-view-layout-switch sw-layout-3" data-value-layout="tf-col-3">
                            <div class="item">
                                <svg class="icon" width="22" height="20" viewBox="0 0 22 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <circle cx="3" cy="6" r="2.5" stroke="#181818"/>
                                    <circle cx="11" cy="6" r="2.5" stroke="#181818"/>
                                    <circle cx="19" cy="6" r="2.5" stroke="#181818"/>
                                    <circle cx="3" cy="14" r="2.5" stroke="#181818"/>
                                    <circle cx="11" cy="14" r="2.5" stroke="#181818"/>
                                    <circle cx="19" cy="14" r="2.5" stroke="#181818"/>
                                </svg>                                    
                            </div>
                        </li>
                        <li class="tf-view-layout-switch sw-layout-4 active" data-value-layout="tf-col-4">
                            <div class="item">
                                <svg class="icon" width="30" height="20" viewBox="0 0 30 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <circle cx="3" cy="6" r="2.5" stroke="#181818"/>
                                    <circle cx="11" cy="6" r="2.5" stroke="#181818"/>
                                    <circle cx="19" cy="6" r="2.5" stroke="#181818"/>
                                    <circle cx="27" cy="6" r="2.5" stroke="#181818"/>
                                    <circle cx="3" cy="14" r="2.5" stroke="#181818"/>
                                    <circle cx="11" cy="14" r="2.5" stroke="#181818"/>
                                    <circle cx="19" cy="14" r="2.5" stroke="#181818"/>
                                    <circle cx="27" cy="14" r="2.5" stroke="#181818"/>
                                </svg>
                            </div>
                        </li>
                        <li class="tf-view-layout-switch sw-layout-5" data-value-layout="tf-col-5">
                            <div class="item">
                                <svg class="icon" width="38" height="20" viewBox="0 0 38 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <circle cx="3" cy="6" r="2.5" stroke="#181818"/>
                                    <circle cx="11" cy="6" r="2.5" stroke="#181818"/>
                                    <circle cx="19" cy="6" r="2.5" stroke="#181818"/>
                                    <circle cx="27" cy="6" r="2.5" stroke="#181818"/>
                                    <circle cx="35" cy="6" r="2.5" stroke="#181818"/>
                                    <circle cx="3" cy="14" r="2.5" stroke="#181818"/>
                                    <circle cx="11" cy="14" r="2.5" stroke="#181818"/>
                                    <circle cx="19" cy="14" r="2.5" stroke="#181818"/>
                                    <circle cx="27" cy="14" r="2.5" stroke="#181818"/>
                                    <circle cx="35" cy="14" r="2.5" stroke="#181818"/>
                                </svg>                                    
                            </div>
                        </li>
                    </ul>
                </div>
                <div class="wrapper-control-shop">
                    <div class="tf-grid-layout wrapper-shop tf-col-4" id="gridLayout">
                        <?php 
                        $query = "SELECT * FROM products ORDER BY sort_order ASC";
                        $products = $obj->fetch($query);
                        foreach ($products as $product){ 
                            $product_id = $product['id'];
                        ?>
                        <div class="card-product grid" data-availability="In stock" data-brand="brand">
                            <div class="card-product-wrapper">
                                <a href="product-detail.php?product_id=<?= base64_encode($product['id']) ?>" class="product-img">
                                    <?php if(!empty($product['image_1'])) { ?>
                                    <img class="lazyload img-product" data-src="../Admin/uploads/products/<?= $product['image_1'] ?>" src="../Admin/uploads/products/<?= $product['image_1'] ?>" alt="<?= $product['name'] ?>" style="object-fit: contain">
                                    <?php } ?>
                                    <?php if(!empty($product['image_2'])) { ?>
                                    <img class="lazyload img-hover" data-src="../Admin/uploads/products/<?= $product['image_2'] ?>" src="../Admin/uploads/products/<?= $product['image_2'] ?>" alt="<?= $product['name'] ?>" style="object-fit: contain">
                                    <?php } else { ?>
                                    <img class="lazyload img-hover" data-src="../Admin/uploads/products/<?= $product['image_1'] ?>" src="../Admin/uploads/products/<?= $product['image_2'] ?>" alt="<?= $product['name'] ?>" style="object-fit: contain">
                                    <?php } ?>
                                </a>
                                <div class="list-product-btn">
                                    <button type="button" class="box-icon wishlist btn-icon-action border-0 p-3" data-product-id="<?= $product_id ?>" data-price="<?= $product['b2c_price'] ?>">
                                        <span class="icon icon-heart"></span>
                                        <span class="tooltip">Wishlist</span>
                                    </button>
                                    <a href="compare.php?product_id=<?= $product_id ?>" class="box-icon compare btn-icon-action">
                                        <span class="icon icon-gitDiff"></span>
                                        <span class="tooltip">Compare</span>
                                    </a>
                                    <button type="button" class="box-icon quickview tf-btn-loading border-0 p-3" data-bs-toggle="modal" data-bs-target="#quickView<?php echo $product_id; ?>">
                                        <span class="icon icon-eye"></span>
                                        <span class="tooltip">Quick View</span>
                                    </button>
                                </div>
                                <div class="list-btn-main">
                                    <button type="button" class="btn-main-product add-to-cart" data-product-id="<?= $product_id ?>" data-price="<?= $product['b2c_price'] ?>">
                                        Add To Cart
                                    </button>
                                </div> 
                            </div>
                            <div class="card-product-info">
                                <a href="product-detail.php?product_id=<?= base64_encode($product['id']) ?>" class="title link"><?= htmlspecialchars($product['name']) ?></a>
                                <span class="price current-price">₹<?= number_format($product['b2c_price'], 2) ?></span>
                            </div>
                        </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </section>
        <!-- /Section product -->
       
        <!-- footer -->
        <?php include 'footer.php'; ?>
        <!-- /footer -->
        
    </div>
    
    <!-- Filter -->
    <?php include 'filter_modal.php'; ?>
    <!-- /Filter -->

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
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.min.js"></script>
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
    <!-- add to cart ajax -->
    <script type="text/javascript" src="js/addToCart.js"></script>
    <!-- add to wishlist ajax -->
    <script type="text/javascript" src="js/addToWishlist.js"></script>
    <!-- product filteration ajax -->
    <script type="text/javascript" src="js/filterProduct.js"></script>

</body>
</html>