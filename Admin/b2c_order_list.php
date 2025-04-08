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
                                        <h3 class="page-title">B2C Orders</h3>
                                        <ul class="breadcrumb">
                                             <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
                                             <li class="breadcrumb-item">Orders</li>
                                             <li class="breadcrumb-item active">B2C Orders</li>
                                        </ul>
                                   </div>
                              </div>
                         </div>

                         <div class="row">
                              <!-- Revenue -->
                              <?php
                              $revenueData = $obj->fetch("SELECT SUM(o.total_price) AS total_revenue FROM orders o INNER JOIN products p ON o.price = p.b2c_price");
                              $totalRevenue = $revenueData[0]['total_revenue'] ?? 0;
                              ?>
                              <div class="col-md-6 col-xl-3">
                                   <div class="card">
                                        <div class="card-body">
                                             <div class="d-flex align-items-center justify-content-between">
                                                  <div>
                                                       <h4 class="card-title mb-2">Revenue</h4>
                                                       <p class="text-muted fw-medium fs-22 mb-0">₹<?= number_format($totalRevenue, 2); ?></p>
                                                  </div>
                                                  <div>
                                                       <div class="avatar-md bg-primary bg-opacity-10 rounded">
                                                            <iconify-icon icon="solar:chat-round-money-broken" class="fs-32 text-primary avatar-title"></iconify-icon>
                                                       </div>
                                                  </div>
                                             </div>
                                        </div>
                                   </div>
                              </div>
                              <!-- Payment Complete -->
                              <?php
                              $paidOrdersCount = $obj->fetch("SELECT COUNT(DISTINCT o.order_id) AS total_paid_orders FROM orders o INNER JOIN products p ON o.price = p.b2c_price WHERE o.status = 'paid'");
                              $totalPaidOrders = $paidOrdersCount[0]['total_paid_orders'] ?? 0;
                              ?>
                              <div class="col-md-6 col-xl-3">
                                   <div class="card">
                                        <div class="card-body">
                                             <div class="d-flex align-items-center justify-content-between">
                                                  <div>
                                                       <h4 class="card-title mb-2">Payment Complete</h4>
                                                       <p class="text-muted fw-medium fs-22 mb-0"><?= $totalPaidOrders; ?></p>
                                                  </div>
                                                  <div>
                                                       <div class="avatar-md bg-primary bg-opacity-10 rounded">
                                                            <iconify-icon icon="solar:chat-round-money-broken" class="fs-32 text-primary avatar-title"></iconify-icon>
                                                       </div>
                                                  </div>
                                             </div>
                                        </div>
                                   </div>
                              </div>
                              <!-- Cash on Delivery -->
                              <?php
                              $codOrdersCount = $obj->fetch("SELECT COUNT(DISTINCT o.order_id) AS total_paid_orders FROM orders o INNER JOIN products p ON o.price = p.b2c_price WHERE o.status = 'cod'");
                              $totalCodOrders = $codOrdersCount[0]['total_paid_orders'] ?? 0;
                              ?>
                              <div class="col-md-6 col-xl-3">
                                   <div class="card">
                                        <div class="card-body">
                                             <div class="d-flex align-items-center justify-content-between">
                                                  <div>
                                                       <h4 class="card-title mb-2">Cash on Delivery</h4>
                                                       <p class="text-muted fw-medium fs-22 mb-0"><?= $totalCodOrders; ?></p>
                                                  </div>
                                                  <div>
                                                       <div class="avatar-md bg-primary bg-opacity-10 rounded">
                                                            <iconify-icon icon="solar:clock-circle-broken" class="fs-32 text-primary avatar-title"></iconify-icon>
                                                       </div>
                                                  </div>
                                             </div>
                                        </div>
                                   </div>
                              </div>
                              <!-- Delivered -->
                              <!-- <div class="col-md-6 col-xl-3">
                                   <div class="card">
                                        <div class="card-body">
                                             <div class="d-flex align-items-center justify-content-between">
                                                  <div>
                                                       <h4 class="card-title mb-2">Delivered</h4>
                                                       <p class="text-muted fw-medium fs-22 mb-0">200</p>
                                                  </div>
                                                  <div>
                                                       <div class="avatar-md bg-primary bg-opacity-10 rounded">
                                                            <iconify-icon icon="solar:clipboard-check-broken" class="fs-32 text-primary avatar-title"></iconify-icon>
                                                       </div>
                                                  </div>
                                             </div>
                                        </div>
                                   </div>
                              </div> -->
                         </div>

                         <div class="row">
                              <div class="col-xl-12">
                                   <div class="card">
                                        <div class="d-flex card-header justify-content-between align-items-center">
                                             <div><h4 class="card-title">All B2C Order List</h4></div>
                                        </div>
                                        <div class="card-body p-0">
                                             <div class="table-responsive">
                                                  <table class="table align-middle mb-0 table-hover table-centered">
                                                       <thead class="bg-light-subtle">
                                                            <tr>
                                                                 <th>Order ID</th>
                                                                 <th>Created at</th>
                                                                 <th>Customer</th>
                                                                 <th>Total</th>
                                                                 <th>Payment Status</th>
                                                                 <th>Items</th>
                                                                 <th>Order Status</th>
                                                                 <th>Shipping</th>
                                                                 <th>Action</th>
                                                            </tr>
                                                       </thead>
                                                       <tbody>
                                                            <?php
                                                            $orders = $obj->fetch("SELECT o.order_id, o.date, o.user_name, o.order_status, o.refund_status, SUM(o.total_price) AS total_price, o.status, SUM(o.quantity) AS quantity, o.ship_status FROM orders o JOIN products p ON o.price = p.b2c_price GROUP BY o.order_id ORDER BY o.date DESC");
                                                            foreach ($orders as $val) { 
                                                                $order_id = $val['order_id'];
                                                                $order_status = $val['order_status'];
                                                                $refund_status = $val['refund_status'];

                                                                if (!empty($refund_status)) {
                                                                    $status = $refund_status;
                                                                    if ($status === 'Request Return') {
                                                                        $order_style = 'text-info fw-bold';
                                                                    } elseif ($status === 'Return Approved') {
                                                                        $order_style = 'text-danger fw-bold';
                                                                    } elseif ($status === 'Return Rejected') {
                                                                        $order_style = 'text-primary fw-bold';
                                                                    } else {
                                                                        $order_style = 'd-none';
                                                                    }
                                                                    if ($status == "Return Approved") {
                                                                         $order_text = "Cancelled";
                                                                    } elseif ($status == "Return Rejected") {
                                                                         $order_text = "Rejected";
                                                                    } elseif ($status == "Request Return") {
                                                                         $order_text = "Requested";
                                                                    } else {
                                                                         $order_text = "";
                                                                    }
                                                                } else {
                                                                    $status = $order_status;
                                                                    if ($status === 'Request Cancellation') {
                                                                        $order_style = 'text-info fw-bold';
                                                                    } elseif ($status === 'Cancellation Approved') {
                                                                        $order_style = 'text-danger fw-bold';
                                                                    } elseif ($status === 'Cancellation Rejected') {
                                                                        $order_style = 'text-primary fw-bold'; 
                                                                    } else {
                                                                        $order_style = 'd-none';
                                                                    }
                                                                    if ($status == "Cancellation Approved") {
                                                                         $order_text = "Cancelled";
                                                                    } elseif ($status == "Cancellation Rejected") {
                                                                         $order_text = "Rejected";
                                                                    } elseif ($status == "Request Cancellation") {
                                                                         $order_text = "Requested";
                                                                    } else {
                                                                         $order_text = "";
                                                                    }
                                                                }
    
                                                                 $statusClass = "";
                                                                 if ($val['ship_status'] == "In Transit") {
                                                                      $statusClass = "border-secondary text-secondary";
                                                                 } elseif ($val['ship_status'] == "Out for Delivery") {
                                                                      $statusClass = "border-warning text-warning";
                                                                 } elseif ($val['ship_status'] == "Completed") {
                                                                      $statusClass = "border-success text-success";
                                                                 } elseif ($val['ship_status'] == "Pending") {
                                                                      $statusClass = "border-danger text-danger";
                                                                 }
    
                                                                 $payStatus = $val['status'] == "paid" ? "bg-success" : ($val['status'] == "cod" ? "bg-warning" : "");
                                                            ?>
                                                            <tr>
                                                                 <td>
                                                                      <?php if (!in_array($order_status, ['Request Cancellation', 'Cancellation Approved'])) { ?>
                                                                      <a href="order_details.php?order_id=<?= base64_encode($order_id); ?>">
                                                                      <?php } else { ?>
                                                                      <a href="javascript:void(0)"></a>
                                                                      <?php } ?>
                                                                           #<?= $val['order_id']; ?>
                                                                      </a>
                                                                 </td>
                                                                 <td><?= date("d M, Y", strtotime($val['date'])); ?></td>
                                                                 <td><a href="javascript:void(0)" class="link-primary fw-medium"><?= $val['user_name']; ?></a></td>
                                                                 <td>₹<?= number_format($val['total_price'], 2); ?></td>
                                                                 <td><span class="badge <?= $payStatus; ?> text-light px-2 py-1 fs-13"><?= $val['status']; ?></span></td>
                                                                 <td><?= $val['quantity']; ?></td>
                                                                 <td><span class="<?= $order_style; ?> fs-13"><?= $order_text; ?></span></td>
                                                                 <td><span class="badge border <?= $statusClass; ?> px-2 py-1 fs-13"><?= $val['ship_status']; ?></span></td>
                                                                 <td>
                                                                      <?php if (!in_array($order_status, ['Request Cancellation', 'Cancellation Approved'])) { ?>
                                                                      <div class="d-flex align-items-center justify-content-center">
                                                                           <a href="order_details.php?order_id=<?= base64_encode($order_id); ?>" class="btn btn-light btn-sm"><iconify-icon icon="solar:eye-broken" class="align-middle fs-18"></iconify-icon></a>
                                                                      </div>
                                                                      <?php } ?>
                                                                 </td>
                                                            </tr>
                                                            <?php } ?>
                                                       </tbody>
                                                  </table>
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