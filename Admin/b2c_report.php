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

        <!-- Start Content here -->
        <!-- ==================================================== -->
        <div>
            <div class="page-content">
                
                <div class="container-xxl">
                    <!-- Page Header -->
                    <div class="page-header my-3">
                        <div class="row align-items-center">
                            <div class="col">
                                <h3 class="page-title">B2C Reports</h3>
                                <ul class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
                                    <li class="breadcrumb-item">Reports</li>
                                    <li class="breadcrumb-item active">Order Reports</li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-xl-12">
                            <div class="card">
                                <div class="d-flex card-header justify-content-between align-items-center">
                                    <div><h4 class="card-title">B2C Order List</h4></div>
                                    <a href="javascript:void(0)" id="exportExcel" class="btn btn-sm btn-primary px-2">Export</a>
                                    <a href="" class="btn btn-sm btn-soft-primary" data-bs-toggle="modal" data-bs-target="#filterModal">
                                        <i class="bx bx-filter me-1"></i>Filter by Date
                                    </a>
                                </div>
                                <div class="card-body p-0">
                                    <div class="table-responsive">
                                        <table id="b2c_report_table" class="table align-middle mb-0 table-hover table-centered">
                                            <thead class="bg-light-subtle">
                                                <tr>
                                                    <th>Order ID</th>
                                                    <th>Created at</th>
                                                    <th>Customer</th>
                                                    <th>Total</th>
                                                    <th>Payment Status</th>
                                                    <th>Items</th>
                                                    <th>Order Status</th>
                                                </tr>
                                            </thead>
                                            <tbody id="b2c_report">
                                                <?php
                                                $cnt = 0;
                                                $orders = $obj->fetch("SELECT o.order_id, o.date, o.user_name, SUM(o.total_price) AS total_price, o.status, SUM(o.quantity) AS quantity, o.ship_status FROM orders o JOIN products p ON o.price = p.b2c_price GROUP BY o.order_id ORDER BY o.date DESC");
                                                foreach ($orders as $val) { 
                                                    $order_id = $val['order_id'];
                                                    
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
                                                    $cnt++; 
                                                ?>
                                                <tr>
                                                    <td>#<?= $val['order_id']; ?></td>
                                                    <td><?= date("d M, Y", strtotime($val['date'])); ?></td>
                                                    <td><a href="javascript:void(0)" class="link-primary fw-medium"><?= $val['user_name']; ?></a></td>
                                                    <td>₹<?= number_format($val['total_price'], 2); ?></td>
                                                    <td><span class="badge bg-success text-light px-2 py-1 fs-13"><?= $val['status']; ?></span></td>
                                                    <td><?= $val['quantity']; ?></td>
                                                    <td><span class="badge border border-danger text-danger  px-2 py-1 fs-13">Pending</span></td>
                                                </tr>
                                                <?php } ?>
                                            </tbody>
                                        </table>
                                    </div>

                                    <!-- Filter Modal -->
                                    <div class="modal fade" id="filterModal" tabindex="-1" aria-labelledby="filterModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h3 class="modal-title" id="filterModalLabel">Filter by Date</h3>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <form id="filterForm">
                                                        <div class="mb-3">
                                                            <label for="startDate" class="form-label">Start Date <span style="color:red;">*</span></label>
                                                            <input type="date" class="form-control" id="startDate" name="startDate" required>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="endDate" class="form-label">End Date <span style="color:red;">*</span></label>
                                                            <input type="date" class="form-control" id="endDate" name="endDate" required>
                                                        </div>
                                                    </form>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-primary" id="saveDate"> See Data </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /Filter Modal -->
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

     
<!-- All necessary scripts are in here -->
<script>
    // ajax for date filteration
    $(document).ready(function () {
        $("#saveDate").click(function () {
            var startDate = $("#startDate").val();
            var endDate = $("#endDate").val();
            if (startDate && endDate) {
                $.ajax({
                    url: "filter_b2c_report.php",
                    type: "POST",
                    data: { startDate: startDate, endDate: endDate },
                    success: function (response) {
                        $("#b2c_report").html(response); 
                        $("#filterModal").modal("hide"); 
                    }
                });
            }
        });
    });

    // script for excel download
    document.getElementById("exportExcel").addEventListener("click", function () {
        Toastify({
            text: "Download will start soon...",
            duration: 500,
            gravity: "top",
            position: "center",
            backgroundColor: "#007bff"
        }).showToast();
        try {
            let table = document.getElementById("b2c_report_table"); 
            let wb = XLSX.utils.book_new(); 
            let ws = XLSX.utils.table_to_sheet(table); 
            XLSX.utils.book_append_sheet(wb, ws, "B2C_Report"); 
            XLSX.writeFile(wb, "B2C_Report.xlsx");
            Toastify({
                text: "Download successful!",
                duration: 3000,
                gravity: "top",
                position: "center",
                backgroundColor: "green"
            }).showToast();
        } catch (error) {
            Toastify({
                text: "Download failed! Try again.",
                duration: 3000,
                gravity: "top",
                position: "center",
                backgroundColor: "red"
            }).showToast();
            console.error("Export Error:", error);
        }
    });
</script>
<?php include 'footerlink.php'; ?>