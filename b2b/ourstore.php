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
        $imageQuery = "SELECT * FROM banner_two LIMIT 1";
        $bans = $obj->fetch($imageQuery);
        foreach ($bans as $ban){ 
        ?>
        <div class="page-title" style="background-image: url('../Admin/uploads/banner/<?= htmlspecialchars($ban['b2b_image']) ?>');">
            <div class="container">
                <h3 class="heading text-center">Our Stores</h3>
                <ul class="breadcrumbs d-flex align-items-center justify-content-center">
                    <li><a class="link" href="index.php">Home</a></li>
                    <li><i class="icon-arrRight"></i></li>
                    <li>Our Stores</li>
                </ul>
            </div>
        </div>
        <?php } ?>
        <!-- /page-title -->

        <section class="flat-spacing">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="flat-animate-tab">
                            <?php
                            $infoQuery = "SELECT * FROM stores";
                            $infos = $obj->fetch($infoQuery); 
                            ?>
                            <ul class="tf-store-list style-row" role="tablist">
                                <?php
                                $cnt = 0; 
                                foreach ($infos as $info) {
                                    $cnt++;
                                    $activeClass = ($cnt === 1) ? 'active' : '';
                                ?>
                                <li class="nav-tab-item" role="presentation">
                                    <a href="#<?= htmlspecialchars($info['name']) ?>" class="tf-store-item <?= $activeClass ?>" data-bs-toggle="tab">
                                        <h6 class="tf-store-title"><?= htmlspecialchars($info['name']) ?></h6>
                                        <div class="tf-store-info">
                                            <p>Phone: <?= htmlspecialchars($info['phone']) ?></p>
                                            <p>Email: <?= htmlspecialchars($info['email']) ?></p>
                                            <p>Address: <?= htmlspecialchars($info['address']) ?></p>
                                        </div>
                                    </a>
                                </li>
                                <?php } ?>
                            </ul>
                            <div class="tab-content">
                                <?php
                                $cnt = 0; 
                                foreach ($infos as $info) {
                                    $cnt++;
                                    $activeClass = ($cnt === 1) ? 'active show' : '';
                                ?>
                                <div class="tab-pane <?= $activeClass ?>" id="<?= htmlspecialchars($info['name']) ?>" role="tabpanel">
                                    <div class="wg-card-store align-items-center tf-grid-layout md-col-2 gap-0">
                                        <div class="card-store-img">
                                            <img data-src="../Admin/uploads/store/<?= htmlspecialchars($info['image']) ?>" alt="store-img" loading="lazy" width="1290" height="880" decoding="async" data-nimg="1" class="lazyload" style="color:transparent" src="../Admin/uploads/store/<?= htmlspecialchars($info['image']) ?>">
                                        </div>
                                        <div class="card-store-info">
                                            <h3 class="card-store-heading"><?= htmlspecialchars($info['name']) ?></h3>
                                            <ul>
                                                <li>
                                                    <h6 class="mb_8">Address:</h6>
                                                    <p class="text-secondary"><?= htmlspecialchars($info['address']) ?></p>
                                                </li>
                                                <li>
                                                    <h6 class="mb_8">Opentime:</h6>
                                                    <p class="text-secondary"><?= htmlspecialchars($info['date']) ?>: <br>
                                                        <span class="text-title text-main"><?= htmlspecialchars($info['time']) ?></span><br>
                                                    </p>
                                                </li>
                                                <li>
                                                    <h6 class="mb_8">Infomation:</h6>
                                                    <p class="text-secondary"><?= htmlspecialchars($info['phone']) ?> <br><?= htmlspecialchars($info['email']) ?></p>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
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
    <!-- /wrapper -->

    <!-- search -->
    <?php include 'search.php'; ?>
    <?php include 'general_search.php'; ?>
    <!-- /search -->
    
    <!-- Javascript -->
    <script type="text/javascript" src="js/bootstrap.min.js"></script>
    <script type="text/javascript" src="js/jquery.min.js"></script>
    <script type="text/javascript" src="js/jquery-validate.js"></script>
    <script type="text/javascript" src="js/bootstrap-select.min.js"></script>
    <script type="text/javascript" src="js/lazysize.min.js"></script>
    <script type="text/javascript" src="js/wow.min.js"></script>
    <script type="text/javascript" src="js/count-down.js"></script>
    <script type="text/javascript" src="js/swiper-bundle.min.js"></script>
    <script type="text/javascript" src="js/carousel.js"></script>
    <script type="text/javascript" src="js/multiple-modal.js"></script>
    <script type="text/javascript" src="js/main.js"></script> 
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAuSiPhoDaOJ7aqtJVtQhYhLzwwJ7rQlmA"></script>
    <script type="text/javascript" src="js/map-contact.js"></script>
    <script type="text/javascript" src="js/marker.js"></script>
    <script type="text/javascript" src="js/infobox.min.js"></script>
    
</body>
</html>