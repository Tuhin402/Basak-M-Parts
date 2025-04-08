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

        <div class="page-content">

            <div class="container-fluid">
                <!-- Page Header -->
                <div class="page-header my-3">
                    <div class="row align-items-center">
                        <div class="col">
                            <h3 class="page-title">Listed Companies</h3>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
                                <li class="breadcrumb-item">Category</li>
                                <li class="breadcrumb-item active">Companies</li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex align-items-center justify-content-between">
                                    <h4 class="card-title">Companies Table</h4>
                                    <button type="button" class="btn btn-sm btn-outline-primary rounded-pill fw-bold" data-bs-toggle="modal" data-bs-target="#sortModal">
                                        Sort Companies
                                    </button>
                                    <a href="" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#addModal">
                                        <i class="bx bx-plus me-1"></i>Add Company
                                    </a>
                                </div>
                            </div>
                            <!--Table start
                            ======================-->
                            <div class="table-responsive table-centered">
                                <table class="table mb-0 table-hover">
                                    <thead class="bg-light bg-opacity-50">
                                        <tr>
                                            <th><a href="javascript:void(0);">#</a></th>
                                            <th><a href="javascript:void(0);">Company Name</a></th>
                                            <th><a href="javascript:void(0);">Image</a></th>
                                            <th><a href="javascript:void(0);">Action</a></th>
                                        </tr>
                                    </thead>
                                    <tbody id="companyTable">
                                        <?php
                                            $cnt = 0;
                                            $totalCompanies = $obj->fetch("SELECT COUNT(*) AS total FROM company")[0]['total'];
                                            $companies = $obj->fetch("SELECT * FROM company ORDER BY sort_order ASC");
                                            foreach ($companies as $val) { 
                                                $cnt++; 
                                        ?>
                                        <tr data-id="<?= $val['id'] ?>">
                                            <td><?php echo $cnt;?></td>
                                            <td><?php echo $val['name'] ?></td>
                                            <td><img src="uploads/company/<?php echo $val['image']?>" alt="company" class="img-fluid avatar-lg rounded"></td>
                                            <td>
                                                <button class="btn btn-sm btn-soft-primary edit-btn" data-bs-toggle="modal" data-bs-target="#editModal<?php echo $val['id']; ?>">
                                                    <iconify-icon icon="solar:pen-2-broken" class="align-middle fs-18"></iconify-icon> Edit
                                                </button>
                                                <button class="btn btn-sm btn-soft-danger delete-btn" data-bs-toggle="modal" data-bs-target="#deleteModal<?php echo $val['id']; ?>">
                                                    <iconify-icon icon="solar:trash-bin-minimalistic-2-broken" class="align-middle fs-18"></iconify-icon> Delete
                                                </button>
                                            </td>
                                        </tr>

                                        <!-- edit modal start  -->
                                        <div class="modal fade" id="editModal<?php echo $val['id']; ?>" tabindex="-1" aria-labelledby="editModalLabel<?php echo $val['id']; ?>" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content">
                                                    <div class="modal-header bg-light">
                                                        <h4 class="modal-title" id="editModalLabel<?php echo $val['id']; ?>">Edit Company</h4>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form class="editCompanyForm" enctype="multipart/form-data">
                                                            <input type="hidden" name="company_id" value="<?php echo $val['id']; ?>">
                                                            <div class="mb-3">
                                                                <label for="companyName" class="form-label">Company Name <span style="color:red;">*</span></label>
                                                                <input type="text" class="form-control" id="companyName" name="company_name" value="<?php echo $val['name']; ?>">
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="companyImage" class="form-label">Company Image <span style="color:red;">*</span></label>
                                                                <input type="file" class="form-control" id="companyImage" name="company_image">
                                                            </div>
                                                            <div class="mb-3">
                                                                <div class="d-flex align-items-center">
                                                                    <img src="uploads/company/<?php echo $val['image']; ?>" alt="Company Image" class="img-fluid me-3" style="max-height: 100px; border-radius: 10px;">
                                                                </div>
                                                            </div>
                                                            <button type="submit" class="btn btn-soft-primary float-end p-2"><i class="bx bx-refresh me-1"></i>Update</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- edit modal end -->

                                        <!-- delete modal start -->
                                        <div class="modal fade" id="deleteModal<?php echo $val['id']; ?>" tabindex="-1" aria-labelledby="deleteModalLabel<?php echo $val['id']; ?>" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h3 class="modal-title" id="deleteModalLabel<?php echo $val['id']; ?>">Delete Company</h3>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body text-center">
                                                        <p>Are you sure you want to delete this company?</p>
                                                        <p><strong><?php echo $val['name']; ?></strong></p>
                                                        <form class="deleteCompanyForm">
                                                            <input type="hidden" name="company_id" value="<?php echo $val['id']; ?>">
                                                        </form>
                                                    </div>
                                                    <div class="modal-footer d-flex justify-content-center">
                                                        <button type="button" class="btn btn-soft-secondary" data-bs-dismiss="modal">Cancel</button>
                                                        <button type="button" class="btn btn-soft-danger confirm-delete" data-id="<?php echo $val['id']; ?>"><i class="bx bx-trash me-1"></i>Delete</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- delete modal end -->
                                         
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>

                            <!-- Add Company Modal Start -->
                            <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h3 class="modal-title" id="addModalLabel">Add Company</h3>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form id="companyForm">
                                                <div class="mb-3">
                                                    <label for="companyName" class="form-label">Company Name <span style="color:red;">*</span></label>
                                                    <input type="text" class="form-control" id="companyName" name="companyName" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="companyImage" class="form-label">Upload Image <span style="color:red;">*</span></label>
                                                    <input type="file" class="form-control" id="companyImage" name="companyImage" accept="image/*" required>
                                                </div>
                                            </form>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-primary" id="saveCompany">Save</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Add company Modal End -->

                            <!-- sort modal -->
                            <div class="modal fade" id="sortModal" tabindex="-1" aria-labelledby="sortModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h3 class="modal-title" id="sortModalLabel">Sort Companies</h3>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <ul id="sortList" class="list-group">
                                                <?php
                                                foreach ($companies as $val) {
                                                ?>
                                                <li class="list-group-item" data-id="<?= $val['id'] ?>" draggable="true"><?= $val['name'] ?></li>
                                                <?php } ?>
                                            </ul>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" id="saveSortOrder" class="btn btn-outline-primary fw-bold px-3 py-2 rounded-pill">Save Order</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /sort modal -->

                            <!-- total entries  -->
                            <div class="card-footer border-top">
                                <div class="row g-3">
                                    <div class="col-sm">
                                        <div class="text-muted">
                                            Total <span class="fw-semibold" id="totalCompanies"><?php echo $totalCompanies; ?></span> entries.
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- total entries  -->
                        </div>
                    </div>
                </div>
            </div>

            <?php include 'footer.php'; ?>
        </div>
    </div>

<!-- All necessary scripts are in here -->
<script>
    // add company ajax
    document.getElementById("saveCompany").addEventListener("click", function() {
        let form = document.getElementById("companyForm");
        let formData = new FormData(form);
        if (!formData.get("companyName") || !formData.get("companyImage").name) {
            showToast("Please fill all fields", "error");
            return;
        }
        fetch("add_company.php", {
            method: "POST",
            body: formData
        })
        .then(res => res.json())
        .then(data => {
            showToast(data.message, data.status);
            if (data.status === "success") {
                form.reset();
                setTimeout(() => {
                    window.location.reload();
                }, 1000);
            }
        })
        .catch(() => showToast("Server error occurred", "error"));
    });
    function showToast(msg, type) {
        Toastify({ text: msg, duration: 2000, gravity: "top", position: "center", backgroundColor: type === "success" ? "green" : "red" }).showToast();
    }

    // edit company ajax 
    $(document).on("submit", ".editCompanyForm", function (e) {
        e.preventDefault();
        let formData = new FormData(this);
        $.ajax({
            url: "edit_company.php",
            type: "POST",
            data: formData,
            processData: false,
            contentType: false,
            success: function (response) {
                let res = JSON.parse(response);
                if (res.status === "success") {
                    Toastify({
                        text: "Company updated successfully!",
                        duration: 3000,
                        gravity: "top",
                        position: "center",
                        backgroundColor: "green",
                    }).showToast();
                    setTimeout(() => {
                        window.location.reload();
                    }, 1000);
                } else {
                    Toastify({
                        text: res.message,
                        duration: 2000,
                        gravity: "top",
                        position: "center",
                        backgroundColor: "red",
                    }).showToast();
                }
            },
            error: function () {
                Toastify({
                    text: "Something went wrong!",
                    duration: 2000,
                    gravity: "top",
                    position: "center",
                    backgroundColor: "red",
                }).showToast();
            },
        });
    });

    // delete company ajax 
    $(document).ready(function () {
        $(".confirm-delete").click(function () {
            var companyId = $(this).data("id");
            $.ajax({
                url: "delete_company.php",
                type: "POST",
                data: { id: companyId },
                beforeSend: function () {
                    Toastify({
                        text: "Deleting company...",
                        duration: 500,
                        gravity: "top",
                        position: "center",
                        backgroundColor: "#FFA500", 
                    }).showToast();
                },
                success: function (response) {
                    if (response.trim() === "success") {
                        $("#deleteModal" + companyId).modal("hide");
                        Toastify({
                            text: "Company deleted successfully!",
                            duration: 2000,
                            gravity: "top",
                            position: "center",
                            backgroundColor: "#28a745", 
                        }).showToast();
                        setTimeout(() => {
                            location.reload();
                        }, 1000);
                    } else {
                        Toastify({
                            text: "Error deleting company. Try again.",
                            duration: 2000,
                            gravity: "top",
                            position: "center",
                            backgroundColor: "#dc3545",
                        }).showToast();
                    }
                }
            });
        });
    });

    // sorting companies
    const sortList = document.getElementById('sortList');
    let draggedItem = null;
    sortList.addEventListener('dragstart', function(e) {
        draggedItem = e.target;
        e.target.classList.add('dragging');
    });
    sortList.addEventListener('dragover', function(e) {
        e.preventDefault();
        const target = e.target;
        if (target && target !== draggedItem && target.nodeName === 'LI') {
            target.classList.add('drag-over');
        }
    });
    sortList.addEventListener('dragleave', function(e) {
    e.target.classList.remove('drag-over');
    });
    sortList.addEventListener('drop', function(e) {
    e.preventDefault();
    if (e.target && e.target.nodeName === 'LI' && e.target !== draggedItem) {
        const rect = e.target.getBoundingClientRect();
        const offset = e.clientY - rect.top;
        if (offset > rect.height / 2) {
            e.target.parentNode.insertBefore(draggedItem, e.target.nextSibling);
        } else {
            e.target.parentNode.insertBefore(draggedItem, e.target);
        }
        e.target.classList.remove('drag-over');
    }
    });
    sortList.addEventListener('dragend', function(e) {
        e.target.classList.remove('dragging');
    });
    document.getElementById('saveSortOrder').addEventListener('click', function() {
    let order = [];
    const items = sortList.querySelectorAll('li');
    items.forEach(item => {
        order.push(item.getAttribute('data-id'));
    });
        fetch('update_company_order.php', {
            method: 'POST',
            headers: {
            'Content-Type': 'application/json'
            },
            body: JSON.stringify({ order: order })
        })
        .then(response => response.json())
        .then(data => {
            if(data.status === "success") {
                Toastify({
                    text: "Sorting order updated successfully!",
                    duration: 3000,
                    gravity: "top",
                    position: "center",
                    backgroundColor: "#28a745"
                }).showToast();
                setTimeout(() => {
                    location.reload();
                }, 1000);
            } else {
                Toastify({
                    text: "Failed to update order.",
                    duration: 3000,
                    gravity: "top",
                    position: "center",
                    backgroundColor: "#dc3545"
                }).showToast();
            }
        })
        .catch(err => {
            Toastify({
            text: "Error updating order.",
            duration: 3000,
            gravity: "top",
            position: "center",
            backgroundColor: "#dc3545"
            }).showToast();
        });
    });
</script>
<?php include 'footerlink.php'; ?>