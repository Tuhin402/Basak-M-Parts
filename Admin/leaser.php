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
                    <div class="page-header my-3 px-2 d-flex align-items-center justify-content-between">
                        <div class="row align-items-center">
                            <div class="col">
                                <h3 class="page-title">Leaser</h3>
                                <ul class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
                                    <li class="breadcrumb-item active">Leaser</li>
                                </ul>
                            </div>
                        </div>
                        <div class="row align-items-center">
                            <a href="javascript:void(0)" id="exportExcel" class="btn btn-sm btn-outline-primary rounded-pill px-3 py-2 fs-14"><i class="bx bx-save"></i> Export</a>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-xl-12">
                            <div class="card">
                                <div class="d-flex card-header justify-content-between align-items-center">
                                    <div><h4 class="card-title">Leaser List</h4></div>
                                    <div class="d-flex align-items-center justify-content-center gap-3">
                                        <a href="" class="btn btn-sm btn-soft-primary" data-bs-toggle="modal" data-bs-target="#dateFilterModal"><i class="bx bx-filter me-1"></i>Filter by Date</a>
                                        <a href="" class="btn btn-sm btn-soft-primary" data-bs-toggle="modal" data-bs-target="#categoryFilterModal"><i class="bx bx-filter me-1"></i>Filter by Category</a>
                                        <a href="" class="btn btn-sm btn-soft-primary" data-bs-toggle="modal" data-bs-target="#companyFilterModal"><i class="bx bx-filter me-1"></i>Filter by Company</a>
                                    </div>
                                </div>
                                <div class="card-body p-0">
                                    <div class="table-responsive">
                                        <table id="leaser_table" class="table align-middle mb-0 table-hover table-centered">
                                            <thead class="bg-light-subtle">
                                                <tr>
                                                    <th class="ps-3">Date</th>
                                                    <th>Product</th>
                                                    <th>Category</th>
                                                    <th>Company</th>
                                                    <th>Rating</th>
                                                    <th>Current Stock</th>
                                                    <th>Total Sell</th>
                                                </tr>
                                            </thead>
                                            <tbody id="leaser">
                                                <?php
                                                $products = $obj->fetch("SELECT * FROM products ORDER BY last_updated DESC");
                                                foreach ($products as $val) { 
                                                    $commonCatId = $val['cat_id'];
                                                    $commonCompId = $val['company_id'];
                                                    $product_id = $val['id'];

                                                    $category = $obj->fetch("SELECT category FROM product_category WHERE id = $commonCatId");
                                                    $cat = isset($category[0]['category']) ? $category[0]['category'] : 'Unknown';

                                                    $company = $obj->fetch("SELECT name FROM company WHERE id = $commonCompId");
                                                    $comp = isset($company[0]['name']) ? $company[0]['name'] : 'Unknown';

                                                    $sql = "SELECT AVG(rating) AS avg_rating FROM product_reviews WHERE product_id = $product_id";
                                                    $result = $obj->fetch($sql);
                                                    $avg_rating = isset($result[0]['avg_rating']) ? round($result[0]['avg_rating'], 1) : 0;

                                                    $online_sql = "SELECT SUM(quantity) AS total_online FROM orders WHERE product_id = $product_id";
                                                    $online_result = $obj->fetch($online_sql);
                                                    $total_online = isset($online_result[0]['total_online']) ? $online_result[0]['total_online'] : 0;

                                                    $offline_sql = "SELECT SUM(qty) AS total_offline FROM offline_sell WHERE pro_id = $product_id";
                                                    $offline_result = $obj->fetch($offline_sql);
                                                    $total_offline = isset($offline_result[0]['total_offline']) ? $offline_result[0]['total_offline'] : 0;

                                                    $total_sell = $total_online + $total_offline;
                                                ?>
                                                <tr>
                                                    <td class="ps-3"><?= date("d M, Y", strtotime($val['last_updated'])); ?></td>
                                                    <td>
                                                        <div class="d-flex align-items-center gap-2">
                                                            <div class="rounded bg-light avatar-md d-flex align-items-center justify-content-center">
                                                                <a href="product_details.php?product_id=<?= base64_encode($product_id); ?>">
                                                                    <img src="uploads/products/<?= $val['image_1'] ?>" alt="Product Image" class="avatar-md rounded">
                                                                </a>
                                                            </div>
                                                            <div>
                                                                <a href="product_details.php?product_id=<?= base64_encode($product_id); ?>" class="text-dark fw-medium fs-15"><?= $val['name'] ?></a>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td><p class="text-muted"><?= $cat ?></p></td>
                                                    <td><p class="text-muted"><?= $comp ?></p></td>
                                                    <td>
                                                        <span class="badge p-1 bg-light text-dark fs-12 me-1"><i class="bx bxs-star align-text-top fs-14 text-warning me-1"></i> <?= $avg_rating ?></span>
                                                    </td>
                                                    <td><p class="text-muted"><?= $val['stock'] ?></p></td>
                                                    <td><p class="text-muted"><?= $total_sell ?></p></td>
                                                  </tr>
                                                <?php } ?>
                                            </tbody>
                                        </table>
                                    </div>

                                    <!-- Date Filter Modal -->
                                    <div class="modal fade" id="dateFilterModal" tabindex="-1" aria-labelledby="dateFilterModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h3 class="modal-title" id="dateFilterModalLabel">Filter by Date</h3>
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
                                    <!-- /Date Filter Modal -->

                                    <!-- Category Filter Modal -->
                                    <div class="modal fade" id="categoryFilterModal" tabindex="-1" aria-labelledby="categoryFilterModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h3 class="modal-title" id="categoryFilterModalLabel">Filter by Category</h3>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <form id="categoryFilterForm">
                                                        <div class="col-lg-12">
                                                            <label for="category" class="form-label">Category <span style="color:red;">*</span></label>
                                                            <select class="form-control" id="category" name="category">
                                                                <option selected disabled>Choose Category</option>
                                                                <?php
                                                                    $sql = "SELECT * FROM product_category ORDER BY id";
                                                                    $cats = $obj->fetch($sql);
                                                                    foreach ($cats as $cat) {
                                                                        echo "<option value='" . $cat['id'] . "'>" . htmlspecialchars($cat['category']) . "</option>";
                                                                    }
                                                                ?>
                                                            </select>
                                                        </div>
                                                    </form>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-primary" id="saveCategory"> See Data </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /Category Filter Modal -->

                                    <!-- Company Filter Modal -->
                                    <div class="modal fade" id="companyFilterModal" tabindex="-1" aria-labelledby="companyFilterModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h3 class="modal-title" id="companyFilterModalLabel">Filter by Company</h3>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <form id="companyFilterForm">
                                                        <div class="col-lg-12">
                                                            <label for="company" class="form-label">Company <span style="color:red;">*</span></label>
                                                            <select class="form-control" id="company" name="company">
                                                                <option selected disabled>Choose Company</option>
                                                                <?php
                                                                    $sql = "SELECT * FROM company ORDER BY id";
                                                                    $comps = $obj->fetch($sql);
                                                                    foreach ($comps as $comp) {
                                                                        echo "<option value='" . $comp['id'] . "'>" . htmlspecialchars($comp['name']) . "</option>";
                                                                    }
                                                                ?>
                                                            </select>
                                                        </div>
                                                    </form>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-primary" id="saveCompany"> See Data </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /Company Filter Modal -->
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
                    url: "filter_leaserByDate.php",
                    type: "POST",
                    data: { startDate: startDate, endDate: endDate },
                    success: function (response) {
                        $("#leaser").html(response);
                        $("#dateFilterModal").modal("hide");
                    }
                });
            }
        });
    });

    // ajax for category filteration
    $(document).ready(function () {
        $("#saveCategory").click(function () {
            var category = $("#category").val();
            if (category) {
                $.ajax({
                    url: "filter_leaserByCategory.php",
                    type: "POST",
                    data: { category: category },
                    success: function (response) {
                        $("#leaser").html(response);
                        $("#categoryFilterModal").modal("hide");
                    }
                });
            }
        });
    });

    // ajax for company filteration
    $(document).ready(function () {
        $("#saveCompany").click(function () {
            var company = $("#company").val();
            if (company) {
                $.ajax({
                    url: "filter_leaserByCompany.php",
                    type: "POST",
                    data: { company: company },
                    success: function (response) {
                        $("#leaser").html(response);
                        $("#companyFilterModal").modal("hide");
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
            let table = document.getElementById("leaser_table"); 
            let wb = XLSX.utils.book_new(); 
            let ws = XLSX.utils.table_to_sheet(table); 
            XLSX.utils.book_append_sheet(wb, ws, "Leaser"); 
            XLSX.writeFile(wb, "Leaser.xlsx");
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