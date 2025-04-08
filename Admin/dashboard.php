<?php
include 'session_config.php';
if(empty($_SESSION['user_email'])){
    echo '<script>window.location.href="login.php"</script>';
}
include "config.php";
include 'headerlink.php'; 

// current month timeline
$currentMonthStart = date("Y-m-01");
$currentMonthEnd = date("Y-m-t");
// last month timeline
$lastMonthStart = date("Y-m-01", strtotime("last month"));
$lastMonthEnd = date("Y-m-t", strtotime("last month"));
?>

<body>
     <div class="wrapper">

          <?php include 'header.php'; ?>
          <?php include 'sidebar.php'; ?>

          <!-- Start right Content here -->
          <!-- ==================================================== -->
          <div class="page-content">
               <div class="container-fluid">
                    <!-- sell overview -->
                    <div class="row">
                         <div class="col-xxl-12">
                              <div class="row">
                                   <!-- Total Orders -->
                                   <?php
                                   $sql = "SELECT COUNT(DISTINCT order_id) AS total_orders FROM orders WHERE date BETWEEN '$currentMonthStart' AND '$currentMonthEnd'";
                                   $result = $obj->fetch($sql);
                                   $totalOrders = $result[0]['total_orders'] ?? 0;
                                   ?>
                                   <div class="col-md-3">
                                        <div class="card overflow-hidden">
                                             <div class="card-body">
                                                  <div class="row">
                                                       <div class="col-12 mb-2">
                                                            <div class="avatar-md bg-soft-primary rounded">
                                                                 <iconify-icon icon="solar:cart-5-bold-duotone" class="avatar-title fs-32 text-primary"></iconify-icon>
                                                            </div>
                                                       </div>
                                                       <div class="col-12">
                                                            <p class="text-muted mb-0 text-truncate"><span class="fs-16 fw-bold">Total Orders - </span> <span class="fs-12"> This Month</span></p>
                                                            <h3 class="text-dark mt-1 mb-0"><?= number_format($totalOrders); ?></h3>
                                                       </div>
                                                  </div>
                                             </div>
                                        </div>
                                   </div> 
                                   <!-- New Leads -->
                                   <?php
                                   $sql = "SELECT SUM(total) AS total_leads FROM (SELECT COUNT(*) AS total FROM reg_btob WHERE created_at >= '$currentMonthStart' AND created_at <= '$currentMonthEnd' UNION ALL SELECT COUNT(*) AS total FROM reg_btoc WHERE created_at >= '$currentMonthStart' AND created_at <= '$currentMonthEnd') AS combined_counts";
                                   $result = $obj->fetch($sql);
                                   $totalLeads = $result[0]['total_leads'] ?? 0;
                                   ?>
                                   <div class="col-md-3">
                                        <div class="card overflow-hidden">
                                             <div class="card-body">
                                                  <div class="row">
                                                       <div class="col-12 mb-2">
                                                            <div class="avatar-md bg-soft-primary rounded">
                                                                 <i class="bx bx-award avatar-title fs-24 text-primary"></i>
                                                            </div>
                                                       </div> 
                                                       <div class="col-12">
                                                            <p class="text-muted mb-0 text-truncate"><span class="fs-16 fw-bold">New Leads - </span> <span class="fs-12"> This Month</span></p>
                                                            <h3 class="text-dark mt-1 mb-0"><?= number_format($totalLeads); ?></h3>
                                                       </div> 
                                                  </div>
                                             </div>
                                        </div>
                                   </div> 
                                   <!-- Deals -->
                                   <?php 
                                   $sql = "SELECT COUNT(DISTINCT order_id) AS total_deals FROM orders WHERE ship_status = 'Completed' AND date BETWEEN '$currentMonthStart' AND '$currentMonthEnd'";
                                   $result = $obj->fetch($sql); 
                                   $totalDeals = $result[0]['total_deals'] ?? 0;
                                   ?>
                                   <div class="col-md-3">
                                        <div class="card overflow-hidden">
                                             <div class="card-body">
                                                  <div class="row">
                                                       <div class="col-12 mb-2">
                                                            <div class="avatar-md bg-soft-primary rounded">
                                                                 <i class="bx bxs-backpack avatar-title fs-24 text-primary"></i>
                                                            </div>
                                                       </div>
                                                       <div class="col-12">
                                                            <p class="text-muted mb-0 text-truncate"><span class="fs-16 fw-bold">Deals - </span> <span class="fs-12"> This Month</span></p>
                                                            <h3 class="text-dark mt-1 mb-0"><?= number_format($totalDeals); ?></h3>
                                                       </div>
                                                  </div>
                                             </div>
                                        </div>
                                   </div>
                                   <!-- Revenue -->
                                   <?php
                                   $sql = "SELECT SUM(total_price) AS total_revenue FROM orders WHERE date BETWEEN '$currentMonthStart' AND '$currentMonthEnd'";
                                   $revenueData = $obj->fetch($sql);
                                   $totalRevenue = $revenueData[0]['total_revenue'] ?? 0;
                                   $total = $obj->amount($totalRevenue);
                                   ?>
                                   <div class="col-md-3">
                                        <div class="card overflow-hidden">
                                             <div class="card-body">
                                                  <div class="row">
                                                       <div class="col-12 mb-2">
                                                            <div class="avatar-md bg-soft-primary rounded">
                                                                 <i class="bx bx-dollar-circle avatar-title text-primary fs-24"></i>
                                                            </div>
                                                       </div>
                                                       <div class="col-12">
                                                            <p class="text-muted mb-0 text-truncate"><span class="fs-16 fw-bold">Revenue - </span> <span class="fs-12"> This Month</span></p>
                                                            <h3 class="text-dark mt-1 mb-0">₹<?= $total; ?></h3>
                                                       </div>
                                                  </div>
                                             </div>
                                        </div>
                                   </div>
                              </div>
                         </div>
                    </div>
                    <!-- Recent Orders -->
                    <div class="row">
                         <div class="col">
                              <div class="card">
                                   <div class="card-body">
                                        <div class="d-flex align-items-center justify-content-start">
                                             <h4 class="card-title fs-18 fw-bold py-1">Recent Orders</h4>
                                        </div>
                                   </div>
                                   <div class="table-responsive table-centered">
                                        <table class="table mb-0">
                                             <thead class="bg-light bg-opacity-50">
                                                  <tr>
                                                       <th>Date</th>
                                                       <th class="ps-3">Order ID.</th>
                                                       <th>Product</th>
                                                       <th>Customer Name</th>
                                                       <th>Payment Status</th>
                                                       <th>Items</th>
                                                       <th>Total</th>
                                                       <th>Cancellations</th>
                                                       <th>Shipping</th>
                                                  </tr>
                                             </thead>
                                             <tbody>
                                                  <?php
                                                  $sql = "SELECT order_id, product_id, date, user_name, SUM(total_price) AS total_price, status, SUM(quantity) AS quantity, ship_status, order_status FROM orders WHERE date BETWEEN '$currentMonthStart' AND '$currentMonthEnd' GROUP BY order_id ORDER BY date DESC";
                                                  $orders = $obj->fetch($sql);
                                                  foreach ($orders as $val) { 
                                                       $order_id = $val['order_id'];
                                                       $product_id = $val['product_id'];
                                                       $order_status = $val['order_status'];

                                                       $productQuery = "SELECT image_1 FROM products WHERE id = '$product_id'";
                                                       $productResult = $obj->fetch($productQuery);
                                                       if (!empty($productResult)) {
                                                            $productImage = $productResult[0]['image_1'];
                                                       }

                                                       $order_text = "";
                                                       if ($order_status == "Cancellation Approved") {
                                                            $order_text = "Cancelled";
                                                       } elseif ($order_status == "Cancellation Rejected") {
                                                            $order_text = "-";
                                                       } elseif ($order_status == "Request Cancellation") {
                                                            $order_text = "Requested";
                                                       } else {
                                                            $order_text = "";
                                                       }
                                                       $order_style = "";
                                                       if ($order_status == "Cancellation Approved") {
                                                            $order_style = "text-danger fw-bold";
                                                       } elseif ($order_status == "Cancellation Rejected") {
                                                            $order_style = "text-primary fw-bold";
                                                       } elseif ($order_status == "Request Cancellation") {
                                                            $order_style = "text-info fw-bold";
                                                       } else {
                                                            $order_style = "d-none";
                                                       }

                                                       $statusClass = "";
                                                       if ($val['ship_status'] == "In Transit") {
                                                            $statusClass = "text-secondary";
                                                       } elseif ($val['ship_status'] == "Out for Delivery") {
                                                            $statusClass = "text-warning";
                                                       } elseif ($val['ship_status'] == "Completed") {
                                                            $statusClass = "text-success";
                                                       } elseif ($val['ship_status'] == "Pending") {
                                                            $statusClass = "text-danger";
                                                       }

                                                       $payStatus = $val['status'] == "paid" ? "bg-success" : ($val['status'] == "cod" ? "bg-warning" : "");
                                                  ?>
                                                  <tr>
                                                       <td><?= date("d M, Y", strtotime($val['date'])); ?></td>
                                                       <td class="ps-3"><a href="order_details.php?order_id=<?= base64_encode($order_id); ?>">#<?= $val['order_id']; ?></a></td>
                                                       <td><a href="product_details.php?product_id=<?= base64_encode($product_id); ?>"><img src="uploads/products/<?= $productImage; ?>" alt="product-image" class="img-fluid avatar-md rounded"></a></td>
                                                       <td><a href="order_details.php?order_id=<?= base64_encode($order_id); ?>"><?= $val['user_name']; ?></a></td>
                                                       <td><span class="badge <?= $payStatus; ?> text-light px-2 py-1 fs-13"><?= $val['status']; ?></span></td>
                                                       <td><?= $val['quantity']; ?></td>
                                                       <td>₹<?= number_format($val['total_price'], 2); ?></td>
                                                       <td><span class="<?= $order_style; ?> fs-13"><?= $order_text; ?></span></td>
                                                       <td><i class="bx bxs-circle <?= $statusClass; ?> me-1"></i><?= $val['ship_status']; ?></td>
                                                  </tr>
                                                  <?php } ?>
                                             </tbody>
                                        </table>
                                   </div>
                              </div>
                         </div>
                    </div>
               </div>

               <?php include 'footer.php'; ?>
          </div>
     </div>
     <!-- END Wrapper -->

<?php include 'footerlink.php'; ?>