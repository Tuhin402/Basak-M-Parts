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
                                <h3 class="page-title">Offine Sell Reports</h3>
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
                                    <div><h4 class="card-title">Offine Sell List</h4></div>
                                    <a href="javascript:void(0)" id="exportExcel" class="btn btn-sm btn-primary px-2">Export</a>
                                    <a href="" class="btn btn-sm btn-soft-primary" data-bs-toggle="modal" data-bs-target="#filterModal">
                                        <i class="bx bx-filter me-1"></i>Filter by Date
                                    </a>
                                </div>
                                <div class="card-body p-0">
                                    <div class="table-responsive">
                                        <table id="offline_report_table" class="table align-middle mb-0 table-hover table-centered">
                                            <thead class="bg-light-subtle">
                                                <tr>
                                                    <th>Selled at</th>
                                                    <th>Product</th>
                                                    <th>Type</th>
                                                    <th>Price</th>
                                                    <th>Items</th>
                                                    <th>Total</th>
                                                    <th>Payment Status</th>
                                                </tr>
                                            </thead>
                                            <tbody id="offline_report">
                                                <?php
                                                $cnt = 0;
                                                $sells = $obj->fetch("SELECT * FROM offline_sell ORDER BY date DESC");
                                                foreach ($sells as $val) { 
                                                    $cnt++; 
                                                ?>
                                                <tr>
                                                    <td><?= date("d M, Y", strtotime($val['date'])); ?></td>
                                                    <td><?= $val['name']; ?></td>
                                                    <td><?= $val['type']; ?></td>
                                                    <td>₹<?= number_format($val['price'], 2); ?></td>
                                                    <td><?= $val['qty']; ?></td>
                                                    <td>₹<?= number_format($val['totalprice'], 2); ?></td>
                                                    <td><span class="badge border border-success text-success px-2 py-1 fs-13">Paid</span></td>
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
                    url: "filter_offline_report.php",
                    type: "POST",
                    data: { startDate: startDate, endDate: endDate },
                    success: function (response) {
                        $("#offline_report").html(response); 
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
            let table = document.getElementById("offline_report_table"); 
            let wb = XLSX.utils.book_new(); 
            let ws = XLSX.utils.table_to_sheet(table); 
            XLSX.utils.book_append_sheet(wb, ws, "Offline_Report"); 
            XLSX.writeFile(wb, "Offline_Report.xlsx");
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