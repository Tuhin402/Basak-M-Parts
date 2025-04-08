<?php 
include 'session_config.php';
$product_id = 0;
if (isset($_GET['product_id'])) {
    $decoded = base64_decode($_GET['product_id']);
    $product_id = intval($decoded);
}
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

        <!-- /Header -->
        <?php include 'header.php'; ?>
        <!-- /Header -->

        <?php
            if ($product_id) {
                $query = "SELECT p.id, p.name AS product_name, p.description, p.sku, p.part, 
                        p.mrp, p.gst, p.b2b_price, p.b2b_discount, p.stock, p.best_seller, p.image_1, p.image_2, p.image_3, p.image_4, 
                        pc.id AS cat_id, pc.category AS category_name, co.id AS company_id, co.name AS company_name FROM products p
                        JOIN category_company cc ON p.cat_id = cc.cat_id AND p.company_id = cc.company_id
                        JOIN product_category pc ON cc.cat_id = pc.id JOIN company co ON cc.company_id = co.id WHERE p.id = $product_id";
            
                $result = $obj->fetch($query);
            
                if (!empty($result)) {
                    $product = $result[0];
            
                    $cat_id = $product['cat_id'];
                    $category_name = $product['category_name'];
                    $company_id = $product['company_id'];
                    $company_name = $product['company_name'];
                    $product_id = $product['id'];
                    $product_name = $product['product_name'];
                    $description = $product['description'];
                    $hsn = $product['sku'];
                    $part = $product['part'];
                    $mrp = $product['mrp'];
                    $gst = $product['gst'];
                    $stock = $product['stock'];
                    $best_seller = $product['best_seller'];
                    $b2b_price = $product['b2b_price'];
                    $b2b_discount = $product['b2b_discount'];
                    $image_1 = $product['image_1'];
                    $image_2 = $product['image_2'];
                    $image_3 = $product['image_3'];
                    $image_4 = $product['image_4'];

                    $final_price = $mrp + ($mrp * ($gst / 100));
                } else {
                    echo "Product not found!";
                    exit;
                }
            } else {
                echo "Invalid product!";
                exit;
            }
        ?>
        <!-- breadcrumb -->
        <div class="tf-breadcrumb">
            <div class="container">
                <div class="tf-breadcrumb-wrap">
                    <div class="tf-breadcrumb-list">
                        <a href="index.php" class="text text-caption-1">Home</a>
                        <i class="icon icon-arrRight"></i>
                        <a href="products-list.php?cat_id=<?= $cat_id ?>" class="text text-caption-1"><?= htmlspecialchars($category_name) ?></a>
                        <i class="icon icon-arrRight"></i>
                        <a href="products-grid.php?cat_id=<?= $cat_id ?>&company_id=<?= $company_id ?>" class="text text-caption-1"><?= htmlspecialchars($company_name) ?></a>
                        <i class="icon icon-arrRight"></i>
                        <span class="text text-caption-1"><?= htmlspecialchars($product_name) ?></span>
                    </div>
                </div>
            </div>
        </div>
        <!-- /breadcrumb -->

        <!-- Product_Main -->
        <section class="flat-spacing">
            <div class="tf-main-product section-image-zoom">
                <div class="container">
                    <div class="row">
                        <!-- Product main image with sliders -->
                        <div class="col-md-6">
                            <div class="tf-product-media-wrap sticky-top">
                                <div class="thumbs-slider">
                                    <!-- Thumbnails Slider -->
                                    <div dir="ltr" class="swiper tf-product-media-thumbs">
                                        <div class="swiper-wrapper">
                                            <?php if (!empty($image_1)): ?>
                                                <div class="swiper-slide">
                                                    <div class="item">
                                                        <img class="lazyload" data-src="../Admin/uploads/products/<?= htmlspecialchars($image_1) ?>" src="../Admin/uploads/products/<?= htmlspecialchars($image_1) ?>" alt="">
                                                    </div>
                                                </div>
                                            <?php endif; ?>
                                            <?php if (!empty($image_2)): ?>
                                                <div class="swiper-slide">
                                                    <div class="item">
                                                        <img class="lazyload" data-src="../Admin/uploads/products/<?= htmlspecialchars($image_2) ?>" src="../Admin/uploads/products/<?= htmlspecialchars($image_2) ?>" alt="">
                                                    </div>
                                                </div>
                                            <?php endif; ?>
                                            <?php if (!empty($image_3)): ?>
                                                <div class="swiper-slide">
                                                    <div class="item">
                                                        <img class="lazyload" data-src="../Admin/uploads/products/<?= htmlspecialchars($image_3) ?>" src="../Admin/uploads/products/<?= htmlspecialchars($image_3) ?>" alt="">
                                                    </div>
                                                </div>
                                            <?php endif; ?>
                                            <?php if (!empty($image_4)): ?>
                                                <div class="swiper-slide">
                                                    <div class="item">
                                                        <img class="lazyload" data-src="../Admin/uploads/products/<?= htmlspecialchars($image_4) ?>" src="../Admin/uploads/products/<?= htmlspecialchars($image_4) ?>" alt="">
                                                    </div>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <!-- Main Slider -->
                                    <div dir="ltr" class="swiper tf-product-media-main" id="gallery-swiper-started">
                                        <div class="swiper-wrapper">
                                            <?php if (!empty($image_1)): ?>
                                                <div class="swiper-slide" data-color="gray">
                                                    <a href="../Admin/uploads/products/<?= htmlspecialchars($image_1) ?>" class="item main-slider-link" data-pswp-width="600px" data-pswp-height="800px">
                                                        <img class="tf-image-zoom lazyload" data-zoom="../Admin/uploads/products/<?= htmlspecialchars($image_1) ?>" data-src="../Admin/uploads/products/<?= htmlspecialchars($image_1) ?>" src="../Admin/uploads/products/<?= htmlspecialchars($image_1) ?>" alt="">
                                                    </a>
                                                </div>
                                            <?php endif; ?>
                                            <?php if (!empty($image_2)): ?>
                                                <div class="swiper-slide" data-color="gray">
                                                    <a href="../Admin/uploads/products/<?= htmlspecialchars($image_2) ?>" class="item main-slider-link" data-pswp-width="600px" data-pswp-height="800px">
                                                        <img class="tf-image-zoom lazyload" data-zoom="../Admin/uploads/products/<?= htmlspecialchars($image_2) ?>" data-src="../Admin/uploads/products/<?= htmlspecialchars($image_2) ?>" src="../Admin/uploads/products/<?= htmlspecialchars($image_2) ?>" alt="">
                                                    </a>
                                                </div>
                                            <?php endif; ?>
                                            <?php if (!empty($image_3)): ?>
                                                <div class="swiper-slide" data-color="gray">
                                                    <a href="../Admin/uploads/products/<?= htmlspecialchars($image_3) ?>" class="item main-slider-link" data-pswp-width="600px" data-pswp-height="800px">
                                                        <img class="tf-image-zoom lazyload" data-zoom="../Admin/uploads/products/<?= htmlspecialchars($image_3) ?>" data-src="../Admin/uploads/products/<?= htmlspecialchars($image_3) ?>" src="../Admin/uploads/products/<?= htmlspecialchars($image_3) ?>" alt="">
                                                    </a>
                                                </div>
                                            <?php endif; ?>
                                            <?php if (!empty($image_4)): ?>
                                                <div class="swiper-slide" data-color="gray">
                                                    <a href="../Admin/uploads/products/<?= htmlspecialchars($image_4) ?>" class="item main-slider-link" data-pswp-width="600px" data-pswp-height="800px">
                                                        <img class="tf-image-zoom lazyload" data-zoom="../Admin/uploads/products/<?= htmlspecialchars($image_4) ?>" data-src="../Admin/uploads/products/<?= htmlspecialchars($image_4) ?>" src="../Admin/uploads/products/<?= htmlspecialchars($image_4) ?>" alt="">
                                                    </a>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>  
                            </div>
                        </div>
                        <!-- /Product main image with sliders -->
                        <!-- product-info-list -->
                        <div class="col-md-6">
                            <div class="tf-product-info-wrap position-relative">
                                <div class="tf-zoom-main"></div>
                                <div class="tf-product-info-list other-image-zoom">
                                    <div class="tf-product-info-heading">
                                        <div class="tf-product-info-name">
                                            <div class="text text-btn-uppercase"><?= htmlspecialchars($category_name) ?></div>
                                            <h3 class="name"><?= htmlspecialchars($product_name) ?></h3>
                                            <?php if($best_seller == 'yes') { ?>
                                            <span class="badge border border-info text-info fw-bold px-3 py-2 rounded-pill mb-3 me-1"><i class="bi bi-star-fill me-1"></i> Best Seller</span>
                                            <?php } ?>
                                            <div class="sub">
                                                <div class="tf-product-info-rate">
                                                    <?php
                                                    $sql = "SELECT AVG(rating) AS avg_rating, COUNT(*) AS total_reviews FROM product_reviews WHERE product_id = $product_id";
                                                    $result = $obj->fetch($sql);

                                                    $avg_rating = isset($result[0]['avg_rating']) ? round($result[0]['avg_rating'], 1) : 0;
                                                    $total_reviews = isset($result[0]['total_reviews']) ? $result[0]['total_reviews'] : 0;
                                                    ?>
                                                    <div class="list-star">
                                                        <?php
                                                        $full_stars = floor($avg_rating);
                                                        $half_star = ($avg_rating - $full_stars) >= 0.5 ? true : false;
                                                        for ($i = 1; $i <= 5; $i++) {
                                                            if ($i <= $full_stars) {
                                                                echo '<i class="fas fa-star icon"></i>'; 
                                                            } elseif ($half_star) {
                                                                echo '<i class="fas fa-star-half icon"></i>'; 
                                                                $half_star = false;
                                                            } else {
                                                                echo '<i class="icon icon-star-empty"></i>'; 
                                                            }
                                                        }
                                                        ?>
                                                    </div>
                                                    <div class="text text-caption-1">(<?php echo $total_reviews; ?> reviews)</div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tf-product-info-desc">
                                            <div class="tf-product-info-price">
                                                <h5 class="price-on-sale font-2">₹<span id="base-price"><?= htmlspecialchars($b2b_price) ?></span></h5>
                                                <div class="compare-at-price font-2"><?= htmlspecialchars($final_price) ?></div>
                                                <?php if($b2b_discount != 0) { ?>
                                                <div class="badges-on-sale text-btn-uppercase">-<?= htmlspecialchars($b2b_discount) ?>%</div>
                                                <?php } ?>
                                            </div>
                                            <p><?= htmlspecialchars($description) ?></p>
                                        </div>
                                    </div>
                                    <div class="tf-product-info-choose-option">
                                        <div class="tf-product-info-quantity">
                                            <div class="title mb_12">Quantity:</div>
                                            <div class="wg-quantity">
                                                <span class="btn-quantity btn_decrease">-</span>
                                                <input class="quantity-product" type="text" id="qnty" name="number" value="1">
                                                <span class="btn-quantity btn_increase">+</span>
                                            </div>
                                        </div>
                                        <div>
                                            <div class="tf-product-info-by-btn mb_10">
                                                <button type="button" class="btn-style-2 flex-grow-1 text-btn-uppercase fw-6 add-to-cart border-0" data-product-id="<?= $product_id ?>" data-price="<?= $b2b_price ?>">
                                                    <span>Add to cart -&nbsp;</span>
                                                    <span class="total_price">₹<span class="total_amount"><?= htmlspecialchars($b2b_price) ?></span></span>
                                                </button>
                                                <a href="compare.php?product_id=<?= $product_id ?>" class="box-icon hover-tooltip compare btn-icon-action">
                                                    <span class="icon icon-gitDiff"></span>
                                                    <span class="tooltip text-caption-2">Compare</span>
                                                </a>
                                                <button type="button" class="btn btn-outline-dark box-icon hover-tooltip wishlist btn-icon-action p-3" data-product-id="<?= $product_id ?>" data-price="<?= $product['b2b_price'] ?>">
                                                    <span class="icon icon-heart"></span>
                                                    <span class="tooltip text-caption-2">Wishlist</span>
                                                </button>
                                            </div>
                                            <button type="button" class="btn-style-3 text-btn-uppercase border-0" id="buy_now_btn" style="width: 100%; color: white;">
                                                <span>Buy Now -&nbsp;</span>
                                                <span class="total_price">₹<span  id="total_price" class="total_amount"><?= htmlspecialchars($b2b_price) ?></span></span>
                                            </button>
                                        </div>
                                        <div class="tf-product-info-help">
                                            <div class="tf-product-info-extra-link">
                                                <a href="#delivery_return" data-bs-toggle="modal" class="tf-product-extra-icon">
                                                    <div class="icon"><i class="icon-shipping"></i></div>
                                                    <p class="text-caption-1">Shipping Policy</p>
                                                </a>
                                                <a href="#share_social" data-bs-toggle="modal" class="tf-product-extra-icon">
                                                    <div class="icon"><i class="icon-share"></i></div>
                                                    <p class="text-caption-1">Share</p>
                                                </a>
                                            </div>
                                            <div class="tf-product-info-time">
                                                <div class="icon"><i class="icon-timer"></i></div>
                                                <p class="text-caption-1">Estimated Delivery:&nbsp;&nbsp;<span>3-6 days</span> (India)</p>
                                            </div>
                                            <div class="tf-product-info-return">
                                                <div class="icon"><i class="icon-arrowClockwise"></i></div>
                                                <p class="text-caption-1">Return within <span>4 days</span> after delivery. Duties & taxes are non-refundable.</p>
                                            </div>
                                        </div>
                                        <ul class="tf-product-info-sku">
                                            <li>
                                                <p class="text-caption-1">HSN:</p>
                                                <p class="text-caption-1 text-1"><?= htmlspecialchars($hsn) ?></p>
                                            </li>
                                            <li>
                                                <p class="text-caption-1">Part No.:</p>
                                                <p class="text-caption-1 text-1"><?= htmlspecialchars($part) ?></p>
                                            </li>
                                            <li>
                                                <p class="text-caption-1">Company:</p>
                                                <p class="text-caption-1"><a href="products-grid.php?cat_id=<?= $cat_id ?>&company_id=<?= $company_id ?>" class="text-1 link"><?= htmlspecialchars($company_name) ?></a></p>
                                            </li>
                                            <li>
                                                <p class="text-caption-1">Availability:</p>
                                                <p class="text-caption-1 text-1">
                                                    <?= ($stock > 5) ? '<span style="color: green;">In Stock</span>' : '<span style="color: red;">Only 2 left</span>'; ?>
                                                </p>
                                            </li>
                                            <li>
                                                <p class="text-caption-1">Category:</p>
                                                <p class="text-caption-1"><a href="products-grid.php?cat_id=<?= $cat_id ?>&company_id=<?= $company_id ?>" class="text-1 link"><?= htmlspecialchars($category_name) ?></a></p>
                                            </li>
                                        </ul>
                                        <div class="tf-product-info-guranteed">
                                            <div class="text-title">
                                                Guranteed safe checkout:
                                            </div>
                                            <div class="tf-payment">
                                                <a href="javascript:void(0);"><img src="images/payment/img-1.png" alt=""></a>
                                                <a href="javascript:void(0);"><img src="images/payment/img-2.png" alt=""></a>
                                                <a href="javascript:void(0);"><img src="images/payment/img-3.png" alt=""></a>
                                                <a href="javascript:void(0);"><img src="images/payment/img-4.png" alt=""></a>
                                                <a href="javascript:void(0);"><img src="images/payment/img-5.png" alt=""></a>
                                                <a href="javascript:void(0);"><img src="images/payment/img-6.png" alt=""></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /product-info-list -->
                    </div>
                </div>
            </div>
        </section>
        <!-- /Product_Main -->

        <!-- Product_Description_Tabs -->
        <section>
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="widget-tabs style-1">
                            <ul class="widget-menu-tab">
                                <li class="item-title active"><span class="inner">Description</span></li>
                                <li class="item-title"><span class="inner">Customer Reviews</span></li>
                                <li class="item-title"><span class="inner">Shipping & Returns</span></li>
                                <li class="item-title"><span class="inner">Return Policies</span></li>
                            </ul>
                            <div class="widget-content-tab">
                                <!-- description -->
                                <div class="widget-content-inner active">
                                    <div class="tab-description">
                                        <div class="right">
                                            <div class="letter-1 text-btn-uppercase mb_12"><?= htmlspecialchars($product_name) ?></div>
                                            <p class="text-secondary"><?= htmlspecialchars($description) ?></p>
                                        </div>
                                    </div>
                                </div>
                                <!-- review -->
                                <div class="widget-content-inner">
                                    <div class="tab-reviews write-cancel-review-wrap">
                                        <div class="tab-reviews-heading">
                                            <?php
                                            $ratings_count = array_fill(1, 5, 0); 
                                            $sql = "SELECT rating, COUNT(*) as count FROM product_reviews WHERE product_id = $product_id GROUP BY rating";
                                            $ratings_data = $obj->fetch($sql);
                                            foreach ($ratings_data as $row) {
                                                $ratings_count[$row['rating']] = $row['count'];
                                            }
                                            $total_ratings = array_sum($ratings_count);
                                            $ratings_percentage = [];
                                            foreach ($ratings_count as $star => $count) {
                                                $ratings_percentage[$star] = ($total_ratings > 0) ? ($count / $total_ratings) * 100 : 0;
                                            }
                                            ?>
                                            <div class="top">
                                                <div class="text-center">
                                                    <div class="number title-display"><?php echo $avg_rating ? $avg_rating : '0.0'; ?></div>
                                                    <div class="list-star">
                                                        <?php
                                                        $full_stars = floor($avg_rating);
                                                        $half_star = ($avg_rating - $full_stars) >= 0.5 ? true : false;
                                                        for ($i = 1; $i <= 5; $i++) {
                                                            if ($i <= $full_stars) {
                                                                echo '<i class="fas fa-star"></i>'; 
                                                            } elseif ($half_star) {
                                                                echo '<i class="fas fa-star-half"></i>'; 
                                                                $half_star = false;
                                                            } else {
                                                                echo '<i class="icon icon-star-empty"></i>'; 
                                                            }
                                                        }
                                                        ?>
                                                    </div>
                                                    <p>(<?php echo $total_reviews; ?> Ratings)</p>
                                                </div>
                                                <div class="rating-score">
                                                    <?php for ($i = 5; $i >= 1; $i--) { ?>
                                                        <div class="item">
                                                            <div class="number-1 text-caption-1"><?php echo $i; ?></div>
                                                            <i class="icon icon-star"></i>
                                                            <div class="line-bg">
                                                                <div style="width: <?php echo $ratings_percentage[$i]; ?>%;"></div>
                                                            </div>
                                                            <div class="number-2 text-caption-1"><?php echo $ratings_count[$i]; ?></div>
                                                        </div>
                                                    <?php } ?>
                                                </div>
                                            </div>
                                            <div>
                                                <div class="btn-style-4 text-btn-uppercase letter-1 btn-comment-review btn-cancel-review">Cancel review</div>
                                                <div class="btn-style-4 text-btn-uppercase letter-1 btn-comment-review btn-write-review">Write a review</div>
                                            </div>
                                        </div>
                                        <div class="reply-comment style-1 cancel-review-wrap">
                                            <div class="d-flex mb_24 gap-20 align-items-center justify-content-between flex-wrap">
                                                <h4><?php echo $total_reviews; ?> Comments</h4>
                                            </div>
                                            <?php 
                                            $sql = "SELECT * FROM product_reviews WHERE product_id = $product_id";
                                            $reviews = $obj->fetch($sql);
                                            foreach($reviews as $review){
                                            ?>
                                            <div class="reply-comment-wrap mb-5">
                                                <div class="reply-comment-item">
                                                    <div class="user">
                                                        <div class="d-flex justify-content-between" style="width: 100%;">
                                                            <h6><a href="javascript:void(0);" class="link"><?php echo $review['name']; ?></a></h6>
                                                            <div class="day text-secondary-2 text-caption-1"><?php echo $review['created_at']; ?></div>
                                                        </div>
                                                    </div>
                                                    <p class="text-secondary"><?php echo $review['review']; ?></p>
                                                </div>
                                            </div>
                                            <?php } ?>
                                        </div>  
                                        <!-- review form -->
                                        <form class="form-write-review write-review-wrap" id="form_review">
                                            <div class="heading">
                                                <h4>Write a review:</h4>
                                                <div class="list-rating-check">
                                                    <input type="radio" id="star5" name="rate" value="5">
                                                    <label for="star5" title="star"></label>
                                                    <input type="radio" id="star4" name="rate" value="4">
                                                    <label for="star4" title="star"></label>
                                                    <input type="radio" id="star3" name="rate" value="3">
                                                    <label for="star3" title="star"></label>
                                                    <input type="radio" id="star2" name="rate" value="2">
                                                    <label for="star2" title="star"></label>
                                                    <input type="radio" id="star1" name="rate" value="1">
                                                    <label for="star1" title="star"></label>
                                                </div>
                                            </div>
                                            <div class="mb_32">
                                                <div class="row g-4">
                                                    <div class="col-lg-12 d-flex flex-column align-items-start">
                                                        <label for="name" class="mb-2">Your Name *</label>
                                                        <input type="text" name="name" id="name" placeholder="Enter Your Name" required>
                                                    </div>
                                                    <div class="col-lg-12 d-flex flex-column align-items-start">
                                                        <label for="review" class="mb-2">Your Review *</label>
                                                        <textarea name="review" id="review" placeholder="Write your review here" rows="10" required></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                            <input type="hidden" name="product_id" id="product_id" value="<?= $product_id ?>">
                                            <div class="button_submit">
                                                <button class="text-btn-uppercase" type="submit">Submit Review</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <!-- shipping -->
                                <div class="widget-content-inner">
                                    <div class="tab-shipping">
                                        <?php 
                                        $shipSql = "SELECT * FROM ship LIMIT 3";
                                        $ships = $obj->fetch($shipSql);
                                        foreach ($ships as $ship) { ?>
                                        <div class="w-100">
                                            <div class="text-btn-uppercase mb_12"><?= htmlspecialchars($ship['title']) ?></div>
                                            <p><?= htmlspecialchars($ship['des']) ?></p>
                                        </div>
                                        <?php } ?>
                                        <div class="w-100">
                                            <div class="text-btn-uppercase mb_12">Read full shipping details :</div>
                                            <div><a href="shipping_policy.php" class="link text-secondary text-decoration-underline mb-5 font-2">Shipping Policy</a></div>

                                            <div class="text-btn-uppercase mb_12">Need more information?</div>
                                            <div><a href="privacy_policy.php" class="link text-secondary text-decoration-underline mb_6 font-2">Privacy Policy</a></div>
                                            <div><a href="returnpolicy.php" class="link text-secondary text-decoration-underline mb_6 font-2">Return & Refund</a></div>
                                            <div><a href="terms.php" class="link text-secondary text-decoration-underline font-2">Terms & Conditions</a></div>
                                        </div>
                                    </div>
                                </div>
                                <!-- return -->
                                <div class="widget-content-inner">
                                    <div class="tab-policies">
                                        <?php 
                                        $returnSql = "SELECT * FROM return_policy LIMIT 3";
                                        $returns = $obj->fetch($returnSql);
                                        foreach ($returns as $return) { ?>
                                        <div class="text-btn-uppercase mb_6"><?= htmlspecialchars($return['title']) ?></div>
                                        <p class="mb_12 text-secondary"><?= htmlspecialchars($return['des']) ?></p>
                                        <?php } ?>
                                        <div class="text-btn-uppercase my-4">Read full Return Policy : <a href="returnpolicy.php" class="link text-secondary text-decoration-underline font-2">Return & Refund</a></div>
                                        <p class="text-btn-upppercase font-2">For any questions or concerns regarding returns, don't hesitate to reach out to our dedicated customer service team. Your satisfaction is our priority.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- /Product_Description_Tabs -->

        
        <!-- /footer -->
        <?php include 'footer.php'; ?>
        <!-- /footer -->
        
    </div>
    <!-- /wrapper -->

    <!-- search -->
    <?php include 'search.php'; ?>
    <?php include 'general_search.php'; ?>
    <!-- /search -->

    <!-- modal shipping -->
    <div class="modal modalCentered fade tf-product-modal modal-part-content" id="delivery_return">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="header">
                    <div class="demo-title">Shipping Policy</div>
                    <span class="icon-close icon-close-popup" data-bs-dismiss="modal"></span>
                </div>
                <div class="overflow-y-auto">
                    <?php 
                    $policyQuery = "SELECT * FROM ship";
                    $policies = $obj->fetch($policyQuery);
                    foreach ($policies as $policy) { ?>
                    <div class="tf-product-popup-delivery">
                        <div class="title"><?= htmlspecialchars($policy['title']) ?></div>
                        <p class="text-paragraph"><?= htmlspecialchars($policy['des']) ?></p>
                    </div>
                    <?php } ?>
                    <div class="tf-product-popup-delivery">
                        <div class="title">Helpline</div>
                        <p class="text-paragraph">Give us a shout if you have any other questions and/or concerns.</p>
                        <?php 
                        $infoSql = "SELECT * FROM contact LIMIT 1";
                        $infos = $obj->fetch($infoSql); 
                        foreach ($infos as $info) { 
                        ?>
                        <p class="text-paragraph">Email: <a href="mailto:<?= htmlspecialchars($info['email']) ?>"><span class="__cf_email__"><?= htmlspecialchars($info['email']) ?></span></a></p>
                        <p class="text-paragraph mb-0">Phone: <a href="tel:<?= htmlspecialchars($info['helpline']) ?>">+91 <?= htmlspecialchars($info['helpline']) ?></a></p>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /modal shipping -->

    <!-- modal share social -->
    <div class="modal modalCentered fade tf-product-modal modal-part-content" id="share_social">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="header">
                    <div><h5 class="fw-semibold">Share :</h5></div>
                    <span class="icon-close icon-close-popup" data-bs-dismiss="modal"></span>
                </div>
                <div class="overflow-y-auto">
                    <?php
                    $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
                    $current_url = $protocol . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
                    ?>
                    <ul class="tf-social-icon d-flex gap-10">
                        <li><a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo urlencode($current_url); ?>" class="box-icon social-facebook bg_line" target="_blank"><i class="icon icon-fb"></i></a></li>
                        <li><a href="https://twitter.com/intent/tweet?url=<?php echo urlencode($current_url); ?>" class="box-icon social-twiter bg_line" target="_blank"><i class="icon icon-x"></i></a></li>
                        <li><a href="https://wa.me/?text=<?php echo urlencode($current_url); ?>" class="box-icon social-whatsapp bg_line" target="_blank"><i class="icon icon-whatsapp"></i></a></li>
                    </ul>
                    <form class="form-share" method="post" accept-charset="utf-8">
                        <fieldset>
                            <input type="text" id="shareUrl" value="" tabindex="0" aria-required="true" readonly>
                        </fieldset>
                        <div class="button-submit">
                            <button id="copyButton" class="tf-btn radius-4 btn-fill" type="button"><span class="text">Copy</span></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- /modal share social -->
    

    <!-- Javascript -->
    <script type="text/javascript" src="js/bootstrap.min.js"></script>
    <script type="text/javascript" src="js/jquery.min.js"></script>
    <script type="text/javascript" src="js/bootstrap-select.min.js"></script>
    <script type="text/javascript" src="js/lazysize.min.js"></script>
    <script type="text/javascript" src="js/wow.min.js"></script>
    <script type="text/javascript" src="js/drift.min.js"></script>
    <script type="text/javascript" src="js/count-down.js"></script>
    <script type="text/javascript" src="js/swiper-bundle.min.js"></script>
    <script type="text/javascript" src="js/carousel.js"></script>
    <script type="text/javascript" src="js/multiple-modal.js"></script>
    <script type="text/javascript" src="js/main.js"></script>
    <script type="module" src="js/model-viewer.min.js"></script>
    <script type="module" src="js/zoom.js"></script>
    <!-- add to cart ajax -->
    <script type="text/javascript" src="js/addToCart.js"></script>
    <!-- add to wishlist ajax -->
    <script type="text/javascript" src="js/addToWishlist.js"></script>

    <!-- All necessary scripts are here -->
    <script>
        // script to dynamically calculate total price 
        document.addEventListener("DOMContentLoaded", function () {
            const basePrice = parseFloat(document.getElementById("base-price").textContent);
            const quantityInput = document.getElementById("qnty");
            const totalPriceElements = document.querySelectorAll(".total_amount"); 

            document.querySelector(".btn_increase").addEventListener("click", function () {
                let quantity = parseInt(quantityInput.value);
                quantity++;
                quantityInput.value = quantity;
                updateTotalPrice(quantity);
            });
            document.querySelector(".btn_decrease").addEventListener("click", function () {
                let quantity = parseInt(quantityInput.value);
                if (quantity > 1) {
                    quantity--;
                    quantityInput.value = quantity;
                    updateTotalPrice(quantity);
                }
            });
            function updateTotalPrice(quantity) {
                const totalPrice = basePrice * quantity;
                totalPriceElements.forEach(element => {
                    element.textContent = totalPrice.toFixed(2); 
                });
            }
        });

        // script for checkout otherwise login
        document.addEventListener("DOMContentLoaded", function () {
            const buyNowBtn = document.getElementById("buy_now_btn");
            const basePrice = parseFloat(document.getElementById("total_price").textContent);
            const quantityInput = document.getElementById("qnty"); 
            const userId = "<?= isset($_SESSION['b2b_user_id']) ? $_SESSION['b2b_user_id'] : 0 ?>"; 

            buyNowBtn.addEventListener("click", function () {
                const quantity = quantityInput ? parseInt(quantityInput.value) : 1; 
                const totalPrice = basePrice * quantity;
                const productId = "<?= $product['id'] ?>";
                const productName = "<?= addslashes($product['product_name']) ?>";
                const productImage = "<?= $product['image_1'] ?>";
                const hsn = "<?= $product['sku'] ?>";
                const part = "<?= $product['part'] ?>";

                if (userId === "0" || userId === "null") {
                    window.location.href = "login_B_to_B.php";
                } else {
                    window.location.href = `single_checkout.php?product_id=${productId}&name=${encodeURIComponent(productName)}&image=${encodeURIComponent(productImage)}&price=${basePrice}&quantity=${quantity}&totalprice=${totalPrice}&hsn=${hsn}&sku=${part}`;
                }
            });
        });

        // review form ajax
        $(document).ready(function() {
            $("#form_review").submit(function(e) {
                e.preventDefault(); 
                var formData = $(this).serialize(); 
                $.ajax({
                    url: "user_review.php",
                    type: "POST",
                    data: formData,
                    dataType: "json",
                    success: function(response) {
                        if (response.status == "success") {
                            Toastify({
                                text: response.message,
                                duration: 3000,
                                gravity: "top",
                                position: "center",
                                backgroundColor: "green",
                            }).showToast();
                            setTimeout(function() {
                                window.location.href = "product-detail.php?product_id=<?= base64_encode($product_id) ?>";
                            }, 2000);
                        } else {
                            Toastify({
                                text: response.message,
                                duration: 3000,
                                gravity: "top",
                                position: "center",
                                backgroundColor: "red",
                            }).showToast();
                        }
                    },
                    error: function() {
                        Toastify({
                            text: "Something went wrong! Please try again.",
                            duration: 3000,
                            gravity: "top",
                            position: "center",
                            backgroundColor: "red",
                        }).showToast();
                    }
                });
            });
        });

        // Image slider
        var galleryThumbs = new Swiper('.tf-product-media-thumbs', {
            spaceBetween: 10,
            slidesPerView: 4,
            freeMode: true,
            watchSlidesVisibility: true,
            watchSlidesProgress: true,
        });
        var galleryMain = new Swiper('#gallery-swiper-started', {
            spaceBetween: 10,
            effect: 'fade',
            autoplay: {
                delay: 4000, 
                disableOnInteraction: false,
            },
            thumbs: {
                swiper: galleryThumbs,
            },
        });

        // magnifier and fancybox
        document.addEventListener("DOMContentLoaded", function() {
            // magnifier
            if (window.innerWidth >= 1024) {
                const mainSliderImages = document.querySelectorAll('.tf-product-media-main .swiper-slide img');
                mainSliderImages.forEach(function(img) {
                    let lens; 
                    const zoomLevel = 2;
                    const lensWidth = 250; 
                    const lensHeight = 300; 
                    const lensHalfWidth = lensWidth / 2;
                    const lensHalfHeight = lensHeight / 2;
                    
                    img.addEventListener('mouseenter', function(e) {
                        lens = document.createElement('div');
                        lens.classList.add('magnifier-lens');
                        lens.style.position = 'absolute';
                        lens.style.border = '1px solid #333';
                        lens.style.width = lensWidth + 'px';
                        lens.style.height = lensHeight + 'px';
                        lens.style.pointerEvents = 'none'; 
                        lens.style.overflow = 'hidden';
                        lens.style.zIndex = '1000'; 
                        lens.style.backgroundImage = `url(${img.src})`;
                        lens.style.backgroundColor = 'rgba(128, 128, 128, 0.2)';
                        lens.style.backgroundBlendMode = 'multiply';
                        const rect = img.getBoundingClientRect();
                        const bgWidth = rect.width * zoomLevel;
                        const bgHeight = rect.height * zoomLevel;
                        lens.style.backgroundSize = `${bgWidth}px ${bgHeight}px`;
                        let parent = img.parentElement;
                        if (window.getComputedStyle(parent).position === "static") {
                            parent.style.position = "relative";
                        }
                        parent.appendChild(lens);
                    });
                    img.addEventListener('mousemove', function(e) {
                        if (!lens) return;
                        const rect = img.getBoundingClientRect();
                        let x = e.clientX - rect.left;
                        let y = e.clientY - rect.top;
                        if (x < lensHalfWidth) x = lensHalfWidth;
                        if (x > rect.width - lensHalfWidth) x = rect.width - lensHalfWidth;
                        if (y < lensHalfHeight) y = lensHalfHeight;
                        if (y > rect.height - lensHalfHeight) y = rect.height - lensHalfHeight;
                        gsap.to(lens, { duration: 0.1, left: (x - lensHalfWidth) + "px", top: (y - lensHalfHeight) + "px", ease: "power2.out" });
                        let bgX = -(x * zoomLevel - lensHalfWidth);
                        let bgY = -(y * zoomLevel - lensHalfHeight);
                        gsap.to(lens, { duration: 0.1, backgroundPosition: `${bgX}px ${bgY}px`, ease: "power2.out" });
                    });
                    img.addEventListener('mouseleave', function() {
                        if (lens && lens.parentElement) {
                            lens.parentElement.removeChild(lens);
                            lens = null;
                        }
                    });
                });
            }
            // fancybox
            if (window.innerWidth < 1024) {
                document.querySelectorAll(".main-slider-link").forEach(function(link) {
                  link.setAttribute("data-fancybox", "gallery");
                });
                Fancybox.bind("[data-fancybox='gallery']", {
                  Toolbar: false,     
                  closeButton: "top", 
                });
            }
        });

        // modal share script
        document.addEventListener("DOMContentLoaded", function() {
            var shareUrlInput = document.getElementById("shareUrl");
            shareUrlInput.value = window.location.href;
            var copyButton = document.getElementById("copyButton");
            copyButton.addEventListener("click", function() {
                var urlToCopy = shareUrlInput.value;
                if (navigator.clipboard && window.isSecureContext) {
                navigator.clipboard.writeText(urlToCopy).then(function() {
                    Toastify({
                        text: "URL copied to clipboard",
                        duration: 1500,
                        gravity: "top",
                        position: "center",
                        backgroundColor: "#28a745"
                    }).showToast();
                }).catch(function(err) {
                    Toastify({
                        text: "Error copying URL",
                        duration: 1500,
                        gravity: "top",
                        position: "center",
                        backgroundColor: "#dc3545"
                    }).showToast();
                });
                } else {
                    shareUrlInput.select();
                    try {
                        var successful = document.execCommand('copy');
                        if (successful) {
                            Toastify({
                                text: "URL copied to clipboard",
                                duration: 1500,
                                gravity: "top",
                                position: "center",
                                backgroundColor: "#28a745"
                            }).showToast();
                        } else {
                            Toastify({
                                text: "Error copying URL",
                                duration: 1500,
                                gravity: "top",
                                position: "center",
                                backgroundColor: "#dc3545"
                            }).showToast();
                        }
                    } catch (err) {
                        Toastify({
                            text: "Error copying URL",
                            duration: 1500,
                            gravity: "top",
                            position: "center",
                            backgroundColor: "#dc3545"
                        }).showToast();
                    }
                }
            });
        });
    </script>

</body>
</html>