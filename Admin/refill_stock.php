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
                              <h3 class="page-title">Refill Stock</h3>
                              <ul class="breadcrumb">
                                   <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
                                   <li class="breadcrumb-item">Products</li>
                                   <li class="breadcrumb-item active">Refill Stock</li>
                              </ul>
                         </div>
                    </div>
               </div>

               <div class="row">
                    <div class="col-xl-12">
                         <div class="card">
                              <div class="card-header d-flex justify-content-between align-items-center gap-1">
                                   <h4 class="card-title flex-grow-1">All Product List</h4>
                                   <!-- search by part_no -->
                                   <form id="searchForm" class="mx-3 flex-grow-1 d-none d-md-block" method="GET" novalidate style="max-width: 260px;">
                                        <div class="input-group">
                                             <input type="text" class="form-control" id="searchInput" name="part" placeholder="Search by Part No." autocomplete="off" required style="border-radius: 10px 0 0 10px; border-right: 0;">
                                             <button type="submit" class="btn btn-soft-secondary" style="border-radius: 0 10px 10px 0; border-left: 0;">
                                                  <iconify-icon icon="solar:magnifer-linear"></iconify-icon>
                                             </button>
                                        </div>
                                   </form>
                                   <!-- /search by part_no -->
                              </div>
                              <div>
                                   <!-- table start  -->
                                   <div class="table-responsive">
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
                                             <tbody id="productTableBody">
                                                  <?php
                                                  $totalProducts = $obj->fetch("SELECT COUNT(*) AS total FROM products")[0]['total'];
                                                  $products = $obj->fetch("SELECT * FROM products ORDER BY sort_order ASC");
                                                  foreach ($products as $val) {
                                                       $commonCatId = $val['cat_id'];
                                                       $commonCompId = $val['company_id'];
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

                                                       $category = $obj->fetch("SELECT category FROM product_category WHERE id = $commonCatId");
                                                       $cat = isset($category[0]['category']) ? $category[0]['category'] : 'Unknown';

                                                       $company = $obj->fetch("SELECT name FROM company WHERE id = $commonCompId");
                                                       $comp = isset($company[0]['name']) ? $company[0]['name'] : 'Unknown'; 

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
                                                            <p class="mb-1 text-muted">B2B: <span class="text-dark fw-medium"> <?php echo $val['b2b_price'] ?> ₹</span></p>
                                                            <p class="mb-0 text-muted">B2C: <span class="text-dark fw-medium"> <?php echo $val['b2c_price'] ?> ₹</span></p>
                                                       </td>
                                                       <td>
                                                            <span class="badge p-1 bg-light text-dark fs-12 me-1"><i class="bx bxs-star align-text-top fs-14 text-warning me-1"></i> <?= $avg_rating ?></span>
                                                       </td>
                                                       <td>
                                                            <div class="d-flex flex-column gap-2">
                                                                 <a href="product_details.php?product_id=<?= base64_encode($product_id); ?>" class="btn btn-light btn-sm">
                                                                      <iconify-icon icon="solar:eye-broken" class="align-middle fs-18"></iconify-icon>
                                                                 </a>
                                                                 <button class="btn btn-soft-primary btn-sm edit-btn" data-bs-toggle="modal" data-bs-target="#editModal<?php echo $val['id']; ?>">
                                                                      Refill
                                                                 </button>
                                                            </div>
                                                       </td>
                                                  </tr>

                                                  <!-- edit modal start  -->
                                                  <div class="modal fade" id="editModal<?php echo $val['id']; ?>" tabindex="-1" aria-labelledby="editModalLabel<?php echo $val['id']; ?>" aria-hidden="true">
                                                       <div class="modal-dialog modal-lg modal-dialog-centered">
                                                            <div class="modal-content">
                                                                 <div class="modal-header bg-light">
                                                                      <h4 class="modal-title" id="editModalLabel<?php echo $val['id']; ?>">Refill Stock</h4>
                                                                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                 </div>
                                                                 <div class="modal-body">
                                                                      <form class="editProductForm" enctype="multipart/form-data">
                                                                           <h4 class="mt-2 text-center p-3 bg-light rounded">Product Details</h4>
                                                                           <input type="hidden" name="product_id" value="<?php echo $val['id']; ?>">
                                                                           <div class="row">
                                                                                <input type="hidden" name="product_category" value="<?php echo $val['cat_id']; ?>">
                                                                                <input type="hidden" name="product_company" value="<?php echo $val['company_id']; ?>">
                                                                                <div class="col-lg-12 mt-3">
                                                                                     <div class="mb-3">
                                                                                          <label for="des" class="form-label">Description</label>
                                                                                          <textarea class="form-control bg-light-subtle" id="des" name="des" rows="7"><?php echo $val['description']; ?></textarea>
                                                                                     </div>
                                                                                </div>
                                                                           </div>

                                                                           <h4 class="mt-2 text-center p-3 bg-light rounded">Stock Details</h4>
                                                                           <div class="row mt-4">
                                                                                <div class="col-lg-6">
                                                                                     <div class="mb-3">
                                                                                          <label for="stock" class="form-label">Old Stock</label>
                                                                                          <input type="number" id="stock" name="stock" class="form-control" value="<?php echo $val['stock']; ?>" readonly>
                                                                                     </div>
                                                                                </div>
                                                                                <div class="col-lg-6">
                                                                                     <div class="mb-3">
                                                                                          <label for="new_stock" class="form-label">New Stock <span style="color: red;">*</span></label>
                                                                                          <input type="number" id="new_stock" name="new_stock" class="form-control" required>
                                                                                     </div>
                                                                                </div>
                                                                                <div class="col-lg-6">
                                                                                     <div class="mb-3">
                                                                                          <label for="sku_no" class="form-label">HSN Number</label>
                                                                                          <input type="text" id="sku_no" name="sku_no" class="form-control" value="<?php echo $val['sku']; ?>" readonly>
                                                                                     </div>
                                                                                </div>
                                                                                <div class="col-lg-6">
                                                                                     <div class="mb-3">
                                                                                          <label for="part_no" class="form-label">Part Number</label>
                                                                                          <input type="text" id="part_no" name="part_no" class="form-control" value="<?php echo $val['part']; ?>" readonly>
                                                                                     </div>
                                                                                </div>
                                                                           </div>

                                                                           <h4 class="mt-2 text-center p-3 bg-light rounded">Pricing Details</h4>
                                                                           <div class="row mt-4 product-row">
                                                                                <div class="col-lg-6">
                                                                                    <label for="mrp" class="form-label">M.R.P Price</label>
                                                                                    <div class="input-group mb-3">
                                                                                        <span class="input-group-text fs-20"><i class="bx bx-rupee"></i></span>
                                                                                        <input type="text" id="mrp" name="mrp" class="form-control mrp" value="<?php echo $val['mrp']; ?>">
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-lg-6">
                                                                                    <label for="gst" class="form-label">GST %</label>
                                                                                    <div class="input-group mb-3">
                                                                                        <span class="input-group-text fs-20"><i class="bx bx-rupee"></i></span>
                                                                                        <input type="text" id="gst" name="gst" class="form-control gst" value="<?php echo $val['gst']; ?>">
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-lg-6">
                                                                                    <label for="base" class="form-label">Base Price without GST</label>
                                                                                    <div class="input-group mb-3">
                                                                                        <span class="input-group-text fs-20"><i class="bx bx-rupee"></i></span>
                                                                                        <input type="text" id="base" name="base" class="form-control base" readonly>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-lg-6">
                                                                                    <label for="ship" class="form-label">Shipping Charges</label>
                                                                                    <div class="input-group mb-3">
                                                                                        <span class="input-group-text fs-20"><i class="bx bx-rupee"></i></span>
                                                                                        <input type="text" id="ship" name="ship" class="form-control" value="<?php echo $val['shipping_price']; ?>" disabled>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-lg-6">
                                                                                     <label for="b2b_discount" class="form-label">Wholesale Discount %</label>
                                                                                     <div class="input-group mb-3">
                                                                                          <span class="input-group-text fs-20"><i class="bx bxs-discount"></i></span>
                                                                                          <input type="text" id="b2b_discount" name="b2b_discount" class="form-control b2b_discount" value="<?php echo $val['b2b_discount']; ?>">
                                                                                     </div>
                                                                                </div>
                                                                                <div class="col-lg-6">
                                                                                     <label for="b2c_discount" class="form-label">Retail Discount %</label>
                                                                                     <div class="input-group mb-3">
                                                                                          <span class="input-group-text fs-20"><i class="bx bxs-discount"></i></span>
                                                                                          <input type="text" id="b2c_discount" name="b2c_discount" class="form-control b2c_discount" value="<?php echo $val['b2c_discount']; ?>">
                                                                                     </div>
                                                                                </div>
                                                                                <div class="col-lg-6">
                                                                                     <label for="b2b_price" class="form-label">Wholesale Price</label>
                                                                                     <div class="input-group mb-3">
                                                                                          <span class="input-group-text fs-20"><i class="bx bx-rupee"></i></span>
                                                                                          <input type="text" id="b2b_price" name="b2b_price" class="form-control b2b_price" value="<?php echo $val['b2b_price']; ?>">
                                                                                     </div>
                                                                                </div>
                                                                                <div class="col-lg-6">
                                                                                     <label for="b2c_price" class="form-label">Retail Price</label>
                                                                                     <div class="input-group mb-3">
                                                                                          <span class="input-group-text fs-20"><i class="bx bx-rupee"></i></span>
                                                                                          <input type="text" id="b2c_price" name="b2c_price" class="form-control b2c_price" value="<?php echo $val['b2c_price']; ?>">
                                                                                     </div>
                                                                                </div>
                                                                           </div>

                                                                           <h4 class="mt-2 text-center p-3 bg-light rounded">Product Image Upload</h4>
                                                                           <div class="row mt-4">
                                                                                <div class="col-lg-12 mb-3 d-flex justify-content-between">
                                                                                     <div>
                                                                                          <label for="image1" class="form-label">Product Image 1</label>
                                                                                          <input type="file" id="image1" name="image1" class="form-control" accept="image/*">
                                                                                     </div>
                                                                                     <div>
                                                                                          <div class="d-flex align-items-center">
                                                                                               <img src="uploads/products/<?php echo $val['image_1']; ?>" alt="Product Image" class="img-fluid me-3" style="max-height: 100px; border-radius: 10px;">
                                                                                          </div>
                                                                                     </div>
                                                                                </div>
                                                                                <div class="col-lg-12 mb-3 d-flex justify-content-between">
                                                                                     <div>
                                                                                          <label for="image2" class="form-label">Product Image 2</label>
                                                                                          <input type="file" id="image2" name="image2" class="form-control" accept="image/*">
                                                                                     </div>
                                                                                     <div>
                                                                                          <div class="d-flex align-items-center">
                                                                                               <img src="uploads/products/<?php echo $val['image_2']; ?>" alt="Product Image" class="img-fluid me-3" style="max-height: 100px; border-radius: 10px;">
                                                                                          </div>
                                                                                     </div>
                                                                                </div>
                                                                                <div class="col-lg-12 mb-3 d-flex justify-content-between">
                                                                                     <div>
                                                                                          <label for="image3" class="form-label">Product Image 3</label>
                                                                                          <input type="file" id="image3" name="image3" class="form-control" accept="image/*">
                                                                                     </div>
                                                                                     <div>
                                                                                          <div class="d-flex align-items-center">
                                                                                               <img src="uploads/products/<?php echo $val['image_3']; ?>" alt="Product Image" class="img-fluid me-3" style="max-height: 100px; border-radius: 10px;">
                                                                                          </div>
                                                                                     </div>
                                                                                </div>
                                                                                <div class="col-lg-12 mb-3 d-flex justify-content-between">
                                                                                     <div>
                                                                                          <label for="image4" class="form-label">Product Image 4</label>
                                                                                          <input type="file" id="image4" name="image4" class="form-control" accept="image/*">
                                                                                     </div>
                                                                                     <div>
                                                                                          <div class="d-flex align-items-center">
                                                                                               <img src="uploads/products/<?php echo $val['image_4']; ?>" alt="Product Image" class="img-fluid me-3" style="max-height: 100px; border-radius: 10px;">
                                                                                          </div>
                                                                                     </div>
                                                                                </div>
                                                                           </div>
                                                                           <button type="submit" class="btn btn-soft-primary mt-3 float-end p-2"><i class="bx bx-refresh me-1"></i>Update</button>
                                                                      </form>
                                                                 </div>
                                                            </div>
                                                       </div>
                                                  </div>
                                                  <!-- edit modal end -->
                                                   
                                                  <?php } ?>
                                             </tbody>
                                        </table>
                                   </div>
                                   <!-- table end -->

                                   <!-- total entries  -->
                                   <div class="card-footer border-top">
                                        <div class="row g-3">
                                             <div class="col-sm">
                                                  <div class="text-muted">
                                                  Total <span class="fw-semibold" id="totalProducts"><?php echo $totalProducts; ?></span> entries.
                                                  </div>
                                             </div>
                                        </div>
                                   </div>
                                   <!-- total entries  -->
                              </div>
                         </div>
                    </div>
               </div>
          </div>

          <?php include 'footer.php'; ?>
     </div>
  </div>


<!-- All necessary scripts are here  -->
<script>
     // edit stock ajax 
     $(document).ready(function () {
        $(".editProductForm").on("submit", function (e) {
            e.preventDefault();
            let formData = new FormData(this);
            $.ajax({
                url: "edit_refill.php",
                type: "POST",
                data: formData,
                contentType: false,
                processData: false,
                success: function (response) {
                        let res = JSON.parse(response);
                        if (res.status === "success") {
                            Toastify({
                            text: "Stock refilled successfully!",
                            duration: 3000,
                            gravity: "top",
                            position: "center",
                            backgroundColor: "#28a745",
                            }).showToast();
                            setTimeout(function(){
                                window.location.reload();
                            }, 1000);
                        } else {
                            Toastify({
                            text: res.message || "Something went wrong!",
                            duration: 3000,
                            gravity: "top",
                            position: "center",
                            backgroundColor: "#dc3545",
                            }).showToast();
                        }
                },
                error: function () {
                        Toastify({
                            text: "Server error! Try again later.",
                            duration: 3000,
                            gravity: "top",
                            position: "center",
                            backgroundColor: "#dc3545",
                        }).showToast();
                }
            });
        });
     });

     // b2b & b2c price calculation 
     document.addEventListener("DOMContentLoaded", function () {
          document.querySelectorAll(".product-row").forEach(function (row) {
               const mrpInput = row.querySelector(".mrp");
               const gstInput = row.querySelector(".gst");
               const baseInput = row.querySelector(".base");
               const b2bDiscountInput = row.querySelector(".b2b_discount");
               const b2cDiscountInput = row.querySelector(".b2c_discount");
               const b2bPriceInput = row.querySelector(".b2b_price");
               const b2cPriceInput = row.querySelector(".b2c_price");

               function calculatePrices() {
                    const mrp = parseFloat(mrpInput.value) || 0;
                    const gst = parseFloat(gstInput.value) || 0;
                    const b2bDiscount = parseFloat(b2bDiscountInput.value) || 0;
                    const b2cDiscount = parseFloat(b2cDiscountInput.value) || 0;

                    const basePrice = mrp / (1 + (gst / 100));
                    baseInput.value = basePrice.toFixed(2);

                    const b2bPrice = mrp - (mrp * (b2bDiscount / 100));
                    b2bPriceInput.value = b2bPrice.toFixed(2);

                    const b2cPrice = mrp - (mrp * (b2cDiscount / 100));
                    b2cPriceInput.value = b2cPrice.toFixed(2);
               }

               mrpInput.addEventListener("input", calculatePrices);
               gstInput.addEventListener("input", calculatePrices);
               b2bDiscountInput.addEventListener("input", calculatePrices);
               b2cDiscountInput.addEventListener("input", calculatePrices);
          });
     });

     // search by part ajax
     $('#searchForm').on('submit', function(e) {
          e.preventDefault();
          var part = $('#searchInput').val().trim();
          if(part === "") return;
          $.ajax({
               url: 'search_for_refill.php',
               type: 'GET',
               data: { part: part },
               success: function(response) {
                    try {
                         var res = JSON.parse(response);
                         if (res.status === 'success') {
                              $('#productTableBody').html(res.html);
                              Toastify({
                                   text: "Search completed successfully",
                                   duration: 3000,
                                   gravity: "top",
                                   position: "center",
                                   backgroundColor: "#28a745"
                              }).showToast();
                         } else {
                              Toastify({
                                   text: "Error: " + res.message,
                                   duration: 3000,
                                   gravity: "top",
                                   position: "center",
                                   backgroundColor: "#dc3545"
                              }).showToast();
                         }
                    } catch(e) {
                         Toastify({
                              text: "Unexpected error occurred",
                              duration: 3000,
                              gravity: "top",
                              position: "center",
                              backgroundColor: "#dc3545"
                         }).showToast();
                    }
               },
               error: function() {
                    Toastify({
                         text: "AJAX error occurred",
                         duration: 3000,
                         gravity: "top",
                         position: "center",
                         backgroundColor: "#dc3545"
                    }).showToast();
               }
          });
     });
</script>
<?php include 'footerlink.php'; ?>