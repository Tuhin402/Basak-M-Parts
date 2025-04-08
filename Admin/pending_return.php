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

        <!-- Start right Content here -->
        <!-- ==================================================== -->
        <div>
            <div class="page-content">
                
                <div class="container-xxl">
                    <!-- Page Header -->
                    <div class="page-header my-3">
                        <div class="row align-items-center">
                            <div class="col">
                                <h3 class="page-title">Pending Returns</h3>
                                <ul class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
                                    <li class="breadcrumb-item">Order Return</li>
                                    <li class="breadcrumb-item active">Pending Returns</li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-xl-12">
                            <div class="card">
                                <div class="d-flex card-header justify-content-between align-items-center">
                                    <div><h4 class="card-title">Pending Return List</h4></div>
                                </div>
                                <div class="card-body p-0">
                                    <div class="table-responsive">
                                        <table class="table align-middle mb-0 table-hover table-centered">
                                            <thead class="bg-light-subtle">
                                                <tr>
                                                    <th>Order ID</th>
                                                    <th>Canceled at</th>
                                                    <th>Customer</th>
                                                    <th>Type</th>
                                                    <th>Bank Name</th>
                                                    <th>Account No.</th>
                                                    <th>IFSC Code</th>
                                                    <th>Branch Address</th>
                                                    <th>Reason</th>
                                                    <th>Return Status</th>
                                                    <th>Payment Status</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $cancels = $obj->fetch("SELECT * FROM order_refund WHERE refund_status = 'Request Return' ORDER BY date DESC");
                                                foreach ($cancels as $val) { 
                                                    $cancel_id = $val['id'];
                                                    $order_id = $val['order_id'];    
                                                    $shiprocket_order_id = $val['shiprocket_order_id'];                                                
                                                    $typeClass = $val['type'] == "b2c" ? "border-primary text-primary" : ($val['type'] == "b2b" ? "border-info text-info" : "");

                                                    $statusClass = "";
                                                    if($val['refund_status'] == "Request Return") {
                                                        $statusClass = "bg-warning"; 
                                                    } elseif($val['refund_status'] == "Return Approved") {
                                                        $statusClass = "bg-success";
                                                    } else {
                                                        $statusClass = "bg-danger";
                                                    }

                                                    $payStatus = $val['payment_status'] == "paid" ? "border-success text-success" : ($val['payment_status'] == "cod" ? "border-danger text-danger" : "");

                                                    $refund_status = "";
                                                    if($val['refund_status'] == "Request Return") {
                                                        $refund_status = "Pending"; 
                                                    } elseif($val['refund_status'] == "Return Approved") {
                                                        $refund_status = "Refunded";
                                                    } else {
                                                        $refund_status = "Rejected";
                                                    }
                                                ?>
                                                <tr>
                                                    <td><a class="fw-semibold" href="order_details.php?order_id=<?= base64_encode($order_id); ?>">#<?= $order_id; ?></a></td>
                                                    <td><?= date("d M, Y", strtotime($val['date'])); ?></td>
                                                    <td><a href="javascript:void(0);" class="link-primary fw-medium"><?= $val['banking_name']; ?></a></td>
                                                    <td><span class="badge border <?= $typeClass; ?>  px-2 py-1 fs-13"><?= $val['type']; ?></span></td>
                                                    <td><?= $val['bank_name']; ?></td>
                                                    <td><a href="javascript:void(0);" class="fw-semibold"><?= $val['acc_no']; ?></a></td>
                                                    <td><?= $val['ifsc']; ?></td>
                                                    <td><?= $val['branch_add']; ?></td>
                                                    <td><?= $val['des']; ?></td>
                                                    <td><span class="badge <?= $statusClass; ?> text-light px-2 py-1 fs-13"><?= $refund_status; ?></span></td>
                                                    <td><span class="badge border <?= $payStatus; ?>  px-2 py-1 fs-13"><?= $val['payment_status']; ?></span></td>
                                                    <td>
                                                        <div class="d-flex flex-column gap-2">
                                                            <button class="btn btn-light btn-sm view-btn" data-bs-toggle="modal" data-bs-target="#viewModal<?= $cancel_id; ?>">
                                                                <iconify-icon icon="solar:eye-broken" class="align-middle fs-18"></iconify-icon>
                                                            </button>
                                                            <button class="btn btn-soft-warning btn-sm refund-btn" data-bs-toggle="modal" data-bs-target="#refundModal<?= $cancel_id; ?>">
                                                                <iconify-icon icon="solar:card-transfer-broken" class="align-middle fs-18"></iconify-icon>
                                                            </button>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <?php } ?>
                                            </tbody>
                                        </table> 

                                        <!-- Refund Modal -->
                                        <?php
                                        $cancels = $obj->fetch("SELECT * FROM order_refund WHERE refund_status = 'Request Return' ORDER BY date DESC");
                                        foreach ($cancels as $val) { 
                                            $cancel_id = $val['id'];
                                            $order_id = $val['order_id'];
                                            $shiprocket_order_id = $val['shiprocket_order_id'];
                                        ?>
                                        <div class="modal fade" id="refundModal<?= $cancel_id; ?>" tabindex="-1" aria-labelledby="refundModalLabel<?= $cancel_id; ?>" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content shadow-sm">
                                                    <form id="refundForm<?= $cancel_id; ?>" enctype="multipart/form-data">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="refundModalLabel<?= $cancel_id; ?>">Confirm Return</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <input type="hidden" name="cancel_id" value="<?= $cancel_id; ?>">
                                                            <input type="hidden" name="order_id" value="<?= $order_id; ?>">
                                                            <input type="hidden" name="shiprocket_order_id" value="<?= $shiprocket_order_id; ?>">
                                                            <h4 class="mb-4 text-center p-3 bg-light rounded">Authentication & Verify</h4>
                                                            <div class="row g-3">
                                                                <div class="col-lg-12">
                                                                    <div class="form-group">
                                                                        <label for="admin_notice<?= $cancel_id; ?>" class="form-label">Admin Notice</label>
                                                                        <textarea class="form-control" id="admin_notice<?= $cancel_id; ?>" name="admin_notice" rows="3" placeholder="Enter admin notice..."></textarea>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-12">
                                                                    <div class="form-group">
                                                                        <label for="support_document<?= $cancel_id; ?>" class="form-label">Upload Supporting Document</label>
                                                                        <input type="file" class="form-control" id="support_document<?= $cancel_id; ?>" name="support_document" accept=".pdf,.jpg,.jpeg,.doc,.docx">
                                                                        <div class="alert alert-info mt-2 text-wrap">
                                                                            <iconify-icon icon="bi:info-circle" class="align-middle fs-18 me-1"></iconify-icon>
                                                                            <span class="fw-medium">Acceptable document formats: <strong>PDF, JPG, JPEG, DOCX</strong>.</span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <input type="hidden" name="action" value="">
                                                            <button type="button" id="rejectBtn<?= $cancel_id; ?>" class="btn btn-outline-secondary px-3 py-2 rounded-pill fw-bold">Reject</button>
                                                            <?php if($val['payment_status'] == 'paid'): ?>
                                                            <button type="button" id="approveBtn<?= $cancel_id; ?>" class="btn btn-outline-primary px-3 py-2 rounded-pill fw-bold">Approve</button>
                                                            <?php else: ?>
                                                            <button type="button" id="approveBtn<?= $cancel_id; ?>" class="btn btn-outline-danger px-3 py-2 rounded-pill fw-bold">Yes, Approve</button>
                                                            <?php endif; ?>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                        <?php } ?>
                                        <!-- /Refund Modal -->

                                        <!-- view modal -->
                                        <?php
                                        $cancels = $obj->fetch("SELECT * FROM order_refund WHERE refund_status = 'Request Return' ORDER BY date DESC");
                                        foreach ($cancels as $val) { 
                                            $cancel_id = $val['id'];
                                            $order_id = $val['order_id'];
                                            $products = $obj->fetch("SELECT product_name, SUM(quantity) AS quantity, price, SUM(total_price) AS total_price FROM orders WHERE order_id = '$order_id' GROUP BY product_name, price");
                                            $totalPrice = 0;
                                        ?>
                                        <div class="modal fade" id="viewModal<?= $cancel_id; ?>" tabindex="-1" aria-labelledby="viewModalLabel<?= $cancel_id; ?>" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered modal-lg">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="viewModalLabel<?= $cancel_id; ?>">Order Details - #<?= $order_id; ?></h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <table class="table table-bordered table-striped table-hovered">
                                                            <thead>
                                                                <tr class="fw-bold">
                                                                    <th>Product Name</th>
                                                                    <th>Quantity</th>
                                                                    <th>Price (₹)</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <?php foreach ($products as $product) { 
                                                                    $totalPrice += $product['total_price']; ?>
                                                                    <tr>
                                                                        <td class="fw-semibold"><?= $product['product_name']; ?></td>
                                                                        <td><?= $product['quantity']; ?></td>
                                                                        <td class="text-success fw-semibold">₹<?= $product['price']; ?></td>
                                                                    </tr>
                                                                <?php } ?>
                                                                <tr>
                                                                    <td colspan="2" class="text-end fw-bold">Total Price (₹)</td>
                                                                    <td class="text-success fw-semibold">₹<?= $totalPrice; ?></td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                        <div class="card">
                                                            <div class="card-header">
                                                                <h4 class="text-title">Product Images</h4>
                                                                <?php
                                                                $imageSql = "SELECT image_1, image_2, image_3, image_4 FROM order_refund WHERE refund_status = 'Request Return' AND order_id = '$order_id' ORDER BY date DESC";
                                                                $images = $obj->fetch($imageSql);
                                                                ?>
                                                                <div class="row g-2">
                                                                    <div class="col-6 col-lg-3 col-md-4 col-sm-6">
                                                                        <img src="<?= $images[0]['image_1'] ?>" alt="product-image" class="image-fluid lazy-load rounded w-100" style="object-fit: cover;">
                                                                    </div>
                                                                    <div class="col-6 col-lg-3 col-md-4 col-sm-6">
                                                                        <img src="<?= $images[0]['image_2'] ?>" alt="product-image" class="image-fluid lazy-load rounded w-100" style="object-fit: cover;">
                                                                    </div>
                                                                    <div class="col-6 col-lg-3 col-md-4 col-sm-6">
                                                                        <img src="<?= $images[0]['image_3'] ?>" alt="product-image" class="image-fluid lazy-load rounded w-100" style="object-fit: cover;">
                                                                    </div>
                                                                    <div class="col-6 col-lg-3 col-md-4 col-sm-6">
                                                                        <img src="<?= $images[0]['image_4'] ?>" alt="product-image" class="image-fluid lazy-load rounded w-100" style="object-fit: cover;">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <?php } ?>
                                        <!-- /view modal -->

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <?php include 'footer.php'; ?>
            </div>
        </div>
    </div>
    <!-- END Wrapper -->


<!-- All Ncessary scripts are here -->
<script>
    // ajax for return ================================================
    // for approve
    document.querySelectorAll("button[id^='approveBtn']").forEach(btn => {
        btn.addEventListener("click", function(e) {
            e.preventDefault();
            const form = btn.closest("form");
            if (!form) {
                console.error("Form not found for approve button.");
                return;
            }
            const actionInput = form.querySelector('input[name="action"]');
            if (!actionInput) {
                console.error("Hidden action input not found in form.");
                return;
            }
            actionInput.value = "approve";
            let formData = new FormData(form);
            fetch("update_return.php", {
                method: "POST",
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if(data.success) {
                    Toastify({
                        text: data.message,
                        duration: 3000,
                        gravity: "top",
                        position: "center",
                        backgroundColor: "green"
                    }).showToast();
                    setTimeout(() => {
                        location.reload();
                    }, 1500);
                } else {
                    Toastify({
                        text: data.message,
                        duration: 3000,
                        gravity: "top",
                        position: "center",
                        backgroundColor: "red"
                    }).showToast();
                }
            })
            .catch(error => {
                Toastify({
                    text: "Error updating refund",
                    duration: 3000,
                    gravity: "top",
                    position: "center",
                    backgroundColor: "red"
                }).showToast();
                console.error("Error:", error);
            });
        });
    });

    // for reject
    document.querySelectorAll("button[id^='rejectBtn']").forEach(btn => {
        btn.addEventListener("click", function(e) {
            e.preventDefault();
            const form = btn.closest("form");
            if (!form) {
                console.error("Form not found for reject button.");
                return;
            }
            const actionInput = form.querySelector('input[name="action"]');
            if (!actionInput) {
                console.error("Hidden action input not found in form.");
                return;
            }
            actionInput.value = "reject";
            let formData = new FormData(form);
            fetch("update_return.php", {
                method: "POST",
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if(data.success) {
                    Toastify({
                        text: data.message,
                        duration: 3000,
                        gravity: "top",
                        position: "center",
                        backgroundColor: "green"
                    }).showToast();
                    setTimeout(() => {
                        location.reload();
                    }, 1500);
                } else {
                    Toastify({
                        text: data.message,
                        duration: 3000,
                        gravity: "top",
                        position: "center",
                        backgroundColor: "red"
                    }).showToast();
                }
            })
            .catch(error => {
                Toastify({
                    text: "Error updating refund",
                    duration: 3000,
                    gravity: "top",
                    position: "center",
                    backgroundColor: "red"
                }).showToast();
                console.error("Error:", error);
            });
        });
    });
</script>
<?php include 'footerlink.php'; ?>