<?php
include 'session_config.php';
if(empty($_SESSION['user_email'])){
    echo '<script>window.location.href="login.php"</script>';
}
include "config.php";
include 'headerlink.php'; 
?>

<body>

    <!-- START Wrapper -->
  <div class="wrapper">
    <?php include 'header.php'; ?>
    <?php include 'sidebar.php'; ?>

     <div class="page-content">
          <div class="container-fluid">
               <!-- Page Header -->
               <div class="page-header my-3">
                    <div class="row align-items-center">
                         <div class="col">
                              <h3 class="page-title">Low Stock</h3>
                              <ul class="breadcrumb">
                                   <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
                                   <li class="breadcrumb-item">Products</li>
                                   <li class="breadcrumb-item active">Low Stock</li>
                              </ul>
                         </div>
                    </div>
               </div>

               <div class="row">
                    <div class="col-xl-12">
                         <div class="card">
                              <div class="card-header d-flex justify-content-between align-items-center gap-1">
                                   <h4 class="card-title flex-grow-1">Product's having Low Stock</h4>
                              </div>
                              <div>
                                   <!-- table start  -->
                                   <div class="table-responsive">
                                        <?php
                                        $cnt = 0;
                                        $products = $obj->fetch("SELECT * FROM products WHERE stock <= 5 ORDER BY sort_order ASC");
                                        ?>
                                        <table class="table align-middle mb-0 table-hover table-centered">
                                             <thead class="bg-light-subtle">
                                                  <tr>
                                                       <th>Product Name</th>
                                                       <th>Part No.</th>
                                                       <th>Description</th>
                                                       <th>Price</th>
                                                       <th>Rating</th>
                                                       <th>Action</th>
                                                  </tr>
                                             </thead>
                                             <tbody>
                                                  <?php if (!empty($products)) { ?>
                                                       <?php foreach ($products as $val) { 
                                                            $product_id = $val['id'];
                                                            $best_seller = $val['best_seller'];

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

                                                            $sql = "SELECT AVG(rating) AS avg_rating FROM product_reviews WHERE product_id = $product_id";
                                                            $result = $obj->fetch($sql);
                                                            $avg_rating = isset($result[0]['avg_rating']) ? round($result[0]['avg_rating'], 1) : 0; 
                                                       ?>
                                                       <tr>
                                                            <td>
                                                                 <div class="d-flex align-items-center gap-2">
                                                                      <div class="rounded bg-light avatar-md d-flex align-items-center justify-content-center">
                                                                           <img src="uploads/products/<?php echo $val['image_1'] ?>" alt="Product Image" class="avatar-md rounded">
                                                                      </div>
                                                                      <div class="d-flex align-items-center flex-column flex-wrap gap-2">
                                                                           <a href="product_details.php?product_id=<?= base64_encode($product_id); ?>" class="text-dark fw-medium fs-15"><?php echo $val['name'] ?></a>
                                                                           <span class="<?= $statusClass ?>"><?= $best ?></span>
                                                                      </div>
                                                                 </div>
                                                            </td>
                                                            <td><p class="text-muted"><?php echo $val['part'] ?></p></td>
                                                            <td><p class="text-muted"><?php echo $val['description'] ?></p></td>
                                                            <td>
                                                                 <p class="mb-1 text-muted">B2B: <span class="text-dark fw-medium"><?php echo $val['b2b_price'] ?> ₹</span></p>
                                                                 <p class="mb-0 text-muted">B2C: <span class="text-dark fw-medium"><?php echo $val['b2c_price'] ?> ₹</span></p>
                                                            </td>
                                                            <td>
                                                                 <span class="badge p-1 bg-light text-dark fs-12 me-1"><i class="bx bxs-star align-text-top fs-14 text-warning me-1"></i> <?= $avg_rating ?></span>
                                                            </td>
                                                            <td>
                                                                 <a href="product_details.php?product_id=<?= base64_encode($product_id); ?>" class="btn btn-light btn-sm">
                                                                      <iconify-icon icon="solar:eye-broken" class="align-middle fs-18"></iconify-icon>
                                                                 </a>
                                                            </td>
                                                       </tr>
                                                       <?php } ?>
                                                  <?php } else { ?>
                                                       <tr>
                                                            <td colspan="6" class="text-center text-muted fw-bold fs-16">
                                                                 No products with low stock available.
                                                            </td>
                                                       </tr>
                                                  <?php } ?>
                                             </tbody>
                                        </table>
                                   </div>
                                   <!-- table end -->

                                   <!-- show modal start  -->
                                   <?php foreach ($products as $val) {  ?>
                                   <div class="modal fade" id="showModal<?php echo $val['id']; ?>" tabindex="-1" aria-labelledby="showModalLabel<?php echo $val['id']; ?>" aria-hidden="true">
                                        <div class="modal-dialog modal-lg modal-dialog-centered">
                                             <div class="modal-content">
                                                  <div class="modal-header bg-light">
                                                       <h4 class="modal-title text-muted" id="showModalLabel<?php echo $val['id']; ?>">
                                                            Details for <span class="text-dark fw-medium"> <?php echo $val['name'] ?></span>
                                                       </h4>
                                                       <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                  </div>
                                                  <div class="modal-body">
                                                       <div class="table-responsive">
                                                            <table class="table table-bordered table-striped table-hover">
                                                                 <thead class="bg-light">
                                                                      <tr>
                                                                           <th class="text-center" scope="col">Stock</th>
                                                                           <th class="text-center" scope="col">Discount %</th>
                                                                           <th class="text-center" scope="col">HSN No.</th>
                                                                      </tr>
                                                                 </thead>
                                                                 <tbody>
                                                                      <tr>
                                                                           <td class="text-center"><span class="text-dark fw-medium"><?php echo $val['stock'] ?></span></td>
                                                                           <td class="text-center">
                                                                                <p class="mb-1 text-muted">B2B: <span class="text-dark fw-medium"> <?php echo $val['b2b_discount'] ?></span></p>
                                                                                <p class="mb-0 text-muted">B2C: <span class="text-dark fw-medium"> <?php echo $val['b2c_discount'] ?></span></p>
                                                                           </td>
                                                                           <td class="text-center"><span class="text-dark fw-medium"><?php echo $val['sku'] ?></span></td>
                                                                      </tr>
                                                                 </tbody>
                                                            </table>
                                                       </div>
                                                  </div>
                                             </div>
                                     </div>
                                   </div>
                                   <?php } ?>
                                   <!-- show modal end  -->
                              </div>
                         </div>
                    </div>
               </div>
          </div>

          <?php include 'footer.php'; ?>
     </div>
  </div>



<?php include 'footerlink.php'; ?>