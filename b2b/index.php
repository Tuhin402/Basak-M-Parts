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

        <?php include 'header.php'; ?>

        <section class="flat-spacing-4 pt-0">
            <div class="container">
                <div class="row row1">
                    <div class="heading-section text-center mt-5" style="margin-bottom: 20px;"> 
                        <h3 class="heading">Categories</h3>
                    </div>
                    <?php
                        $query = "SELECT DISTINCT pc.id, pc.category, pc.image FROM product_category pc JOIN category_company cc ON pc.id = cc.cat_id";
                        $categories = $obj->fetch($query);
                        foreach ($categories as $category){
                    ?>
                    <div class="col-6 col-sm-6 col-md-3 col-lg-2">
                        <div class="card border-0 shadow-sm rounded-3 overflow-hidden mb-3" style="background: #fff;">
                            <a href="company.php?cat_id=<?= $category['id'] ?>" class="product-img">
                                <div class="ratio ratio-1x1">
                                    <img class="lazyload img-fluid" data-src="../Admin/uploads/category/<?= $category['image'] ?>" 
                                        src="../Admin/uploads/category/<?= $category['image'] ?>" 
                                        alt="<?= htmlspecialchars($category['category']) ?>"
                                        style="object-fit: contain; width: 100%; height: 100%;">
                                </div>
                            </a>
                            <div class="card-body text-center p-3">
                                <a href="company.php?cat_id=<?= $category['id'] ?>" class="text-decoration-none fw-bold d-block" style="color: #00529F;">
                                    -<?= htmlspecialchars($category['category']) ?>-
                                </a>
                            </div>
                        </div>
                    </div>
                    <?php } ?>
                </div>
            </div>
        </section>

        <!-- popular categories -->
        <?php include 'all_products_section.php'; ?>
        <!-- /popular categories -->

        <!-- What's New Today -->
        <section class="flat-spacing-4 pt-0">
            <div class="container">
                <div class="heading-section-2 wow fadeInUp">
                    <h3>What's New Today</h3>
                    <a href="products-all.php" class="line-under">See All Products</a>
                </div>
                <section class="flat-spacing pt-0">
                    <div class="container">
                        <div class="swiper tf-sw-collection" data-preview="4" data-tablet="3" data-mobile-sm="1" data-mobile="1" data-space-lg="30" data-space-md="30" data-space="15" data-pagination="1" data-pagination-md="1" data-pagination-lg="1">
                            <div class="swiper-wrapper">
                                <?php 
                                $cnt = 0;
                                $dealQuery = "SELECT * FROM popular_picks_b2b";
                                $deals = $obj->fetch($dealQuery);
                                foreach ($deals as $deal){ 
                                    $cnt++;
                                ?>
                                <div class="swiper-slide ss" style="border-radius: 30px;">
                                    <div class="card d-flex flex-column border-0 shadow-sm rounded-3 overflow-hidden">
                                        <div class="card-body p-3" style="flex: 0 0 auto;">
                                            <h5 class="card-title text-start mb-3">
                                                <a href="<?= $deal['link'] ?>" class="link"><?= $deal['title'] ?></a>
                                            </h5>
                                        </div>
                                        <div style="flex: 1 1 auto;">
                                            <a href="<?= $deal['link'] ?>">
                                                <img src="../Admin/uploads/popular/<?= $deal['image'] ?>" 
                                                    alt="banner-cls" style="width: 100%; height: auto; object-fit: contain;">
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <?php } ?>
                            </div>
                            <div class="sw-pagination-collection sw-dots type-circle justify-content-center"></div>
                        </div>
                    </div>
                </section>
            </div>
        </section>
        <!-- /Today's Popular Picks -->

        <!-- how to buy section -->
        <section class="flat-spacing-4 pt-0">
            <div class="container">
                <div class="text-center mb-4">
                    <h3 class="fw-bold">How to Purchase From Us</h3>
                    <p class="text-muted">Watch our quick guides</p>
                </div>
                <div class="swiper yt-swiper swiper tf-sw-collection" data-preview="3" data-tablet="2" data-mobile-sm="1" data-mobile="1" data-space-lg="30" data-space-md="30" data-space="15" data-pagination="1" data-pagination-md="1" data-pagination-lg="1">
                    <div class="swiper-wrapper text-center">
                        <?php 
                        $videoQuery = "SELECT * FROM videos";
                        $videos = $obj->fetch($videoQuery);
                        foreach ($videos as $video) { 
                        ?>
                        <div class="swiper-slide" style="margin: auto; display: flex; justify-content: center; width: fit-content;">
                            <div class="video-container position-relative" style="width: 300px; height: 180px;">
                                <img src="../Admin/uploads/videos/<?= $video['image'] ?>" class="img-fluid rounded video-thumbnail" alt="Video Thumbnail" data-video="<?= $video['link'] ?>" onclick="playVideo(this)" style="width: 100%; height: 100%; object-fit: cover;">
                                <div class="play-button position-absolute top-50 start-50 translate-middle" data-video="<?= $video['link'] ?>" onclick="playVideo(this)">
                                    <div class="bg-danger rounded d-flex align-items-center justify-content-center" style="width: 60px; height: 45px; cursor: pointer;">
                                        <i class="bi bi-play-fill text-white" style="font-size: 1.4rem; margin-left: 4px;"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php } ?>
                    </div>
                    <div class="sw-pagination-collection sw-dots type-circle justify-content-center"></div>
                </div>
            </div>
        </section>
        <!-- /how to buy section -->
        
        <!-- certificates -->
        <section id="certificatesSection" class="flat-spacing-5 line-top">
            <div class="container">
                <h2 class="section-title mb-5">Certificates</h2>
                <div dir="ltr" class="swiper tf-sw-partner sw-auto" data-preview="auto" data-tablet="auto" data-mobile-sm="auto" data-mobile="auto" data-space-lg="74" data-space-md="50" data-space="50" data-loop="true" data-auto-play="true" data-delay="0">
                    <div class="swiper-wrapper">
                        <?php 
                        $certificateQuery = "SELECT * FROM certificates";
                        $certificates = $obj->fetch($certificateQuery);
                        foreach ($certificates as $certificate){ 
                        ?>
                        <div class="swiper-slide">
                            <a href="../Admin/uploads/certificate/<?= $certificate['image'] ?>" data-fancybox="gallery" class="brand-item zoomable" style="height: 300px; width: 200px;">
                                <img src="../Admin/uploads/certificate/<?= $certificate['image'] ?>" class="brand-item certificate-img" alt="brand" style="height: 100%; width: 100%; object-fit: cover;">
                            </a>
                        </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </section>
        <!-- /certificates -->

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

    <script>
        // Initialize Fancybox
        document.addEventListener("DOMContentLoaded", function() {
            Fancybox.bind("[data-fancybox='gallery']", {
                Toolbar: true,
                Thumbs: true
            });
        });

        // play vdo function
        function playVideo(element) {
            let videoUrl = element.getAttribute("data-video");
            Fancybox.show([
                {
                    src: videoUrl,
                    type: "iframe",
                },
            ]);
        }
    </script>
</body>
</html>