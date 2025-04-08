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
                            <h3 class="page-title">Certificates</h3>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
                                <li class="breadcrumb-item active">Certificates</li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex align-items-center justify-content-between">
                                    <h4 class="card-title">Certificates Table</h4>
                                    <a href="" class="btn btn-sm btn-soft-primary" data-bs-toggle="modal" data-bs-target="#addModal">
                                        <i class="bx bx-plus me-1"></i>Add Certificate
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
                                            <th><a href="javascript:void(0);">Certificate</a></th>
                                            <th><a href="javascript:void(0);">Action</a></th>
                                        </tr>
                                    </thead>
                                    <tbody id="categoryTable">
                                        <?php
                                            $cnt = 0;
                                            $totalCertificates = $obj->fetch("SELECT COUNT(*) AS total FROM certificates")[0]['total'];
                                            $certificates = $obj->fetch("SELECT * FROM certificates ORDER BY id DESC");
                                            foreach ($certificates as $val) { 
                                                $cnt++; 
                                        ?>
                                        <tr>
                                            <td><?php echo $cnt;?></td>
                                            <td><img src="uploads/certificate/<?php echo $val['image']?>" alt="category" class="img-fluid avatar-lg rounded"></td>
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
                                                        <h4 class="modal-title" id="editModalLabel<?php echo $val['id']; ?>">Edit Certificate</h4>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form class="editCertificateForm" enctype="multipart/form-data">
                                                            <input type="hidden" name="certificate_id" value="<?php echo $val['id']; ?>">
                                                            <div class="mb-3">
                                                                <label for="image" class="form-label">Certificate Image</label>
                                                                <input type="file" class="form-control" id="image" name="image">
                                                            </div>
                                                            <div class="mb-3">
                                                                <div class="d-flex align-items-center">
                                                                    <img src="uploads/certificate/<?php echo $val['image']; ?>" alt="Certificate Image" class="img-fluid me-3" style="max-height: 100px; border-radius: 10px;">
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
                                                        <h3 class="modal-title" id="deleteModalLabel<?php echo $val['id']; ?>">Delete Certificate</h3>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body text-center">
                                                        <p>Are you sure you want to delete this certificate?</p>
                                                        <div class="d-flex align-items-center justify-content-center">
                                                            <img src="uploads/certificate/<?php echo $val['image']; ?>" alt="Certificate Image" class="img-fluid me-3" style="max-height: 200px; border-radius: 10px;">
                                                        </div>
                                                        <form class="deleteCertificateForm">
                                                            <input type="hidden" name="certificate_id" value="<?php echo $val['id']; ?>">
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

                            <!-- Add Modal Start -->
                            <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h3 class="modal-title" id="addModalLabel">Add Certificate</h3>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form id="certificateFormAdd">
                                                <div class="mb-3">
                                                    <label for="image" class="form-label">Upload Certificate Image <span style="color:red;">*</span></label>
                                                    <input type="file" class="form-control" id="image" name="image" accept="image/*" required>
                                                </div>
                                            </form>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-primary" id="saveCertificate">Save</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Add Modal End -->

                            <!-- total entries  -->
                            <div class="card-footer border-top">
                                <div class="row g-3">
                                    <div class="col-sm">
                                        <div class="text-muted">
                                            Total <span class="fw-semibold" id="totalCertificates"><?php echo $totalCertificates; ?></span> entries.
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
    // add certificate ajax
    document.getElementById("saveCertificate").addEventListener("click", function() {
        let form = document.getElementById("certificateFormAdd");
        let formData = new FormData(form);
        if (!formData.get("image").name) {
            showToast("Please fill all fields", "error");
            return;
        }
        fetch("add_certificate.php", {
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

    // edit certificate ajax 
    $(document).on("submit", ".editCertificateForm", function (e) {
        e.preventDefault();
        let formData = new FormData(this);
        $.ajax({
            url: "edit_certificate.php",
            type: "POST",
            data: formData,
            processData: false,
            contentType: false,
            success: function (response) {
                let res = JSON.parse(response);
                if (res.status === "success") {
                    Toastify({
                        text: "Certificate updated successfully!",
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

    // delete certificate ajax 
    $(document).ready(function () {
        $(".confirm-delete").click(function () {
            var certificateId = $(this).data("id");
            $.ajax({
                url: "delete_certificate.php",
                type: "POST",
                data: { id: certificateId },
                beforeSend: function () {
                    Toastify({
                        text: "Deleting certificate...",
                        duration: 500,
                        gravity: "top",
                        position: "center",
                        backgroundColor: "#FFA500", 
                    }).showToast();
                },
                success: function (response) {
                    if (response.trim() === "success") {
                        $("#deleteModal" + certificateId).modal("hide");
                        Toastify({
                            text: "Certificate deleted successfully!",
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
                            text: "Error deleting certificate. Try again.",
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
</script>
<?php include 'footerlink.php'; ?>