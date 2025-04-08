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

        <!-- Return Policy -->
        <section class="flat-spacing">
            <div class="container">
                <div class="terms-of-use-wrap">
                    <div class="left sticky-top">
                        <?php 
                        $cnt = 0;
                        $policyQuery = "SELECT * FROM return_policy";
                        $policies = $obj->fetch($policyQuery);
                        foreach ($policies as $policy){ 
                            $cnt++;
                            $activeClass = ($cnt === 1) ? 'active' : '';
                        ?>
                        <h6 class="btn-scroll-target <?= $activeClass; ?>" data-scroll="<?= $policy['title']; ?>"><?= $cnt; ?>. <?= htmlspecialchars($policy['title']) ?> </h6>
                        <?php } ?>
                    </div>
                    <div class="right">
                        <h4 class="heading">Return Policy</h4>
                        <?php 
                        $cnt = 0;
                        foreach ($policies as $policy){ 
                            $cnt++;
                        ?>
                        <div class="terms-of-use-item item-scroll-target" data-scroll="<?= $policy['title']; ?>">
                            <h5 class="terms-of-use-title"><?= $cnt; ?>. <?= htmlspecialchars($policy['title']) ?></h5>
                            <div class="terms-of-use-content">
                                <pre style="white-space: pre-wrap; word-wrap: break-word; overflow-wrap: break-word;"><?= htmlspecialchars($policy['des']) ?></pre>
                            </div>
                        </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </section>
        <!-- /Return Policy -->

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
    <script type="text/javascript" src="js/map-contact.js"></script>
    <script type="text/javascript" src="js/marker.js"></script>
    <script type="text/javascript" src="js/infobox.min.js"></script>
    

</body>
</html>