<?php
include 'session_config.php';
if(empty($_SESSION['user_email'])){
    echo '<script>window.location.href="login.php"</script>';
}
include "config.php";
include 'headerlink.php';

$product_id = isset($_GET['product_id']) ? base64_decode($_GET['product_id']) : null;
if (!$product_id) {
    die("Invalid Product ID"); 
}
$sql = "SELECT * FROM products WHERE id = '$product_id'";
$productDetails = $obj->fetch($sql);

if (!$productDetails) {
    die("Order not found!"); 
}
$cat_id = $productDetails[0]['cat_id'];
$company_id = $productDetails[0]['company_id'];

$name = $productDetails[0]['name'];
$description = $productDetails[0]['description'];
$sku = $productDetails[0]['sku'];
$part = $productDetails[0]['part'];
$mrp = $productDetails[0]['mrp'];
$gst = $productDetails[0]['gst'];
$stock = $productDetails[0]['stock'];
$best_seller = $productDetails[0]['best_seller'];
$ship = $productDetails[0]['shipping_price'];
$b2b_price = $productDetails[0]['b2b_price'];
$b2b_discount = $productDetails[0]['b2b_discount'];
$b2c_price = $productDetails[0]['b2c_price'];
$b2c_discount = $productDetails[0]['b2c_discount'];
$b2c_special_discount = $productDetails[0]['b2c_special_discount'];
$final_price = $mrp + ($mrp * ($gst / 100));

$statusClass = "";
$best = "";
if($best_seller == 'yes') {
     $statusClass = 'badge border border-success text-success fw-semibold';
} elseif($best_seller = 'no') {
     $statusClass = 'd-none';
} else {
     $statusClass = 'd-none';
}

if($best_seller = 'yes') {
     $best = 'Best Seller';
} else {
     $best = 'd-none';
}

$image_1 = $productDetails[0]['image_1'];
$image_2 = $productDetails[0]['image_2'];
$image_3 = $productDetails[0]['image_3'];
$image_4 = $productDetails[0]['image_4'];

$date = $productDetails[0]['last_updated'];
$date_format = date("F j, Y \a\\t g:i a", strtotime($date));

$category = $obj->fetch("SELECT category FROM product_category WHERE id = $cat_id");
$cat = isset($category[0]['category']) ? $category[0]['category'] : 'Unknown';

$company = $obj->fetch("SELECT name FROM company WHERE id = $company_id");
$comp = isset($company[0]['name']) ? $company[0]['name'] : 'Unknown';

$sql = "SELECT AVG(rating) AS avg_rating, COUNT(*) AS total_reviews FROM product_reviews WHERE product_id = $product_id";
$result = $obj->fetch($sql);
$avg_rating = isset($result[0]['avg_rating']) ? round($result[0]['avg_rating'], 1) : 0;
$total_reviews = isset($result[0]['total_reviews']) ? $result[0]['total_reviews'] : 0;

$sql = "SELECT * FROM product_reviews WHERE product_id = $product_id";
$reviews = $obj->fetch($sql);
?>

<body>
     <div class="wrapper">

          <?php include 'header.php'; ?>
          <?php include 'sidebar.php'; ?>

          <!-- Start Content here -->
          <!-- ==================================================== -->
          <div class="page-content">
               <div class="container-xxl">
                    <div class="row">
                         <div class="col-lg-5">
                              <div class="card">
                                   <div class="card-body">
                                        <div id="carouselExampleFade" class="carousel slide carousel-fade" data-bs-ride="carousel">
                                             <div class="carousel-inner" role="listbox">
                                                  <?php if($image_1) { ?>
                                                  <div class="carousel-item active">
                                                       <img src="uploads/products/<?= $image_1; ?>" alt="product-main-image" class="img-fluid bg-light rounded">
                                                  </div>
                                                  <?php } ?>
                                                  <?php if($image_2) { ?>
                                                  <div class="carousel-item">
                                                       <img src="uploads/products/<?= $image_2; ?>" alt="product-main-image" class="img-fluid bg-light rounded">
                                                  </div>
                                                  <?php } ?>
                                                  <?php if($image_3) { ?>
                                                  <div class="carousel-item">
                                                       <img src="uploads/products/<?= $image_3; ?>" alt="product-main-image" class="img-fluid bg-light rounded">
                                                  </div>
                                                  <?php } ?>
                                                  <?php if($image_4) { ?>
                                                  <div class="carousel-item">
                                                       <img src="uploads/products/<?= $image_4; ?>" alt="product-main-image" class="img-fluid bg-light rounded">
                                                  </div>
                                                  <?php } ?>
                                             </div>
                                             <div class="carousel-indicators m-0 mt-2 d-lg-flex d-none position-static h-100">
                                                  <?php if($image_1) { ?>
                                                  <button type="button" data-bs-target="#carouselExampleFade" data-bs-slide-to="0" aria-current="true" aria-label="Slide 1" class="w-auto h-auto rounded bg-light active">
                                                       <img src="uploads/products/<?= $image_1; ?>" class="d-block avatar-xl rounded" alt="swiper-indicator-img">
                                                  </button>
                                                  <?php } ?>
                                                  <?php if($image_2) { ?>
                                                  <button type="button" data-bs-target="#carouselExampleFade" data-bs-slide-to="1" aria-label="Slide 2" class="w-auto h-auto rounded bg-light">
                                                       <img src="uploads/products/<?= $image_2; ?>" class="d-block avatar-xl rounded" alt="swiper-indicator-img">
                                                  </button>
                                                  <?php } ?>
                                                  <?php if($image_3) { ?>
                                                  <button type="button" data-bs-target="#carouselExampleFade" data-bs-slide-to="2" aria-label="Slide 3" class="w-auto h-auto rounded bg-light">
                                                       <img src="uploads/products/<?= $image_3; ?>" class="d-block avatar-xl rounded" alt="swiper-indicator-img">
                                                  </button>
                                                  <?php } ?>
                                                  <?php if($image_4) { ?>
                                                  <button type="button" data-bs-target="#carouselExampleFade" data-bs-slide-to="3" aria-label="Slide 3" class="w-auto h-auto rounded bg-light">
                                                       <img src="uploads/products/<?= $image_4; ?>" class="d-block avatar-xl rounded" alt="swiper-indicator-img">
                                                  </button>
                                                  <?php } ?>
                                             </div>
                                        </div>
                                   </div>
                              </div>
                         </div>
                         <div class="col-lg-7">
                              <div class="card">
                                   <div class="card-body">
                                        <h4 class="badge bg-success text-light fs-14 py-1 px-2">New Arrival</h4>
                                        <p class="fs-24 text-dark fw-semibold mb-1"><?= $name; ?></p>
                                        <span class="mb-2 <?= $statusClass ?> px-2 py-1 rounded-pill"><?= $best ?></span>
                                        <div class="d-flex gap-2 align-items-center">
                                             <ul class="d-flex text-warning m-0 fs-20  list-unstyled">
                                                  <?php
                                                  $full_stars = floor($avg_rating);
                                                  $half_star = ($avg_rating - $full_stars) >= 0.5 ? true : false;
                                                  for ($i = 1; $i <= 5; $i++) {
                                                       if ($i <= $full_stars) {
                                                            echo '<li><i class="bx bxs-star"></i></li>'; 
                                                       } elseif ($half_star) {
                                                            echo '<li><i class="bx bxs-star-half"></i></li>'; 
                                                            $half_star = false;
                                                       } else {
                                                            echo '<i class="bx bxs-star-empty"></i>'; 
                                                       }
                                                  } ?>
                                             </ul>
                                             <p class="mb-0 fw-medium fs-18 text-dark"><?= $avg_rating; ?> <span class="text-muted fs-13">(<?php echo $total_reviews; ?> reviews)</span></p>
                                        </div>
                                        <h2 class="fw-medium my-3"><span class="fs-20 fw-bold text-primary">Retail Price: </span> ₹<?= $b2c_price; ?> <span class="fs-16 text-decoration-line-through">₹<?= $final_price; ?></span><span class="fs-16 text-danger ms-2">(<?= $b2c_discount; ?> %Off)</span></h2>
                                        <h2 class="fw-medium my-3"><span class="fs-20 fw-bold text-primary">Wholesale Price: </span> ₹<?= $b2b_price; ?> <span class="fs-16 text-decoration-line-through">₹<?= $final_price; ?></span><span class="fs-16 text-danger ms-2">(<?= $b2b_discount; ?> %Off)</span></h2>
                                        <h4 class="fw-medium"><span class="text-dark">Special Retail Discount : </span> <span class="text-muted"> <?= $b2c_special_discount; ?>%</span></h4>
                                        <h4 class="text-dark fw-medium">Description :</h4>
                                        <p class="text-muted"><?= $description; ?></p>
                                        <h4 class="text-dark fw-medium mt-3">Policies :</h4>
                                        <a href="t&c.php" class="text-sucess fw-medium">1.  Terms & Condition</a> <br>
                                        <a href="shipping.php" class="text-sucess fw-medium">2.  Shipping Policy</a>  <br>
                                        <a href="return.php" class="text-sucess fw-medium">3.  Return & Refund</a>
                                   </div>
                              </div>
                         </div>
                    </div>
                    <div class="row">
                         <div class="col-lg-6">
                              <div class="card">
                                   <div class="card-header">
                                        <h4 class="card-title">Item Details</h4>
                                   </div>
                                   <div class="card-body">
                                        <div>
                                             <ul class="d-flex flex-column gap-2 list-unstyled fs-14 text-muted mb-0">
                                                  <li><span class="fw-medium text-dark">Last Updated</span><span class="mx-2">:</span><?= $date_format; ?></li>
                                                  <li><span class="fw-medium text-dark">Generic Name</span><span class="mx-2">:</span><?= $name; ?></li>
                                                  <li><span class="fw-medium text-dark">MRP Price.</span><span class="mx-2">:</span> ₹<?= $mrp; ?></li>
                                                  <li><span class="fw-medium text-dark">Shipping Price.</span><span class="mx-2">:</span> ₹<?= $ship; ?></li>
                                                  <li><span class="fw-medium text-dark">Category</span><span class="mx-2">:</span><?= $cat; ?></li>
                                                  <li><span class="fw-medium text-dark">Company </span><span class="mx-2">:</span><?= $comp; ?></li>
                                                  <li><span class="fw-medium text-dark">SKU No.</span><span class="mx-2">:</span><?= $sku; ?></li>
                                                  <li><span class="fw-medium text-dark">Part No.</span><span class="mx-2">:</span> <?= $part; ?></li>
                                                  <li><span class="fw-medium text-dark">Country of Origin</span><span class="mx-2">:</span>India</li>
                                             </ul>
                                        </div>
                                   </div>
                              </div>
                         </div>
                         <div class="col-lg-6">
                              <div class="card">
                                   <div class="card-header">
                                        <h4 class="card-title">Reviews From Customer</h4>
                                   </div>
                                   <div class="card-body">
                                        <?php if(!empty($reviews)) {?>
                                             <?php foreach($reviews as $review) { 
                                                  $rating_id = $review['id'];
                                                  $rating = $review['rating'];
                                             ?>
                                             <div class="d-flex align-items-center justify-content-start">
                                                  <div><h5 class="text-dark mb-0"><?= $review['name']; ?></h5></div>
                                             </div>
                                             <div class="d-flex align-items-center gap-2 mt-3 mb-1">
                                                  <ul class="d-flex text-warning m-0 fs-20 list-unstyled">
                                                       <?php
                                                       $full_stars = floor($rating);
                                                       $half_star = ($rating - $full_stars) >= 0.5 ? true : false;
                                                       for ($i = 1; $i <= 5; $i++) {
                                                            if ($i <= $full_stars) {
                                                                 echo '<li><i class="bx bxs-star"></i></li>'; 
                                                            } elseif ($half_star) {
                                                                 echo '<li><i class="bx bxs-star-half"></i></li>'; 
                                                                 $half_star = false;
                                                            } else {
                                                                 echo '<li><i class="bx bxs-star-empty"></i></li>'; 
                                                            }
                                                       } ?>
                                                  </ul>
                                             </div>
                                             <p class="text-muted"><?= $review['review']; ?></p>
                                             <div class="d-flex align-items-center gap-2 mt-3 mb-1">
                                                  <button class="btn btn-sm btn-outline-primary rounded-pill deleteBtn" data-id="<?= $rating_id; ?>"><i class="bx bx-trash"></i> <span> Not Useful</span></button>
                                             </div>
                                             <hr class="my-3">
                                        <?php } ?>
                                        <?php } else { ?>
                                             <div class="d-flex align-items-center justify-content-start">
                                                  <div><h5 class="text-warning mb-0">No reviews submitted yet :(</h5></div>
                                             </div>
                                        <?php } ?>
                                   </div>
                              </div>
                         </div>
                    </div>

               </div>
               <!-- End Container Fluid -->

               <?php include 'footer.php'; ?>
          </div>
     </div>
    <!-- END Wrapper -->


<!-- All necessary scripts are here -->
<script>
     // delete customer review ajax
     $(document).ready(function () {
          $(".deleteBtn").click(function () {
               let button = $(this);
               let rating_id = button.data("id");
               $.ajax({
                    url: "remove_review.php",
                    type: "POST",
                    data: { rating_id: rating_id },
                    success: function (response) {
                         if (response === "success") {
                              Toastify({
                                   text: "Review deleted successfully!",
                                   duration: 3000,
                                   gravity: "top",
                                   position: "center",
                                   backgroundColor: "#22C55E",
                              }).showToast();
                              setTimeout(() => {
                                   window.location.reload();
                              }, 1000);
                         } else {
                              Toastify({
                                   text: "Error deleting review!",
                                   duration: 3000,
                                   gravity: "top",
                                   position: "center",
                                   backgroundColor: "#ff0000",
                              }).showToast();
                         }
                    }
               });
          });
     });
</script>
<?php include 'footerlink.php'; ?>