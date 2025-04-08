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
                                <h3 class="page-title">Completed Cancellations</h3>
                                <ul class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
                                    <li class="breadcrumb-item">Order Cancellation</li>
                                    <li class="breadcrumb-item active">Completed Cancellations</li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-xl-12">
                            <div class="card">
                                <div class="d-flex card-header justify-content-between align-items-center">
                                    <div><h4 class="card-title">Completed Cancellation List</h4></div>
                                </div>
                                <div class="card-body p-0">
                                    <div class="table-responsive">
                                        <table class="table align-middle mb-0 table-hover table-centered">
                                            <thead class="bg-light-subtle">
                                                <tr>
                                                    <th>Order ID</th>
                                                    <th>Customer</th>
                                                    <th>Type</th>
                                                    <th>Bank Name</th>
                                                    <th>Account No.</th>
                                                    <th>IFSC Code</th>
                                                    <th>Branch Address</th>
                                                    <th>Reason</th>
                                                    <th>Order Status</th>
                                                    <th>Payment Status</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $cancels = $obj->fetch("SELECT * FROM order_cancel WHERE order_status != 'Request Cancellation' ORDER BY date DESC");
                                                foreach ($cancels as $val) { 
                                                    $cancel_id = $val['id'];
                                                    $order_id = $val['order_id'];                                                      
                                                    $typeClass = $val['type'] == "b2c" ? "border-primary text-primary" : ($val['type'] == "b2b" ? "border-info text-info" : "");

                                                    $statusClass = "";
                                                    if($val['order_status'] == "Request Cancellation") {
                                                        $statusClass = "bg-warning"; 
                                                    } elseif($val['order_status'] == "Cancellation Approved") {
                                                        $statusClass = "bg-success";
                                                    } else {
                                                        $statusClass = "bg-danger";
                                                    }

                                                    $payStatus = $val['payment_status'] == "paid" ? "border-success text-success" : ($val['payment_status'] == "cod" ? "border-danger text-danger" : "");

                                                    $order_status = "";
                                                    if($val['order_status'] == "Request Cancellation") {
                                                        $order_status = "Pending"; 
                                                    } elseif($val['order_status'] == "Cancellation Approved") {
                                                        $order_status = "Refunded";
                                                    } else {
                                                        $order_status = "Rejected";
                                                    }
                                                ?>
                                                <tr>
                                                    <td><a class="fw-semibold" href="order_details.php?order_id=<?= base64_encode($order_id); ?>">#<?= $order_id; ?></a></td>
                                                    <td><a href="javascript:void(0);" class="link-primary fw-medium"><?= $val['banking_name']; ?></a></td>
                                                    <td><span class="badge border <?= $typeClass; ?>  px-2 py-1 fs-13"><?= $val['type']; ?></span></td>
                                                    <td><?= $val['bank_name']; ?></td>
                                                    <td><a href="javascript:void(0);" class="fw-semibold"><?= $val['acc_no']; ?></a></td>
                                                    <td><?= $val['ifsc']; ?></td>
                                                    <td><?= $val['branch_add']; ?></td>
                                                    <td><?= $val['des']; ?></td>
                                                    <td><span class="badge <?= $statusClass; ?> text-light px-2 py-1 fs-13"><?= $order_status; ?></span></td>
                                                    <td><span class="badge border <?= $payStatus; ?>  px-2 py-1 fs-13"><?= $val['payment_status']; ?></span></td>
                                                    <td>
                                                        <div class="d-flex flex-column gap-2">
                                                            <button class="btn btn-light btn-sm view-btn" data-bs-toggle="modal" data-bs-target="#viewModal<?php echo $val['id']; ?>">
                                                                <iconify-icon icon="solar:eye-broken" class="align-middle fs-18"></iconify-icon>
                                                            </button>
                                                        </div>
                                                    </td>
                                                </tr>

                                                <?php } ?>
                                            </tbody>
                                        </table>

                                        <!-- view modal -->
                                        <?php
                                        $cancels = $obj->fetch("SELECT * FROM order_cancel WHERE order_status != 'Request Cancellation' ORDER BY date DESC");
                                        foreach ($cancels as $val) { 
                                            $cancel_id = $val['id'];
                                            $order_id = $val['order_id'];    
                                            $products = $obj->fetch("SELECT product_name, SUM(quantity) AS quantity, price, SUM(total_price) AS total_price FROM orders WHERE order_id = '$order_id' GROUP BY product_name, price");
                                            $totalPrice = 0;
                                        ?>
                                        <div class="modal fade" id="viewModal<?= $val['id']; ?>" tabindex="-1" aria-labelledby="viewModalLabel<?= $val['id']; ?>" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content shadow-lg border-0 rounded-3">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title fw-bold" id="viewModalLabel<?= $val['id']; ?>">
                                                            <i class="bi bi-receipt-cutoff me-2"></i> Admin Notice
                                                        </h5>
                                                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body p-4">
                                                        <div class="row g-2">
                                                            <div class="col-12">
                                                                <div class="alert alert-info d-flex align-items-center text-wrap" role="alert">
                                                                    <i class="bi bi-info-circle-fill me-2"></i>
                                                                    <div class="text-wrap"><strong>Admin Notice: &nbsp;&nbsp;</strong> <?= $val['admin_notice']; ?></div>
                                                                </div>
                                                            </div>
                                                            <div class="col-12">
                                                                <?php if($val['admin_proof'] != "-") { ?>
                                                                <div class="card border-0">
                                                                    <div class="card-body p-3">
                                                                        <h5 class="card-title fw-semibold mb-2 d-flex align-items-center justify-content-start text-wrap">
                                                                            <iconify-icon icon="solar:file-bold-duotone" class="text-primary fs-3 me-2"></iconify-icon> Supporting Document
                                                                        </h5>
                                                                        <p class="text-muted mb-3 text-wrap">View the official document uploaded by the admin.</p>
                                                                        <a href="uploads/proof/<?= $val['admin_proof']; ?>" target="_blank" class="btn btn-soft-primary fw-semibold px-3 py-2 rounded-pill">
                                                                            <i class="bi bi-eye-fill me-1"></i> View Document
                                                                        </a>
                                                                    </div>
                                                                </div>
                                                                <?php } ?>
                                                            </div>
                                                            <div class="col-12 text-center mt-3">
                                                                <div class="d-inline-block">
                                                                    <span class="badge border border-primary text-primary d-flex align-items-center justify-content-center w-auto">
                                                                        <iconify-icon icon="solar:shield-bold-duotone" class="me-1"></iconify-icon> Secure & Verified
                                                                    </span>
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

     
<?php include 'footerlink.php'; ?>