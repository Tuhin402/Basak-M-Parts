<?php
include 'session_config.php';
if(empty($_SESSION['user_email'])){
    echo '<script>window.location.href="login.php"</script>';
}
include "config.php";
include 'headerlink.php'; 
?>

<body>

  <div class="wrapper">
    <?php include 'header.php'; ?>
    <?php include 'sidebar.php'; ?>

     <div class="page-content">
          <div class="container-xxl">
               <!-- Page Header -->
               <div class="page-header my-3">
                    <div class="row align-items-center">
                         <div class="col">
                              <h3 class="page-title">Create Product</h3>
                              <ul class="breadcrumb">
                                   <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
                                   <li class="breadcrumb-item">Products</li>
                                   <li class="breadcrumb-item active">Create Product</li>
                              </ul>
                         </div>
                    </div>
               </div>

               <div class="row">
                    <div class="col-xl-12 col-lg-12 ">
                         <div class="card">
                              <div class="card-header">
                                   <h3 class="card-title">Add Product</h3>
                              </div>
                              <div class="card-body">
                                   <!-- form start 
                                   ===================================== -->
                                   <form id="productAddForm" novalidate>
                                        <h4 class="mt-4 text-center p-3 bg-light rounded">Product Details</h4>
                                        <div class="row mt-4">
                                             <div class="col-lg-4">
                                                  <div class="mb-3">
                                                       <label for="product_name" class="form-label">Product Name <span style="color:red;">*</span></label>
                                                       <input type="text" id="product_name" name="product_name" class="form-control" placeholder="Product Name" required>
                                                  </div>
                                             </div>
                                             <div class="col-lg-4">
                                                  <label for="product_category" class="form-label">Category <span style="color:red;">*</span></label>
                                                  <select class="form-control" id="product_category" name="product_category" required>
                                                       <option selected disabled>Select Category</option>
                                                       <?php
                                                            $sql = "SELECT * FROM product_category ORDER BY id";
                                                            $cats = $obj->fetch($sql);
                                                            foreach ($cats as $cat) {
                                                                 echo "<option value='" . $cat['id'] . "'>" . htmlspecialchars($cat['category']) . "</option>";
                                                            }
                                                       ?>
                                                  </select>
                                             </div>
                                             <div class="col-lg-4">
                                                  <label for="product_company" class="form-label">Company <span style="color:red;">*</span></label>
                                                  <select class="form-control" id="product_company" name="product_company" required>
                                                       <option selected disabled>Select Company</option>
                                                       <?php
                                                            $sql = "SELECT * FROM company ORDER BY id";
                                                            $comps = $obj->fetch($sql);
                                                            foreach ($comps as $comp) {
                                                                 echo "<option value='" . $comp['id'] . "'>" . htmlspecialchars($comp['name']) . "</option>";
                                                            }
                                                       ?>
                                                  </select>
                                             </div>
                                        </div>
                                        <div class="row">
                                             <div class="col-lg-12">
                                                  <div class="mb-3">
                                                       <label for="des" class="form-label">Description <span style="color:red;">*</span></label>
                                                       <textarea class="form-control bg-light-subtle" id="des" name="des" rows="7" placeholder="Short description about the product" required></textarea>
                                                  </div>
                                             </div>
                                        </div>

                                        <h4 class="mt-4 text-center p-3 bg-light rounded">Stock Details</h4>
                                        <div class="row mt-4">
                                             <div class="col-lg-6">
                                                  <div class="mb-3">
                                                       <label for="sku_no" class="form-label">HSN Number <span style="color:red;">*</span></label>
                                                       <input type="text" id="sku_no" name="sku_no" class="form-control" placeholder="25544**" required>
                                                  </div>
                                             </div>
                                             <div class="col-lg-6">
                                                  <div class="mb-3">
                                                       <label for="part_no" class="form-label">Part Number <span style="color:red;">*</span></label>
                                                       <input type="text" id="part_no" name="part_no" class="form-control" placeholder="#54A6**" required>
                                                  </div>
                                             </div>
                                             <div class="col-lg-6">
                                                  <div class="mb-3">
                                                       <label for="stock" class="form-label">Stock <span style="color:red;">*</span></label>
                                                       <input type="number" id="stock" name="stock" class="form-control" placeholder="Quantity of product" required>
                                                  </div>
                                             </div>
                                             <div class="col-lg-6">
                                                  <label for="best_seller" class="form-label">Mark as Best Seller</label>
                                                  <select class="form-control" id="best_seller" name="best_seller">
                                                       <option selected disabled>Choose an option</option>
                                                       <option value="yes">Yes</option>
                                                       <option value="no">No</option>
                                                  </select>
                                             </div>
                                        </div>

                                        <h4 class="mt-4 text-center p-3 bg-light rounded">Pricing Details</h4>
                                        <div class="row mt-4">
                                             <div class="col-lg-6">
                                                  <label for="mrp" class="form-label">M.R.P Price <span style="color:red;">*</span></label>
                                                  <div class="input-group mb-3">
                                                       <span class="input-group-text fs-20"><i class="bx bx-rupee"></i></span>
                                                       <input type="number" id="mrp" name="mrp" class="form-control" placeholder="000" required>
                                                  </div>
                                             </div>
                                             <div class="col-lg-6">
                                                  <label for="gst" class="form-label">G.S.T % <span style="color:red;">*</span></label>
                                                  <div class="input-group mb-3">
                                                       <span class="input-group-text fs-20"><i class="bx bx-rupee"></i></span>
                                                       <input type="number" id="gst" name="gst" class="form-control" placeholder="000" required>
                                                  </div>
                                             </div>
                                             <div class="col-lg-6">
                                                  <label for="base" class="form-label">Base Price without GST <span style="color:red;">*</span></label>
                                                  <div class="input-group mb-3">
                                                       <span class="input-group-text fs-20"><i class="bx bx-rupee"></i></span>
                                                       <input type="number" id="base" name="base" class="form-control" placeholder="000" readonly>
                                                  </div>
                                             </div>
                                             <div class="col-lg-6">
                                                  <label for="ship" class="form-label">Shipping Charges</label>
                                                  <div class="input-group mb-3">
                                                       <span class="input-group-text fs-20"><i class="bx bx-rupee"></i></span>
                                                       <input type="number" id="ship" name="ship" class="form-control" placeholder="000">
                                                  </div>
                                             </div>
                                             <div class="col-lg-6">
                                                  <label for="b2b_discount" class="form-label">Wholesale Discount %</label>
                                                  <div class="input-group mb-3">
                                                       <span class="input-group-text fs-20"><i class="bx bxs-discount"></i></span>
                                                       <input type="number" id="b2b_discount" name="b2b_discount" class="form-control" placeholder="000">
                                                  </div>
                                             </div>
                                             <div class="col-lg-6">
                                                  <label for="b2c_discount" class="form-label">Retail Discount %</label>
                                                  <div class="input-group mb-3">
                                                       <span class="input-group-text fs-20"><i class="bx bxs-discount"></i></span>
                                                       <input type="number" id="b2c_discount" name="b2c_discount" class="form-control" placeholder="000">
                                                  </div>
                                             </div>
                                             <div class="col-lg-6">
                                                  <label for="b2b_price" class="form-label">Wholesale Price <span style="color:red;">*</span></label>
                                                  <div class="input-group mb-3">
                                                       <span class="input-group-text fs-20"><i class="bx bx-rupee"></i></span>
                                                       <input type="text" id="b2b_price" name="b2b_price" class="form-control" placeholder="000" readonly>
                                                  </div>
                                             </div>
                                             <div class="col-lg-6">
                                                  <label for="b2c_price" class="form-label">Retail Price <span style="color:red;">*</span></label>
                                                  <div class="input-group mb-3">
                                                       <span class="input-group-text fs-20"><i class="bx bx-rupee"></i></span>
                                                       <input type="text" id="b2c_price" name="b2c_price" class="form-control" placeholder="000" readonly>
                                                  </div>
                                             </div>
                                             <div class="col-lg-6">
                                                  <label for="b2c_special_discount" class="form-label">Retail Special Discount %</label>
                                                  <div class="input-group mb-3">
                                                       <span class="input-group-text fs-20"><i class="bx bxs-discount"></i></span>
                                                       <input type="number" id="b2c_special_discount" name="b2c_special_discount" class="form-control" placeholder="000">
                                                  </div>
                                             </div>
                                        </div>

                                        <h4 class="mt-4 text-center p-3 bg-light rounded">Product Image Upload</h4>
                                        <div class="row mt-4">
                                             <div class="col-lg-6">
                                                  <div class="mb-3">
                                                       <label for="image1" class="form-label">Product Image 1 <span style="color:red;">*</span></label>
                                                       <input type="file" id="image1" name="image1" class="form-control" accept="image/*" required>
                                                  </div>
                                             </div>
                                             <div class="col-lg-6">
                                                  <div class="mb-3">
                                                       <label for="image2" class="form-label">Product Image 2</label>
                                                       <input type="file" id="image2" name="image2" class="form-control" accept="image/*">
                                                  </div>
                                             </div>
                                             <div class="col-lg-6">
                                                  <div class="mb-3">
                                                       <label for="image3" class="form-label">Product Image 3</label>
                                                       <input type="file" id="image3" name="image3" class="form-control" accept="image/*">
                                                  </div>
                                             </div>
                                             <div class="col-lg-6">
                                                  <div class="mb-3">
                                                       <label for="image4" class="form-label">Product Image 4</label>
                                                       <input type="file" id="image4" name="image4" class="form-control" accept="image/*">
                                                  </div>
                                             </div>
                                        </div>

                                        <div class="p-3 bg-light my-3 rounded">
                                             <div class="row justify-content-end g-2">
                                                  <div class="col-lg-2">
                                                       <button type="submit" class="btn btn-soft-primary w-100">Create Product</button>
                                                  </div>
                                                  <div class="col-lg-2">
                                                       <button type="reset" class="btn btn-soft-secondary w-100">Cancel</button>
                                                  </div>
                                             </div>
                                        </div>
                                   </form>
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
     // b2b & b2c price calculation 
     document.addEventListener("DOMContentLoaded", function () {
          const mrpInput = document.getElementById("mrp");
          const gstInput = document.getElementById("gst");
          const basePriceInput = document.getElementById("base");
          const b2bDiscountInput = document.getElementById("b2b_discount");
          const b2cDiscountInput = document.getElementById("b2c_discount");
          const b2bPriceInput = document.getElementById("b2b_price");
          const b2cPriceInput = document.getElementById("b2c_price");

          function calculateBasePrice() {
               const mrp = parseFloat(mrpInput.value) || 0;
               const gst = parseFloat(gstInput.value) || 0;

               const basePrice = mrp / (1 + (gst / 100));
               basePriceInput.value = basePrice.toFixed(2);

               calculatePrices();
          }

          function calculatePrices() {
               const mrpPrice = parseFloat(mrpInput.value) || 0;
               const b2bDiscount = parseFloat(b2bDiscountInput.value) || 0;
               const b2cDiscount = parseFloat(b2cDiscountInput.value) || 0;

               const b2bPrice = mrpPrice - (mrpPrice * (b2bDiscount / 100));
               b2bPriceInput.value = b2bPrice.toFixed(2);

               const b2cPrice = mrpPrice - (mrpPrice * (b2cDiscount / 100));
               b2cPriceInput.value = b2cPrice.toFixed(2);
          }

          mrpInput.addEventListener("input", calculateBasePrice);
          gstInput.addEventListener("input", calculateBasePrice);

          b2bDiscountInput.addEventListener("input", calculatePrices);
          b2cDiscountInput.addEventListener("input", calculatePrices);
     });

     // add ajax 
     $(document).ready(function () {
          $("#productAddForm").on("submit", function (e) {
               e.preventDefault();
               let formData = new FormData(this);
               $.ajax({
                    url: "add_product.php",
                    type: "POST",
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function (response) {
                         let res = JSON.parse(response);
                         if (res.status === "success") {
                              Toastify({
                              text: res.message,
                              duration: 2000,
                              gravity: "top",
                              position: "center",
                              backgroundColor: "green",
                              }).showToast();
                              $("#productAddForm")[0].reset();
                         } else {
                              Toastify({
                              text: res.message,
                              duration: 2000,
                              gravity: "top",
                              position: "center",
                              backgroundColor: "red",
                              }).showToast();
                         }
                    },
                    error: function () {
                         Toastify({
                              text: "Something went wrong!",
                              duration: 2000,
                              gravity: "top",
                              position: "center",
                              backgroundColor: "red",
                         }).showToast();
                    },
               });
          });
     });
</script>
<?php include 'footerlink.php'; ?>