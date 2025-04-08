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
                              <h3 class="page-title">Offline Sell</h3>
                              <ul class="breadcrumb">
                                   <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
                                   <li class="breadcrumb-item">Products</li>
                                   <li class="breadcrumb-item active">Offline Sell</li>
                              </ul>
                         </div>
                    </div>
               </div>

               <div class="row">
                    <div class="col-xl-12">
                            <div class="card">
                                <div class="card-header d-flex justify-content-between align-items-center gap-1">
                                    <h4 class="card-title flex-grow-1">All Product List</h4>
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
                                                       <th>Stock</th>
                                                       <th>Rating</th>
                                                       <th>Action</th>
                                                  </tr>
                                             </thead>
                                             <tbody>
                                                <?php
                                                    $cnt = 0;
                                                    $totalProducts = $obj->fetch("SELECT COUNT(*) AS total FROM products")[0]['total'];
                                                    $products = $obj->fetch("SELECT * FROM products ORDER BY id DESC");
                                                    foreach ($products as $val) {
                                                        $product_id = $val['id'];

                                                        $sql = "SELECT AVG(rating) AS avg_rating FROM product_reviews WHERE product_id = $product_id";
                                                        $result = $obj->fetch($sql);
                                                        $avg_rating = isset($result[0]['avg_rating']) ? round($result[0]['avg_rating'], 1) : 0;

                                                        $cnt++; 
                                                ?>
                                                <tr>
                                                    <td>
                                                        <div class="d-flex align-items-center gap-2">
                                                                <div class="rounded bg-light avatar-md d-flex align-items-center justify-content-center">
                                                                    <img src="uploads/products/<?php echo $val['image_1'] ?>" alt="" class="avatar-md rounded">
                                                                </div>
                                                                <div>
                                                                    <a href="javascript:void(0);" class="text-dark fw-medium fs-15"><?php echo $val['name'] ?></a>
                                                                </div>
                                                        </div>
                                                    </td>
                                                    <td><p class="text-muted"><?php echo $val['part'] ?></p></td>
                                                    <td><p class="text-muted"><?php echo $val['description'] ?></p></td>
                                                    <td>
                                                        <p class="mb-1 text-muted">B2B: <span class="text-dark fw-medium"> <?php echo $val['b2b_price'] ?> ₹</span></p>
                                                        <p class="mb-0 text-muted">B2C: <span class="text-dark fw-medium"> <?php echo $val['b2c_price'] ?> ₹</span></p>
                                                    </td>
                                                    <td><span class="text-dark fw-medium"><?php echo $val['stock'] ?></span></td>
                                                    <td>
                                                        <span class="badge p-1 bg-light text-dark fs-12 me-1"><i class="bx bxs-star align-text-top fs-14 text-warning me-1"></i> <?= $avg_rating ?></span>
                                                    </td>
                                                    <td>
                                                        <div class="d-flex flex-column gap-2">
                                                                <a href="product_details.php?product_id=<?= base64_encode($product_id); ?>" class="btn btn-light btn-sm">
                                                                      <iconify-icon icon="solar:eye-broken" class="align-middle fs-18"></iconify-icon>
                                                                 </a>
                                                                <button class="btn btn-soft-primary btn-sm edit-btn" data-bs-toggle="modal" data-bs-target="#editModal<?php echo $val['id']; ?>">
                                                                    Sell
                                                                </button>
                                                        </div>
                                                    </td>
                                                </tr>

                                                <!-- sell modal start  -->
                                                <div class="modal fade" id="editModal<?php echo $val['id']; ?>" tabindex="-1" aria-labelledby="editModalLabel<?php echo $val['id']; ?>" aria-hidden="true">
                                                    <div class="modal-dialog modal-lg modal-dialog-centered">
                                                        <div class="modal-content">
                                                            <div class="modal-header bg-light">
                                                                <h4 class="modal-title" id="editModalLabel<?php echo $val['id']; ?>">Sell Product</h4>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <form class="editProductForm" enctype="multipart/form-data">
                                                                    <input type="hidden" name="product_id" value="<?php echo $val['id']; ?>">
                                                                    <h4 class="mt-2 text-center p-3 bg-light rounded">Order Details</h4>
                                                                    <div class="row mt-4">
                                                                        <div class="col-lg-6">
                                                                            <div class="mb-3">
                                                                                <label for="part_no" class="form-label">Part Number</label>
                                                                                <input type="text" id="part_no" name="part_no" class="form-control" value="<?php echo $val['part']; ?>" readonly>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-lg-6">
                                                                            <div class="mb-3">
                                                                                <label for="stock" class="form-label">Stock</label>
                                                                                <input type="number" id="stock" name="stock" class="form-control" value="<?php echo $val['stock']; ?>" readonly>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-lg-6">
                                                                            <div class="mb-3">
                                                                                <label for="type_<?php echo $val['id']; ?>" class="form-label">Choose Type <span style="color: red;">*</span></label>
                                                                                <select id="type_<?php echo $val['id']; ?>" name="type" class="form-control type-select" data-b2b-price="<?php echo $val['b2b_price']; ?>" data-b2c-price="<?php echo $val['b2c_price']; ?>" required>
                                                                                    <option value="">Select Type</option>
                                                                                    <option value="B2B">B2B</option>
                                                                                    <option value="B2C">B2C</option>
                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-lg-6">
                                                                            <label for="price_<?php echo $val['id']; ?>" class="form-label">Price</label>
                                                                            <div class="input-group mb-3">
                                                                                <span class="input-group-text fs-20"><i class="bx bx-rupee"></i></span>
                                                                                <input type="text" id="price_<?php echo $val['id']; ?>" name="price" class="form-control price-input" value="" readonly>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-lg-6">
                                                                            <label for="qty_<?php echo $val['id']; ?>" class="form-label">Quantity</label>
                                                                            <div class="input-group mb-3">
                                                                                <span class="input-group-text fs-20"><i class="bx bx-list-ol"></i></span>
                                                                                <input type="number" id="qty_<?php echo $val['id']; ?>" name="qty" class="form-control qty-input" min="1" required>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-lg-6">
                                                                            <label for="totalPrice_<?php echo $val['id']; ?>" class="form-label">Total Price</label>
                                                                            <div class="input-group mb-3">
                                                                                <span class="input-group-text fs-20"><i class="bx bx-rupee"></i></span>
                                                                                <input type="text" id="totalPrice_<?php echo $val['id']; ?>" name="totalPrice" class="form-control total-price-input" readonly>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-lg-6">
                                                                            <div class="mb-3">
                                                                                <label for="date" class="form-label">Date</label>
                                                                                <input type="date" id="date" name="date" class="form-control">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <button type="submit" class="btn btn-soft-primary mt-3 float-end py-2 px-3"><i class="bx bx-cart me-1"></i>Sell</button>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- sell modal end -->
                                                   
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
    $(document).ready(function () {
        // ajax to dynamically fetch price and auto calculate total price
        $(".type-select").on("change", function () {
            let selectedType = $(this).val();
            let b2bPrice = $(this).data("b2b-price");
            let b2cPrice = $(this).data("b2c-price");

            let priceInput = $(this).closest(".row").find(".price-input");

            if (selectedType === "B2B") {
                priceInput.val(b2bPrice);
            } else if (selectedType === "B2C") {
                priceInput.val(b2cPrice);
            } else {
                priceInput.val("");
            }
            $(this).closest(".row").find(".qty-input").trigger("input");
        });
        $(".qty-input").on("input", function () {
            let qty = parseInt($(this).val()) || 0;
            let price = parseFloat($(this).closest(".row").find(".price-input").val()) || 0;
            let totalPrice = qty * price;
            $(this).closest(".row").find(".total-price-input").val(totalPrice.toFixed(2));
        });

        // sell product ajax 
        $(".editProductForm").on("submit", function (e) {
            e.preventDefault();
            let formData = new FormData(this);
            $.ajax({
                url: "sell_update.php",
                type: "POST",
                data: formData,
                contentType: false,
                processData: false,
                success: function (response) {
                    let res = JSON.parse(response);
                    Toastify({
                        text: res.message || "Something went wrong!", 
                        duration: 3000,
                        gravity: "top",
                        position: "center",
                        backgroundColor: res.status === "success" ? "#28a745" : "#dc3545",  
                    }).showToast();
                    if (res.status === "success") {
                        setTimeout(function(){
                            window.location.reload();
                        }, 1000);
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
</script>
<?php include 'footerlink.php'; ?>