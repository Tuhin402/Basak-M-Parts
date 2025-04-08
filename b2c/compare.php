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

  <div id="wrapper">

    <?php include 'header.php'; 

    if (isset($_GET['product_id'])) {
        $product_id = $_GET['product_id'];
        
        $query = "SELECT p.*, c.category AS category_name, co.name AS company_name FROM products p
                  LEFT JOIN product_category c ON p.cat_id = c.id LEFT JOIN company co ON p.company_id = co.id WHERE p.id = $product_id";
        
        $product = $obj->fetch($query);

        if (!empty($product)) {
            $product = $product[0];
            $cat_id = $product['cat_id'];
            $company_id = $product['company_id'];

            $query = "SELECT p.*, c.category AS category_name, co.name AS company_name FROM products p
                      LEFT JOIN product_category c ON p.cat_id = c.id LEFT JOIN company co ON p.company_id = co.id
                      WHERE p.cat_id = $cat_id AND p.company_id = $company_id AND p.id != $product_id ORDER BY RAND() LIMIT 2";

            $related_products = $obj->fetch($query);
            array_unshift($related_products, $product); 
        }
    }
    ?>


    <!-- breadcrumb -->
    <div class="page-title" style="background-image: url(images/page-title.jpg)">
      <div class="container">
        <h3 class="heading text-center">Compare Products</h3>
        <ul class="breadcrumbs d-flex align-items-center justify-content-center">
          <li><a class="link" href="index.php">Home</a></li>
          <li><i class="icon-arrRight"></i></li>
          <li><a class="link" href="products-all.php">Shop</a></li>
          <li><i class="icon-arrRight"></i></li>
          <li>Compare</li>
        </ul>
      </div>
    </div>
    <!-- /breadcrumb -->

    <!-- compare -->
    <section class="flat-spacing">
      <div class="container">
          <?php if (!empty($related_products)) { ?>
              <div class="table-responsive">
                  <table class="table table-bordered text-center">
                      <thead>
                          <tr>
                              <th></th>
                              <?php foreach ($related_products as $prod) { 
                                $prod_id = $prod['id'];?>
                                  <th>
                                    <div class="d-flex flex-column align-items-center justify-content-center">
                                      <div class="image_container" style="width: 200px; height: 300px;">
                                        <a href="product-detail.php?product_id=<?= base64_encode($prod_id) ?>" style="width: 200px; height: 300px;">
                                          <img src="../Admin/uploads/products/<?= htmlspecialchars($prod['image_1']) ?>" class="img-fluid rounded" alt="<?= htmlspecialchars($prod['name']) ?>" style="width:100%; height:100%; object-fit: cover;">
                                        </a>
                                      </div>
                                    </div>
                                    <h5 class="fw-semibold text-danger">
                                      <a href="product-detail.php?product_id=<?= base64_encode($prod_id) ?>"><?= htmlspecialchars($prod['name']) ?></a>
                                    </h5>
                                  </th>
                              <?php } ?>
                          </tr>
                      </thead>
                      <tbody>
                          <tr>
                              <td><strong>Rating</strong></td>
                              <?php foreach ($related_products as $prod) { 
                                  $prod_id = $prod['id']; 
                                  $rating_query = "SELECT AVG(rating) AS avg_rating, COUNT(*) AS total_reviews FROM product_reviews WHERE product_id = $prod_id";
                                  $rating_result = $obj->fetch($rating_query);
                                  $avg_rating = isset($rating_result[0]['avg_rating']) ? round($rating_result[0]['avg_rating'], 1) : 0;
                                  $total_reviews = isset($rating_result[0]['total_reviews']) ? $rating_result[0]['total_reviews'] : 0;
                              ?>
                                  <td>
                                      <div class="box-rating">
                                          <div class="list-star">
                                              <?php
                                              $full_stars = floor($avg_rating);
                                              $half_star = ($avg_rating - $full_stars) >= 0.5 ? true : false;

                                              for ($i = 1; $i <= 5; $i++) {
                                                  if ($i <= $full_stars) {
                                                      echo '<i class="fas fa-star text-warning"></i>'; 
                                                  } elseif ($half_star) {
                                                      echo '<i class="fas fa-star-half-alt text-warning"></i>'; 
                                                      $half_star = false;
                                                  } else {
                                                      echo '<i class="far fa-star text-muted"></i>'; 
                                                  }
                                              }
                                              ?>
                                          </div>
                                          <span class="text text-caption-1">(<?php echo $total_reviews; ?> reviews)</span>
                                      </div>
                                  </td>
                              <?php } ?>
                          </tr>
                          <tr>
                              <td><strong>Price</strong></td>
                              <?php foreach ($related_products as $prod) { ?>
                                  <td class="fw-semibold text-success">₹ <?= htmlspecialchars($prod['b2c_price']) ?></td>
                              <?php } ?>
                          </tr>
                          <tr>
                              <td><strong>Category</strong></td>
                              <?php foreach ($related_products as $prod) { ?>
                                  <td><?= htmlspecialchars($prod['category_name']) ?></td>
                              <?php } ?>
                          </tr>
                          <tr>
                              <td><strong>Company</strong></td>
                              <?php foreach ($related_products as $prod) { ?>
                                  <td><?= htmlspecialchars($prod['company_name']) ?></td>
                              <?php } ?>
                          </tr>
                      </tbody>
                  </table>
              </div>
          <?php } else { ?>
              <div class="text-center">
                  No items to compare yet. Add products to your comparison list and decide smarter!
                  <a class="btn-line" href="products-all.php">Explore Products</a>
              </div>
          <?php } ?>
      </div>
    </section>
    <!-- /compare -->

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