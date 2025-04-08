<?php 
include 'session_config.php';

if (!isset($_SESSION["b2b_user_name"], $_SESSION["b2b_user_email"], $_SESSION["b2b_user_mobile"])) {
    header("Location: login.php"); 
    exit();
}
$userName = $_SESSION["b2b_user_name"];
$userEmail = $_SESSION["b2b_user_email"];
$userMobile = $_SESSION["b2b_user_mobile"];

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

        <?php include 'header.php'; ?>

        <!-- page-title -->
        <?php 
        $imageQuery = "SELECT * FROM banner_two LIMIT 1";
        $bans = $obj->fetch($imageQuery);
        foreach ($bans as $ban){ 
        ?>
        <div class="page-title" style="background-image: url('../Admin/uploads/banner/<?= htmlspecialchars($ban['b2b_image']) ?>');">
            <div class="container">
                <h3 class="heading text-center">My orders</h3>
                <ul class="breadcrumbs d-flex align-items-center justify-content-center">
                    <li><a class="link" href="index.php">Home</a></li>
                    <li><i class="icon-arrRight"></i></li>
                    <li>My orders</li>
                </ul>
            </div>
        </div>
        <?php } ?>
        <!-- /page-title -->

        <section class="flat-spacing">
            <div class="container">
                <div class="my-account-wrap">
                    <div class="my-account-content">
                        <div class="account-orders">
                            <div class="wrap-account-order">
                                <?php 
                                $sql = "SELECT order_id, shiprocket_order_id, date, status, ship_status, order_status, refund_status, SUM(total_price) as total_price, SUM(quantity) as product_count FROM orders WHERE user_name = '$userName' AND user_email = '$userEmail' AND user_mobile = '$userMobile' GROUP BY order_id ORDER BY date DESC";
                                $orders = $obj->fetch($sql);
                                $index = 0;
                                foreach ($orders as $order) {
                                    $index++;
                                    $order_id = $order['order_id']; 
                                    $shiprocket_order_id = $order['shiprocket_order_id']; 
                                    $modalId = "orderModal" . $order_id;
                                    $collapseId = "collapseOrder" . $order_id;
                                    
                                    $orderTime = strtotime($order['date']); 
                                    $currentTime = time();
                                    
                                    // checking if passed 12 hrs - for cancel
                                    $allowCancel = ($currentTime - $orderTime) <= 43200; 
                                    // checking if passed 4 days - for return
                                    $allowReturn = ($currentTime - $orderTime) <= 345600;
                                    
                                    $cancelModalId = "cancelModal" . $order_id;
                                    $refundModalId = "refundModal" . $order_id;
                                    
                                    $paymentBadge = ($order['status'] == 'paid') ? 'bg-success' : 'bg-danger';
                                    
                                    if (!empty($order['refund_status'])) {
                                        $status = $order['refund_status'];
                                        if ($status === 'Request Return') {
                                            $orderBadge = 'bg-warning';
                                        } elseif ($status === 'Return Approved') {
                                            $orderBadge = 'bg-success';
                                        } elseif ($status === 'Return Rejected') {
                                            $orderBadge = 'bg-danger';
                                        } else {
                                            $orderBadge = 'd-none';
                                        }
                                    } else {
                                        $status = $order['order_status'];
                                        if ($status === 'Request Cancellation') {
                                            $orderBadge = 'bg-warning';
                                        } elseif ($status === 'Cancellation Approved') {
                                            $orderBadge = 'bg-success';
                                        } elseif ($status === 'Cancellation Rejected') {
                                            $orderBadge = 'bg-danger';
                                        } else {
                                            $orderBadge = 'd-none';
                                        }
                                    }
                                ?>
                                <div class="card mb-4 shadow-sm border-0">
                                    <div class="card-header bg-white border-bottom d-flex justify-content-between align-items-center" data-bs-toggle="collapse" data-bs-target="#<?= $collapseId ?>" aria-expanded="false" aria-controls="<?= $collapseId ?>" style="cursor: pointer;">
                                        <div>
                                            <h5 class="mb-0 text-dark fw-medium">Order Id:  &nbsp;<span class="fw-bold" style="color:#2C97FB;"><?php echo $order['order_id']; ?></span></h5>
                                            <small class="text-muted"><i class="bi bi-calendar-event me-1"></i><?php echo date("F j, Y", strtotime($order['date'])); ?></small>
                                        </div>
                                        <div>
                                            <i class="bi bi-chevron-down fs-4"></i>
                                        </div>
                                    </div>
                                    <!-- Collapsible Body -->
                                    <div id="<?= $collapseId ?>" class="collapse <?= ($index === 1) ? 'show' : '' ?>">
                                        <div class="card-body">
                                            <div class="row g-4">
                                                <!-- Order Summary Section -->
                                                <div class="col-lg-8">
                                                    <div class="row">
                                                        <div class="col-6">
                                                            <p class="mb-1 fw-semibold text-muted"><i class="bi bi-box-seam me-1"></i> Product</p>
                                                            <p class="mb-0 text-dark">
                                                                <?php 
                                                                    if($order['product_count'] > 1) {
                                                                        $singleSql = "SELECT product_name FROM orders WHERE order_id = '".$order['order_id']."' LIMIT 2";
                                                                        $names = $obj->fetch($singleSql);
                                                                        echo $names[0]['product_name'] . ($order['product_count'] > 1 ? ' <strong>+ ' . ($order['product_count'] - 1) . ' more</strong>' : '');
                                                                    } else {
                                                                        $singleSql = "SELECT product_name FROM orders WHERE order_id = '".$order['order_id']."' LIMIT 1";
                                                                        $singleOrder = $obj->fetch($singleSql);
                                                                        echo $singleOrder[0]['product_name'];
                                                                    }
                                                                ?>
                                                            </p>
                                                        </div>
                                                        <!-- Total -->
                                                        <div class="col-6">
                                                            <p class="mb-1 fw-semibold text-muted"><i class="bi bi-currency-rupee me-1"></i> Total</p>
                                                            <p class="mb-0 text-dark">
                                                                <strong>₹<?php echo $order['total_price']; ?></strong> for 
                                                                <strong><?php echo $order['product_count']; ?></strong> item<?php echo ($order['product_count'] > 1 ? "s" : ""); ?>
                                                            </p>
                                                        </div>
                                                    </div>
                                                    <div class="row mt-3">
                                                        <div class="col-6">
                                                            <p class="mb-1 fw-semibold text-muted"><i class="bi bi-credit-card me-1"></i> Payment</p>
                                                            <p class="mb-0">
                                                                <span class="badge <?php echo $paymentBadge; ?> text-white"><?php echo ucfirst($order['status']); ?></span>
                                                            </p>
                                                        </div>
                                                        <div class="col-6">
                                                            <p class="mb-1 fw-semibold text-muted"><i class="bi bi-info-circle me-1"></i> Order Status</p>
                                                            <p class="mb-0">
                                                                <span class="badge <?php echo $orderBadge; ?> text-white"><?php echo $status ?: '—'; ?></span>
                                                            </p>
                                                        </div>
                                                    </div>
                                                    <div class="d-flex flex-wrap gap-2 mt-3">
                                                        <button type="button" class="btn btn-outline-primary fw-bold rounded-pill" data-bs-toggle="modal" data-bs-target="#<?= $modalId ?>">
                                                            <i class="bi bi-eye"></i> View
                                                        </button>
                                                        <?php 
                                                            $cancellationStatuses = ['Request Cancellation', 'Cancellation Approved', 'Cancellation Rejected'];
                                                            $refundStatuses       = ['Request Return', 'Return Approved', 'Return Rejected'];
                                                        ?>
                                                        <?php if (!in_array($order['order_status'], $cancellationStatuses) && !in_array($order['refund_status'], $refundStatuses) && ($order['ship_status'] == 'Pending')) { ?>
                                                            <button type="button" class="btn btn-outline-danger fw-bold rounded-pill" data-bs-toggle="modal" data-bs-target="#<?= $cancelModalId; ?>">
                                                                <i class="bi bi-x-circle"></i> Cancel
                                                            </button>
                                                        <?php } ?>
                                                        <?php if (!in_array($order['refund_status'], $refundStatuses) && !in_array($order['order_status'], $cancellationStatuses) && ($order['ship_status'] == 'Completed')) { ?>
                                                            <button type="button" class="btn btn-outline-info fw-bold rounded-pill" data-bs-toggle="modal" data-bs-target="#<?= $refundModalId; ?>">
                                                                <i class="bi bi-arrow-counterclockwise"></i> Return
                                                            </button>
                                                        <?php } ?>
                                                    </div>
                                                </div>
                                                <!-- Track Order Section -->
                                                <div class="col-lg-4 border-start ps-4">
                                                    <p class="mb-2 fw-semibold text-muted"><i class="bi bi-truck me-1"></i> Track Order</p>
                                                    <?php 
                                                        $trackSql = "SELECT confinement_id, tracking_link FROM other_dispatch WHERE order_id = '$order_id' AND shiprocket_order_id = '$shiprocket_order_id'";
                                                        $trackData = $obj->fetch($trackSql);
                                                        $trackId = isset($trackData[0]['confinement_id']) ? $trackData[0]['confinement_id'] : '';
                                                        $trackLink = isset($trackData[0]['tracking_link']) ? $trackData[0]['tracking_link'] : '';
                                                    ?>
                                                    <?php if(empty($trackData) || empty($trackId) || empty($trackLink)) { ?>
                                                        <button type="button" class="btn btn-primary w-100 track-order-btn" data-order-id="<?= $order_id; ?>" data-shiprocket-order-id="<?= $shiprocket_order_id; ?>" id="trackBtn_<?= $order_id; ?>">
                                                            <i class="bi bi-truck"></i> Track Your Order
                                                        </button>
                                                    <?php } else { ?>
                                                        <div class="bg-light rounded p-2">
                                                            <p class="mb-1">
                                                                <a href="<?= $trackLink ?>" class="text-info fw-bold text-decoration-none"><i class="bi bi-truck me-1"></i> Track Your Order</a>
                                                            </p>
                                                            <p class="mb-0 text-dark small">Tracking ID: <span class="fw-semibold"><?= $trackId ?></span></p>
                                                        </div>
                                                    <?php } ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <!-- Individual modal -->
                                <div class="modal modalCentered fade tf-product-modal modal-part-content" id="<?php echo $modalId; ?>" tabindex="-1" aria-labelledby="modalLabel<?php echo $order['order_id']; ?>" aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="header">
                                                <div><h5 class="fw-semibold" id="cancelModalLabel<?php echo $order['order_id']; ?>">Order Details : </h5></div>
                                                <span class="icon-close icon-close-popup" data-bs-dismiss="modal" aria-label="Close"></span>
                                            </div>
                                            <div class="modal-body">
                                                <div class="wd-form-order">
                                                    <div class="order-head">
                                                        <div class="content">
                                                            <div class="badgee">
                                                                <?php echo $order['status'] === 'paid' ? 'Online Payment' : 'Cash on Delivery'; ?>
                                                            </div>
                                                            <h6 class="mt-8 fw-5">Order: #<?php echo $order['order_id']; ?></h6>
                                                        </div>
                                                    </div>
                                                    <?php 
                                                        $detailSql = "SELECT * FROM orders WHERE order_id = '".$order['order_id']."'";
                                                        $orderDetails = $obj->fetch($detailSql);
                                                    ?>
                                                    <div class="tf-grid-layout md-col-2 gap-15">
                                                        <?php foreach($orderDetails as $detail) { ?>
                                                        <div class="item">
                                                            <div class="text-2 text_black-2">Product Name</div>
                                                            <div class="text-2 mt_4 fw-6"><?php echo $detail['product_name']; ?></div>
                                                        </div>
                                                        <div class="item">
                                                            <div class="text-2 text_black-2">Quantity</div>
                                                            <div class="text-2 mt_4 fw-6"><?php echo $detail['quantity']; ?></div>
                                                        </div>
                                                        <?php } ?>
                                                        <div class="item">
                                                            <div class="text-2 text_black-2">Address</div>
                                                            <div class="text-2 mt_4 fw-6">
                                                                <?php echo $orderDetails[0]['address']; ?>
                                                            </div>
                                                        </div>
                                                        <div class="item">
                                                            <div class="text-2 text_black-2">Landmark</div>
                                                            <div class="text-2 mt_4 fw-6">
                                                                <?php echo $orderDetails[0]['landmark']; ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <?php 
                                                        $trackSql = "SELECT confinement_id, tracking_link FROM other_dispatch WHERE order_id = '$order_id' AND shiprocket_order_id = '$shiprocket_order_id'";
                                                        $trackData = $obj->fetch($trackSql);
                                                        $trackId = $trackData[0]['confinement_id'];
                                                        $trackLink = $trackData[0]['tracking_link'];
                                                    ?>
                                                    <!--Track Order Button-->
                                                    <?php if((empty($trackData)) && (empty($trackId)) && (empty($trackLink))) { ?>
                                                    <div class="mt-4">
                                                        <button type="button" class="btn btn-primary fw-bold rounded track-order-btn" data-order-id="<?= $order_id; ?>" data-shiprocket-order-id="<?= $shiprocket_order_id; ?>" id="trackBtn_<?= $order_id; ?>">
                                                            Track Your Order
                                                        </button>
                                                    </div>
                                                    <?php } ?>
                                                    <!--/Track Order Button-->
                                                    <div class="widget-tabs style-3 widget-order-tab">
                                                        <div class="widget-content-tab">
                                                            <div class="widget-content-inner active">
                                                                
                                                                <?php if((!empty($trackData)) && (!empty($trackId)) && (!empty($trackLink))) { ?>
                                                                    <p class="text-2 mb-1"><a href="<?= $trackLink ?>" class="fw-bold text-info"> Track Your Order</a></p>
                                                                    <p class="text-2">Tracking/Consignment Id : &nbsp;<span><?= $trackId ?></span></p>
                                                                <?php } ?>
                                                            
                                                                <ul class="mt_20">
                                                                    <li>Order Id : <span class="fw-7">#<?php echo $order['order_id']; ?></span></li>
                                                                    <li>Date : <span class="fw-7">
                                                                        <?php echo date("F j, Y", strtotime($order['date'])); ?>
                                                                    </span></li>
                                                                    <li>Total : <span class="fw-7">₹<?php echo $order['total_price']; ?></span></li>
                                                                    <li>Status : <span class="fw-7"><?php echo $order['status']; ?></span></li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Cancel Order Modal -->
                                <div class="modal modalCentered fade tf-product-modal modal-part-content" id="<?php echo $cancelModalId; ?>" tabindex="-1" aria-labelledby="cancelModalLabel<?php echo $order['order_id']; ?>" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered modal-lg">
                                        <div class="modal-content">
                                            <div class="header">
                                                <div><h5 class="fw-semibold" id="cancelModalLabel<?php echo $order['order_id']; ?>">Cancel Order #<?php echo $order['order_id']; ?></h5></div>
                                                <span class="icon-close icon-close-popup" data-bs-dismiss="modal" aria-label="Close"></span>
                                            </div>
                                            <div class="modal-body">
                                                <?php if ($allowCancel) { ?>
                                                    <div class="alert alert-warning text-center text-dark rounded-3 shadow-sm border-0" role="alert">
                                                        <p class="text-danger">Warning: By submitting this form, you are requesting to cancel your order <strong>#<?php echo $order['order_id']; ?></strong>. Please provide the required information to proceed with the cancellation process.</p>
                                                    </div>
                                                    <form class="cancelOrder" novalidate>
                                                        <input type="hidden" name="shiprocket_order_id" value="<?php echo $order['shiprocket_order_id']; ?>">
                                                        <input type="hidden" name="order_id" value="<?php echo $order['order_id']; ?>">
                                                        <input type="hidden" name="user_name" value="<?php echo $userName; ?>">
                                                        <input type="hidden" name="user_email" value="<?php echo $userEmail; ?>">
                                                        <div class="row g-2">
                                                            <div class="col-lg-12">
                                                                <div class="mb-3">
                                                                    <label for="reason<?php echo $order['order_id']; ?>" class="form-label">Reason for Cancellation*</label>
                                                                    <textarea class="form-control" id="reason<?php echo $order['order_id']; ?>" name="reason" rows="2" required></textarea>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-6">
                                                                <div class="mb-3">
                                                                    <label for="bank_account<?php echo $order['order_id']; ?>" class="form-label">Bank Account No.*</label>
                                                                    <input type="text" class="form-control" id="bank_account<?php echo $order['order_id']; ?>" name="bank_account" required>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-6">
                                                                <div class="mb-3">
                                                                    <label for="ifsc<?php echo $order['order_id']; ?>" class="form-label">IFSC Code*</label>
                                                                    <input type="text" class="form-control" id="ifsc<?php echo $order['order_id']; ?>" name="ifsc" required>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-6">
                                                                <div class="mb-3">
                                                                    <label for="bank_name<?php echo $order['order_id']; ?>" class="form-label">Bank Name*</label>
                                                                    <input type="text" class="form-control" id="bank_name<?php echo $order['order_id']; ?>" name="bank_name" readonly>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-6">
                                                                <div class="mb-3">
                                                                    <label for="banking_name<?php echo $order['order_id']; ?>" class="form-label">Banking Name*</label>
                                                                    <input type="text" class="form-control" id="banking_name<?php echo $order['order_id']; ?>" name="banking_name" required>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-12">
                                                                <div class="mb-3">
                                                                    <label for="branch_address<?php echo $order['order_id']; ?>" class="form-label">Branch Address*</label>
                                                                    <input type="text" class="form-control" id="branch_address<?php echo $order['order_id']; ?>" name="branch_address" readonly>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-12">
                                                                <div class="form-check">
                                                                    <input class="form-check-input" type="checkbox" id="confirm<?php echo $order['order_id']; ?>" required>
                                                                    <label class="form-check-label" for="confirm<?php echo $order['order_id']; ?>">I confirm that I want to cancel this order*</label>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-12">
                                                                <button type="submit" class="btn btn-outline-danger w-100 rounded-pill fs-20 fw-bold py-3">Submit Cancellation</button>
                                                            </div>
                                                        </div>
                                                    </form>
                                                <?php } else { ?>
                                                    <div class="alert alert-warning text-center text-dark rounded-3 shadow-sm border-0" role="alert" style="font-size: 1.1rem;">
                                                        <strong class="d-block mb-2">Notice:</strong>
                                                        12 hours have passed since the order was placed. You cannot cancel this order.<br>
                                                        For more insight, read our policy – 
                                                        <a href="returnpolicy.php" class="line-under">Return & Refund</a>
                                                    </div>
                                                <?php } ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Refund Order Modal -->
                                <div class="modal modalCentered fade tf-product-modal modal-part-content" id="<?php echo $refundModalId; ?>" tabindex="-1" aria-labelledby="refundModalLabel<?php echo $order['order_id']; ?>" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered modal-lg">
                                        <div class="modal-content">
                                            <div class="header">
                                                <div><h5 class="fw-semibold" id="refundModalLabel<?php echo $order['order_id']; ?>">Return Order #<?php echo $order['order_id']; ?></h5></div>
                                                <span class="icon-close icon-close-popup" data-bs-dismiss="modal" aria-label="Close"></span>
                                            </div>
                                            <div class="modal-body">
                                                <?php if ($allowReturn) { ?>
                                                <div class="alert alert-info text-center text-dark rounded-3 shadow-sm border-0" role="alert">
                                                    <p class="text-dark">Warning: By submitting this form, you are requesting to return your order <strong>#<?php echo $order['order_id']; ?></strong>. Please provide the required information to proceed with the return process.</p>
                                                </div>
                                                <form class="returnOrder" novalidate>
                                                    <input type="hidden" name="shiprocket_order_id" value="<?php echo $order['shiprocket_order_id']; ?>">
                                                    <input type="hidden" name="order_id" value="<?php echo $order['order_id']; ?>">
                                                    <input type="hidden" name="user_name" value="<?php echo $userName; ?>">
                                                    <input type="hidden" name="user_email" value="<?php echo $userEmail; ?>">
                                                    <div class="row g-2">
                                                        <div class="col-lg-12">
                                                            <div class="mb-3">
                                                                <label for="reason<?php echo $order['order_id']; ?>" class="form-label">Reason for Return*</label>
                                                                <textarea class="form-control" id="reason<?php echo $order['order_id']; ?>" name="reason" rows="2" required></textarea>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <div class="mb-3">
                                                                <label for="bank_account<?php echo $order['order_id']; ?>" class="form-label">Bank Account No.*</label>
                                                                <input type="text" class="form-control" id="bank_account<?php echo $order['order_id']; ?>" name="bank_account" required>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <div class="mb-3">
                                                                <label for="ifsc2<?php echo $order['order_id']; ?>" class="form-label">IFSC Code*</label>
                                                                <input type="text" class="form-control" id="ifsc2<?php echo $order['order_id']; ?>" name="ifsc" required>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <div class="mb-3">
                                                                <label for="bank_name2<?php echo $order['order_id']; ?>" class="form-label">Bank Name*</label>
                                                                <input type="text" class="form-control" id="bank_name2<?php echo $order['order_id']; ?>" name="bank_name" readonly>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <div class="mb-3">
                                                                <label for="banking_name<?php echo $order['order_id']; ?>" class="form-label">Banking Name*</label>
                                                                <input type="text" class="form-control" id="banking_name<?php echo $order['order_id']; ?>" name="banking_name" required>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-12">
                                                            <div class="mb-3">
                                                                <label for="branch_address2<?php echo $order['order_id']; ?>" class="form-label">Branch Address*</label>
                                                                <input type="text" class="form-control" id="branch_address2<?php echo $order['order_id']; ?>" name="branch_address" readonly>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <div class="mb-3">
                                                                <label for="image_1<?php echo $order['order_id']; ?>" class="form-label">Product Image 1*</label>
                                                                <input type="file" class="form-control" id="image_1<?php echo $order['order_id']; ?>" name="image_1" accept=".jpg, .jpeg, .png" required>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <div class="mb-3">
                                                                <label for="image_2<?php echo $order['order_id']; ?>" class="form-label">Product Image 2*</label>
                                                                <input type="file" class="form-control" id="image_2<?php echo $order['order_id']; ?>" name="image_2" accept=".jpg, .jpeg, .png" required>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <div class="mb-3">
                                                                <label for="image_3<?php echo $order['order_id']; ?>" class="form-label">Product Image 3*</label>
                                                                <input type="file" class="form-control" id="image_3<?php echo $order['order_id']; ?>" name="image_3" accept=".jpg, .jpeg, .png" required>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <div class="mb-3">
                                                                <label for="image_4<?php echo $order['order_id']; ?>" class="form-label">Product Image 4*</label>
                                                                <input type="file" class="form-control" id="image_4<?php echo $order['order_id']; ?>" name="image_4" accept=".jpg, .jpeg, .png" required>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-12">
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="checkbox" id="confirm2<?php echo $order['order_id']; ?>" required>
                                                                <label class="form-check-label" for="confirm2<?php echo $order['order_id']; ?>">I confirm that I want to return this order*</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-12">
                                                            <button type="submit" class="btn btn-outline-secondary w-100 rounded-pill fs-20 fw-bold py-3">Submit Return</button>
                                                        </div>
                                                    </div>
                                                </form>
                                                <?php } else { ?>
                                                <div class="alert alert-info text-center text-dark rounded-3 shadow-sm border-0" role="alert" style="font-size: 1.1rem;">
                                                    <strong class="d-block mb-2">Notice:</strong>
                                                    4 days have passed since the order was placed. You cannot return this order.<br>
                                                    For more insight, read our policy – <a href="returnpolicy.php" class="line-under">Return & Refund</a>
                                                </div>
                                                <?php } ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
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

    <!-- All Necessary scripts are here -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // script for auto fill bank details in cancel
            document.querySelectorAll('[id^="ifsc"]').forEach(function(ifscField) {
                ifscField.addEventListener('blur', function() {
                    const ifsc = this.value.trim();
                    const orderId = this.id.replace('ifsc', '');
                    if(ifsc !== "") {
                        const loadingToast = Toastify({
                            text: "Fetching bank details...",
                            duration: -1, 
                            gravity: "top",
                            position: "center",
                            backgroundColor: "#007bff"
                        });
                        loadingToast.showToast();
                        fetch('validate_bank.php', {
                            method: 'POST',
                            headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                            body: "action=ifsc&ifsc=" + encodeURIComponent(ifsc)
                        })
                        .then(response => response.json())
                        .then(data => {
                            loadingToast.hideToast();
                            if(data.success) {
                                document.getElementById('branch_address' + orderId).value = data.branch_address;
                                document.getElementById('bank_name' + orderId).value = data.bank_name;
                                Toastify({
                                    text: "Bank details auto-filled.",
                                    duration: 3000,
                                    gravity: "top",
                                    position: "center",
                                    backgroundColor: "#28a745"
                                }).showToast();
                            } else {
                                Toastify({
                                    text: data.message,
                                    duration: 3000,
                                    gravity: "top",
                                    position: "center",
                                    backgroundColor: "#dc3545"
                                }).showToast();
                            }
                        })
                        .catch(error => console.error('Error:', error));
                    }
                });
            });

            // script for auto fill bank details in return
            document.querySelectorAll('[id^="ifsc2"]').forEach(function(ifscField) {
                ifscField.addEventListener('blur', function() {
                    const ifsc = this.value.trim();
                    const orderId = this.id.replace('ifsc2', '');
                    if(ifsc2 !== "") {
                        const loadingToast = Toastify({
                            text: "Fetching bank details...",
                            duration: -1, 
                            gravity: "top",
                            position: "center",
                            backgroundColor: "#007bff"
                        });
                        loadingToast.showToast();
                        fetch('validate_bank.php', {
                            method: 'POST',
                            headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                            body: "action=ifsc&ifsc=" + encodeURIComponent(ifsc)
                        })
                        .then(response => response.json())
                        .then(data => {
                            loadingToast.hideToast();
                            if(data.success) {
                                document.getElementById('branch_address2' + orderId).value = data.branch_address;
                                document.getElementById('bank_name2' + orderId).value = data.bank_name;
                                Toastify({
                                    text: "Bank details auto-filled.",
                                    duration: 3000,
                                    gravity: "top",
                                    position: "center",
                                    backgroundColor: "#28a745"
                                }).showToast();
                            } else {
                                Toastify({
                                    text: data.message,
                                    duration: 3000,
                                    gravity: "top",
                                    position: "center",
                                    backgroundColor: "#dc3545"
                                }).showToast();
                            }
                        })
                        .catch(error => console.error('Error:', error));
                    }
                });
            });

            // script for cancel submission
            document.querySelectorAll('.cancelOrder').forEach(function(form) {
                form.addEventListener('submit', function(e) {
                    e.preventDefault();
                    const orderId = form.elements["order_id"].value;
                    const confirmCheckbox = document.getElementById('confirm' + orderId);
                    if (!confirmCheckbox.checked) {
                        Toastify({
                            text: "Please confirm that you want to cancel the order by checking the box.",
                            duration: 3000,
                            gravity: "top",
                            position: "center",
                            backgroundColor: "#dc3545"
                        }).showToast();
                        return; 
                    }
                    const formData = new FormData(this);
                    formData.append('action', 'cancel_order');
                    fetch('cancel_order.php', {
                        method: 'POST',
                        body: new URLSearchParams(formData)
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            Toastify({
                                text: "Cancellation request submitted successfully.",
                                duration: 2000,
                                gravity: "top",
                                position: "center",
                                backgroundColor: "#28a745"
                            }).showToast();
                            setTimeout(() => {
                                location.reload();
                            }, 2000);
                        } else {
                            Toastify({
                                text: data.message,
                                duration: 3000,
                                gravity: "top",
                                position: "center",
                                backgroundColor: "#dc3545"
                            }).showToast();
                        }
                    })
                    .catch(error => console.error('Error:', error));
                });
            });

            // script for return submission
            document.querySelectorAll('.returnOrder').forEach(function(form) {
                form.addEventListener('submit', function(e) {
                    e.preventDefault();
                    const orderId = form.elements["order_id"].value;
                    const confirmCheckbox = document.getElementById('confirm2' + orderId);
                    if (!confirmCheckbox.checked) {
                        Toastify({
                            text: "Please confirm that you want to return the order by checking the box.",
                            duration: 3000,
                            gravity: "top",
                            position: "center",
                            backgroundColor: "#dc3545"
                        }).showToast();
                        return; 
                    }
                    const formData = new FormData(this);
                    formData.append('action', 'return_order');
                    fetch('return_order.php', {
                        method: 'POST',
                        body: formData 
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            Toastify({
                                text: "Return request submitted successfully.",
                                duration: 2000,
                                gravity: "top",
                                position: "center",
                                backgroundColor: "#28a745"
                            }).showToast();
                            setTimeout(() => {
                                location.reload();
                            }, 2000);
                        } else {
                            Toastify({
                                text: data.message,
                                duration: 3000,
                                gravity: "top",
                                position: "center",
                                backgroundColor: "#dc3545"
                            }).showToast();
                        }
                    })
                    .catch(error => console.error('Error:', error));
                });
            });
        
            // script for track order
            document.querySelectorAll('.track-order-btn').forEach(function(button) {
                button.addEventListener('click', function() {
                    var orderId = this.getAttribute('data-order-id');
                    var shiprocketOrderId = this.getAttribute('data-shiprocket-order-id');
                    var btn = this;
                    btn.disabled = true;
                    btn.innerText = 'Fetching tracking link...';
                    fetch('get_tracking_link.php', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json'
                        },
                        body: JSON.stringify({
                            order_id: orderId,
                            shiprocket_order_id: shiprocketOrderId
                        })
                    })
                    .then(function(response) {
                        return response.json();
                    })
                    .then(function(data) {
                        btn.disabled = false;
                        if(data.success) {
                            window.location.href = data.track_url;
                        } else {
                            btn.innerText = 'Track Your Order';
                            Toastify({
                                text: "Your Order have not shipped yet.",
                                duration: 3000,
                                gravity: "top",
                                position: "center",
                                backgroundColor: "#0DCAF0"
                            }).showToast();
                        }
                    })
                    .catch(function(error) {
                        btn.disabled = false;
                        btn.innerText = 'Track Your Order';
                        console.error("Error fetching tracking link:", error);
                        Toastify({
                            text: "An error occurred. Please try again later.",
                            duration: 3000,
                            gravity: "top",
                            position: "center",
                            backgroundColor: "#0DCAF0"
                        }).showToast();
                    });
                });
            });
        });
    </script>
</body>
</html>