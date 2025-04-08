<?php
include 'session_config.php';
if(empty($_SESSION['user_email'])){
    echo '<script>window.location.href="login.php"</script>';
}
include "config.php";
include 'headerlink.php';

$order_id = isset($_GET['order_id']) ? base64_decode($_GET['order_id']) : null;
if (!$order_id) {
    die("Invalid order ID"); 
}
$sql = "SELECT o.user_name, o.user_email, o.address, o.user_mobile, o.price, SUM(o.total_price) AS total_price, o.date, o.status, o.ship_status, o.order_status, o.refund_status, o.shiprocket_order_id, o.razorpay_order_id 
        FROM orders o WHERE o.order_id = '$order_id' GROUP BY o.order_id";

$orderDetails = $obj->fetch($sql);

if (!$orderDetails) {
    die("Order not found!"); 
}

$user_name = $orderDetails[0]['user_name'];
$user_email = $orderDetails[0]['user_email'];
$user_address = $orderDetails[0]['address'];
$user_mobile = $orderDetails[0]['user_mobile'];
$price = $orderDetails[0]['price'];
$total_price = $orderDetails[0]['total_price'];
$date = $orderDetails[0]['date'];

$shiprocket_order_id = $orderDetails[0]['shiprocket_order_id'];

$status = $orderDetails[0]['status'];
$ship_status = $orderDetails[0]['ship_status'];
$order_status = $orderDetails[0]['order_status'];
$refund_status = $orderDetails[0]['refund_status'];

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
         $order_text = "Order Returned";
    } elseif ($status == "Return Rejected") {
         $order_text = "Return Rejected";
    } elseif ($status == "Request Return") {
         $order_text = "Requested for Return";
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
         $order_text = "Order Cancelled";
    } elseif ($status == "Cancellation Rejected") {
         $order_text = "Cancellation Rejected";
    } elseif ($status == "Request Cancellation") {
         $order_text = "Requested for Cancellation";
    } else {
         $order_text = "";
    }
}

$statusClass = "";
if ($ship_status == "In Transit") {
     $statusClass = "border-secondary text-secondary";
} elseif ($ship_status == "Out for Delivery") {
     $statusClass = "border-warning text-warning";
} elseif ($ship_status == "Completed") {
     $statusClass = "border-success text-success";
} elseif ($ship_status == "Pending") {
     $statusClass = "border-danger text-danger";
}

$razorpay_order_id = $orderDetails[0]['razorpay_order_id'];

$payStatus = $status == "paid" ? "bg-success-subtle text-success" : ($status == "cod" ? "bg-warning-subtle text-warning" : "");

$formatted_date = date("F j, Y \a\\t g:i a", strtotime($date));

$productQuery = "SELECT o.product_id, o.quantity, o.price, p.name AS product_name, p.image_1, (SELECT COUNT(*) FROM orders WHERE order_id = '$order_id') AS qty FROM orders o JOIN products p ON o.product_id = p.id WHERE o.order_id = '$order_id'";
$productDetails = $obj->fetch($productQuery);
$qty = $productDetails[0]['qty'];
?>

<body>
     <div class="wrapper">

          <?php include 'header.php'; ?>
          <?php include 'sidebar.php'; ?>

          <div class="page-content">

               <div class="container-xxl">
                    <div class="row">
                         <div class="col-xl-8 col-lg-8">
                              <div class="row">
                                   <div class="col-lg-12">
                                        <div class="card">
                                             <div class="card-body">
                                                  <div class="d-flex flex-wrap align-items-center justify-content-between gap-2">
                                                       <div>
                                                            <h4 class="fw-medium text-dark d-flex align-items-center gap-2">#<?= $order_id ?> <span class="badge <?= $payStatus; ?>  px-2 py-1 fs-13"><?= $status ?></span><span class="border <?= $statusClass ?> fs-13 px-2 py-1 rounded"><?= $ship_status ?></span></h4>
                                                            <p class="mb-1">Orders // Order Details // #<?= $order_id ?> - <?= $formatted_date ?></p>
                                                            <span class="mb-0 <?= $order_style; ?> fs-13"><iconify-icon icon="bi:info-circle" class="align-middle fs-14 me-1"></iconify-icon><?= $order_text; ?></span>
                                                            <?php if (!in_array($order_status, ['Request Cancellation', 'Cancellation Approved']) && !in_array($refund_status, ['Request Return', 'Return Approved']) && $ship_status === 'Out for Delivery') { ?>
                                                                <button class="btn btn-soft-info fw-medium px-3 py-2 rounded-pill mt-2 mark-status" data-new-status="In Transit" data-order-id="<?= $order_id ?>" data-shiprocket-order-id="<?= $shiprocket_order_id ?>">
                                                                    <span>Mark as - <strong>In Transit</strong></span>
                                                                </button>
                                                            <?php } elseif ($ship_status === "In Transit") { ?>
                                                                <button class="btn btn-soft-success fw-medium px-3 py-2 rounded-pill mt-2 mark-status" data-new-status="Completed" data-order-id="<?= $order_id ?>" data-shiprocket-order-id="<?= $shiprocket_order_id ?>">
                                                                    <span>Mark as - <strong>Completed</strong></span>
                                                                </button>
                                                            <?php } ?>
                                                       </div>
                                                  </div>
                                             </div>
                                             <?php if (!in_array($order_status, ['Request Cancellation', 'Cancellation Approved']) && !in_array($refund_status, ['Request Return', 'Return Approved']) && $ship_status == 'Pending') { ?>
                                             <div class="card-footer d-flex flex-wrap align-items-center justify-content-end bg-light-subtle">
                                                  <div><a href="javascript:void(0)" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#dispatchModal">Dispatch Order</a></div>
                                             </div>
                                             <?php } ?>
                                        </div>
                                        <!-- product details -->
                                        <div class="card">
                                             <div class="card-header">
                                                  <h4 class="card-title">Product Details</h4>
                                             </div>
                                             <div class="card-body">
                                                  <div class="table-responsive">
                                                       <table class="table align-middle mb-0 table-hover table-centered">
                                                            <thead class="bg-light-subtle border-bottom">
                                                                 <tr>
                                                                      <th>Product Name</th>
                                                                      <th>Status</th>
                                                                      <th>Quantity</th>
                                                                      <th>Price</th>
                                                                      <th>Amount</th>
                                                                 </tr>
                                                            </thead>
                                                            <tbody>
                                                                 <?php foreach ($productDetails as $product) { ?>
                                                                 <tr>
                                                                      <td>
                                                                           <div class="d-flex align-items-center gap-2">
                                                                                <div class="rounded bg-light avatar-md d-flex align-items-center justify-content-center">
                                                                                     <img src="uploads/products/<?= $product['image_1']; ?>" alt="Product Image" class="avatar-md rounded">
                                                                                </div>
                                                                                <div>
                                                                                     <a href="javascript:void(0)" class="text-dark fw-medium fs-15"><?= $product['product_name']; ?></a>
                                                                                </div>
                                                                           </div>
                                                                      </td>
                                                                      <td><span class="badge bg-success-subtle text-success  px-2 py-1 fs-13">Ready</span></td>
                                                                      <td><?= $product['quantity']; ?></td>
                                                                      <td>₹<?= number_format($product['price'], 2); ?></td>
                                                                      <td>₹<?= number_format($product['price'] * $product['quantity'], 2); ?></td>
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
                         <div class="col-xl-4 col-lg-4">
                              <div class="card">
                                   <div class="card-header">
                                        <h4 class="card-title fw-bold">Payment Information</h4>
                                   </div>
                                   <div class="card-body">
                                        <div class="d-flex align-items-center gap-3 mb-3">
                                             <div>
                                                  <?php if($status == 'paid') { ?>
                                                  <p class="mb-0 text-dark">Online Payment</p>
                                                  <?php } else { ?>
                                                  <p class="mb-0 text-dark">Cash on Delivery</p>
                                                  <?php } ?>
                                             </div>
                                             <div class="ms-auto">
                                                  <iconify-icon icon="solar:check-circle-broken" class="fs-22 text-success"></iconify-icon>
                                             </div>
                                        </div>
                                        <p class="text-dark mb-1 fw-medium">Total Amount : <span class="text-muted fw-normal fs-13"> ₹<?= $total_price ?></span></p>
                                        <p class="text-dark mb-1 fw-medium">Transaction ID : <span class="text-muted fw-normal fs-13"> <?= $razorpay_order_id? $razorpay_order_id : "N/A" ?></span></p>
                                        <p class="text-dark mb-0 fw-medium">Card Holder Name : <span class="text-muted fw-normal fs-13"> <?= $user_name ?></span></p>

                                   </div>
                              </div>
                              <div class="card">
                                   <div class="card-header">
                                        <h4 class="card-title fw-bold">Customer Details</h4>
                                   </div>
                                   <div class="card-body">
                                        <div class="d-flex align-items-center">
                                             <div>
                                                  <p class="mb-1 fw-semibold"><?= $user_name ?></p>
                                                  <a href="mailto:<?= $user_email ?>" class="link-primary fw-medium"><?= $user_email ?></a>
                                             </div>
                                        </div>
                                        <div class="d-flex justify-content-between mt-3">
                                             <h5 class="fw-semibold">Contact Number</h5>
                                        </div>
                                        <a href="tel:<?= $user_mobile ?>" class="link-primary fw-medium mb-1"><?= $user_mobile ?></a>

                                        <div class="d-flex justify-content-between mt-3">
                                             <h5 class="fw-semibold">Shipping Address</h5>
                                        </div>
                                        <div>
                                             <p class="mb-1"><?= $user_address ?></p>
                                        </div>
                                   </div>
                              </div>
                         </div>
                    </div>

                    <!-- dispatch modal -->
                    <div class="modal fade" id="dispatchModal" tabindex="-1" aria-labelledby="dispatchModalLabel" aria-hidden="true">
                         <div class="modal-dialog modal-dialog-centered">
                              <div class="modal-content border-0 shadow">
                                   <div class="modal-header">
                                        <h5 class="modal-title" id="dispatchModalLabel">Choose Dispatch Method</h5>
                                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                                   </div>
                                   <div class="modal-body p-4">
                                        <div class="row g-2">
                                             <div class="col-lg-12">
                                                  <button type="button" class="btn btn-soft-primary fw-bold px-3 py-2 fs-18 rounded-pill w-100" id="viaShiprocketBtn">
                                                       <span class="bi bi-rocket me-2"></span>via Shiprocket
                                                  </button>
                                             </div>
                                             <div class="col-lg-12">
                                                  <button type="button" class="btn btn-outline-secondary fw-bold px-3 py-2 fs-18 rounded-pill w-100" data-bs-dismiss="modal" data-bs-toggle="modal" data-bs-target="#othersModal">
                                                       <span class="bi bi-three-dots me-2"></span>via Others
                                                  </button>
                                             </div>
                                        </div>
                                   </div>
                              </div>
                         </div>
                    </div>
                    <!-- /dispatch modal -->

                    <!-- dispatch others modal -->
                    <div class="modal fade" id="othersModal" tabindex="-1" aria-labelledby="othersModalLabel" aria-hidden="true">
                         <div class="modal-dialog modal-dialog-centered">
                              <div class="modal-content border-0 shadow">
                                   <div class="modal-header">
                                        <h5 class="modal-title" id="othersModalLabel">Other Dispatch Details</h5>
                                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                                   </div>
                                   <div class="modal-body p-4">
                                        <form id="othersDispatchForm">
                                             <h4 class="mb-3 text-center p-3 bg-light rounded text-wrap">Add Necessary Details</h4>
                                             <div class="row g-2">
                                                  <input type="hidden" name="order_id" value="<?= $order_id; ?>">
                                                  <input type="hidden" name="shiprocket_order_id" value="<?= $shiprocket_order_id; ?>">
                                                  <div class="col-lg-12">
                                                       <div class="form-group mb-2">
                                                            <label for="confinementId" class="form-label">Consignment ID*</label>
                                                            <input type="text" class="form-control" id="confinementId" name="confinementId" placeholder="Enter Consignment ID" required>
                                                       </div>
                                                  </div>
                                                  <div class="col-lg-12">
                                                       <div class="form-group mb-2">
                                                            <label for="trackingLink" class="form-label">Tracking Link*</label>
                                                            <input type="url" class="form-control" id="trackingLink" name="trackingLink" placeholder="Enter Tracking Link" required>
                                                       </div>
                                                  </div>
                                                  <div class="col-lg-12">
                                                       <div class="alert alert-warning d-flex align-items-center text-wrap" role="alert">
                                                            <span class="bi bi-info-circle me-2"></span>Please fill in the details for dispatch via other providers.
                                                       </div>
                                                  </div>
                                                  <div class="col-lg-12">
                                                       <button type="submit" class="btn btn-outline-primary px-3 py-2 fw-bold rounded-pill float-end fs-16"><span class="bi bi-check me-1"></span>Submit</button>
                                                  </div>
                                             </div>
                                        </form>
                                   </div>
                              </div>
                         </div>
                    </div>
                    <!-- /dispatch others modal -->

               </div>

               <?php include 'footer.php'; ?>
          </div>
     </div>



<!-- All necessary scripts are in here -->
<script>
     // ajax submission for other method
     $(document).ready(function () {
          $("#othersDispatchForm").submit(function (e) {
               e.preventDefault(); 
               let formData = $(this).serialize(); 
               $.ajax({
                    type: "POST",
                    url: "process_other_dispatch.php", 
                    data: formData,
                    dataType: "json",
                    beforeSend: function () {
                         Toastify({
                              text: "Processing request...",
                              duration: 700,
                              gravity: "top",
                              position: "center",
                              backgroundColor: "#007bff",
                         }).showToast();
                    },
                    success: function (response) {
                         if (response.success) {
                              Toastify({
                                   text: response.message,
                                   duration: 3000,
                                   gravity: "top",
                                   position: "center",
                                   backgroundColor: "#28a745",
                              }).showToast();
                              setTimeout(() => {
                                   window.location.reload();
                              }, 1500);
                         } else {
                              Toastify({
                                   text: response.message,
                                   duration: 3000,
                                   gravity: "top",
                                   position: "center",
                                   backgroundColor: "#dc3545",
                              }).showToast();
                         }
                    },
                    error: function () {
                         Toastify({
                              text: "An error occurred. Please try again.",
                              duration: 3000,
                              gravity: "top",
                              position: "center",
                              backgroundColor: "#dc3545",
                         }).showToast();
                    },
               });
          });
     });

     // ajax for shiprocket order
     $(document).ready(function () {
          $("#viaShiprocketBtn").click(function() {
               let orderId = "<?= $order_id ?>";
               let shiprocketOrderId = "<?= $shiprocket_order_id ?>";  
               $.ajax({
                    type: "POST",
                    url: "process_shiprocket_dispatch.php", 
                    data: { order_id: orderId, shiprocket_order_id: shiprocketOrderId },
                    dataType: "json",
                    beforeSend: function () {
                         Toastify({
                              text: "Dispatching order via Shiprocket...",
                              duration: 700,
                              gravity: "top",
                              position: "center",
                              backgroundColor: "#007bff",
                         }).showToast();
                    },
                    success: function (response) {
                         if(response.success) {
                              Toastify({
                                   text: response.message,
                                   duration: 4000,
                                   gravity: "top",
                                   position: "center",
                                   backgroundColor: "#28a745",
                              }).showToast();
                              setTimeout(() => {
                                   window.location.reload();
                              }, 1500);
                         } else {
                              Toastify({
                                   text: response.message,
                                   duration: 4000,
                                   gravity: "top",
                                   position: "center",
                                   backgroundColor: "#dc3545",
                              }).showToast();
                         }
                    },
                    error: function () {
                         Toastify({
                              text: "An error occurred while dispatching order.",
                              duration: 4000,
                              gravity: "top",
                              position: "center",
                              backgroundColor: "#dc3545",
                              stopOnFocus: true,
                         }).showToast();
                    }
               });
          });
     });
     
    //  ajax for updating ship status
    document.querySelectorAll('.mark-status').forEach(button => {
        button.addEventListener('click', function() {
            const newStatus = this.getAttribute('data-new-status');
            const orderId = this.getAttribute('data-order-id');
            const shiprocketOrderId = this.getAttribute('data-shiprocket-order-id');
            fetch('update_ship_status.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({
                    order_id: orderId,
                    shiprocket_order_id: shiprocketOrderId,
                    new_status: newStatus
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    Toastify({
                        text: data.message,
                        duration: 2000,
                        gravity: "top",
                        position: "center",
                        backgroundColor: "#28a745"
                    }).showToast();
                    setTimeout(() => {
                       window.location.reload();
                    }, 1500);
                } else {
                    Toastify({
                        text: data.message,
                        duration: 2000,
                        gravity: "top",
                        position: "center",
                        backgroundColor: "#dc3545"
                    }).showToast();
                }
            })
            .catch(error => console.error('Error updating ship status:', error));
        });
    });
</script>
<?php include 'footerlink.php'; ?>