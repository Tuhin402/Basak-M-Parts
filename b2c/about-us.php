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

        <?php include 'header.php'; ?>

        <!-- page-title -->
        <?php 
        $imageQuery = "SELECT * FROM banner LIMIT 1";
        $bans = $obj->fetch($imageQuery);
        foreach ($bans as $ban){ 
        ?>
        <div class="page-title" style="background-image: url('../Admin/uploads/banner/<?= htmlspecialchars($ban['b2c_image']) ?>');">
            <div class="container">
                <h3 class="heading text-center">About Our Store</h3>
                <ul class="breadcrumbs d-flex align-items-center justify-content-center">
                    <li><a class="link" href="index.php">Home</a></li>
                    <li><i class="icon-arrRight"></i></li>
                    <li>About Our Store</li>
                </ul>
            </div>
        </div>
        <?php } ?>
        <!-- /page-title -->

        <!-- about-us -->
        <section class="flat-spacing about-us-main pb_0">
            <div class="container rw1">
                <div class="row">
                    <div class="col-md-6">
                        <?php 
                        $bannerQuery = "SELECT * FROM about_bnr LIMIT 1";
                        $banners = $obj->fetch($bannerQuery);
                        foreach ($banners as $banner){ 
                        ?>
                        <div class="about-us-features wow fadeInLeft">
                            <img class="lazyload img-fluid" data-src="../Admin/uploads/about/<?= $banner['image'] ?>" src="../Admin/uploads/about/<?= $banner['image'] ?>" alt="image-team">
                        </div>
                        <?php } ?>
                    </div>
                    <div class="col-md-6">
                        <div class="about-us-content">
                            <?php foreach ($banners as $banner){ ?>
                            <h3 class="title wow fadeInUp"><?= htmlspecialchars($banner['title']) ?></h3>
                            <?php } ?>
                            <div class="widget-tabs style-3">
                                <ul class="widget-menu-tab wow fadeInUp">
                                    <?php 
                                        $cnt = 0;
                                        $headshotQuery = "SELECT * FROM about_headshot";
                                        $headshots = $obj->fetch($headshotQuery);
                                        foreach ($headshots as $headshot){ 
                                            $cnt++;
                                            $activeClass = ($cnt === 1) ? 'active' : '';
                                    ?>
                                    <li class="item-title <?= $activeClass; ?>">
                                        <span class="inner text-button"><?= htmlspecialchars($headshot['title']) ?></span>
                                    </li>
                                    <?php } ?>
                                </ul>
                                <div class="widget-content-tab wow fadeInUp">
                                    <?php 
                                        $cnt = 0;
                                        foreach ($headshots as $headshot){ 
                                            $cnt++;
                                            $activeClass = ($cnt === 1) ? 'active' : '';
                                    ?>
                                    <div class="widget-content-inner <?= $activeClass; ?>">
                                        <p><?= htmlspecialchars($headshot['des']) ?></p>
                                    </div>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- /about-us -->

        <!-- Iconbox -->
        <section class="flat-spacing line-bottom-container">
            <div class="container">
                <div dir="ltr" class="swiper tf-sw-iconbox" data-preview="4" data-tablet="3" data-mobile-sm="2" data-mobile="1" data-space-lg="30" data-space-md="30" data-space="15" data-pagination="1" data-pagination-sm="2" data-pagination-md="3" data-pagination-lg="4">
                    <div class="swiper-wrapper">
                        <div class="swiper-slide">
                            <div class="tf-icon-box style-2">
                                <div class="icon-box"><span class="icon icon-return"></span></div>
                                <div class="content">
                                    <h6>Easy Returns</h6>
                                    <p class="text-secondary">Risk-free shopping with easy returns.</p>
                                </div>
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="tf-icon-box style-2">
                                <div class="icon-box"><span class="icon icon-shipping"></span></div>
                                <div class="content">
                                    <h6>Shop with Confidence</h6>
                                    <p class="text-secondary">No extra costs, just the price you see.</p>
                                </div>
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="tf-icon-box style-2">
                                <div class="icon-box"><span class="icon icon-headset"></span></div>
                                <div class="content">
                                    <h6>24/7 Support</h6>
                                    <p class="text-secondary">24/7 support, always here just for you</p>
                                </div>
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="tf-icon-box style-2">
                                <div class="icon-box"><span class="icon icon-sealCheck"></span></div>
                                <div class="content">
                                    <h6>Member Discounts</h6>
                                    <p class="text-secondary">Special prices for our loyal customers.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="sw-pagination-iconbox sw-dots type-circle justify-content-center"></div>
                </div>
            </div>
        </section>
        <!-- /Iconbox -->

        <!-- Our Teams -->
        <section class="flat-spacing">
            <div class="container">
                <div class="heading-section text-center wow fadeInUp">
                    <h3 class="heading">Meet Our Teams</h3>
                    <p class="subheading text-secondary-2">Discover exceptional experiences through testimonials from our satisfied customers.</p>
                </div>
                <div dir="ltr" class="swiper tf-sw-latest" data-preview="4" data-tablet="3" data-mobile="2" data-space-lg="30" data-space-md="30" data-space="15" data-pagination="1" data-pagination-md="1" data-pagination-lg="1">
                    <div class="swiper-wrapper">
                        <?php 
                        $teamQuery = "SELECT * FROM team";
                        $teams = $obj->fetch($teamQuery);
                        foreach ($teams as $team){ 
                        ?>
                        <div class="swiper-slide">
                            <div class="team-item hover-image wow fadeInUp" data-wow-delay="0s">
                                <div class="image">
                                    <img class="lazyload" data-src="../Admin/uploads/team/<?= htmlspecialchars($team['image']) ?>" src="../Admin/uploads/team/<?= htmlspecialchars($team['image']) ?>" alt="image-team">
                                </div>
                                <div class="content">
                                    <div>
                                        <h6 class="name"><a class="link text-line-clamp-1" href="<?= htmlspecialchars($team['social']) ?>"><?= htmlspecialchars($team['name']) ?></a></h6>
                                        <div class="infor text-caption-1 text-secondary-2"><?= htmlspecialchars($team['role']) ?></div>
                                    </div>
                                    <ul class="tf-social-icon">
                                        <li><a href="<?= htmlspecialchars($team['social']) ?>" class="social-facebook"><i class="icon icon-fb"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <?php } ?>
                    </div>
                    <div class="sw-pagination-latest sw-dots type-circle justify-content-center"></div>
                </div>
            </div>
        </section>
        <!-- /Our Teams -->

        <!-- Testimonial -->
        <section class="flat-spacing">
            <div class="container">
                <div class="heading-section text-center wow fadeInUp">
                    <h3 class="heading">Customer Review</h3>
                </div>
                <div class="swiper tf-sw-testimonial wow fadeInUp" data-wow-delay="0.1s" data-preview="3" data-tablet="2" data-mobile="1" data-space-lg="30" data-space-md="30" data-space="15" data-pagination="1" data-pagination-md="1" data-pagination-lg="1">
                    <div class="swiper-wrapper">
                        <?php 
                        $reviewQuery = "SELECT * FROM reviews";
                        $reviews = $obj->fetch($reviewQuery);
                        foreach ($reviews as $review){ 
                            $rating = (float)$review['rating']; 
                            $fullStars = floor($rating); 
                            $halfStar = ($rating - $fullStars) >= 0.5;
                        ?>
                        <div class="swiper-slide">
                            <div class="testimonial-item style-4">
                                <div class="content-top">
                                    <div class="box-icon">
                                        <i class="icon icon-quote"></i>
                                    </div>
                                    <div class="text-title"><?= htmlspecialchars($review['title']) ?></div>
                                    <p class="text-secondary">"<?= htmlspecialchars($review['des']) ?>"</p>
                                    <div class="box-rate-author">
                                        <div class="box-author">
                                            <div class="text-title author"><?= htmlspecialchars($review['name']) ?></div>
                                        </div>
                                        <div class="list-star-default color-primary">
                                            <?php 
                                                for ($i = 0; $i < $fullStars; $i++) { 
                                                    echo '<i class="icon icon-star"></i>'; 
                                                }
                                                if ($halfStar) { 
                                                    echo '<i class="icon icon-star-half"></i>'; 
                                                }
                                                for ($i = ($fullStars + ($halfStar ? 1 : 0)); $i < 5; $i++) { 
                                                    echo '<i class="icon icon-star-outline"></i>'; 
                                                }
                                            ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php } ?>
                    </div>
                    <div class="sw-pagination-testimonial sw-dots type-circle d-flex justify-content-center"></div>
                </div>
            </div>
        </section>
        <!-- /Testimonial -->
        
        <!-- Footer -->
        <?php include 'footer.php'; ?>
        <!-- /Footer -->
        
    </div>
    <!-- /wrapper -->

    <!-- search -->
    <?php include 'search.php'; ?>
    <?php include 'general_search.php'; ?>
    <!-- /search -->
    
    <!-- Javascript -->
    <script type="text/javascript" src="js/bootstrap.min.js"></script>
    <script type="text/javascript" src="js/jquery.min.js"></script>
    <script type="text/javascript" src="js/bootstrap-select.min.js"></script>
    <script type="text/javascript" src="js/lazysize.min.js"></script>
    <script type="text/javascript" src="js/wow.min.js"></script>
    <script type="text/javascript" src="js/count-down.js"></script>
    <script type="text/javascript" src="js/swiper-bundle.min.js"></script>
    <script type="text/javascript" src="js/carousel.js"></script>
    <script type="text/javascript" src="js/multiple-modal.js"></script>
    <script type="text/javascript" src="js/main.js"></script>

</body>
</html>