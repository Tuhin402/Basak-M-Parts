<?php 
include 'session_config.php'; 
$cat_id = isset($_GET['cat_id']) ? intval($_GET['cat_id']) : 0;
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
          <div class="heading-section text-center mt-4" style="margin-bottom: 20px">
            <h3 class="heading">Our Companies</h3>
          </div>
            <?php 
            if ($cat_id) {
              $query = "SELECT DISTINCT c.id, c.name, c.image FROM company c JOIN category_company cc ON c.id = cc.company_id WHERE cc.cat_id = $cat_id ORDER BY sort_order ASC";      
              $companies = $obj->fetch($query);
            } else {
              echo "Invalid category!";
              exit;
            }
            foreach ($companies as $company){ 
            ?>
            <div class="col-6 col-sm-4 col-md-4 col-lg-3">
                <div class="card border-0 shadow-sm rounded-3 text-center p-3 d-flex flex-column align-items-center" 
                    style="background: #fff; height: 220px;">
                    <a href="products-grid.php?cat_id=<?= $cat_id ?>&company_id=<?= $company['id'] ?>" class="d-block w-100 position-relative" style="height: 120px;">
                        <img class="lazyload img-fluid w-100 h-100 object-fit-contain" src="../Admin/uploads/company/<?= $company['image'] ?>" alt="<?= htmlspecialchars($company['name']) ?>">
                    </a>
                    <div class="mt-2">
                        <div class="fw-bold text-dark"><?= htmlspecialchars($company['name']) ?></div>
                        <a href="products-grid.php?cat_id=<?= $cat_id ?>&company_id=<?= $company['id'] ?>" class="text-primary text-decoration-none fw-medium d-inline-block mt-1">
                            View Products <i class="bi bi-chevron-double-right ms-1"></i>
                        </a>
                    </div>
                </div>
            </div>
            <?php } ?>
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
</body>
</html>