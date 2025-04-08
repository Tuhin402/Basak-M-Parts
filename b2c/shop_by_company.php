<?php 
include 'session_config.php';
include 'headerlink.php'; 
?>

<body class="preload-wrapper">
  <!-- Scroll Top -->
  <button id="scroll-top">
    <svg width="24" height="25" viewBox="0 0 24 25" fill="none" xmlns="http://www.w3.org/2000/svg">
      <g clip-path="url(#clip0_15741_24194)">
        <path
          d="M3 11.9175L12 2.91748L21 11.9175H16.5V20.1675C16.5 20.3664 16.421 20.5572 16.2803 20.6978C16.1397 20.8385 15.9489 20.9175 15.75 20.9175H8.25C8.05109 20.9175 7.86032 20.8385 7.71967 20.6978C7.57902 20.5572 7.5 20.3664 7.5 20.1675V11.9175H3Z"
          stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
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

  <div id="wrapper">

    <?php include 'header.php'; 
    if (isset($_GET['company_name'])) {
        $company_name = trim($_GET['company_name']);
    
        $company_query = "SELECT id FROM company WHERE name LIKE '%$company_name%'";
        $company_result = $obj->fetch($company_query);
    
        if (!empty($company_result)) {
            $company_id = $company_result[0]['id']; 
            $product_query = "SELECT DISTINCT p.* FROM products p WHERE p.company_id = $company_id";
            $products = $obj->fetch($product_query);
        } else {
            echo "<script>window.location.href = '404.php';</script>";
            exit();
        }
    } else {
        echo "<script>window.location.href = 'products-all.php';</script>";
        exit();
    }
    ?>

    <section class="flat-spacing">
        <div class="container">
            <div class="flat-animate-tab">
                <div class="tab-content">
                    <div class="tab-pane active show" id="AllProducts" role="tabpanel">
                        <div class="row">
                            <?php if (!empty($products)) { ?>
                                <?php foreach ($products as $product) { ?>
                                    <div class="col-6 col-lg-3 col-md-4 col-sm-6 mb-4">
                                        <div class="card-product wow fadeInUp" data-wow-delay="0.1s">
                                            <div class="card-product-wrapper">
                                                <a href="product-detail.php?product_id=<?= base64_encode($product['id']) ?>" class="product-img">
                                                    <img class="lazyload img-product" data-src="../Admin/uploads/products/<?= $product['image_1'] ?>" src="../Admin/uploads/products/<?= $product['image_1'] ?>" alt="<?= $product['name'] ?>">
                                                    <img class="lazyload img-hover" data-src="../Admin/uploads/products/<?= $product['image_2'] ?>" src="../Admin/uploads/products/<?= $product['image_2'] ?>" alt="<?= $product['name'] ?>">
                                                </a>
                                                <div class="list-product-btn">
                                                    <button type="button" class="box-icon wishlist btn-icon-action border-0 p-3" data-product-id="<?= $product['id'] ?>" data-price="<?= $product['b2c_price'] ?>">
                                                        <span class="icon icon-heart"></span>
                                                        <span class="tooltip">Wishlist</span>
                                                    </button>
                                                    <a href="compare.php?product_id=<?= $product['id'] ?>" class="box-icon compare btn-icon-action">
                                                        <span class="icon icon-gitDiff"></span>
                                                        <span class="tooltip">Compare</span>
                                                    </a>
                                                    <button type="button" class="box-icon quickview tf-btn-loading border-0 p-3" data-bs-toggle="modal" data-bs-target="#quickView<?= $product['id'] ?>">
                                                        <span class="icon icon-eye"></span>
                                                        <span class="tooltip">Quick View</span>
                                                    </button>
                                                </div>
                                                <div class="list-btn-main">
                                                    <button type="button" class="btn-main-product add-to-cart" data-product-id="<?= $product['id'] ?>" data-price="<?= $product['b2c_price'] ?>">
                                                        Add To Cart
                                                    </button>
                                                </div> 
                                            </div>
                                            <div class="card-product-info">
                                                <a href="product-detail.php?product_id=<?= base64_encode($product['id']) ?>" class="title link"><?= htmlspecialchars($product['name']) ?></a>
                                                <span class="price current-price">₹<?= number_format($product['b2c_price'], 2) ?></span>
                                            </div>
                                        </div>
                                    </div>
                                <?php } ?>
                            <?php } else { ?>
                                <h5 class="text-center fw-semibold text-danger">No products found.</h5>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

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